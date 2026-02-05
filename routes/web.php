<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InfobaseController;
use App\Http\Controllers\TataTertibController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\CalendarEventController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileRuanganController;
use App\Http\Controllers\ProfilPegawaiController;
use App\Http\Controllers\StaffOfMonthController;
use App\Http\Controllers\LanguageController;

Route::get('/login', function () {
    return redirect()->route('admin.login');
})->name('login');

Route::get('/', [InfobaseController::class, 'home'])->name('home');

// Language switching route
Route::get('/language/{locale}', [LanguageController::class, 'switchLanguage'])->name('language.switch');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact', [ContactController::class, 'show'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::prefix('infobase')->name('infobase.')->group(function () {
    Route::get('tata-tertib', [InfobaseController::class, 'tataTertib'])->name('tata-tertib');
    Route::get('calendar-aktifitas', [InfobaseController::class, 'calendarAktifitas'])->name('calendar-aktifitas');
    Route::get('pengumuman', [InfobaseController::class, 'pengumuman'])->name('pengumuman');
    Route::get('staff-of-month', [InfobaseController::class, 'staffOfMonth'])->name('staff-of-month');
    Route::get('profile-ruangan', [InfobaseController::class, 'profileRuangan'])->name('profile-ruangan');
    Route::get('profil-pegawai', [InfobaseController::class, 'profilPegawai'])->name('profil-pegawai');
});

Route::post('admin/tata_tertib/store-jenis', [TataTertibController::class, 'storeJenis'])->name('admin.tata_tertib.store-jenis')->middleware('auth');

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
Route::resource('admin/profile-ruangan', ProfileRuanganController::class)->names('admin.profile')->middleware('auth');
Route::delete('admin/profile-ruangan/image/{image}', [ProfileRuanganController::class, 'deleteImage'])->name('admin.profile.deleteImage')->middleware('auth');

// Admin Staff of Month CRUD (protected)
Route::resource('admin/staff-of-month', StaffOfMonthController::class)->names('admin.staff-of-month')->middleware('auth');
Route::post('admin/staff-of-month/store-jabatan', [StaffOfMonthController::class, 'storeJabatan'])->name('admin.staff-of-month.store-jabatan')->middleware('auth');
Route::delete('admin/staff-of-month/jabatan/{jabatan}', [StaffOfMonthController::class, 'destroyJabatan'])->name('admin.staff-of-month.destroy-jabatan')->middleware('auth');

// Admin Profil Pegawai CRUD (protected)
Route::resource('admin/profil-pegawai', ProfilPegawaiController::class)->names('admin.profil_pegawai')->middleware('auth');
Route::post('admin/profil-pegawai/store-jabatan', [ProfilPegawaiController::class, 'storeJabatan'])->name('admin.profil_pegawai.store-jabatan')->middleware('auth');
Route::post('admin/profil-pegawai/update-order', [ProfilPegawaiController::class, 'updateOrder'])->name('admin.profil_pegawai.update-order')->middleware('auth');

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