<?php

// app/Http/Controllers/PengumumanController.php
namespace App\Http\Controllers;

use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengumumanController extends Controller
{
  public function index()
{
    // Halaman admin: list + form create
    $pengumumans = Pengumuman::latest('created_at')->get();

    return view('admin.pengumuman.index', compact('pengumumans'));
}
    // Halaman admin: list + form create (seperti di gambar kanan)
    public function admin()
    {
        $this->authorize('manage', Pengumuman::class); // atau manual cek is admin

        $pengumumans = Pengumuman::latest()->get();

        return view('admin.pengumuman.admin', compact('pengumumans'));
    }

    public function store(Request $request)
    {
        $this->authorize('manage', Pengumuman::class);

        $validated = $request->validate([
            'title'         => 'required|string|max:255',
            'body'          => 'required|string',
            'published_at'  => 'nullable|date',
        ]);

        Pengumuman::create($validated);

        return redirect()->route('pengumuman.admin')
            ->with('success', 'Pengumuman berhasil dibuat');
    }

    public function update(Request $request, Pengumuman $pengumuman)
    {
        $this->authorize('manage', $pengumuman);

        $validated = $request->validate([
            'title'         => 'required|string|max:255',
            'body'          => 'required|string',
            'published_at'  => 'nullable|date',
        ]);

        $pengumuman->update($validated);

        return redirect()->route('pengumuman.admin')
            ->with('success', 'Pengumuman berhasil diperbarui');
    }

    public function destroy(Pengumuman $pengumuman)
    {
        $this->authorize('manage', $pengumuman);

        $pengumuman->delete();

        return redirect()->route('pengumuman.admin')
            ->with('success', 'Pengumuman berhasil dihapus');
    }
    public function show(Pengumuman $pengumuman)
    {
        return view('infobase.pengumuman-detail', compact('pengumuman'));
    }}
