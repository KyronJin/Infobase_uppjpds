<?php

namespace App\Http\Controllers;

use App\Models\StaffOfMonth;
use App\Models\Jabatan;
use Illuminate\Http\Request;

class StaffOfMonthController extends Controller
{
    public function index()
    {
        $items = StaffOfMonth::orderBy('created_at', 'desc')->paginate(12);
        $jabatans = Jabatan::all();
        return view('admin.staff.index', compact('items', 'jabatans'));
    }

    public function create()
    {
        $jabatans = Jabatan::all();
        return view('admin.staff.create', compact('jabatans'));
    }

    public function storeJabatan(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
            ], [
                'name.required' => 'Nama posisi harus diisi.',
                'name.string' => 'Nama posisi harus berupa teks.',
                'name.max' => 'Nama posisi maksimal 255 karakter.',
            ]);

            // Check if jabatan already exists (case-insensitive)
            $exists = Jabatan::whereRaw('LOWER(name) = LOWER(?)', [$request->name])->exists();
            
            if ($exists) {
                return redirect()->back()->with('error', '✗ Posisi "' . $request->name . '" sudah ada!');
            }

            Jabatan::create($request->only('name'));

            return redirect()->back()->with('success', '✓ Posisi berhasil ditambahkan!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', '✗ Gagal menambahkan posisi: ' . $e->getMessage());
        }
    }

    public function destroyJabatan(Jabatan $jabatan)
    {
        try {
            $jabatan->delete();
            return redirect()->back()->with('success', '✓ Posisi berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', '✗ Gagal menghapus posisi: ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'name' => 'required|string|max:255',
                'position' => 'required|string|max:255',
                'month' => 'nullable|integer|min:1|max:12',
                'year' => 'nullable|integer|min:2026',
                'bio' => 'nullable|string',
                'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'photo_link' => 'nullable|url',
            ], [
                'name.required' => 'Nama staff harus diisi.',
                'name.string' => 'Nama staff harus berupa teks.',
                'name.max' => 'Nama staff maksimal 255 karakter.',
                'position.required' => 'Posisi harus dipilih.',
                'position.string' => 'Posisi harus berupa teks.',
                'position.max' => 'Posisi maksimal 255 karakter.',
                'month.integer' => 'Bulan harus berupa angka.',
                'month.min' => 'Bulan minimal 1.',
                'month.max' => 'Bulan maksimal 12.',
                'year.integer' => 'Tahun harus berupa angka.',
                'year.min' => 'Tahun minimal 2026.',
                'bio.string' => 'Biodata harus berupa teks.',
                'photo.image' => 'File harus berupa gambar.',
                'photo.mimes' => 'Format gambar harus JPEG, PNG, JPG, atau GIF.',
                'photo.max' => 'Ukuran gambar maksimal 2MB.',
                'photo_link.url' => 'Link foto harus berupa URL yang valid.',
            ]);

            $data['is_active'] = $request->has('is_active') ? true : false;

            // Handle photo upload
            if ($request->hasFile('photo')) {
                try {
                    $data['photo_path'] = $request->file('photo')->store('staff_of_month', 'public');
                } catch (\Exception $e) {
                    return redirect()->back()->with('error', '✗ Gagal upload foto: ' . $e->getMessage())->withInput();
                }
            }

            StaffOfMonth::create($data);

            return redirect()->route('admin.staff-of-month.index')->with('success', '✓ Staff of Month berhasil ditambahkan!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', '✗ Gagal menambahkan staff: ' . $e->getMessage())->withInput();
        }
    }

    public function edit(StaffOfMonth $staffOfMonth)
    {
        // Untuk AJAX request, return JSON
        if (request()->expectsJson()) {
            return response()->json([
                'id' => $staffOfMonth->id,
                'name' => $staffOfMonth->name,
                'position' => $staffOfMonth->position,
                'month' => $staffOfMonth->month,
                'year' => $staffOfMonth->year,
                'bio' => $staffOfMonth->bio,
                'photo_path' => $staffOfMonth->photo_path,
                'photo_link' => $staffOfMonth->photo_link,
                'is_active' => $staffOfMonth->is_active,
            ]);
        }
        
        return view('admin.staff.edit', ['item' => $staffOfMonth]);
    }

    public function update(Request $request, StaffOfMonth $staffOfMonth)
    {
        try {
            $data = $request->validate([
                'name' => 'required|string|max:255',
                'position' => 'required|string|max:255',
                'month' => 'nullable|integer|min:1|max:12',
                'year' => 'nullable|integer|min:2026',
                'bio' => 'nullable|string',
                'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'photo_link' => 'nullable|url',
                'delete_photo' => 'nullable|in:0,1',
            ], [
                'name.required' => 'Nama staff harus diisi.',
                'name.string' => 'Nama staff harus berupa teks.',
                'name.max' => 'Nama staff maksimal 255 karakter.',
                'position.required' => 'Posisi harus dipilih.',
                'position.string' => 'Posisi harus berupa teks.',
                'position.max' => 'Posisi maksimal 255 karakter.',
                'month.integer' => 'Bulan harus berupa angka.',
                'month.min' => 'Bulan minimal 1.',
                'month.max' => 'Bulan maksimal 12.',
                'year.integer' => 'Tahun harus berupa angka.',
                'year.min' => 'Tahun minimal 2026.',
                'bio.string' => 'Biodata harus berupa teks.',
                'photo.image' => 'File harus berupa gambar.',
                'photo.mimes' => 'Format gambar harus JPEG, PNG, JPG, atau GIF.',
                'photo.max' => 'Ukuran gambar maksimal 2MB.',
                'photo_link.url' => 'Link foto harus berupa URL yang valid.',
            ]);

            $data['is_active'] = $request->has('is_active') ? true : false;

            // Handle photo deletion
            if ($request->input('delete_photo') === '1') {
                try {
                    if ($staffOfMonth->photo_path) {
                        \Illuminate\Support\Facades\Storage::disk('public')->delete($staffOfMonth->photo_path);
                    }
                    $data['photo_path'] = null;
                } catch (\Exception $e) {
                    \Log::warning('Failed to delete photo: ' . $e->getMessage());
                }
            }

            // Handle photo upload
            if ($request->hasFile('photo')) {
                try {
                    // Delete old photo
                    if ($staffOfMonth->photo_path) {
                        \Illuminate\Support\Facades\Storage::disk('public')->delete($staffOfMonth->photo_path);
                    }
                    $data['photo_path'] = $request->file('photo')->store('staff_of_month', 'public');
                } catch (\Exception $e) {
                    return redirect()->back()->with('error', '✗ Gagal upload foto: ' . $e->getMessage())->withInput();
                }
            }

            $staffOfMonth->update($data);

            return redirect()->route('admin.staff-of-month.index')->with('success', '✓ Staff of Month berhasil diperbarui!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', '✗ Gagal memperbarui staff: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy(StaffOfMonth $staffOfMonth)
    {
        try {
            // Delete photo if exists
            if ($staffOfMonth->photo_path) {
                try {
                    \Illuminate\Support\Facades\Storage::disk('public')->delete($staffOfMonth->photo_path);
                } catch (\Exception $e) {
                    // Continue with deletion even if photo deletion fails
                    \Log::warning('Failed to delete photo: ' . $e->getMessage());
                }
            }
            $staffOfMonth->delete();
            return redirect()->route('admin.staff-of-month.index')->with('success', '✓ Staff of Month berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', '✗ Gagal menghapus staff: ' . $e->getMessage());
        }
    }

    public function publicIndex()
    {
        // Get latest/best staff for each position
        $items = StaffOfMonth::where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy('position')
            ->map(function($group) {
                return $group->first(); // Get the most recent staff for each position
            })
            ->values(); // Reset array keys
        
        return view('infobase.staff', compact('items'));
    }
}
