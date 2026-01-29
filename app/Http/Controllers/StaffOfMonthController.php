<?php

namespace App\Http\Controllers;

use App\Models\StaffOfMonth;
use Illuminate\Http\Request;

class StaffOfMonthController extends Controller
{
    public function index()
    {
        $items = StaffOfMonth::orderBy('created_at', 'desc')->get();
        return view('admin.staff.index', compact('items'));
    }

    public function create()
    {
        return view('admin.staff.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'nullable|string|max:255',
            'month' => 'nullable|integer|min:1|max:12',
            'year' => 'nullable|integer',
            'bio' => 'nullable|string',
            'photo_link' => 'nullable|url',
            'is_active' => 'sometimes|boolean',
        ]);

        $data['is_active'] = $request->has('is_active');

        StaffOfMonth::create($data);

        return redirect()->route('admin.staff.index')->with('success', 'Staff created.');
    }

    public function edit(StaffOfMonth $staff_of_month)
    {
        return view('admin.staff.edit', compact('staff_of_month'));
    }

    public function update(Request $request, StaffOfMonth $staff_of_month)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'nullable|string|max:255',
            'month' => 'nullable|integer|min:1|max:12',
            'year' => 'nullable|integer',
            'bio' => 'nullable|string',
            'photo_link' => 'nullable|url',
            'is_active' => 'sometimes|boolean',
        ]);

        $data['is_active'] = $request->has('is_active');

        $staff_of_month->update($data);

        return redirect()->route('admin.staff.index')->with('success', 'Updated.');
    }

    public function destroy(StaffOfMonth $staff_of_month)
    {
        $staff_of_month->delete();
        return redirect()->route('admin.staff.index')->with('success', 'Deleted.');
    }

    public function publicIndex()
    {
        $items = StaffOfMonth::where('is_active', true)->orderBy('created_at', 'desc')->get();
        return view('infobase.staff-of-month', compact('items'));
    }
}
