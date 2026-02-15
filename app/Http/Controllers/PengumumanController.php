<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Carbon\Carbon;

class PengumumanController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $status = $request->input('status');
        
        $query = Pengumuman::query();
        
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Filter berdasarkan status di admin (opsional, bisa dikosongkan)
        if (!empty($status) && Schema::hasColumn('pengumumans', 'status')) {
            if ($status === 'active') {
                $query->where('status', 'active');
            } elseif ($status === 'inactive') {
                $query->where('status', 'inactive');
            }
        }
        
        // Untuk admin, tampilkan semua pengumuman, bukan hanya aktif
        $pengumumans = $query->latest('published_at')->paginate(10);
        
        return view('admin.pengumuman.index', compact('pengumumans', 'search', 'status'));
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:20480',
            'published_at' => 'required|date_format:Y-m-d\TH:i',
            'unpublished_at' => 'required|date_format:Y-m-d\TH:i|after:published_at',
            'valid_from' => 'required|date_format:Y-m-d',
            'valid_until' => 'required|date_format:Y-m-d|after_or_equal:valid_from',
            'status' => 'required|in:active,inactive',
        ], [
            'title.required' => 'Judul pengumuman harus diisi.',
            'title.string' => 'Judul pengumuman harus berupa teks.',
            'title.max' => 'Judul pengumuman maksimal 255 karakter.',
            'description.required' => 'Deskripsi pengumuman harus diisi.',
            'description.string' => 'Deskripsi pengumuman harus berupa teks.',
            'image.image' => 'File harus berupa gambar.',
            'image.mimes' => 'Format gambar harus: jpeg, png, jpg, gif, atau svg.',
            'image.max' => 'Ukuran gambar maksimal 20 MB.',
            'published_at.required' => 'Tanggal publikasi harus diisi.',
            'published_at.date_format' => 'Format tanggal dan waktu publikasi tidak valid.',
            'unpublished_at.required' => 'Tanggal unpublikasi harus diisi.',
            'unpublished_at.date_format' => 'Format tanggal dan waktu unpublikasi tidak valid.',
            'unpublished_at.after' => 'Tanggal unpublikasi harus setelah tanggal publikasi.',
            'valid_from.required' => 'Tanggal mulai berlaku harus diisi.',
            'valid_from.date_format' => 'Format tanggal mulai berlaku tidak valid.',
            'valid_until.required' => 'Tanggal berakhir berlaku harus diisi.',
            'valid_until.date_format' => 'Format tanggal berakhir berlaku tidak valid.',
            'valid_until.after_or_equal' => 'Tanggal berakhir berlaku harus sama atau setelah mulai berlaku.',
            'status.required' => 'Status harus dipilih.',
            'status.in' => 'Status harus berupa "active" atau "inactive".',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('pengumuman', 'public');
            $validated['image_path'] = $imagePath;
        }

        // Konversi tanggal dari input form ke UTC
        $validated['published_at'] = Carbon::parse($validated['published_at'], 'Asia/Jakarta')->setTimezone('UTC');
        $validated['unpublished_at'] = Carbon::parse($validated['unpublished_at'], 'Asia/Jakarta')->setTimezone('UTC');
        $validated['valid_from'] = Carbon::parse($validated['valid_from'], 'Asia/Jakarta')->startOfDay()->setTimezone('UTC');
        $validated['valid_until'] = Carbon::parse($validated['valid_until'], 'Asia/Jakarta')->endOfDay()->setTimezone('UTC');

        // Add status column if not exists
        if (!Schema::hasColumn('pengumumans', 'status')) {
            Schema::table('pengumumans', function (Blueprint $table) {
                $table->string('status')->default('active');
            });
        }

        // Remove image key if it wasn't processed
        unset($validated['image']);

        $pengumuman = Pengumuman::create($validated);

        return redirect()->route('admin.pengumuman.index')->with('success', '✓ Pengumuman "' . $pengumuman->title . '" telah berhasil ditambahkan ke sistem.');
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
                'status' => $pengumuman->status,
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:20480',
            'published_at' => 'required|date_format:Y-m-d\TH:i',
            'unpublished_at' => 'required|date_format:Y-m-d\TH:i|after:published_at',
            'valid_from' => 'required|date_format:Y-m-d',
            'valid_until' => 'required|date_format:Y-m-d|after_or_equal:valid_from',
            'status' => 'required|in:active,inactive',
        ], [
            'title.required' => 'Judul pengumuman harus diisi.',
            'title.string' => 'Judul pengumuman harus berupa teks.',
            'title.max' => 'Judul pengumuman maksimal 255 karakter.',
            'description.required' => 'Deskripsi pengumuman harus diisi.',
            'description.string' => 'Deskripsi pengumuman harus berupa teks.',
            'image.image' => 'File harus berupa gambar.',
            'image.mimes' => 'Format gambar harus: jpeg, png, jpg, gif, atau svg.',
            'image.max' => 'Ukuran gambar maksimal 20 MB.',
            'published_at.required' => 'Tanggal publikasi harus diisi.',
            'published_at.date_format' => 'Format tanggal dan waktu publikasi tidak valid.',
            'unpublished_at.required' => 'Tanggal unpublikasi harus diisi.',
            'unpublished_at.date_format' => 'Format tanggal dan waktu unpublikasi tidak valid.',
            'unpublished_at.after' => 'Tanggal unpublikasi harus setelah tanggal publikasi.',
            'valid_from.required' => 'Tanggal mulai berlaku harus diisi.',
            'valid_from.date_format' => 'Format tanggal mulai berlaku tidak valid.',
            'valid_until.required' => 'Tanggal berakhir berlaku harus diisi.',
            'valid_until.date_format' => 'Format tanggal berakhir berlaku tidak valid.',
            'valid_until.after_or_equal' => 'Tanggal berakhir berlaku harus sama atau setelah mulai berlaku.',
            'status.required' => 'Status harus dipilih.',
            'status.in' => 'Status harus berupa "active" atau "inactive".',
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

        // Konversi tanggal dari input form ke UTC
        $validated['published_at'] = Carbon::parse($validated['published_at'], 'Asia/Jakarta')->setTimezone('UTC');
        $validated['unpublished_at'] = Carbon::parse($validated['unpublished_at'], 'Asia/Jakarta')->setTimezone('UTC');
        $validated['valid_from'] = Carbon::parse($validated['valid_from'], 'Asia/Jakarta')->startOfDay()->setTimezone('UTC');
        $validated['valid_until'] = Carbon::parse($validated['valid_until'], 'Asia/Jakarta')->endOfDay()->setTimezone('UTC');

        // Remove image key if it wasn't processed
        unset($validated['image']);

        $pengumuman->update($validated);

        return redirect()->route('admin.pengumuman.index')->with('success', '✓ Pengumuman "' . $pengumuman->title . '" telah berhasil diperbarui di sistem.');
    }

    public function destroy(Pengumuman $pengumuman)
    {
        try {
            $title = $pengumuman->title;
            
            if ($pengumuman->image_path) {
                Storage::disk('public')->delete($pengumuman->image_path);
            }
            $pengumuman->delete();

            // Check if this is an AJAX request
            if (request()->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => '"' . $title . '" telah berhasil dihapus dari sistem.'
                ]);
            }

            return redirect()->route('admin.pengumuman.index')->with('success', [
                'title' => '✓ Pengumuman Dihapus',
                'message' => '"' . $title . '" telah berhasil dihapus dari sistem.',
                'type' => 'success',
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            if (request()->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Pengumuman tidak ditemukan atau sudah dihapus.'
                ], 404);
            }
            return redirect()->route('admin.pengumuman.index')->with('error', 'Pengumuman tidak ditemukan atau sudah dihapus.');
        } catch (\Exception $e) {
            if (request()->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal menghapus: ' . $e->getMessage()
                ], 500);
            }
            return redirect()->route('admin.pengumuman.index')->with('error', 'Gagal menghapus: ' . $e->getMessage());
        }
    }

    public function show(Pengumuman $pengumuman)
    {
        // Update expired status terlebih dahulu
        Pengumuman::updateExpiredStatus();
        
        // Refresh model untuk mendapat status terbaru
        $pengumuman->refresh();
        
        // Cek apakah pengumuman masih aktif dan dalam range berlaku
        $now = now();
        $isPublished = !$pengumuman->published_at || $pengumuman->published_at <= $now;
        $isNotUnpublished = !$pengumuman->unpublished_at || $pengumuman->unpublished_at >= $now;
        $isValidFromPassed = !$pengumuman->valid_from || $pengumuman->valid_from <= $now;
        $isValidUntilNotPassed = !$pengumuman->valid_until || $pengumuman->valid_until >= $now;
        $isActive = $pengumuman->status === 'active';
        
        // Jika pengumuman tidak aktif atau sudah expired, tampilkan 404
        if (!($isPublished && $isNotUnpublished && $isValidFromPassed && $isValidUntilNotPassed && $isActive)) {
            abort(404, 'Pengumuman tidak ditemukan');
        }
        
        return view('infobase.pengumuman-detail', compact('pengumuman'));
    }
}