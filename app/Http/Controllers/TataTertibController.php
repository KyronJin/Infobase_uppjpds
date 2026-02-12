<?php

namespace App\Http\Controllers;

use App\Models\TataTertib;
use App\Models\JenisTataTertib;
use Illuminate\Http\Request;

class TataTertibController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $items = TataTertib::with('jenisTataTertib')
            ->when($search, function ($query, $search) {
                $query->where('content', 'like', "%{$search}%")
                      ->orWhereHas('jenisTataTertib', function ($q) use ($search) {
                          $q->where('name', 'like', "%{$search}%");
                      });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $jenis = JenisTataTertib::all();
        return view('admin.tata_tertib.index', compact('items', 'jenis', 'search'));
    }

    public function create()
    {
        $jenis = JenisTataTertib::all();
        return view('admin.tata_tertib.create', compact('jenis'));
    }

    public function storeJenis(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);

        JenisTataTertib::create($request->only('name'));
        return redirect()->back()->with('success', 'Jenis Tata Tertib berhasil ditambahkan!');
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'jenis_tata_tertib_id' => 'required|exists:jenis_tata_tertibs,id',
                'content' => 'required|string',
                'is_active' => 'required|in:0,1',
            ]);

            TataTertib::create($validated);

            return redirect()->route('admin.tata_tertib.index')
                ->with('success', 'Tata Tertib berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menambahkan tata tertib: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function edit($id)
    {
        $tata_tertib = TataTertib::findOrFail($id);
        
        if (request()->wantsJson()) {
            return response()->json($tata_tertib);
        }
        
        $jenis = JenisTataTertib::all();
        return view('admin.tata_tertib.edit', compact('tata_tertib', 'jenis'));
    }

    public function update(Request $request, $id)
    {
        try {
            $tata_tertib = TataTertib::findOrFail($id);
            
            $validated = $request->validate([
                'jenis_tata_tertib_id' => 'required|exists:jenis_tata_tertibs,id',
                'content' => 'required|string',
                'is_active' => 'required|in:0,1',
            ]);

            $tata_tertib->update($validated);

            return redirect()->route('admin.tata_tertib.index')
                ->with('success', 'Tata Tertib berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal memperbarui tata tertib: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $tata_tertib = TataTertib::findOrFail($id);
            $tata_tertib->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'Tata Tertib berhasil dihapus!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus tata tertib: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroyJenis($id)
    {
        try {
            $jenis = JenisTataTertib::findOrFail($id);
            
            if ($jenis->tataTertibs()->count() > 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'Tidak bisa menghapus jenis tata tertib yang masih memiliki data tata tertib. Hapus semua tata tertib dengan jenis ini terlebih dahulu.'
                ], 400);
            }

            $jenis->delete();
            return response()->json([
                'success' => true,
                'message' => 'Jenis tata tertib berhasil dihapus!'   
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus jenis tata tertib: ' . $e->getMessage()
            ], 500);
        }
    }
}
