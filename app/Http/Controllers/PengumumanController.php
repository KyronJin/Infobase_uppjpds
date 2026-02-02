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
            'published_at' => 'nullable|date_format:Y-m-d\TH:i',
            'valid_from' => 'nullable|date_format:Y-m-d',
            'valid_until' => 'nullable|date_format:Y-m-d',
        ], [
            'title.required' => 'Judul pengumuman harus diisi.',
            'title.string' => 'Judul pengumuman harus berupa teks.',
            'title.max' => 'Judul pengumuman maksimal 255 karakter.',
            'description.required' => 'Deskripsi pengumuman harus diisi.',
            'description.string' => 'Deskripsi pengumuman harus berupa teks.',
            'published_at.date_format' => 'Format tanggal dan waktu publikasi tidak valid.',
            'valid_from.date_format' => 'Format tanggal mulai berlaku tidak valid.',
            'valid_until.date_format' => 'Format tanggal berakhir tidak valid.',
        ]);

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
            ]);
        }
        
        return view('admin.pengumuman.edit', compact('pengumuman'));
    }

    public function update(Request $request, Pengumuman $pengumuman)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'published_at' => 'nullable|date_format:Y-m-d\TH:i',
            'valid_from' => 'nullable|date_format:Y-m-d',
            'valid_until' => 'nullable|date_format:Y-m-d',
        ], [
            'title.required' => 'Judul pengumuman harus diisi.',
            'title.string' => 'Judul pengumuman harus berupa teks.',
            'title.max' => 'Judul pengumuman maksimal 255 karakter.',
            'description.required' => 'Deskripsi pengumuman harus diisi.',
            'description.string' => 'Deskripsi pengumuman harus berupa teks.',
            'published_at.date_format' => 'Format tanggal dan waktu publikasi tidak valid.',
            'valid_from.date_format' => 'Format tanggal mulai berlaku tidak valid.',
            'valid_until.date_format' => 'Format tanggal berakhir tidak valid.',
        ]);

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