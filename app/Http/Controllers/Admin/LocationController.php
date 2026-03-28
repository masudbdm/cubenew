<?php

namespace App\Http\Controllers\Admin;

use DB;
use Auth;
use App\Models\Post;
use App\Models\User;
use App\Models\Page;
use App\Models\Category;
use App\Models\CustomerDetail;
use App\Models\ProjectLocation;
use App\Models\WebsiteParameter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
class LocationController extends Controller
{
    public function index()
    {
        menuSubmenu('locations', 'locations');
        $locations = ProjectLocation::orderBy('title')->paginate(20);
        return view('admin.location.index',compact('locations'));
    }

    public function create()
    {
        return view('admin.location.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|min:3|max:255',
            'description' => 'nullable|string'
        ]);

        ProjectLocation::create([
            'title' => $request->title,
            'description' => $request->description,
            'addedby_id' => Auth::id(),
        ]);

        return redirect()
            ->route('admin.locations')
            ->with('success', 'Location created successfully.');
    }

     /* ======================================
        4. EDIT PAGE
    ====================================== */

    public function edit($id)
    {
        $location = ProjectLocation::findOrFail($id);

        return view('admin.location.edit', compact('location'));
    }


    /* ======================================
        5. UPDATE
    ====================================== */

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|min:3|max:255',
            'description' => 'nullable|string'
        ]);

        $location = ProjectLocation::findOrFail($id);

        $location->update([
            'title' => $request->title,
            'description' => $request->description,
            'editedby_id' => Auth::id(),
        ]);

        return redirect()
            ->route('admin.locations')
            ->with('success', 'Location updated successfully.');
    }


    /* ======================================
        6. DELETE
    ====================================== */

    public function delete($id)
    {
        DB::transaction(function () use ($id) {

            $location = ProjectLocation::findOrFail($id);

            // Related posts nullify
            Post::where('project_location_id', $id)
                ->update(['project_location_id' => null]);

            // Delete location
            $location->delete();
        });

        return redirect()
            ->route('admin.locations')
            ->with('success', 'Location deleted successfully.');
    }
}
