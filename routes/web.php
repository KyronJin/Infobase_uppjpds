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
use App\Http\Controllers\Admin\GalleryPhotoController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Models\GalleryPhoto;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\AgendaIntegrationController;
use App\Http\Controllers\PublicAgendaController;

Route::get('/login', function () {
    return redirect()->route('admin.login');
})->name('login');

Route::prefix('admin/integrasi-agenda')->middleware('auth')->group(function () {
    Route::get('/login', [AgendaIntegrationController::class, 'showLogin'])->name('admin.agenda.login');
    Route::post('/login', [AgendaIntegrationController::class, 'login'])->name('admin.agenda.login.post');

    Route::get('/calendars', [AgendaIntegrationController::class, 'calendars'])->name('admin.agenda.calendars');
    Route::post('/calendars', [AgendaIntegrationController::class, 'saveCalendars'])->name('admin.agenda.calendars.save');
});

Route::get('/events', [PublicAgendaController::class, 'index'])->name('public.events');

Route::get('/', [InfobaseController::class, 'home'])->name('home');

// Language switching route
Route::get('/language/{locale}', [LanguageController::class, 'switchLanguage'])->name('language.switch');

// Debug route for testing locale
Route::get('/debug/locale', function () {
    return response()->json([
        'app_locale' => app()->getLocale(),
        'session_locale' => session('locale'),
        'test_translation' => __('messages.home'),
    ]);
});

Route::get('/about', function () {
    $aboutPhotos = GalleryPhoto::active()
        ->whereIn('location', ['about', 'both'])
        ->orderBy('order')
        ->get();
    
    // Get all active about content from database
    $allAbouts = \App\Models\About::where('active', true)->get();
    
    // Get specific content for sections
    $aboutContent = $allAbouts->firstWhere('key', 'profil_institusi');
    $visiMisiContent = $allAbouts->firstWhere('key', 'visi_misi');
    
    return view('about', compact('aboutPhotos', 'aboutContent', 'visiMisiContent', 'allAbouts'));
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
Route::delete('admin/tata-tertib/jenis/{jenis}', [TataTertibController::class, 'destroyJenis'])->name('admin.tata_tertib.destroy-jenis')->middleware('auth');

// Pengumuman public detail view
Route::get('pengumuman/{pengumuman}', [PengumumanController::class, 'show'])->name('pengumuman.show');

// Admin Auth
Route::get('admin/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('admin/login', [AdminAuthController::class, 'login'])->name('admin.login.post');
Route::post('admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

// Dashboard shortcut
Route::get('admin/dashboard', function() {
    return redirect()->route('admin.pengumuman.index');
})->name('admin.dashboard')->middleware('auth');

// Admin Pengumuman CRUD (protected)
Route::resource('admin/pengumuman', PengumumanController::class)->names('admin.pengumuman')->middleware('auth');

// Admin Calendar Events (tanpa create/store; event dibuat dari aplikasi terintegrasi)
Route::resource('admin/calendar', CalendarEventController::class)
    ->except(['create', 'store'])
    ->names('admin.calendar')
    ->middleware('auth');

// Admin Tata Tertib CRUD
Route::resource('admin/tata-tertib', TataTertibController::class)->names('admin.tata_tertib')->middleware('auth');

// Admin About CRUD (protected)
Route::resource('admin/about', AboutController::class)->names('admin.about')->middleware('auth');
Route::post('admin/about/create-defaults', [AboutController::class, 'createDefaults'])->name('admin.about.create-defaults')->middleware('auth');

// Route untuk serve profile ruangan images
Route::get('/storage/profile_ruangan_images/{filename}', function ($filename) {
    // Sanitize filename untuk security
    $filename = basename($filename);
    $candidatePaths = [
        storage_path('app/profile_ruangan_images/' . $filename),
        storage_path('app/private/profile_ruangan_images/' . $filename),
        storage_path('app/public/profile_ruangan_images/' . $filename),
    ];
    
    $path = null;
    foreach ($candidatePaths as $candidatePath) {
        if (file_exists($candidatePath)) {
            $path = $candidatePath;
            break;
        }
    }
    
    \Log::debug('Image serving request', [
        'filename' => $filename,
        'path' => $path,
        'exists' => file_exists($path),
    ]);
    
    if (!$path) {
        \Log::warning('Image not found', [
            'filename' => $filename,
            'checked_paths' => $candidatePaths,
        ]);
        abort(404, 'Image not found');
    }
    
    if (!is_readable($path)) {
        \Log::error('Image not readable', ['path' => $path]);
        abort(403, 'Image not readable');
    }
    
    return response()->file($path, [
        'Cache-Control' => 'public, max-age=31536000',
    ]);
})->name('profile-ruangan.image');

// Debug route untuk show upload test form
Route::get('/debug/upload-test', function () {
    return view('debug.upload-test');
})->name('debug.upload-test.form')->middleware('auth');

// Debug route untuk test file upload dengan copy
Route::post('/debug/upload-test', function (\Illuminate\Http\Request $request) {
    \Log::info('Upload test endpoint hit', [
        'files' => $request->files->keys(),
        'all_input' => array_keys($request->all()),
    ]);
    
    $uploadDir = storage_path('app/profile_ruangan_images');
    $result = [
        'upload_dir' => $uploadDir,
        'dir_exists' => is_dir($uploadDir),
        'dir_writable' => is_writable($uploadDir),
        'files' => [],
    ];
    
    // Create dir if not exists
    if (!is_dir($uploadDir)) {
        @mkdir($uploadDir, 0755, true);
        $result['dir_created'] = true;
    }
    
    for ($i = 1; $i <= 3; $i++) {
        $slotName = "slot_{$i}_image";
        if ($request->hasFile($slotName)) {
            $file = $request->file($slotName);
            $fileData = [
                'name' => $file->getClientOriginalName(),
                'size' => $file->getSize(),
                'mime' => $file->getMimeType(),
                'valid' => $file->isValid(),
                'temp_path' => $file->getRealPath(),
            ];
            
            // Try to copy file
            try {
                $filename = uniqid('test_' . $i . '_') . '.' . $file->getClientOriginalExtension();
                $fullPath = $uploadDir . DIRECTORY_SEPARATOR . $filename;
                
                if (copy($file->getRealPath(), $fullPath)) {
                    $fileData['saved'] = true;
                    $fileData['saved_path'] = $fullPath;
                    $fileData['file_exists'] = file_exists($fullPath);
                    $fileData['file_size'] = file_exists($fullPath) ? filesize($fullPath) : 0;
                    $fileData['is_readable'] = is_readable($fullPath);
                } else {
                    $fileData['saved'] = false;
                    $fileData['error'] = 'copy() returned false';
                }
            } catch (\Exception $e) {
                $fileData['error'] = $e->getMessage();
            }
            
            $result['files'][$slotName] = $fileData;
        }
    }
    
    \Log::info('Test upload result', $result);
    
    return response()->json([
        'success' => true,
        'debug' => $result,
    ]);
})->name('debug.upload-test.post')->middleware('auth');

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
Route::delete('admin/profil-pegawai/jabatan/{id}', [ProfilPegawaiController::class, 'deleteJabatan'])->name('admin.profil_pegawai.destroy-jabatan')->middleware('auth');
Route::post('admin/profil-pegawai/jabatan/{id}', [ProfilPegawaiController::class, 'deleteJabatan'])->name('admin.profil_pegawai.destroy-jabatan-post')->middleware('auth');

// Simple create form for testing
Route::get('admin/profil-pegawai-simple', function() {
    $jabatans = \App\Models\Jabatan::ordered()->get();
    return view('admin.profil_pegawai.create-simple', compact('jabatans'));
})->name('admin.profil_pegawai.create-simple')->middleware('auth');

// Debug route for profil pegawai form
Route::get('admin/profil-pegawai-debug', function() {
    $jabatans = \App\Models\Jabatan::ordered()->get();
    return view('admin.profil_pegawai.debug-create', compact('jabatans'));
})->name('admin.profil_pegawai.debug')->middleware('auth');

// Admin Gallery Photo CRUD (protected)
Route::resource('admin/gallery', GalleryPhotoController::class)->names('admin.gallery')->middleware('auth');

// Admin User Management (protected)
Route::get('admin/users', [AdminUserController::class, 'index'])->name('admin.users.index')->middleware('auth');
Route::post('admin/users', [AdminUserController::class, 'store'])->name('admin.users.store')->middleware('auth');

// Test routes for Excel import feature
require_once __DIR__ . '/test-routes.php';

// Debug routes
require_once __DIR__ . '/debug-routes.php';