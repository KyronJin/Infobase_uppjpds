<?php

namespace App\Http\Controllers;

use App\Models\TataTertib;
use Illuminate\Http\Request;

class TataTertibController extends Controller
{
    public function index()
    {
        $items = TataTertib::orderBy('created_at', 'desc')->get();
        return view('admin.tata_tertib.index', compact('items'));
    }

    public function create()
    {
        return view('admin.tata_tertib.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'document_link' => 'nullable|url',
            'is_active' => 'sometimes|boolean',
        ]);

        $data['is_active'] = $request->has('is_active');

        TataTertib::create($data);

        return redirect()->route('admin.tata_tertib.index')->with('success', 'Tata Tertib created.');
    }

    public function edit(TataTertib $tata_tertib)
    {
        return view('admin.tata_tertib.edit', compact('tata_tertib'));
    }

    public function update(Request $request, TataTertib $tata_tertib)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'document_link' => 'nullable|url',
            'is_active' => 'sometimes|boolean',
        ]);

        $data['is_active'] = $request->has('is_active');

        $tata_tertib->update($data);

        return redirect()->route('admin.tata_tertib.index')->with('success', 'Tata Tertib updated.');
    }

    public function destroy(TataTertib $tata_tertib)
    {
        $tata_tertib->delete();
        return redirect()->route('admin.tata_tertib.index')->with('success', 'Deleted.');
    }

    // Public listing
    public function publicIndex()
    {
        $items = TataTertib::where('is_active', true)->orderBy('created_at', 'desc')->get();
        return view('infobase.tata-tertib', compact('items'));
    }
}
