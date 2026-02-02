<?php

namespace App\Http\Controllers;

use App\Models\CalendarEvent;
use Illuminate\Http\Request;

class CalendarEventController extends Controller
{
    public function index()
    {
        $items = CalendarEvent::orderBy('start_at', 'desc')->paginate(12);
        return view('admin.calendar.index', compact('items'));
    }

    public function create()
    {
        return view('admin.calendar.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_at' => 'nullable|date',
            'end_at' => 'nullable|date',
            'location' => 'nullable|string|max:255',
            'is_active' => 'sometimes|boolean',
        ], [
            'title.required' => 'Judul event harus diisi.',
            'title.string' => 'Judul event harus berupa teks.',
            'title.max' => 'Judul event maksimal 255 karakter.',
            'description.string' => 'Deskripsi harus berupa teks.',
            'start_at.date' => 'Tanggal mulai harus berupa tanggal yang valid.',
            'end_at.date' => 'Tanggal selesai harus berupa tanggal yang valid.',
            'location.string' => 'Lokasi harus berupa teks.',
            'location.max' => 'Lokasi maksimal 255 karakter.',
        ]);

        $data['is_active'] = $request->has('is_active') ? true : false;

        CalendarEvent::create($data);

        return redirect()->route('admin.calendar.index')->with('success', '✓ Event berhasil ditambahkan!');
    }

    public function edit(CalendarEvent $calendar)
    {
        // If JSON is requested, return JSON
        if (request()->wantsJson()) {
            return response()->json($calendar);
        }
        
        return view('admin.calendar.edit', ['item' => $calendar]);
    }

    public function update(Request $request, CalendarEvent $calendar)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_at' => 'nullable|date',
            'end_at' => 'nullable|date',
            'location' => 'nullable|string|max:255',
            'is_active' => 'sometimes|boolean',
        ], [
            'title.required' => 'Judul event harus diisi.',
            'title.string' => 'Judul event harus berupa teks.',
            'title.max' => 'Judul event maksimal 255 karakter.',
            'description.string' => 'Deskripsi harus berupa teks.',
            'start_at.date' => 'Tanggal mulai harus berupa tanggal yang valid.',
            'end_at.date' => 'Tanggal selesai harus berupa tanggal yang valid.',
            'location.string' => 'Lokasi harus berupa teks.',
            'location.max' => 'Lokasi maksimal 255 karakter.',
        ]);

        $data['is_active'] = $request->has('is_active') ? true : false;

        $calendar->update($data);

        return redirect()->route('admin.calendar.index')->with('success', '✓ Event berhasil diperbarui!');
    }

    public function destroy(CalendarEvent $calendar)
    {
        $calendar->delete();
        return redirect()->route('admin.calendar.index')->with('success', '✓ Event berhasil dihapus!');
    }
}
