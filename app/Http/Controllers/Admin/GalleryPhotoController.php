<?php

namespace App\Http\Controllers\Admin;

use App\Models\GalleryPhoto;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\View\View;
use Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;

class GalleryPhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        if (!Schema::hasTable('gallery_photos')) {
            $photos = new \Illuminate\Pagination\LengthAwarePaginator([], 0, 12);
        } else {
            $photos = GalleryPhoto::orderBy('order')->paginate(12);
        }
        return view('admin.gallery.index', compact('photos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.gallery.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Jika lokasi hero, title tidak wajib
        $isTitleRequired = $request->input('location') !== 'hero' ? 'required' : 'nullable';
        
        $validated = $request->validate([
            'title' => "{$isTitleRequired}|string|max:255",
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:20480',
            'category' => 'required|string|max:50',
            'location' => 'required|string|in:home,about,both,hero',
            'order' => 'nullable|integer',
            'button_text' => 'nullable|string|max:100',
            'button_link' => 'nullable|string|max:255',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('gallery', 'public');
            $validated['image_path'] = Storage::url($imagePath);
        }

        $validated['is_active'] = $request->has('is_active');

        // Generate default title for hero banner if not provided
        if ($request->input('location') === 'hero' && empty($validated['title'])) {
            $validated['title'] = 'Hero Banner - ' . ucfirst($validated['category']) . ' ' . date('Y-m-d H:i');
        }

        // Create table if not exists
        if (!Schema::hasTable('gallery_photos')) {
            Schema::create('gallery_photos', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->text('description')->nullable();
                $table->string('image_path');
                $table->string('category')->nullable();
                $table->enum('location', ['home', 'about', 'both', 'hero'])->default('both');
                $table->boolean('is_active')->default(true);
                $table->integer('order')->default(0);
                $table->timestamps();
            });
        } else {
            // Check if location enum needs update
            $columns = Schema::getColumnListing('gallery_photos');
            if (in_array('location', $columns)) {
                // Alter enum to include 'hero'
                DB::statement("ALTER TABLE gallery_photos MODIFY COLUMN location ENUM('home', 'about', 'both', 'hero') DEFAULT 'both'");
            }
        }

        // Remove button fields if columns don't exist
        if (!Schema::hasColumn('gallery_photos', 'button_text')) {
            unset($validated['button_text']);
        }
        if (!Schema::hasColumn('gallery_photos', 'button_link')) {
            unset($validated['button_link']);
        }

        GalleryPhoto::create($validated);

        return redirect()->route('admin.gallery.index')
                        ->with('success', 'Foto galeri berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GalleryPhoto $gallery)
    {
        if (request()->wantsJson()) {
            return response()->json($gallery);
        }
        return view('admin.gallery.edit', compact('gallery'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, GalleryPhoto $gallery)
    {
        // Jika lokasi hero, title tidak wajib
        $isTitleRequired = $request->input('location') !== 'hero' ? 'required' : 'nullable';
        
        $validated = $request->validate([
            'title' => "{$isTitleRequired}|string|max:255",
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:20480',
            'category' => 'required|string|max:50',
            'location' => 'required|string|in:home,about,both,hero',
            'order' => 'nullable|integer',
            'button_text' => 'nullable|string|max:100',
            'button_link' => 'nullable|string|max:255',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($gallery->image_path && Storage::disk('public')->exists(str_replace('storage/', '', $gallery->image_path))) {
                Storage::disk('public')->delete(str_replace('storage/', '', $gallery->image_path));
            }

            $imagePath = $request->file('image')->store('gallery', 'public');
            $validated['image_path'] = 'storage/' . $imagePath;
        }

        $validated['is_active'] = $request->has('is_active');

        // Generate default title for hero banner if not provided or empty
        if ($request->input('location') === 'hero' && empty($validated['title'])) {
            $validated['title'] = $gallery->title ?? 'Hero Banner - ' . ucfirst($validated['category']) . ' ' . date('Y-m-d H:i');
        }

        // Remove button fields if columns don't exist
        if (!Schema::hasColumn('gallery_photos', 'button_text')) {
            unset($validated['button_text']);
        }
        if (!Schema::hasColumn('gallery_photos', 'button_link')) {
            unset($validated['button_link']);
        }

        $gallery->update($validated);

        return redirect()->route('admin.gallery.index')
                        ->with('success', 'Foto galeri berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GalleryPhoto $gallery)
    {
        // Delete image file
        if ($gallery->image_path && Storage::disk('public')->exists(str_replace('storage/', '', $gallery->image_path))) {
            Storage::disk('public')->delete(str_replace('storage/', '', $gallery->image_path));
        }

        $gallery->delete();

        return redirect()->route('admin.gallery.index')
                        ->with('success', 'Foto galeri berhasil dihapus');
    }
}
