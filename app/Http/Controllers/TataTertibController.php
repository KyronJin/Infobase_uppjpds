<?php

namespace App\Http\Controllers;

use App\Models\TataTertib;
use App\Models\JenisTataTertib;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TataTertibController extends Controller
{
    public function index()
    {
        $items = TataTertib::with('jenisTataTertib')->orderBy('created_at', 'desc')->get();
        $jenis = JenisTataTertib::all();
        return view('admin.tata_tertib.index', compact('items', 'jenis'));
    }

    public function storeJenis(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);
        JenisTataTertib::create($request->only('name'));
        return redirect()->back()->with('success', 'Jenis Tata Tertib berhasil ditambahkan.');
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'jenis_tata_tertib_id' => 'required|exists:jenis_tata_tertibs,id',
                'content' => 'required|string',
                'is_active' => 'sometimes|boolean',
            ]);

            $validated['is_active'] = $request->has('is_active') ? 1 : 0;

            // Split content by lines and create multiple records
            $lines = explode("\n", trim($validated['content']));
            $createdCount = 0;

            foreach ($lines as $line) {
                $line = trim($line);
                if (!empty($line)) {
                    TataTertib::create([
                        'jenis_tata_tertib_id' => $validated['jenis_tata_tertib_id'],
                        'content' => $line,
                        'is_active' => $validated['is_active'],
                    ]);
                    $createdCount++;
                }
            }

            return redirect()->route('admin.tata_tertib.index')
                ->with('success', "Tata Tertib berhasil ditambahkan ($createdCount item).");
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function edit(TataTertib $tata_tertib)
    {
        $jenis = JenisTataTertib::all();
        return view('admin.tata_tertib.edit', compact('tata_tertib', 'jenis'));
    }

    public function update(Request $request, TataTertib $tata_tertib)
    {
        try {
            $validated = $request->validate([
                'jenis_tata_tertib_id' => 'required|exists:jenis_tata_tertibs,id',
                'content' => 'required|string',
                'is_active' => 'sometimes|boolean',
            ]);

            $validated['is_active'] = $request->has('is_active') ? 1 : 0;
            $tata_tertib->update($validated);

            return redirect()->route('admin.tata_tertib.index')
                ->with('success', 'Tata Tertib berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy(TataTertib $tata_tertib)
    {
        $tata_tertib->delete();
        return redirect()->route('admin.tata_tertib.index')
            ->with('success', 'Tata Tertib berhasil dihapus.');
    }
}