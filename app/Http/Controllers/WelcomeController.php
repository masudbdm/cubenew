<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Log;
use App\Models\Category;
use App\Models\CustomerDetail;
use App\Models\Menu;
use App\Models\MenuPage;
use App\Models\Page;
use App\Models\Post;
use App\Models\ProjectLocation;
use App\Models\SubCategory;
use App\Models\Team;
use App\Models\PostCategory;
use App\Models\WebsiteParameter;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\ContactMessageMail;
use Illuminate\Support\Facades\Mail;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Laravel\Ui\Presets\React;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class WelcomeController extends Controller
{

    public function welcome()
    {
        $categoriesPost = Cache::remember('home_categories_post', now()->addDays(7), function () {
            return Category::whereHas('posts')
                ->orderBy('drag_id')
                ->with('posts.location')
                ->get();
        });

        $categories = Cache::remember('home_categories', now()->addDays(7), function () {
            return Category::orderBy('drag_id')->get();
        });

        $postCategories = Cache::remember('home_post_categories', now()->addDays(7), function () {
            return PostCategory::all();
        });

        $posts = Cache::remember('home_posts_masonry_32', now()->addDays(7), function () {
            return Post::query()
                ->where('publish_status', 'published')
                ->where('front_slider', true)
                ->with([
                    'location:id,title',
                    'categories:id,name',
                ])
                ->orderByRaw('drag_id IS NULL, drag_id ASC')
                ->orderBy('id', 'desc')
                ->limit(32)
                ->get();
        });

        $pages = Cache::remember('home_pages', now()->addDays(7), function () {
            return Page::orderBy('drag_id')->get();
        });

        $featured_teams = Cache::remember('featured_teams', now()->addDays(7), function () {
                return Team::where('status', 1)
                    ->where('featured', 1)
                    ->orderByRaw('drag_id IS NULL, drag_id ASC')
                    ->limit(4)
                    ->get();
            });

        $projectSearchPayload = Cache::remember('project_search_payload', now()->addHour(), function () {
            return $this->buildProjectSearchPayload();
        });

        return view('home.welcome', compact(
            'categories',
            'posts',
            'postCategories',
            'categoriesPost',
            'pages',
            'featured_teams',
            'projectSearchPayload'
        ));
    }

    /**
     * Data for homepage project search (locations, categories, subcategories, and post-based relations).
     */
    private function buildProjectSearchPayload(): array
    {
        $locale = app()->getLocale();

        $locations = ProjectLocation::orderBy('title')
            ->get(['id', 'title'])
            ->map(fn (ProjectLocation $l) => [
                'id' => $l->id,
                'title' => $l->title,
            ])
            ->values()
            ->all();

        $categories = Category::orderBy('drag_id')
            ->get()
            ->map(function (Category $c) use ($locale) {
                return [
                    'id' => $c->id,
                    'name' => $c->getTranslation('name', $locale) ?? $c->name,
                ];
            })
            ->values()
            ->all();

        $subcategories = SubCategory::orderBy('name')
            ->get()
            ->map(function (SubCategory $s) use ($locale) {
                return [
                    'id' => $s->id,
                    'category_id' => $s->category_id,
                    'name' => $s->getTranslation('name', $locale) ?? $s->name,
                ];
            })
            ->values()
            ->all();

        $locationCategories = [];
        $locationCategorySubcategories = [];

        $posts = Post::query()
            ->where('publish_status', 'published')
            ->whereNotNull('project_location_id')
            ->with([
                'categories:id',
                'subcategories:id,category_id',
            ])
            ->select('id', 'project_location_id')
            ->get();

        foreach ($posts as $post) {
            $lid = (int) $post->project_location_id;
            foreach ($post->categories as $cat) {
                $cid = (int) $cat->id;
                $locationCategories[$lid][$cid] = true;
                foreach ($post->subcategories as $sub) {
                    if ((int) $sub->category_id === $cid) {
                        $key = $lid . '_' . $cid;
                        $locationCategorySubcategories[$key][(int) $sub->id] = true;
                    }
                }
            }
        }

        foreach ($locationCategories as $lid => $cats) {
            $ids = array_keys($cats);
            sort($ids);
            $locationCategories[$lid] = $ids;
        }

        foreach ($locationCategorySubcategories as $key => $subs) {
            $ids = array_keys($subs);
            sort($ids);
            $locationCategorySubcategories[$key] = $ids;
        }

        return [
            'locations' => $locations,
            'categories' => $categories,
            'subcategories' => $subcategories,
            'locationCategories' => $locationCategories,
            'locationCategorySubcategories' => $locationCategorySubcategories,
        ];
    }

    public function projectSearch(Request $request)
    {
        $validated = $request->validate([
            'location_id' => 'required|exists:project_locations,id',
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'required|exists:sub_categories,id',
        ]);

        $projectSearchPayload = Cache::remember('project_search_payload', now()->addHour(), function () {
            return $this->buildProjectSearchPayload();
        });

        $categories = Cache::remember('home_categories', now()->addDays(7), function () {
            return Category::orderBy('drag_id')->get();
        });

        $pages = Cache::remember('home_pages', now()->addDays(7), function () {
            return Page::orderBy('drag_id')->get();
        });

        $location = ProjectLocation::findOrFail($validated['location_id']);
        $category = Category::findOrFail($validated['category_id']);
        $subcategory = SubCategory::findOrFail($validated['subcategory_id']);

        if ((int) $subcategory->category_id !== (int) $category->id) {
            abort(404);
        }

        $posts = Post::query()
            ->where('publish_status', 'published')
            ->where('project_location_id', $location->id)
            ->whereHas('categories', function ($q) use ($category) {
                $q->where('categories.id', $category->id);
            })
            ->whereHas('subcategories', function ($q) use ($subcategory) {
                $q->where('sub_categories.id', $subcategory->id);
            })
            ->orderByRaw('drag_id IS NULL, drag_id ASC')
            ->orderByDesc('updated_at')
            ->paginate(24)
            ->withQueryString();

        $postsForRightSidebar = Post::where('publish_status', 'published')
            ->orderByRaw('drag_id IS NULL, drag_id ASC')
            ->orderByDesc('updated_at')
            ->take(5)
            ->get();

        $metaTitle = $location->title . ' · ' . $category->name . ' · ' . $subcategory->name;
        $metaDescription = Str::limit(strip_tags($location->title . ' — ' . $category->name . ' — ' . $subcategory->name), 160);

        return view('home.projectSearch', compact(
            'projectSearchPayload',
            'categories',
            'pages',
            'posts',
            'postsForRightSidebar',
            'location',
            'category',
            'subcategory',
            'metaTitle',
            'metaDescription'
        ));
    }


    public function categories()
    {
        return view('home.categories');
    }

    public function categoryDetails(Category $category)
    {
        $categories = Cache::remember('home_categories', now()->addDays(7), function () {
            return Category::orderBy('drag_id')->get();
        });

        $pages = Cache::remember('home_pages', now()->addDays(7), function () {
            return Page::orderBy('drag_id')->get();
        });

        $findPosts = PostCategory::where('category_id',$category->id)->pluck('post_id');

        $posts = Post::query()
            ->where('publish_status', 'published')
            ->whereIn('id', $findPosts)
            ->orderByRaw('drag_id IS NULL, drag_id ASC')
            ->orderByDesc('updated_at')
            ->get();

        $postsForRightSidebar = Post::where('publish_status', 'published')
            ->orderByRaw('drag_id IS NULL, drag_id ASC')
            ->orderByDesc('updated_at')
            ->take(5)
            ->get();

        // $allPosts = Post::latest()->take(3)->get();

        // dd($posts);
        return view('home.categoryDetails',compact('categories','category','pages','postsForRightSidebar','posts'));
    }


    public function subcategoryDetails(SubCategory $subcategory)
    {
        $categories = Cache::remember('home_categories', now()->addDays(7), function () {
            return Category::orderBy('drag_id')->get();
        });

        $pages = Cache::remember('home_pages', now()->addDays(7), function () {
            return Page::orderBy('drag_id')->get();
        });

        $posts = $subcategory->posts()
            ->where('publish_status', 'published')
            ->latest()
            ->get();

        $postsForRightSidebar = Post::where('publish_status','published')
            ->latest()
            ->take(5)
            ->get();

        return view(
            'home.subcategoryDetails',
            compact(
                'categories',
                'subcategory',
                'pages',
                'postsForRightSidebar',
                'posts'
            )
        );
    }



    public function menuDetails(Request $request)
    {
        // dd("function menuDetails");
        // dd($request->menuId);
        $menu = Menu::find($request->menuId);

        // $menuPageID = MenuPage::where('menu_id',$request->menuId)->value('page_id');
        $menuPageID = MenuPage::where('menu_id',$request->menuId)->value('page_id');

        // dd($menuPageID);

        if($menuPageID)
        {
            $pageItems = Page::find($menuPageID)->items;

            // dd($pageItems);

            if($pageItems->count() > 0)
            {
                return view('home.menuDetails',compact('menu','pageItems'));
            }

        }

        return view('home.menuDetails',compact('menu'));
    }

    public function pageDetails(Request $request)
    {
        // dd("Function pageDetails");
        // dd($request->page);
        $page = Page::find($request->page);

        // dd($page);
        
        $pageItems = Page::find($request->page)->items;

        // dd($pageItems->count());
        if ($pageItems->count() == 0) 
        {
            return view('home.pageDetails',compact('page'));
        }
        else
        {
            return view('home.pageDetails',compact('page','pageItems'));
        }

    }

    public function details()
    {
        $categories = Cache::remember('home_categories', now()->addDays(7), function () {
            return Category::orderBy('drag_id')->get();
        });

        $pages = Cache::remember('home_pages', now()->addDays(7), function () {
            return Page::orderBy('drag_id')->get();
        });

        
        return view('home.details',compact('categories','pages'));
    }

    public function companyProfile()
    {
        $categories = Cache::remember('home_categories', now()->addDays(7), function () {
            return Category::orderBy('drag_id')->get();
        });
        $pages = Cache::remember('home_pages', now()->addDays(7), function () {
            return Page::orderBy('drag_id')->get();
        });
        return view('home.companyProfile',compact('categories','pages'));
    }

    public function aboutUs()
    {
        $categories = Cache::remember('home_categories', now()->addDays(7), function () {
            return Category::orderBy('drag_id')->get();
        });
        $pages = Cache::remember('home_pages', now()->addDays(7), function () {
            return Page::orderBy('drag_id')->get();
        });
        return view('home.aboutUs',compact('categories','pages'));
    }

    public function career()
    {
        $categories = Cache::remember('home_categories', now()->addDays(7), function () {
            return Category::orderBy('drag_id')->get();
        });
        $pages = Cache::remember('home_pages', now()->addDays(7), function () {
            return Page::orderBy('drag_id')->get();
        });
        return view('home.career',compact('categories','pages'));
    }

    public function contactUs()
    {
        $categories = Cache::remember('home_categories', now()->addDays(7), function () {
            return Category::orderBy('drag_id')->get();
        });
        $pages = Cache::remember('home_pages', now()->addDays(7), function () {
            return Page::orderBy('drag_id')->get();
        });
        return view('home.contactUs', compact('categories','pages') );
    }

    public function postDetails(Post $post)
    {
        // dd("function postDetails");
        // $categories = Category::orderBy('drag_id')->get();

        $post->load('images');
        $posts = Post::where('publish_status', 'published')
            ->where('id', '<>', $post->id)
            ->orderByRaw('drag_id IS NULL, drag_id ASC')
            ->orderByDesc('updated_at')
            ->take(5)
            ->get();

        // dd($allPosts);

        // dd($post);

        return view('home.postDetails',compact('posts','post'));
    }



public function information(Request $request)
{
 
    // Honeypot spam check
    if ($request->filled('website') || $request->filled('company_name')) {
        abort(403, 'Spam detected');
    }
    if ($request->filled('hp_time')) {
        $t = (int) $request->input('hp_time');
        // If submitted unrealistically fast (bot), block. Keep threshold low to avoid false positives.
        if ($t > 0 && (time() - $t) < 2) {
            abort(403, 'Spam detected');
        }
    }

    /**
     * 1️⃣ Sanitize input
     */
    $input = [
        'customer_name'    => trim(strip_tags($request->customer_name)),
        'customer_email'   => filter_var($request->customer_email, FILTER_SANITIZE_EMAIL),
        'customer_message' => trim(strip_tags($request->customer_message)),
        'customer_mobile' => trim(strip_tags($request->customer_mobile)),
        'post_id' => $request->post_id == 100000 ? null : $request->post_id,
    ];



    /**
     * 2️⃣ Validate customer data
     */
    $validator = Validator::make($input, [
        'customer_name'    => 'required|string|max:100',
        'customer_email'   => 'required|email:rfc,dns|max:150',
        'customer_message' => 'required|string|max:2000',
        'customer_mobile' => 'nullable|string|max:20',
    ]);

    if ($validator->fails()) {
        return back()
            ->withErrors($validator)
            ->withInput();
    }

 

    /**
     * 3️⃣ Save to DB (safe data)
     */
    $infoStore = new CustomerDetail;
    $infoStore->customer_name    = $input['customer_name'];
    $infoStore->customer_email   = $input['customer_email'];
    $infoStore->customer_message = $input['customer_message'];
    $infoStore->customer_mobile = $input['customer_mobile'];
    $infoStore->post_id = $input['post_id'];
    $infoStore->save();

    /**
     * 4️⃣ Validate admin contact email
     */
    $websiteParameter = WebsiteParameter::first();

    if (
    !$websiteParameter ||
    empty($websiteParameter->contact_email) ||
    !filter_var($websiteParameter->contact_email, FILTER_VALIDATE_EMAIL)
) {
    Log::warning('Invalid contact_email in WebsiteParameter');
    return back()->with('success', 'Your message successfully submitted.');
}


    /**
     * 5️⃣ Send mail (only if both emails valid)
     */
    try {
        Mail::to($websiteParameter->contact_email)
            ->send(new ContactMessageMail([
                'name'    => $input['customer_name'],
                'email'   => $input['customer_email'],
                'message' => $input['customer_message'],
                'mobile' => $input['customer_mobile'],
                'post_id' => $input['post_id'],
            ]));
    } catch (\Throwable $e) {
        Log::error('Contact mail failed: ' . $e->getMessage());
        // Silent fail: user not affected
    }

    return redirect()->back()->with('success', 'Your message successfully submitted.');
}


    protected function _registerOrLoginUser($data)
    {
        $user = User::where('email', '=', $data->email)->first();
        if (!$user) {
            $user = new User();
            $user->name = $data->name;
            $user->email = $data->email;
            $user->provider_id = $data->id;
            $user->avatar = $data->avatar;
            $user->save();
        }
        Auth::login($user);
    }
    //Google Login
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    //Google Callback
    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->user();
        $this->_registerOrLoginUser($user);
        //Return after login
        return redirect()->route('home');
    }


    //Facebook Login
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }
    //Facebook Callback
    public function handleFacebookCallback()
    {
        $user = Socialite::driver('facebook')->user();
        $this->_registerOrLoginUser($user);
        //Return after login
        return redirect()->route('home');
    }

    public function post(Request $request)
    {
        app()->setLocale($request->lan);
        app()->getLocale();
        $post = Post::first();
        return $post->title;
    }
    public function allNews(Request $request)
    {
        if(!(getLang() == $request->lan)){
         setLang($request->lan);
        };
        App::setLocale($request->lan);
        $posts = Post::with('writer', 'categories', 'subcategories')->latest()->get();
        return view('news.allnews', compact('posts'));
    }
    public function newsDetails(Request $request)
    {
        if(!(getLang() == $request->lan)){
            setLang($request->lan);
         };
         App::setLocale($request->lan);
        $news= Post::find($request->news);
        //   dd(app()->getLocale());
        return view('news.newsDetails',compact('news'));
    }


    public function setlan(Request $request)
    {
        setLang($request->lan);
        App::setlocale($request->lan);
        // if (Auth::check()) {
        //     $user= Auth::user();
        //     $user->language= $request->lan;
        //     $user->save();
            
        //     App::setLocale($user->language);
        //     Cookie::queue('lang',$user->language,1000000);
        // }else{
        //     App::setLocale($request->lan);
        //     Cookie::queue('lang',$request->lan,1000000);
        // }
     return true;
    }
   

    public function setLanguage(Request $request)
    {
        $lan = $request->lan;
        $min = 60 * 24 * 30 * 2; //for 2 months;
        Cookie::queue('edition', $lan, $min);
       
        return redirect('/');
    }

    public function teams()
    {
        $teams =   Team::where('status', 1)
                        ->orderByRaw('drag_id IS NULL, drag_id ASC')
                        ->paginate(12);
                    

        return view('home.teams', compact('teams'));
    }

    public function teamShow(string $slug)
    {
        $team = Team::where('username', $slug)
            ->where('status', 1)
            ->firstOrFail();

        return view('home.teamDetails', compact('team'));
    }

    public function donationStore(Request $request)
    {
        // dd($request->all());
        /* ===============================
           0. Honeypot (Bot Protection)
        =============================== */
        if ($request->filled('website')) {
            return response()->json([
                'message' => 'Spam detected'
            ], 422);
        }

        /* ===============================
           Normalize Mobile BEFORE validation
        =============================== */
        $rawMobile = $request->input('mobile'); // original input

        if ($rawMobile) {

            // +8801XXXXXXXXX → 01XXXXXXXXX
            if (str_starts_with($rawMobile, '+880')) {
                $normalizedMobile = substr($rawMobile, 3);
            }
            // 8801XXXXXXXXX → 01XXXXXXXXX
            elseif (str_starts_with($rawMobile, '880')) {
                $normalizedMobile = substr($rawMobile, 2);
            }
            // already local
            else {
                $normalizedMobile = $rawMobile;
            }

            // overwrite request for validation
            $request->merge([
                'mobile' => $normalizedMobile
            ]);
        }

        /* ===============================
           1. Validation
        =============================== */
        try {

            $validated = $request->validate([

                'post_id'           => 'required|integer|exists:posts,id',
                'name'              => 'required|string|min:2|max:255',
                'father_name'       => 'required|string|max:255',
                'email'             => 'required|email|max:255',

                // Bangladesh local format only
                'mobile'            => ['required', 'regex:/^01[3-9]\d{8}$/'],

                'present_address'   => 'required|string|max:1000',
                'permanent_address' => 'required|string|max:1000',
                'nid'               => 'required|string|max:50',

                'nid_pic'           => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',

                'purpose'           => 'nullable',
                'details'           => 'nullable|string|max:3000',

                'document_type'     => 'required|array|min:1',
                'document_type.*'   => 'required|string|max:255',

                'document_file'     => 'required|array|min:1',
                'document_file.*'   => 'required|file|mimes:jpg,jpeg,png,pdf|max:4096',

            ]);

        } catch (ValidationException $e) {

            return response()->json([
                'message' => 'Validation failed',
                'errors'  => $e->errors()
            ], 422);
        }

        /* ===============================
           2. Database Transaction
        =============================== */
        DB::beginTransaction();

        try {

            /* ===============================
               3. Store NID Picture
            =============================== */
            $nidPic      = $request->file('nid_pic');
            $nidFileName = uniqid('nid_') . '.' . $nidPic->getClientOriginalExtension();

            $nidPath = $nidPic->storeAs(
                'donations/nid',
                $nidFileName,
                'public'
            );

            $tracking = 'DN-' . strtoupper(Str::random(8));

            /* ===============================
               4. Insert Donation Application
            =============================== */
            $donationId = DB::table('donation_applications')->insertGetId([

                'post_id'           => $request->post_id,
                'name'              => $request->name,
                'father_name'       => $request->father_name,
                'email'             => $request->email,

                // always store E.164-like format
                'mobile'            => '+88' . $request->mobile,

                'present_address'   => $request->present_address,
                'permanent_address' => $request->permanent_address,
                'nid'               => $request->nid,
                'nid_pic'           => $nidPath,
                'purpose'           => $request->purpose,
                'details'           => $request->details,
                'date'              => now()->toDateString(),
                'status'            => 'pending',
                'tracking_number'   => $tracking,
                'created_at'        => now(),
                'updated_at'        => now(),
            ]);

            /* ===============================
               5. Store Documents
            =============================== */
            foreach ($request->document_type as $index => $type) {

                if (!$request->hasFile("document_file.$index")) {
                    throw ValidationException::withMessages([
                        "document_file.$index" => ['এই ডকুমেন্ট ফাইলটি আবশ্যক']
                    ]);
                }

                $file     = $request->file("document_file.$index");
                $fileName = uniqid('doc_') . '.' . $file->getClientOriginalExtension();

                $filePath = $file->storeAs(
                    'donations/documents',
                    $fileName,
                    'public'
                );

                DB::table('donation_documents')->insert([
                    'donation_application_id' => $donationId,
                    'document_type'           => $type,
                    'file_name'               => $filePath,
                    'created_at'              => now(),
                    'updated_at'              => now(),
                ]);
            }

            DB::commit();

            /* ===============================
               6. Success Response
            =============================== */
            return response()->json([
                'status'   => 'success',
                'message'  => 'ডোনেশন রিকোয়েস্ট সফলভাবে জমা হয়েছে',
                'tracking' => $tracking,
                'redirect' => route('donation.track.page', [
                    'ref'    => $tracking,
                    'mobile' => $request->mobile // 01XXXXXXXXX
                ])
            ]);

        } catch (\Throwable $e) {

            DB::rollBack();
            report($e);

             // dd($e);

            return response()->json([
                'status'  => 'error',
                'message' => 'সার্ভার সমস্যা হয়েছে। পরে আবার চেষ্টা করুন।'
            ], 500);
        }
    }
 

    public function trackPage(Request $request)
    {
        // success redirect থেকে ref আসলে auto fill হবে
        $tracking = $request->ref ?? null;
        $mobile   = $request->mobile ?? null;

        return view('home.track', compact('tracking','mobile'));
    }


    public function trackResult(Request $request)
    {
        $request->validate([
            'tracking_number' => 'required|string',
            'mobile'          => ['required', 'regex:/^01[3-9]\d{8}$/'],
        ]);

        // Normalize mobile
        $mobile = '+88' . $request->mobile;

        $donation = DB::table('donation_applications')
            ->where('tracking_number', $request->tracking_number)
            ->where('mobile', $mobile)
            ->first();

        if (!$donation) {
            return response()->json([
                'status'  => 'error',
                'message' => 'এই তথ্য অনুযায়ী কোনো ডোনেশন রিকুয়েস্ট পাওয়া যায়নি'
            ], 404);
        }

        $documents = DB::table('donation_documents')
            ->where('donation_application_id', $donation->id)
            ->get();

        $html = view('home.partials.donationInvoiceAjax',
            compact('donation','documents')
        )->render();

        return response()->json([
            'status' => 'success',
            'html'   => $html
        ]);
    }

    public function donateNow()
    {
        return view('home.donateNow');
    }

    public function donationNeeded()
    {
        $categoriesPost = Cache::remember('home_categories_post', now()->addDays(7), function () {
            return Category::whereHas('posts')
                ->orderBy('drag_id')
                ->with('posts.location')
                ->get();
        });

        return view('home.donationNeeded',['categoriesPost'=> $categoriesPost]);
    }

    public function allbrochures()
    {
        $brochures = Post::whereNotNull('brochure_file')->where('publish_status', 'published')->orderBy('title')->paginate(50);

        return view('home.allbrochures',['brochures'=> $brochures]);
    }

    public function customerReviews()
    {
        return redirect('/');
    }
    public function landownerReviews()
    {
        return redirect('/');
    }
}
