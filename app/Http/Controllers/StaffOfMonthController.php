<?php

namespace App\Http\Controllers;

use App\Models\StaffOfMonth;
use App\Models\Jabatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            ]);

            $exists = Jabatan::whereRaw('LOWER(name) = LOWER(?)', [$request->name])->exists();
            if ($exists) {
                return redirect()->back()->with('error', '✗ Posisi "' . $request->name . '" sudah ada!');
            }

            Jabatan::create($request->only('name'));
            return redirect()->back()->with('success', '✓ Posisi berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', '✗ Gagal menambahkan posisi: ' . $e->getMessage());
        }
    }

    public function destroyJabatan($id)
    {
        try {
            $jabatan = Jabatan::find($id);
            if (!$jabatan) {
                if (request()->expectsJson()) {
                    return response()->json(['success' => false, 'message' => 'Posisi tidak ditemukan!'], 404);
                }
                return redirect()->back()->with('error', 'Posisi tidak ditemukan!');
            }
            $jabatan->delete();
            
            if (request()->expectsJson()) {
                return response()->json(['success' => true, 'message' => 'Posisi berhasil dihapus!']);
            }
            
            return redirect()->back()->with('success', '✓ Posisi berhasil dihapus!');
        } catch (\Exception $e) {
            if (request()->expectsJson()) {
                return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
            }
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
                'year' => 'required|integer|min:2000',
                'bio' => 'nullable|string',
                'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:20480',
                'photo_link' => 'nullable|url',
            ]);

            // Cek duplikat: posisi sama di bulan yang sama
            $duplicate = StaffOfMonth::where('position', $data['position'])
                                     ->where('month', $data['month'])
                                     ->where('year', $data['year'])
                                     ->exists();
            
            if ($duplicate && $data['month']) {
                return redirect()->back()->with('error', '✗ Posisi "' . $data['position'] . '" sudah ada untuk bulan ini! Silakan ganti bulan atau posisi.')->withInput();
            }

            $data['is_active'] = $request->has('is_active');

            if ($request->hasFile('photo')) {
                // Simpan path ke variabel baru
                $data['photo_path'] = $request->file('photo')->store('staff_of_month', 'public');
            }

            // PENTING: Hapus 'photo' dari array agar tidak mencoba masuk ke kolom database
            unset($data['photo']);

            StaffOfMonth::create($data);
            return redirect()->route('admin.staff-of-month.index')->with('success', '✓ Staff of Month berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', '✗ Gagal menambahkan staff: ' . $e->getMessage())->withInput();
        }
    }

    public function edit($id)
    {
        $staffOfMonth = StaffOfMonth::find($id);
        if (!$staffOfMonth) {
            return redirect()->route('admin.staff-of-month.index')->with('error', 'Data tidak ditemukan!');
        }

        if (request()->expectsJson()) {
            return response()->json($staffOfMonth);
        }

        return view('admin.staff.edit', ['item' => $staffOfMonth]);
    }

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

            // Cek duplikat: posisi sama di bulan yang sama (kecuali record ini sendiri)
            $duplicate = StaffOfMonth::where('position', $data['position'])
                                     ->where('month', $data['month'])
                                     ->where('year', $data['year'])
                                     ->where('id', '!=', $id)
                                     ->exists();
            
            if ($duplicate && $data['month']) {
                return redirect()->back()->with('error', '✗ Posisi "' . $data['position'] . '" sudah ada untuk bulan ini! Silakan ganti bulan atau posisi.')->withInput();
            }

            $data['is_active'] = $request->has('is_active');

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

            // PENTING: Hapus 'photo' agar tidak error tipe data di database
            unset($data['photo']);

            $staffOfMonth->update($data);
            return redirect()->route('admin.staff-of-month.index')->with('success', '✓ Staff of Month berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', '✗ Gagal memperbarui staff: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $staffOfMonth = StaffOfMonth::find($id);
            if (!$staffOfMonth) {
                if (request()->expectsJson()) {
                    return response()->json(['success' => false, 'message' => 'Data tidak ditemukan!'], 404);
                }
                return redirect()->route('admin.staff-of-month.index')->with('error', 'Data tidak ditemukan!');
            }

            if ($staffOfMonth->photo_path) {
                Storage::disk('public')->delete($staffOfMonth->photo_path);
            }

            $staffOfMonth->delete();
            
            if (request()->expectsJson()) {
                return response()->json(['success' => true, 'message' => 'Staff of Month berhasil dihapus!']);
            }
            
            return redirect()->route('admin.staff-of-month.index')->with('success', '✓ Staff of Month berhasil dihapus!');
        } catch (\Exception $e) {
            if (request()->expectsJson()) {
                return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
            }
            return redirect()->back()->with('error', '✗ Gagal menghapus staff: ' . $e->getMessage());
        }
    }

    public function publicIndex()
    {
        $items = StaffOfMonth::where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->get();
        
        // Ambil bulan-bulan yang tersedia
        $availableMonths = $items->pluck('month')->filter()->unique()->sort()->values();
        
        // Group by position untuk menampilkan satu per posisi
        $itemsByPosition = $items->groupBy('position')->map(fn($group) => $group->first())->values();

        return view('infobase.staff-of-month', compact('items', 'itemsByPosition', 'availableMonths'));
    }
}