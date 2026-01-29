<?php

namespace App\Http\Controllers;

use App\Models\ProfileRuangan;
use Illuminate\Http\Request;

class ProfileRuanganController extends Controller
{
    public function index()
    {
        $items = ProfileRuangan::orderBy('created_at', 'desc')->get();
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
            'floor' => 'nullable|string|max:255',
            'capacity' => 'nullable|integer',
            'description' => 'nullable|string',
            'photo_link' => 'nullable|url',
            'is_active' => 'sometimes|boolean',
        ]);

        $data['is_active'] = $request->has('is_active');

        ProfileRuangan::create($data);

        return redirect()->route('admin.profile.index')->with('success', 'Created.');
    }

    public function edit(ProfileRuangan $profile_ruangan)
    {
        return view('admin.profile.edit', compact('profile_ruangan'));
    }

    public function update(Request $request, ProfileRuangan $profile_ruangan)
    {
        $data = $request->validate([
            'room_name' => 'required|string|max:255',
            'floor' => 'nullable|string|max:255',
            'capacity' => 'nullable|integer',
            'description' => 'nullable|string',
            'photo_link' => 'nullable|url',
            'is_active' => 'sometimes|boolean',
        ]);

        $data['is_active'] = $request->has('is_active');

        $profile_ruangan->update($data);

        return redirect()->route('admin.profile.index')->with('success', 'Updated.');
    }

    public function destroy(ProfileRuangan $profile_ruangan)
    {
        $profile_ruangan->delete();
        return redirect()->route('admin.profile.index')->with('success', 'Deleted.');
    }

    public function publicIndex()
    {
        $items = ProfileRuangan::where('is_active', true)->orderBy('created_at', 'desc')->get();
        return view('infobase.profile-ruangan', compact('items'));
    }
}
