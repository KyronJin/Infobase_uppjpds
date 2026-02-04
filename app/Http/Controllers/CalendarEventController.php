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
            'capacity' => 'nullable|integer|min:0',
            'participants' => 'nullable|integer|min:0',
            'is_active' => 'nullable|in:0,1,on,true,false',
        ]);

        $data['is_active'] = $request->has('is_active') ? true : false;

        try {
            CalendarEvent::create($data);
        } catch (\Exception $e) {
            // Jika field belum ada di database, hapus dan simpan tanpa field
            if (strpos($e->getMessage(), 'Unknown column') !== false) {
                unset($data['capacity'], $data['participants']);
                CalendarEvent::create($data);
            } else {
                throw $e;
            }
        }

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
            'capacity' => 'nullable|integer|min:0',
            'participants' => 'nullable|integer|min:0',
            'is_active' => 'nullable|in:0,1,on,true,false',
        ]);

        $data['is_active'] = $request->has('is_active') ? true : false;

        try {
            $calendar->update($data);
        } catch (\Exception $e) {
            // Jika field belum ada di database, hapus dan update tanpa field
            if (strpos($e->getMessage(), 'Unknown column') !== false) {
                unset($data['capacity'], $data['participants']);
                $calendar->update($data);
            } else {
                throw $e;
            }
        }

        return redirect()->route('admin.calendar.index')->with('success', '✓ Event berhasil diperbarui!');
    }

    public function destroy(CalendarEvent $calendar)
    {
        $calendar->delete();
        return redirect()->route('admin.calendar.index')->with('success', '✓ Event berhasil dihapus!');
    }
}
