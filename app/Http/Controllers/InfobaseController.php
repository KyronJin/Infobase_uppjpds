<?php

namespace App\Http\Controllers;

use App\Models\ProfileRuangan;
use App\Models\CalendarEvent;
use App\Models\Pengumuman;
use App\Models\JenisTataTertib;
use Illuminate\Http\Request;
use Illuminate\View\View;

class InfobaseController extends Controller
{
    /**
     * Halaman utama Infobase (overview semua bagian)
     */
    public function index(): View
    {
        $todayOfficer = [
            'name'     => 'Fenty Afriyeni',
            'position' => 'Petugas Harian',
            'image'    => asset('images/petugas/fenty.jpg'),
        ];

        $infobaseData = [
            'tataTertib' => [
                'title'       => 'Tata Tertib',
                'description' => 'Berisi Tata Tertib dan Peraturan di Perpustakaan',
                'image'       => asset('images/icons/tata-tertib.png'),
                'route'       => route('infobase.tata-tertib'),
            ],
            'calendarAktifitas' => [
                'title'       => 'Calendar Aktifitas',
                'description' => 'Berisi informasi kunjungan atau event di hari berjalan',
                'image'       => asset('images/icons/calendar.png'),
                'route'       => route('infobase.calendar-aktifitas'),
            ],
            'pengumuman' => [
                'title'       => 'Pengumuman',
                'description' => 'Berisi pengumuman yang bersifat penting',
                'image'       => asset('images/icons/announcement.png'),
                'route'       => route('infobase.pengumuman'),
            ],
            'staffOfMonth' => [
                'title'       => 'Staff of The Month',
                'description' => 'Berisi data PJLP terbaik',
                'image'       => asset('images/icons/staff.png'),
                'route'       => route('infobase.staff-of-month'),
            ],
            'profileRuangan' => [
                'title'       => 'Profile Ruangan',
                'description' => 'Berisi foto dan informasi mengenai ruangan yang dapat dipinjam untuk event',
                'image'       => asset('images/icons/room.png'),
                'route'       => route('infobase.profile-ruangan'),
            ],
        ];

        return view('infobase.index', compact('todayOfficer', 'infobaseData'));
    }

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
        $pengumumans = Pengumuman::active()->latest('published_at')->get();
        return view('infobase.pengumuman', compact('pengumumans'));
    }

    public function staffOfMonth(): View
    {
        $staff = [
            'name'    => 'Nama Staff Terbaik',
            'photo'   => asset('images/staff/best.jpg'),
            'reason'  => 'Alasan dipilih sebagai staff terbaik bulan ini...',
        ];

        return view('infobase.staff-of-month', [
            'title' => 'Staff of The Month',
            'staff' => $staff,
        ]);
    }

    /**
     * Halaman Profile Ruangan - AMBIL DARI DATABASE
     */
    public function profileRuangan(): View
    {
        $items = ProfileRuangan::where('is_active', true)->orderBy('created_at', 'desc')->get();
        $title = 'Profile Ruangan';

        return view('infobase.profile-ruangan', compact('items', 'title'));
    }
}