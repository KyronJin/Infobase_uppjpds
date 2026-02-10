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
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'category' => 'required|string|max:50',
            'location' => 'required|string|in:home,about,both',
            'order' => 'nullable|integer',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('gallery', 'public');
            $validated['image_path'] = 'storage/' . $imagePath;
        }

        $validated['is_active'] = $request->has('is_active');

        // Create table if not exists
        if (!Schema::hasTable('gallery_photos')) {
            Schema::create('gallery_photos', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->text('description')->nullable();
                $table->string('image_path');
                $table->string('category')->nullable();
                $table->enum('location', ['home', 'about', 'both'])->default('both');
                $table->boolean('is_active')->default(true);
                $table->integer('order')->default(0);
                $table->timestamps();
            });
        }

        GalleryPhoto::create($validated);

        return redirect()->route('admin.gallery.index')
                        ->with('success', 'Foto galeri berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GalleryPhoto $gallery): View
    {
        return view('admin.gallery.edit', compact('gallery'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, GalleryPhoto $gallery)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'category' => 'required|string|max:50',
            'location' => 'required|string|in:home,about,both',
            'order' => 'nullable|integer',
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
