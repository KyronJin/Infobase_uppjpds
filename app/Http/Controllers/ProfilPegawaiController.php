<?php

namespace App\Http\Controllers;

use App\Models\ProfilPegawai;
use App\Models\Jabatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfilPegawaiController extends Controller
{
    public function index()
{
    $items = ProfilPegawai::with('jabatan')->whereHas('jabatan')->orderBy('created_at', 'desc')->get();
    $jabatans = Jabatan::all();
    return view('admin.profil_pegawai.index', compact('items', 'jabatans'));
}

    public function storeJabatan(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);
        Jabatan::create($request->only('name'));
        return redirect()->back()->with('success', 'Jabatan berhasil ditambahkan.');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan_id' => 'required|exists:jabatans,id',
            'deskripsi' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto_path'] = $request->file('foto')->store('profil_pegawai', 'public');
        }

        ProfilPegawai::create($validated);

        return redirect()->route('admin.profil_pegawai.index')->with('success', 'Profil Pegawai berhasil ditambahkan.');
    }

    public function edit(ProfilPegawai $profil_pegawai)
    {
        $jabatans = Jabatan::all();
        return view('admin.profil_pegawai.edit', compact('profil_pegawai', 'jabatans'));
    }

    public function update(Request $request, ProfilPegawai $profil_pegawai)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan_id' => 'required|exists:jabatans,id',
            'deskripsi' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            if ($profil_pegawai->foto_path) {
                Storage::disk('public')->delete($profil_pegawai->foto_path);
            }
            $validated['foto_path'] = $request->file('foto')->store('profil_pegawai', 'public');
        }

        $profil_pegawai->update($validated);

        return redirect()->route('admin.profil_pegawai.index')->with('success', 'Profil Pegawai berhasil diperbarui.');
    }

    public function destroy(ProfilPegawai $profil_pegawai)
    {
        if ($profil_pegawai->foto_path) {
            Storage::disk('public')->delete($profil_pegawai->foto_path);
        }
        $profil_pegawai->delete();

        return redirect()->route('admin.profil_pegawai.index')->with('success', 'Profil Pegawai berhasil dihapus.');
    }

    // Public slider view
    public function publicIndex()
{
    $pegawais = ProfilPegawai::with('jabatan')->whereHas('jabatan')->orderBy('created_at', 'desc')->get();
    $jabatans = Jabatan::ordered()->get();
    return view('infobase.profil-pegawai', compact('pegawais', 'jabatans'));
}

    public function updateOrder(Request $request)
{
    $request->validate([
        'jabatans' => 'required|array',
        'jabatans.*' => 'integer|exists:jabatans,id',
    ]);

    foreach ($request->jabatans as $index => $jabatanId) {
        Jabatan::where('id', $jabatanId)->update(['order' => $index + 1]);
    }

    return response()->json(['success' => true]);
}
}