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
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi file gambar
            'is_active' => 'sometimes|boolean',
        ]);

        $data['is_active'] = $request->has('is_active');

        $profileRuangan = ProfileRuangan::create($data);

        // Handle multiple image uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('profile_ruangan_images', 'public'); // Simpan di storage/app/public
                ProfileRuanganImage::create([
                    'profile_ruangan_id' => $profileRuangan->id,
                    'image_path' => $path,
                ]);
            }
        }

        return redirect()->route('admin.profile.index')->with('success', 'Created.');
    }

    public function edit(ProfileRuangan $profile_ruangan)
    {
        $profile_ruangan->load('images');
        return view('admin.profile.edit', compact('profile_ruangan'));
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
            'is_active' => 'sometimes|boolean',
        ]);

        $data['is_active'] = $request->has('is_active');

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

        return redirect()->route('admin.profile.index')->with('success', 'Updated.');
    }

    public function destroy(ProfileRuangan $profile_ruangan)
    {
        // Hapus images dari storage
        foreach ($profile_ruangan->images as $image) {
            Storage::disk('public')->delete($image->image_path);
            $image->delete();
        }
        $profile_ruangan->delete();
        return redirect()->route('admin.profile.index')->with('success', 'Deleted.');
    }

    public function publicIndex()
    {
        $items = ProfileRuangan::with('images')->where('is_active', true)->orderBy('created_at', 'desc')->get();
        return view('infobase.profile-ruangan', compact('items'));
    }
}