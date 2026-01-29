<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InfobaseController;
use App\Http\Controllers\TataTertibController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\CalendarEventController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileRuanganController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact', [ContactController::class, 'show'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::prefix('infobase')->name('infobase.')->group(function () {
    Route::get('/', [InfobaseController::class, 'index'])->name('index');
    Route::get('tata-tertib', [InfobaseController::class, 'tataTertib'])->name('tata-tertib');
    Route::get('calendar-aktifitas', [InfobaseController::class, 'calendarAktifitas'])->name('calendar-aktifitas');
    Route::get('pengumuman', [InfobaseController::class, 'pengumuman'])->name('pengumuman');
    Route::get('staff-of-month', [InfobaseController::class, 'staffOfMonth'])->name('staff-of-month');
    Route::get('profile-ruangan', [InfobaseController::class, 'profileRuangan'])->name('profile-ruangan');
});

// Pengumuman public detail view
Route::get('pengumuman/{pengumuman}', [PengumumanController::class, 'show'])->name('pengumuman.show');

// Admin Auth
Route::get('admin/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('admin/login', [AdminAuthController::class, 'login'])->name('admin.login.post');
Route::post('admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

// Admin Pengumuman CRUD (protected)
Route::resource('admin/pengumuman', PengumumanController::class)->names('admin.pengumuman')->middleware('auth');

// Admin Calendar Events CRUD (protected)
Route::resource('admin/calendar', CalendarEventController::class)->names('admin.calendar')->middleware('auth');

// Admin Tata Tertib CRUD
Route::resource('admin/tata-tertib', TataTertibController::class)->names('admin.tata_tertib')->middleware('auth');

// Admin Profile Ruangan CRUD (protected)
Route::resource('admin/profile', ProfileRuanganController::class)->names('admin.profile')->middleware('auth');


// routes/web.php

Route::middleware('auth')->group(function () {

    // Halaman yang dilihat semua user (Inbox pengumuman)
    Route::get('/pengumuman', [PengumumanController::class, 'index'])
        ->name('pengumuman.index');

    // Halaman khusus admin (list + form seperti di gambar)
    Route::middleware('can:manage,App\Models\Pengumuman')->group(function () {
        Route::get('/pengumuman/admin', [PengumumanController::class, 'admin'])
            ->name('pengumuman.admin');

        Route::post('/pengumuman', [PengumumanController::class, 'store'])
            ->name('pengumuman.store');

        Route::patch('/pengumuman/{pengumuman}', [PengumumanController::class, 'update'])
            ->name('pengumuman.update');

        Route::delete('/pengumuman/{pengumuman}', [PengumumanController::class, 'destroy'])
            ->name('pengumuman.destroy');
    });
});