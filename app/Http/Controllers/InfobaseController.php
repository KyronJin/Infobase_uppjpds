<?php

namespace App\Http\Controllers;

use App\Models\ProfileRuangan;
use App\Models\Pengumuman;
use App\Models\JenisTataTertib;
use App\Models\StaffOfMonth;
use App\Models\ProfilPegawai;
use App\Models\Jabatan;
use App\Models\TataTertib;
use App\Models\GalleryPhoto;
use Illuminate\Http\Request;
use Illuminate\View\View;

class InfobaseController extends Controller
{
    public function home(): View
    {
        // Update status pengumuman yang sudah expired
        // Pengumuman::updateExpiredStatus();

        // Get latest 3 announcements - only show active and within valid date range
        $latestAnnouncements = Pengumuman::where(function ($q) {
            $now = now();
            $q->whereNull('published_at')
              ->orWhere('published_at', '<=', $now);
        })
        ->validByDate()
        // ->where('status', 'active')
        ->latest('published_at')
        ->limit(3)
        ->get();

        // Get gallery photos for home page
        $homePhotos = GalleryPhoto::home()
            ->orderBy('order')
            ->limit(6)
            ->get();

        // Get hero banner images
        $heroImages = GalleryPhoto::hero()
            ->orderBy('order')
            ->get();

        return view('home', [
            'latestAnnouncements' => $latestAnnouncements,
            'homePhotos' => $homePhotos,
            'heroImages' => $heroImages,
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

        return view('infobase.calendar-aktifitas', [
            'title'  => 'Kalender Kegiatan',
            'search' => $search,
        ]);
    }

    public function pengumuman(Request $request)
    {
        // Update status pengumuman yang sudah expired
        // Pengumuman::updateExpiredStatus();

        $search = $request->query('search', '');
        
        $query = Pengumuman::where(function ($q) {
            $now = now();
            $q->whereNull('published_at')
              ->orWhere('published_at', '<=', $now);
        })
        ->validByDate();

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
        $selectedMonth = $request->query('month', null);
        $selectedYear = $request->query('year', null);
        
        $query = StaffOfMonth::where('is_active', true);

        // Apply search if provided
        if (!empty($search)) {
            $query->search($search);
        }

        // Apply month filter if provided
        if (!empty($selectedMonth) && is_numeric($selectedMonth)) {
            $query->where('month', $selectedMonth);
        }

        // Apply year filter if provided
        if (!empty($selectedYear) && is_numeric($selectedYear)) {
            $query->where('year', $selectedYear);
        }

        // Get all available months
        $allMonths = StaffOfMonth::where('is_active', true)
            ->whereNotNull('month')
            ->distinct('month')
            ->pluck('month')
            ->sort()
            ->values();

        // Get all available years
        $allYears = StaffOfMonth::where('is_active', true)
            ->whereNotNull('year')
            ->distinct('year')
            ->pluck('year')
            ->sort()
            ->reverse()
            ->values();

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
            'selectedMonth' => $selectedMonth,
            'allMonths' => $allMonths,
            'selectedYear' => $selectedYear,
            'allYears' => $allYears,
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
        $jabatanFilter = $request->query('jabatan_id', '');
        
        $query = ProfilPegawai::with('jabatan');

        // Apply search if provided
        if (!empty($search)) {
            $query->search($search);
        }

        // Apply jabatan filter if provided
        if (!empty($jabatanFilter)) {
            $query->where('jabatan_id', $jabatanFilter);
        }

        $allPegawai = $query->orderBy('nama', 'asc')->get();
        
        // Chunk into groups of 5 for slides
        $slides = $allPegawai->chunk(5);
        
        // Get all jabatans for org chart and filter dropdown
        $jabatans = Jabatan::orderBy('order')->get();
        
        $title = 'Profil Pegawai';

        return view('infobase.profil-pegawai', compact('slides', 'allPegawai', 'jabatans', 'title', 'search', 'jabatanFilter'));
    }
}