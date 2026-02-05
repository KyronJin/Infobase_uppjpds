<?php

namespace App\Http\Controllers;

use App\Models\ProfileRuangan;
use App\Models\CalendarEvent;
use App\Models\Pengumuman;
use App\Models\JenisTataTertib;
use App\Models\StaffOfMonth;
use App\Models\ProfilPegawai;
use App\Models\TataTertib;
use Illuminate\Http\Request;
use Illuminate\View\View;

class InfobaseController extends Controller
{
    public function home(): View
    {
        // Get latest 3 announcements
        $latestAnnouncements = Pengumuman::where(function ($q) {
            $now = now();
            $q->whereNull('published_at')
              ->orWhere('published_at', '<=', $now);
        })->latest('published_at')->limit(3)->get();

        return view('home', [
            'latestAnnouncements' => $latestAnnouncements,
            'content' => [],
        ]);
    }

    public function tataTertib(Request $request): View
    {
        $search = $request->query('search', '');
        
        $query = JenisTataTertib::with(['tataTertibs' => function ($q) use ($search) {
            $q->where('is_active', true);
            if (!empty($search)) {
                $q->search($search);
            }
        }]);

        if (!empty($search)) {
            $query->whereHas('tataTertibs', function ($q) use ($search) {
                $q->where('is_active', true)->search($search);
            });
        } else {
            $query->whereHas('tataTertibs', function ($q) {
                $q->where('is_active', true);
            });
        }

        $jenis = $query->get();
        
        $title = 'Tata Tertib dan Peraturan';
        $content = 'Berisi Tata Tertib dan Peraturan di Perpustakaan';

        return view('infobase.tata-tertib', compact('jenis', 'title', 'content', 'search'));
    }

    public function calendarAktifitas(Request $request): View
    {
        $search = $request->query('search', '');
        
        $query = CalendarEvent::where('is_active', true);

        // Apply search if provided
        if (!empty($search)) {
            $query->search($search);
        }

        $events = $query->orderBy('start_at', 'asc')->paginate(12);

        return view('infobase.calendar-aktifitas', [
            'title'  => 'Kalender Kegiatan',
            'events' => $events,
            'search' => $search,
        ]);
    }

    public function pengumuman(Request $request)
    {
        $search = $request->query('search', '');
        
        $query = Pengumuman::where(function ($q) {
            $now = now();
            $q->whereNull('published_at')
              ->orWhere('published_at', '<=', $now);
        });

        // Apply search if provided
        if (!empty($search)) {
            $query->search($search);
        }

        $pengumumans = $query->latest('published_at')->paginate(10);
        
        return view('infobase.pengumuman', compact('pengumumans', 'search'));
    }

    public function staffOfMonth(Request $request): View
    {
        $search = $request->query('search', '');
        
        $query = StaffOfMonth::where('is_active', true);

        // Apply search if provided
        if (!empty($search)) {
            $query->search($search);
        }

        // Get paginated staff
        $staff = $query->orderBy('created_at', 'desc')->paginate(12);
        
        // Get staff grouped by position for the current page
        $staffByPosition = $staff->getCollection()->groupBy('position')
            ->map(function($group) {
                return $group->first(); // Get the most recent staff for each position
            });
        
        // Get all unique positions for tabs
        $positions = $staffByPosition->keys();
        
        // Get first staff as default
        $defaultStaff = $staffByPosition->first();

        return view('infobase.staff-of-month', [
            'title' => 'Staff of The Month',
            'staff' => $staff,
            'staffByPosition' => $staffByPosition,
            'positions' => $positions,
            'defaultStaff' => $defaultStaff,
            'search' => $search,
        ]);
    }

    /**
     * Halaman Profile Ruangan - AMBIL DARI DATABASE
     */
    public function profileRuangan(Request $request): View
    {
        $search = $request->query('search', '');
        
        $query = ProfileRuangan::with('images')->where('is_active', true);

        // Apply search if provided
        if (!empty($search)) {
            $query->search($search);
        }

        $items = $query->orderBy('created_at', 'desc')->paginate(12);
        $title = 'Profile Ruangan';

        return view('infobase.profile-ruangan', compact('items', 'title', 'search'));
    }

    /**
     * Halaman Profil Pegawai
     */
    public function profilPegawai(Request $request): View
    {
        $search = $request->query('search', '');
        
        $query = ProfilPegawai::with('jabatan');

        // Apply search if provided
        if (!empty($search)) {
            $query->search($search);
        }

        $pegawai = $query->orderBy('nama', 'asc')->paginate(12);
        $title = 'Profil Pegawai';

        return view('infobase.profil-pegawai', compact('pegawai', 'title', 'search'));
    }
}