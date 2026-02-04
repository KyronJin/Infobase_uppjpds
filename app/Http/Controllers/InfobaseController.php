<?php

namespace App\Http\Controllers;

use App\Models\ProfileRuangan;
use App\Models\CalendarEvent;
use App\Models\Pengumuman;
use App\Models\JenisTataTertib;
use App\Models\StaffOfMonth;
use Illuminate\Http\Request;
use Illuminate\View\View;

class InfobaseController extends Controller
{
    public function tataTertib(): View
    {
        $jenis = JenisTataTertib::with('tataTertibs')->whereHas('tataTertibs', function ($q) {
            $q->where('is_active', true);
        })->get();
        
        $title = 'Tata Tertib dan Peraturan';
        $content = 'Berisi Tata Tertib dan Peraturan di Perpustakaan';

        return view('infobase.tata-tertib', compact('jenis', 'title', 'content'));
    }

    public function calendarAktifitas(): View
    {
        $events = CalendarEvent::where('is_active', true)
            ->orderBy('start_at', 'asc')
            ->get();

        return view('infobase.calendar-aktifitas', [
            'title'  => 'Kalender Kegiatan',
            'events' => $events,
        ]);
    }

    public function pengumuman()
    {
        $pengumumans = Pengumuman::where(function ($q) {
            $now = now();
            $q->whereNull('published_at')
              ->orWhere('published_at', '<=', $now);
        })->latest('published_at')->get();
        return view('infobase.pengumuman', compact('pengumumans'));
    }

    public function staffOfMonth(): View
    {
        // Get staff grouped by position
        $staffByPosition = StaffOfMonth::where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy('position')
            ->map(function($group) {
                return $group->first(); // Get the most recent staff for each position
            });
        
        // Get all unique positions for tabs
        $positions = $staffByPosition->keys();
        
        // Get first staff as default
        $defaultStaff = $staffByPosition->first();

        return view('infobase.staff-of-month', [
            'title' => 'Staff of The Month',
            'staffByPosition' => $staffByPosition,
            'positions' => $positions,
            'defaultStaff' => $defaultStaff,
        ]);
    }

    /**
     * Halaman Profile Ruangan - AMBIL DARI DATABASE
     */
    public function profileRuangan(): View
    {
        $items = ProfileRuangan::with('images')->where('is_active', true)->orderBy('created_at', 'desc')->get();
        $title = 'Profile Ruangan';

        return view('infobase.profile-ruangan', compact('items', 'title'));
    }
}