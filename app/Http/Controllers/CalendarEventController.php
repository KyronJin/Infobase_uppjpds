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
        ]);

        $data['is_active'] = $request->has('is_active');

        CalendarEvent::create($data);

        return redirect()->route('admin.calendar.index')->with('success', 'Event dibuat.');
    }

    public function edit(CalendarEvent $calendar)
    {
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
        ]);

        $data['is_active'] = $request->has('is_active');

        $calendar->update($data);

        return redirect()->route('admin.calendar.index')->with('success', 'Event diperbarui.');
    }

    public function destroy(CalendarEvent $calendar)
    {
        $calendar->delete();
        return redirect()->route('admin.calendar.index')->with('success', 'Event dihapus.');
    }
}
