<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Media;
use App\Models\Post;
use App\Models\ProjectLocation;
use App\Models\DonationGiven;
use App\Models\PostCategory;
use App\Models\DonationApplication;
use App\Models\PostSubcategory;
use App\Models\Tag;
use App\Models\WebsiteParameter;
use App\Models\PostImage;
use Illuminate\Http\Request;
// use Validator;
// use Auth;
use DB;
use Illuminate\Support\Facades\Cache;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

// use Spatie\Translatable;
class EditorController extends Controller
{
    public $websiteParamiter;
    public function __construct()
    {
        $this->websiteParameter = WebsiteParameter::first();
    }
    public function addNewPost(Request $request)
    {
        // dd("ok");
        menuSubmenu('post', 'addNewPost');
        $cats = Category::all();
        $post = Post::where('publish_status', 'temp')->first();
        $locations = ProjectLocation::orderBy('title')->get();
        $mediaAll = Media::latest()->paginate(200);
        if (!$post) {
            $post = new Post;
            $post->addedby_id = Auth::id();
            $post->save();
        }

        Cache::flush();

        return view('admin.post.addNewPost', compact('cats', 'post', 'mediaAll','locations'));
    }

    public function selectTagsOrAddNew(Request $request)
    {
        $tags = Tag::where('title', 'like', '%' . $request->q . '%')
            ->select(['title'])->take(30)->get();
        if ($tags->count()) {
            if ($request->ajax()) {
                return $tags;
            }
        } else {
            if ($request->ajax()) {
                return $tags;
            }
        }
    }
    public function allPost()
    {
        menuSubmenu('post', 'allPost');
        $posts = Post::latest()->where('publish_status', '!=', 'temp')->get();
        return view('admin.post.allPosts', compact('posts'));
    }

    public function storePost(Request $request)
    {

        // dd($request->feature_image);
        $validation = Validator::make(
            $request->all(),
            [
                // "title" => "title",
                // "description" => "required",
                // "publish" => "on"
                // 'excerpt' => 'max:254|required',
                // 'feature_image' => 'image|dimensions:min_with=310,min_height=200,ratio=3/2'
                'feature_image' => 'image|dimensions:min_with=310,min_height=200',
                'brochure_file' => 'nullable|mimes:jpg,jpeg,png,pdf,doc,docx|max:10240',
                'number_of_bedrooms' => 'nullable|string|max:255',
                'rajuk_approval_number' => 'nullable|string|max:255',
                'engineer_name' => 'nullable|string|max:255',
                'post_images' => 'nullable|array|max:24',
                'post_images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:8192'
                // 'feature_image' => 'required'
            ]
        );

        if ($validation->fails()) {
            return back()
                ->withErrors($validation)
                ->withInput()
                ->with('error', 'Something Went Wrong!');
        }

        $web_editons = explode(',', WebsiteParameter::first()->news_editions);

        foreach ($web_editons as $key => $lan) {
            $tagFieldName = $lan . "_tags";
            if ($request[$tagFieldName]) {
                foreach ($request[$tagFieldName] as $tag) {
                    $t = Tag::where('title', $tag)->first();
                    if (!$t) {
                        $t = new Tag;
                        $t->title = $tag;
                        $t->addedby_id = Auth::id();
                        $t->save();
                    }
                }
            }
        }

        $description = [];
        $tags = [];
        $titles = [];
        $excerpts = [];
        foreach ($web_editons as $key => $lan) {
            $descriptionField = $lan . "_description";
            $tagFieldName = $lan . "_tags";
            $titleFieldName = $lan . "_title";
            $excerptFieldName = $lan . "_excerpt";

            $des = $request[$descriptionField];
            $tag = $request[$tagFieldName];
            $title = $request[$titleFieldName];
            $excerpt = $request[$excerptFieldName];

            $description[$lan] = $des;
            $tags[$lan] = $tag;
            $titles[$lan] = $title;
            $excerpts[$lan] = $excerpt;
        }

        
        


        $post = Post::where('publish_status', 'temp')->first();
        if (!$post) {
            $post = new Post;
            $post->addedby_id = Auth::id();
            $post->save();
        }

        $post->title = $titles ?? null;
        $post->description =  $description ?? null;
        $post->excerpt = $excerpts ?? null;
        $post->tags = $tags;
        $post->publish_status = $request->publish ? 'published' : 'draft';
        $post->front_slider = $request->front_slider ? true : false;
        $post->headline = $request->headline ? true : false;
        $post->highlight = $request->highlight ? true : false;
        // $post->writer_id = $request->author;
        // $post->purpose = $request->purpose;
        $post->project_location_id = $request->project_location_id ?? null;
        $post->addedby_id = Auth::id();
        $post->published_at = date('Y-m-d H:i:s', strtotime("$request->publish_date $request->publish_time"));

        $post->land = $request->land ?? null;
        $post->specialty = $request->specialty ?? null;
        $post->front_road = $request->front_road ?? null;
        $post->floors = $request->floors ?? null;
        $post->apartments = $request->apartments ?? null;
        $post->size = $request->size ?? null;
        $post->basements = $request->basements ?? null;
        $post->no_of_car_parking = $request->no_of_car_parking ?? null;
        $post->number_of_bedrooms = $request->number_of_bedrooms ?? null;
        $post->rajuk_approval_number = $request->rajuk_approval_number ?? null;
        $post->engineer_name = $request->engineer_name ?? null;
        $post->address = $request->address ?? null;
        $post->yt_video_code = $request->yt_video_code ?? null;
        $post->lat = $request->lat ?? null;
        $post->lng = $request->lng ?? null;
        $post->google_map = $request->google_map ?? null;


        if ($request->hasFile('feature_image')) {

            $ffile = $request->feature_image;
            $fimgExt = strtolower($ffile->getClientOriginalExtension());
            $fimageNewName = rand(1111, 9999) . time() . '.' . $fimgExt;
            $originalName = $ffile->getClientOriginalName();

            Storage::disk('public')->put('media/image/' . $fimageNewName, File::get($ffile));

            if ($post->feature_img_name) {

                Storage::disk('public')->delete('media/image/' . $post->feature_img_name);
            }

            $post->feature_img_name = $fimageNewName;
            $post->feature_img_original_name = $originalName;
            $post->feature_img_ext = $fimgExt;
        }



        if ($request->hasFile('brochure_file')) {

            $file = $request->brochure_file;
            $ext = strtolower($file->getClientOriginalExtension());
            $newName = rand(1111, 9999) . time() . '.' . $ext;
            $originalName = $file->getClientOriginalName();

            Storage::disk('public')->put('media/brochure/' . $newName, File::get($file));

            // Delete old brochure if exists
            if ($post->brochure_file) {
                Storage::disk('public')->delete('media/brochure/' . $post->brochure_file);
            }

            $post->brochure_file = $newName;
            $post->brochure_original_name = $originalName;
            $post->brochure_ext = $ext;
        }


        $post->save();

        if ($request->hasFile('post_images')) {
            $i = 0;
            foreach ($request->file('post_images') as $img) {
                if (!$img) continue;
                $ext = strtolower($img->getClientOriginalExtension());
                $name = 'post_'.$post->id.'_'.time().'_'.(++$i).'.'.$ext;
                $path = $img->storeAs('media/post-images', $name, 'public');
                PostImage::create([
                    'post_id' => $post->id,
                    'image_path' => $path,
                    'sort_order' => (int) $post->images()->max('sort_order') + 1,
                ]);
            }
        }
        $post->categories()->detach();
        if ($request->categories) {
            foreach ($request->categories as $cat) {
                $c = PostCategory::where('category_id', $cat)->where('post_id', $post->id)->first();
                if (!$c) {
                    $c = new PostCategory;
                    $c->category_id = $cat;
                    $c->post_id = $post->id;
                    $c->addedby_id = Auth::id();
                    $c->save();
                }
            }
        }
        $post->subcategories()->detach();
        if ($request->subCategories) {
            foreach ($request->subCategories as $cat) {

                $c = PostSubcategory::where('subcategory_id', $cat)->where('post_id', $post->id)->first();
                if (!$c) {
                    $c = new PostSubcategory;
                    $c->subcategory_id = $cat;
                    $c->post_id = $post->id;
                    $c->addedby_id = Auth::id();
                    $c->save();
                }
            }
        }

        Cache::flush();

        return redirect()->back()->with('success', 'Post Added Successfully');
    }

    public function viewPost(Request $request)
    {

        // return PostCategory::all();
        $post = Post::findBySlug($request->slug);
        return view('admin.post.viewPost', compact('post'));
    }
    public function editPost(Post $post, Request $request)
    {
        menuSubmenu('post', 'editPost');
        $cats = Category::all();
        $oldTags = $post->tags ?? null;
        $mediaAll = Media::latest()->paginate(200);
        $locations = ProjectLocation::orderBy('title')->get();
        $test = Media::latest()->first();
        return view('admin.post.editPost', [
            'post' => $post,
            'cats' => $cats,
            'oldTags' => $oldTags,
            'mediaAll' => $mediaAll,
            'test'=>$test,
            'locations'=> $locations

        ]);
    }
    public function updtePost(Post $post, Request $request)
    {
        $request->validate([
            'number_of_bedrooms' => 'nullable|string|max:255',
            'rajuk_approval_number' => 'nullable|string|max:255',
            'engineer_name' => 'nullable|string|max:255',
            'post_images' => 'nullable|array|max:24',
            'post_images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:8192',
            'remove_post_image_ids' => 'nullable|array',
            'remove_post_image_ids.*' => 'integer',
            'post_image_meta' => 'nullable|array',
        ]);

        $web_editons = explode(',', WebsiteParameter::first()->news_editions);

        foreach ($web_editons as $key => $lan) {
            $tagFieldName = $lan . "_tags";
            if ($request[$tagFieldName]) {
                foreach ($request[$tagFieldName] as $tag) {
                    $t = Tag::where('title', $tag)->first();
                    if (!$t) {
                        $t = new Tag;
                        $t->title = $tag;
                        $t->addedby_id = Auth::id();
                        $t->save();
                    }
                }
            }
        }

        $description = [];
        $tags = [];
        $titles = [];
        $excerpts = [];
        foreach ($web_editons as $key => $lan) {
            $descriptionField = $lan . "_description";
            $tagFieldName = $lan . "_tags";
            $titleFieldName = $lan . "_title";
            $excerptFieldName = $lan . "_excerpt";

            $des = $request[$descriptionField];
            $tag = $request[$tagFieldName];
            $title = $request[$titleFieldName];
            $excerpt = $request[$excerptFieldName];

            $description[$lan] = $des;
            $tags[$lan] = $tag;
            $titles[$lan] = $title;
            $excerpts[$lan] = $excerpt;
        }
        // $post = Post::where('publish_status', 'temp')->first();
        if (!$post) {
            $post = new Post;
            $post->addedby_id = Auth::id();
            $post->save();
        }
        // return $titles;
        $post->title = $titles ?? null;

        $post->description =  $description ?? null;
        $post->excerpt = $excerpts ?? null;
        $post->tags = $tags;
        $post->publish_status = $request->publish ? 'published' : 'draft';
        $post->front_slider = $request->front_slider ? true : false;
        $post->headline = $request->headline ? true : false;
        $post->highlight = $request->highlight ? true : false;
        $post->writer_id = $request->author;
        $post->addedby_id = Auth::id();
        // $post->purpose = $request->purpose;
        $post->project_location_id = $request->project_location_id ?? null;
        $post->published_at = date('Y-m-d H:i:s', strtotime("$request->publish_date $request->publish_time"));

        $post->land = $request->land ?? null;
        $post->specialty = $request->specialty ?? null;
        $post->front_road = $request->front_road ?? null;
        $post->floors = $request->floors ?? null;
        $post->apartments = $request->apartments ?? null;
        $post->size = $request->size ?? null;
        $post->basements = $request->basements ?? null;
        $post->no_of_car_parking = $request->no_of_car_parking ?? null;
        $post->number_of_bedrooms = $request->number_of_bedrooms ?? null;
        $post->rajuk_approval_number = $request->rajuk_approval_number ?? null;
        $post->engineer_name = $request->engineer_name ?? null;
        $post->address = $request->address ?? null;
        $post->yt_video_code = $request->yt_video_code ?? null;
        $post->lat = $request->lat ?? null;
        $post->lng = $request->lng ?? null;
        $post->google_map = $request->google_map ?? null;
        
        if ($request->hasFile('feature_image')) {
            $prviewFilePath = 'media/image/' . $post->feature_img_name;
            if (Storage::disk('public')->exists($prviewFilePath)) {
                Storage::disk('public')->delete($prviewFilePath);
            }
            $ffile = $request->feature_image;
            $fimgExt = strtolower($ffile->getClientOriginalExtension());
            $fimageNewName = image_slug($post->title) . "_" . rand(11, 99) . time() . '.' . $fimgExt;
            $originalName = $ffile->getClientOriginalName();

            Storage::disk('public')->put('media/image/' . $fimageNewName, File::get($ffile));

            if ($post->feature_img_name) {

                Storage::disk('public')->delete('media/image/' . $post->feature_img_name);
            }

            $post->feature_img_name = $fimageNewName;
            $post->feature_img_original_name = $originalName;
            $post->feature_img_ext = $fimgExt;
        }


        if ($request->hasFile('brochure_file')) {

            $file = $request->brochure_file;
            $ext = strtolower($file->getClientOriginalExtension());
            $newName = rand(1111, 9999) . time() . '.' . $ext;
            $originalName = $file->getClientOriginalName();

            Storage::disk('public')->put('media/brochure/' . $newName, File::get($file));

            // Delete old brochure if exists
            if ($post->brochure_file) {
                Storage::disk('public')->delete('media/brochure/' . $post->brochure_file);
            }

            $post->brochure_file = $newName;
            $post->brochure_original_name = $originalName;
            $post->brochure_ext = $ext;
        }

        
        $post->save();

        // Update meta (description + sort order)
        if ($request->filled('post_image_meta')) {
            $meta = (array) $request->input('post_image_meta');
            foreach ($meta as $id => $row) {
                $id = (int) $id;
                $img = PostImage::where('post_id', $post->id)->where('id', $id)->first();
                if (!$img) continue;
                $img->description = isset($row['description']) ? trim((string) $row['description']) : null;
                $img->sort_order = isset($row['sort_order']) ? (int) $row['sort_order'] : $img->sort_order;
                $img->save();
            }
        }

        if ($request->filled('remove_post_image_ids')) {
            $ids = array_map('intval', (array) $request->input('remove_post_image_ids'));
            $imgs = PostImage::where('post_id', $post->id)->whereIn('id', $ids)->get();
            foreach ($imgs as $img) {
                if ($img->image_path && Storage::disk('public')->exists($img->image_path)) {
                    Storage::disk('public')->delete($img->image_path);
                }
                $img->delete();
            }
        }

        if ($request->hasFile('post_images')) {
            $i = 0;
            $startOrder = (int) ($post->images()->max('sort_order') ?? 0);
            foreach ($request->file('post_images') as $img) {
                if (!$img) continue;
                $ext = strtolower($img->getClientOriginalExtension());
                $name = 'post_'.$post->id.'_'.time().'_'.(++$i).'.'.$ext;
                $path = $img->storeAs('media/post-images', $name, 'public');
                PostImage::create([
                    'post_id' => $post->id,
                    'image_path' => $path,
                    'sort_order' => $startOrder + $i,
                ]);
            }
        }
        $post->categories()->detach();
        if ($request->categories) {
            foreach ($request->categories as $cat) {
                $c = PostCategory::where('category_id', $cat)->where('post_id', $post->id)->first();
                if (!$c) {
                    $c = new PostCategory;
                    $c->category_id = $cat;
                    $c->post_id = $post->id;
                    $c->addedby_id = Auth::id();
                    $c->save();
                }
            }
        }
        $post->subcategories()->detach();
        if ($request->subCategories) {
            foreach ($request->subCategories as $cat) {

                $c = PostSubcategory::where('subcategory_id', $cat)->where('post_id', $post->id)->first();
                if (!$c) {
                    $c = new PostSubcategory;
                    $c->subcategory_id = $cat;
                    $c->post_id = $post->id;
                    $c->addedby_id = Auth::id();
                    $c->save();
                }
            }
        }

        Cache::flush();
        return redirect()->back()->with('success', 'Post Added Successfully');
    }

    public function allDonationApplication()
    {
        menuSubmenu('application', 'applicationAll');

        $applications = DonationApplication::orderBy('id', 'desc')->paginate(20);

        return view('admin.donation.applicationAll', compact('applications'));

    }

    public function donationApplicationDelete($id)
    {
        $application = DonationApplication::findOrFail($id);

        $application->delete();

        return redirect()
            ->back()
            ->with('success', 'Application deleted successfully.');
    }

    public function donationApplicationEdit($id)
    {
        $application = DonationApplication::findOrFail($id);

        $documents = DB::table('donation_documents')
            ->where('donation_application_id', $id)
            ->get();

        return view('admin.donation.applicationEdit', compact('application','documents'));
    }

    public function donationApplicationUpdate(Request $request, $id)
    {
        $application = DonationApplication::findOrFail($id);

        /* ===============================
           1. Validation
        =============================== */
        $validated = $request->validate([
            'name'              => 'required|string|min:2|max:255',
            'father_name'       => 'nullable|string|max:255',
            'email'             => 'required|email|max:255',
            'mobile'            => ['required', 'regex:/^01[3-9]\d{8}$/'],
            'present_address'   => 'required|string|max:1000',
            'permanent_address' => 'required|string|max:1000',
            'nid'               => 'required|string|max:50',
            'nid_pic'           => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'purpose'           => 'nullable|string|max:255',
            'details'           => 'nullable|string|max:3000',
            'status'            => 'required|string|in:pending,approved,delivered,rejected',

            'document_type'     => 'nullable|array',
            'document_type.*'   => 'nullable|string|max:255',
            'document_file'     => 'nullable|array',
            'document_file.*'   => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:4096',
        ]);

        DB::beginTransaction();

        try {
            // ===============================
            // Update NID Picture if uploaded
            // ===============================
            if ($request->hasFile('nid_pic')) {
                // Delete old file if exists
                if ($application->nid_pic && Storage::disk('public')->exists($application->nid_pic)) {
                    Storage::disk('public')->delete($application->nid_pic);
                }

                $nidPic      = $request->file('nid_pic');
                $nidFileName = uniqid('nid_') . '.' . $nidPic->getClientOriginalExtension();
                $nidPath     = $nidPic->storeAs('donations/nid', $nidFileName, 'public');

                $application->nid_pic = $nidPath;
            }

            // ===============================
            // Update main application fields
            // ===============================
            $application->update([
                'name'              => $request->name,
                'father_name'       => $request->father_name,
                'email'             => $request->email,
                'mobile'            => '+88'.$request->mobile,
                'present_address'   => $request->present_address,
                'permanent_address' => $request->permanent_address,
                'nid'               => $request->nid,
                'purpose'           => $request->purpose,
                'details'           => $request->details,
                'status'            => $request->status,
            ]);

            // ===============================
            // Add new documents if any
            // ===============================
            if ($request->has('document_type') && $request->hasFile('document_file')) {
                foreach ($request->document_type as $index => $type) {
                    if (!$request->hasFile("document_file.$index")) continue;

                    $file     = $request->file("document_file.$index");
                    $fileName = uniqid('doc_') . '.' . $file->getClientOriginalExtension();
                    $filePath = $file->storeAs('donations/documents', $fileName, 'public');

                    DB::table('donation_documents')->insert([
                        'donation_application_id' => $application->id,
                        'document_type'           => $type,
                        'file_name'               => $filePath,
                        'created_at'              => now(),
                        'updated_at'              => now(),
                    ]);
                }
            }

            DB::commit();

            return redirect()->route('admin.donation.application.edit', $application->id)
                             ->with('success', 'Donation application updated successfully.');

        } catch (\Throwable $e) {
            DB::rollBack();
            report($e);

            return back()->withErrors(['error' => 'Server error. Please try again later.']);
        }
    }

    public function donationDocumentDelete($id)
    {
        $document = DB::table('donation_documents')->where('id', $id)->first();

        if (!$document) {
            return back()->withErrors(['error' => 'Document not found.']);
        }

        // ফাইল ডিলিট করা (public disk থেকে)
        if ($document->file_name && Storage::disk('public')->exists($document->file_name)) {
            Storage::disk('public')->delete($document->file_name);
        }

        // ডাটাবেস থেকে রেকর্ড ডিলিট করা
        DB::table('donation_documents')->where('id', $id)->delete();

        return back()->with('success', 'Document deleted successfully.');
    }

    public function donationApplicationShow($id)
    {
        $application = DonationApplication::findOrFail($id);

        // Load all documents for this application
        $documents = DB::table('donation_documents')
            ->where('donation_application_id', $application->id)
            ->get();

        return view('admin.donation.applicationShow', compact('application', 'documents'));
    }

    
    public function postApplications(Post $post, $status = null)
    {
        // Query builder শুরু
        $query = $post->donationApplications();

        // Status filter
        if ($status && in_array($status, ['pending', 'approved', 'delivered'])) {
            $query->where('status', $status);
        }

        // Latest first
        $applications = $query->orderBy('created_at', 'desc')->get();

        return view('admin.donation.applications', compact('post', 'applications', 'status'));
    }

    public function donationPaymentsForApplication (DonationApplication $application)
    {
        $payments = $application->payments()->latest()->paginate(20);

        return view('admin.donation.payments', compact('application','payments'));
    }

    public function donationPaymentStore(Request $request)
    {
        $request->validate([
            'donation_application_id' => 'required|exists:donation_applications,id',
            'amount' => 'required|numeric|min:0',
            'document' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:4096'
        ]);

        $application = DonationApplication::findOrFail($request->donation_application_id);

        // File upload
        $documentPath = null;

        if ($request->hasFile('document')) {

            $documentPath = $request->file('document')
                ->store('donation/payments', 'public');
        }

        DonationGiven::create([
            'donation_application_id' => $application->id,
            'amount' => $request->amount,
            'purpose' => $request->purpose,
            'date' => $request->date ?? now()->toDateString(),
            'status' => 'pending',
            'document' => $documentPath,
            'addedby_id' => auth()->id(),
        ]);

        return back()->with('success','Payment of '.$request->amount.' TK added successfully');
    }

}
