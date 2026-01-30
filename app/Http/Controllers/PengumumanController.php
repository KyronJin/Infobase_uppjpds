<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class PengumumanController extends Controller
{
    public function index()
    {
        // Untuk admin, tampilkan semua pengumuman, bukan hanya aktif
        $pengumumans = Pengumuman::latest('published_at')->get();
        return view('admin.pengumuman.index', compact('pengumumans'));
    }

    public function create()
    {
        return view('admin.pengumuman.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'published_at' => 'nullable|date',
            'unpublished_at' => 'nullable|date|after:published_at',
            'valid_from' => 'nullable|date',
            'valid_until' => 'nullable|date|after:valid_from',
        ]);

        // Konversi tanggal ke UTC dari Asia/Jakarta
        if ($validated['published_at']) {
            $validated['published_at'] = Carbon::parse($validated['published_at'], 'Asia/Jakarta')->setTimezone('UTC');
        }
        if ($validated['unpublished_at']) {
            $validated['unpublished_at'] = Carbon::parse($validated['unpublished_at'], 'Asia/Jakarta')->setTimezone('UTC');
        }
        if ($validated['valid_from']) {
            $validated['valid_from'] = Carbon::parse($validated['valid_from'], 'Asia/Jakarta')->setTimezone('UTC');
        }
        if ($validated['valid_until']) {
            $validated['valid_until'] = Carbon::parse($validated['valid_until'], 'Asia/Jakarta')->setTimezone('UTC');
        }

        if ($request->hasFile('image')) {
            $validated['image_path'] = $request->file('image')->store('pengumuman_images', 'public');
        }

        Pengumuman::create($validated);

        return redirect()->route('admin.pengumuman.index')->with('success', 'Pengumuman berhasil dibuat');
    }

    public function edit(Pengumuman $pengumuman)
    {
        return view('admin.pengumuman.edit', compact('pengumuman'));
    }

    public function update(Request $request, Pengumuman $pengumuman)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'published_at' => 'nullable|date',
            'unpublished_at' => 'nullable|date|after:published_at',
            'valid_from' => 'nullable|date',
            'valid_until' => 'nullable|date|after:valid_from',
        ]);

        // Konversi tanggal ke UTC dari Asia/Jakarta
        if ($validated['published_at']) {
            $validated['published_at'] = Carbon::parse($validated['published_at'], 'Asia/Jakarta')->setTimezone('UTC');
        }
        if ($validated['unpublished_at']) {
            $validated['unpublished_at'] = Carbon::parse($validated['unpublished_at'], 'Asia/Jakarta')->setTimezone('UTC');
        }
        if ($validated['valid_from']) {
            $validated['valid_from'] = Carbon::parse($validated['valid_from'], 'Asia/Jakarta')->setTimezone('UTC');
        }
        if ($validated['valid_until']) {
            $validated['valid_until'] = Carbon::parse($validated['valid_until'], 'Asia/Jakarta')->setTimezone('UTC');
        }

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($pengumuman->image_path) {
                Storage::disk('public')->delete($pengumuman->image_path);
            }
            $validated['image_path'] = $request->file('image')->store('pengumuman_images', 'public');
        }

        $pengumuman->update($validated);

        return redirect()->route('admin.pengumuman.index')->with('success', 'Pengumuman berhasil diperbarui');
    }

    public function destroy(Pengumuman $pengumuman)
    {
        if ($pengumuman->image_path) {
            Storage::disk('public')->delete($pengumuman->image_path);
        }
        $pengumuman->delete();

        return redirect()->route('admin.pengumuman.index')->with('success', 'Pengumuman berhasil dihapus');
    }

    public function show(Pengumuman $pengumuman)
    {
        // Pastikan pengumuman aktif untuk public
        if (!$pengumuman->active) {
            abort(404);
        }
        return view('infobase.pengumuman-detail', compact('pengumuman'));
    }
}