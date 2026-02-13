<?php

namespace App\Http\Controllers;

use App\Models\StaffOfMonth;
use App\Models\Jabatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StaffOfMonthController extends Controller
{
    /**
     * Tampilan Utama: Menampilkan staff dan daftar posisi (Jabatan).
     */
    public function index()
    {
        $items = StaffOfMonth::orderBy('created_at', 'desc')->paginate(12);
        // Penting: Ambil data jabatan agar tombol/modal posisi berfungsi
        $jabatans = Jabatan::orderBy('name', 'asc')->get(); 
        return view('admin.staff.index', compact('items', 'jabatans'));
    }

    /**
     * Form Tambah Staff.
     */
    public function create()
    {
        // Pastikan jabatans dikirim agar dropdown posisi muncul
        $jabatans = Jabatan::orderBy('name', 'asc')->get();
        return view('admin.staff.create', compact('jabatans'));
    }

    /**
     * Fungsi Simpan Posisi Jabatan Baru.
     */
    public function storeJabatan(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
            ]);

            // Cek duplikat (Case Insensitive)
            $exists = Jabatan::whereRaw('LOWER(name) = LOWER(?)', [trim($request->name)])->exists();
            if ($exists) {
                return redirect()->back()->with('error', '✗ Posisi "' . $request->name . '" sudah ada!');
            }

            Jabatan::create(['name' => trim($request->name)]);
            return redirect()->back()->with('success', '✓ Posisi berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', '✗ Gagal menambahkan posisi: ' . $e->getMessage());
        }
    }

    /**
     * Fungsi Hapus Posisi Jabatan.
     */
    public function destroyJabatan($id)
    {
        try {
            $jabatan = Jabatan::findOrFail($id);
            $jabatan->delete();
            
            if (request()->expectsJson()) {
                return response()->json(['success' => true, 'message' => 'Posisi berhasil dihapus!']);
            }
            
            return redirect()->back()->with('success', '✓ Posisi berhasil dihapus!');
        } catch (\Exception $e) {
            if (request()->expectsJson()) {
                return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
            }
            return redirect()->back()->with('error', '✗ Gagal menghapus posisi.');
        }
    }

    /**
     * Simpan Staff of Month Baru.
     */
    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'name' => 'required|string|max:255',
                'position' => 'required|string|max:255',
                'month' => 'nullable|integer|min:1|max:12',
                'year' => 'required|integer|min:2000',
                'bio' => 'nullable|string',
                'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:20480',
                'photo_link' => 'nullable|url',
            ]);

            // Cek duplikat staff pada posisi & periode yang sama
            $duplicate = StaffOfMonth::where('position', $data['position'])
                                     ->where('month', $data['month'])
                                     ->where('year', $data['year'])
                                     ->exists();
            
            if ($duplicate && $data['month']) {
                return redirect()->back()->with('error', '✗ Posisi tersebut sudah terisi untuk bulan ini!')->withInput();
            }

            $data['is_active'] = $request->has('is_active');

            if ($request->hasFile('photo')) {
                $data['photo_path'] = $request->file('photo')->store('staff_of_month', 'public');
            }

            unset($data['photo']); // Hapus 'photo' agar tidak masuk ke kolom database
            StaffOfMonth::create($data);

            return redirect()->route('admin.staff-of-month.index')->with('success', '✓ Staff berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', '✗ Gagal: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Form Edit Staff (Perbaikan Utama).
     */
    public function edit($id)
    {
        $staffOfMonth = StaffOfMonth::findOrFail($id);
        
        // PERBAIKAN: Harus ambil $jabatans agar dropdown posisi muncul di form edit
        $jabatans = Jabatan::orderBy('name', 'asc')->get();

        if (request()->expectsJson()) {
            return response()->json([
                'staff' => $staffOfMonth,
                'jabatans' => $jabatans
            ]);
        }

        return view('admin.staff.edit', [
            'item' => $staffOfMonth,
            'jabatans' => $jabatans // Kirim variabel posisi ke view edit
        ]);
    }

    /**
     * Update Data Staff & Posisi.
     */
    public function update(Request $request, $id)
    {
        try {
            $staffOfMonth = StaffOfMonth::findOrFail($id);

            $data = $request->validate([
                'name' => 'required|string|max:255',
                'position' => 'required|string|max:255',
                'month' => 'nullable|integer|min:1|max:12',
                'year' => 'required|integer|min:2000',
                'bio' => 'nullable|string',
                'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:20480',
                'photo_link' => 'nullable|url',
                'delete_photo' => 'nullable|in:0,1',
            ]);

            // Cek duplikat kecuali untuk ID yang sedang diupdate
            $duplicate = StaffOfMonth::where('position', $data['position'])
                                     ->where('month', $data['month'])
                                     ->where('year', $data['year'])
                                     ->where('id', '!=', $id)
                                     ->exists();
            
            if ($duplicate && $data['month']) {
                return redirect()->back()->with('error', '✗ Posisi ini sudah diisi staff lain pada periode ini!')->withInput();
            }

            $data['is_active'] = $request->has('is_active');

            // Logika hapus/ganti foto
            if ($request->input('delete_photo') === '1' && $staffOfMonth->photo_path) {
                Storage::disk('public')->delete($staffOfMonth->photo_path);
                $data['photo_path'] = null;
            }

            if ($request->hasFile('photo')) {
                if ($staffOfMonth->photo_path) {
                    Storage::disk('public')->delete($staffOfMonth->photo_path);
                }
                $data['photo_path'] = $request->file('photo')->store('staff_of_month', 'public');
            }

            unset($data['photo']);
            $staffOfMonth->update($data);

            return redirect()->route('admin.staff-of-month.index')->with('success', '✓ Berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', '✗ Gagal update: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Hapus Staff.
     */
    public function destroy($id)
    {
        try {
            $staffOfMonth = StaffOfMonth::findOrFail($id);

            if ($staffOfMonth->photo_path) {
                Storage::disk('public')->delete($staffOfMonth->photo_path);
            }

            $staffOfMonth->delete();
            return redirect()->route('admin.staff-of-month.index')->with('success', '✓ Staff berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', '✗ Gagal menghapus staff.');
        }
    }

    /**
     * Tampilan Publik.
     */
    public function publicIndex()
    {
        $items = StaffOfMonth::where('is_active', true)
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();
        
        $availableMonths = $items->pluck('month')->filter()->unique()->sort()->values();
        $itemsByPosition = $items->groupBy('position')->map(fn($group) => $group->first())->values();

        return view('infobase.staff-of-month', compact('items', 'itemsByPosition', 'availableMonths'));
    }
}