<?php

namespace App\Http\Controllers;

use App\Models\ProfilPegawai;
use App\Models\Jabatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProfilPegawaiController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        
        $query = ProfilPegawai::with('jabatan')
            ->whereHas('jabatan');
            
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%")
                  ->orWhereHas('jabatan', function ($subQ) use ($search) {
                      $subQ->where('name', 'like', "%{$search}%");
                  });
            });
        }
        
        $items = $query->orderBy('created_at', 'desc')->paginate(12);
        $jabatans = Jabatan::all();

        return view('admin.profil_pegawai.index', compact('items', 'jabatans', 'search'));
    }

    public function storeJabatan(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ], [
            'name.required' => 'Nama jabatan harus diisi.',
            'name.string' => 'Nama jabatan harus berupa teks.',
            'name.max' => 'Nama jabatan maksimal 255 karakter.',
        ]);

        Jabatan::create($request->only('name'));

        return redirect()->back()->with('success', '✓ Jabatan berhasil ditambahkan!');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'       => 'required|string|max:255',
            'jabatan_id' => 'required|exists:jabatans,id',
            'deskripsi'  => 'required|string',
            'foto'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'nama.required' => 'Nama pegawai harus diisi.',
            'nama.string' => 'Nama pegawai harus berupa teks.',
            'nama.max' => 'Nama pegawai maksimal 255 karakter.',
            'jabatan_id.required' => 'Jabatan harus dipilih.',
            'jabatan_id.exists' => 'Jabatan yang dipilih tidak valid.',
            'deskripsi.required' => 'Deskripsi pegawai harus diisi.',
            'deskripsi.string' => 'Deskripsi pegawai harus berupa teks.',
            'foto.image' => 'File harus berupa gambar.',
            'foto.mimes' => 'Format gambar harus JPEG, PNG, JPG, atau GIF.',
            'foto.max' => 'Ukuran gambar maksimal 2MB.',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto_path'] = $request->file('foto')->store('profil_pegawai', 'public');
        }

        ProfilPegawai::create($validated);

        return redirect()->route('admin.profil_pegawai.index')
            ->with('success', '✓ Profil Pegawai berhasil ditambahkan!');
    }

    public function edit($id)
    {
        try {
            $profil_pegawai = ProfilPegawai::findOrFail($id);
            $jabatans = Jabatan::ordered()->get();

            // If JSON is requested, return JSON
            if (request()->wantsJson()) {
                return response()->json($profil_pegawai);
            }

            return view('admin.profil_pegawai.edit', compact('profil_pegawai', 'jabatans'));
        } catch (ModelNotFoundException $e) {
            return redirect()->route('admin.profil_pegawai.index')
                ->with('error', 'Data pegawai tidak ditemukan.');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $profil_pegawai = ProfilPegawai::findOrFail($id);

            $validated = $request->validate([
                'nama'       => 'required|string|max:255',
                'jabatan_id' => 'required|exists:jabatans,id',
                'deskripsi'  => 'required|string',
                'foto'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ], [
                'nama.required' => 'Nama pegawai harus diisi.',
                'nama.string' => 'Nama pegawai harus berupa teks.',
                'nama.max' => 'Nama pegawai maksimal 255 karakter.',
                'jabatan_id.required' => 'Jabatan harus dipilih.',
                'jabatan_id.exists' => 'Jabatan yang dipilih tidak valid.',
                'deskripsi.required' => 'Deskripsi pegawai harus diisi.',
                'deskripsi.string' => 'Deskripsi pegawai harus berupa teks.',
                'foto.image' => 'File harus berupa gambar.',
                'foto.mimes' => 'Format gambar harus JPEG, PNG, JPG, atau GIF.',
                'foto.max' => 'Ukuran gambar maksimal 2MB.',
            ]);

            if ($request->hasFile('foto')) {
                // Hapus foto lama jika ada
                if ($profil_pegawai->foto_path) {
                    Storage::disk('public')->delete($profil_pegawai->foto_path);
                }
                $validated['foto_path'] = $request->file('foto')->store('profil_pegawai', 'public');
            }

            $profil_pegawai->update($validated);

            return redirect()->route('admin.profil_pegawai.index')
                ->with('success', '✓ Profil Pegawai berhasil diperbarui!');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('admin.profil_pegawai.index')
                ->with('error', '✗ Data pegawai tidak ditemukan!');
        }
    }

    public function destroy($id)
    {
        try {
            $profil_pegawai = ProfilPegawai::findOrFail($id);

            if ($profil_pegawai->foto_path) {
                Storage::disk('public')->delete($profil_pegawai->foto_path);
            }

            $profil_pegawai->delete();

            return redirect()->route('admin.profil_pegawai.index')
                ->with('success', '✓ Profil Pegawai berhasil dihapus!');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('admin.profil_pegawai.index')
                ->with('error', '✗ Data pegawai tidak ditemukan!');
        }
    }

    // Halaman public (slider / daftar pegawai)
    public function publicIndex(Request $request)
    {
        $search = $request->query('search', '');
        
        $query = ProfilPegawai::with('jabatan')
            ->whereHas('jabatan');

        // Apply search if provided
        if (!empty($search)) {
            $query->search($search);
        }

        $pegawai = $query->orderBy('created_at', 'desc')->paginate(12);
        $jabatans = Jabatan::ordered()->get();

        return view('infobase.profil-pegawai', compact('pegawai', 'jabatans', 'search'));
    }

    public function updateOrder(Request $request)
    {
        $request->validate([
            'jabatans'   => 'required|array',
            'jabatans.*' => 'integer|exists:jabatans,id',
        ]);

        foreach ($request->jabatans as $index => $jabatanId) {
            Jabatan::where('id', $jabatanId)->update(['order' => $index + 1]);
        }

        return response()->json(['success' => true]);
    }
}