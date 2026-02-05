<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class PengumumanController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        
        $query = Pengumuman::query();
        
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }
        
        // Untuk admin, tampilkan semua pengumuman, bukan hanya aktif
        $pengumumans = $query->latest('published_at')->paginate(10);
        return view('admin.pengumuman.index', compact('pengumumans', 'search'));
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'published_at' => 'nullable|date_format:Y-m-d\TH:i',
            'valid_from' => 'nullable|date_format:Y-m-d',
            'valid_until' => 'nullable|date_format:Y-m-d',
        ], [
            'title.required' => 'Judul pengumuman harus diisi.',
            'title.string' => 'Judul pengumuman harus berupa teks.',
            'title.max' => 'Judul pengumuman maksimal 255 karakter.',
            'description.required' => 'Deskripsi pengumuman harus diisi.',
            'description.string' => 'Deskripsi pengumuman harus berupa teks.',
            'image.image' => 'File harus berupa gambar.',
            'image.mimes' => 'Format gambar harus: jpeg, png, jpg, gif, atau svg.',
            'image.max' => 'Ukuran gambar maksimal 2 MB.',
            'published_at.date_format' => 'Format tanggal dan waktu publikasi tidak valid.',
            'valid_from.date_format' => 'Format tanggal mulai berlaku tidak valid.',
            'valid_until.date_format' => 'Format tanggal berakhir tidak valid.',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('pengumuman', 'public');
            $validated['image_path'] = $imagePath;
        }

        // Konversi tanggal dari datetime-local ke UTC
        if ($validated['published_at']) {
            $validated['published_at'] = Carbon::parse($validated['published_at'], 'Asia/Jakarta')->setTimezone('UTC');
        }
        if ($validated['valid_from']) {
            $validated['valid_from'] = Carbon::parse($validated['valid_from'], 'Asia/Jakarta')->setTimezone('UTC');
        }
        if ($validated['valid_until']) {
            $validated['valid_until'] = Carbon::parse($validated['valid_until'], 'Asia/Jakarta')->setTimezone('UTC');
        }

        // Remove image key if it wasn't processed
        unset($validated['image']);

        Pengumuman::create($validated);

        return redirect()->route('admin.pengumuman.index')->with('success', '✓ Pengumuman berhasil ditambahkan!');
    }

    public function edit(Pengumuman $pengumuman)
    {
        // Untuk AJAX request, return JSON
        if (request()->expectsJson()) {
            return response()->json([
                'id' => $pengumuman->id,
                'title' => $pengumuman->title,
                'description' => $pengumuman->description,
                'published_at' => $pengumuman->published_at?->format('Y-m-d\TH:i'),
                'valid_from' => $pengumuman->valid_from?->format('Y-m-d'),
                'valid_until' => $pengumuman->valid_until?->format('Y-m-d'),
                'image_path' => $pengumuman->image_path,
            ]);
        }
        
        return view('admin.pengumuman.edit', compact('pengumuman'));
    }

    public function update(Request $request, Pengumuman $pengumuman)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'published_at' => 'nullable|date_format:Y-m-d\TH:i',
            'valid_from' => 'nullable|date_format:Y-m-d',
            'valid_until' => 'nullable|date_format:Y-m-d',
        ], [
            'title.required' => 'Judul pengumuman harus diisi.',
            'title.string' => 'Judul pengumuman harus berupa teks.',
            'title.max' => 'Judul pengumuman maksimal 255 karakter.',
            'description.required' => 'Deskripsi pengumuman harus diisi.',
            'description.string' => 'Deskripsi pengumuman harus berupa teks.',
            'image.image' => 'File harus berupa gambar.',
            'image.mimes' => 'Format gambar harus: jpeg, png, jpg, gif, atau svg.',
            'image.max' => 'Ukuran gambar maksimal 2 MB.',
            'published_at.date_format' => 'Format tanggal dan waktu publikasi tidak valid.',
            'valid_from.date_format' => 'Format tanggal mulai berlaku tidak valid.',
            'valid_until.date_format' => 'Format tanggal berakhir tidak valid.',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($pengumuman->image_path) {
                Storage::disk('public')->delete($pengumuman->image_path);
            }
            $imagePath = $request->file('image')->store('pengumuman', 'public');
            $validated['image_path'] = $imagePath;
        }

        // Konversi tanggal dari datetime-local ke UTC
        if ($validated['published_at']) {
            $validated['published_at'] = Carbon::parse($validated['published_at'], 'Asia/Jakarta')->setTimezone('UTC');
        }
        if ($validated['valid_from']) {
            $validated['valid_from'] = Carbon::parse($validated['valid_from'], 'Asia/Jakarta')->setTimezone('UTC');
        }
        if ($validated['valid_until']) {
            $validated['valid_until'] = Carbon::parse($validated['valid_until'], 'Asia/Jakarta')->setTimezone('UTC');
        }

        // Remove image key if it wasn't processed
        unset($validated['image']);

        $pengumuman->update($validated);

        return redirect()->route('admin.pengumuman.index')->with('success', '✓ Pengumuman berhasil diperbarui!');
    }

    public function destroy(Pengumuman $pengumuman)
    {
        if ($pengumuman->image_path) {
            Storage::disk('public')->delete($pengumuman->image_path);
        }
        $pengumuman->delete();

        return redirect()->route('admin.pengumuman.index')->with('success', '✓ Pengumuman berhasil dihapus!');
    }

    public function show(Pengumuman $pengumuman)
    {
        return view('infobase.pengumuman-detail', compact('pengumuman'));
    }
}