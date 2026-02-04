<?php

namespace App\Http\Controllers;

use App\Models\ProfileRuangan;
use App\Models\ProfileRuanganImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileRuanganController extends Controller
{
    public function index()
    {
        $items = ProfileRuangan::with('images')->orderBy('created_at', 'desc')->get();
        return view('admin.profile.index', compact('items'));
    }

    public function create()
    {
        return view('admin.profile.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'room_name' => 'required|string|max:255',
            'floor' => 'nullable|integer|min:1|max:7',
            'capacity' => 'nullable|integer',
            'description' => 'nullable|string',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'nullable|in:0,1,on,true,false',
        ], [
            'room_name.required' => 'Nama ruangan harus diisi.',
            'room_name.string' => 'Nama ruangan harus berupa teks.',
            'room_name.max' => 'Nama ruangan maksimal 255 karakter.',
            'floor.integer' => 'Lantai harus berupa angka.',
            'floor.min' => 'Lantai minimal 1.',
            'floor.max' => 'Lantai maksimal 7.',
            'capacity.integer' => 'Kapasitas harus berupa angka.',
            'description.string' => 'Deskripsi harus berupa teks.',
            'images.*.image' => 'File harus berupa gambar.',
            'images.*.mimes' => 'Format gambar harus JPEG, PNG, JPG, atau GIF.',
            'images.*.max' => 'Ukuran gambar maksimal 2MB.',
        ]);

        $data['is_active'] = $request->has('is_active') ? true : false;

        $profileRuangan = ProfileRuangan::create($data);

        // Handle multiple image uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('profile_ruangan_images', 'public');
                ProfileRuanganImage::create([
                    'profile_ruangan_id' => $profileRuangan->id,
                    'image_path' => $path,
                ]);
            }
        }

        return redirect()->route('admin.profile.index')->with('success', '✓ Profile ruangan berhasil ditambahkan!');
    }

    public function edit(ProfileRuangan $profile_ruangan)
    {
        // If JSON is requested, return JSON
        if (request()->wantsJson()) {
            return response()->json($profile_ruangan);
        }
        
        $profile_ruangan->load('images');
        return view('admin.profile.edit', compact('profile_ruangan'));
    }

    public function editModal(ProfileRuangan $profile_ruangan)
    {
        return response()->json($profile_ruangan);
    }

    public function update(Request $request, ProfileRuangan $profile_ruangan)
    {
        $data = $request->validate([
            'room_name' => 'required|string|max:255',
            'floor' => 'nullable|integer|min:1|max:7',
            'capacity' => 'nullable|integer',
            'description' => 'nullable|string',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'nullable|in:0,1,on,true,false',
        ], [
            'room_name.required' => 'Nama ruangan harus diisi.',
            'room_name.string' => 'Nama ruangan harus berupa teks.',
            'room_name.max' => 'Nama ruangan maksimal 255 karakter.',
            'floor.integer' => 'Lantai harus berupa angka.',
            'floor.min' => 'Lantai minimal 1.',
            'floor.max' => 'Lantai maksimal 7.',
            'capacity.integer' => 'Kapasitas harus berupa angka.',
            'description.string' => 'Deskripsi harus berupa teks.',
            'images.*.image' => 'File harus berupa gambar.',
            'images.*.mimes' => 'Format gambar harus JPEG, PNG, JPG, atau GIF.',
            'images.*.max' => 'Ukuran gambar maksimal 2MB.',
        ]);

        $data['is_active'] = $request->has('is_active') ? true : false;

        $profile_ruangan->update($data);

        // Handle new images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('profile_ruangan_images', 'public');
                ProfileRuanganImage::create([
                    'profile_ruangan_id' => $profile_ruangan->id,
                    'image_path' => $path,
                ]);
            }
        }

        return redirect()->route('admin.profile.index')->with('success', '✓ Profile ruangan berhasil diperbarui!');
    }

    public function destroy(ProfileRuangan $profile_ruangan)
    {
        // Hapus images dari storage
        foreach ($profile_ruangan->images as $image) {
            Storage::disk('public')->delete($image->image_path);
            $image->delete();
        }
        $profile_ruangan->delete();
        return redirect()->route('admin.profile.index')->with('success', '✓ Profile ruangan berhasil dihapus!');
    }

    public function publicIndex()
    {
        $items = ProfileRuangan::with('images')->where('is_active', true)->orderBy('created_at', 'desc')->get();
        return view('infobase.profile-ruangan', compact('items'));
    }

    public function deleteImage(ProfileRuanganImage $image)
    {
        $profileRuanganId = $image->profile_ruangan_id;
        
        // Hapus file dari storage
        Storage::disk('public')->delete($image->image_path);
        
        // Hapus record dari database
        $image->delete();
        
        return redirect()->route('admin.profile.edit', $profileRuanganId)->with('success', '✓ Gambar berhasil dihapus!');
    }
}