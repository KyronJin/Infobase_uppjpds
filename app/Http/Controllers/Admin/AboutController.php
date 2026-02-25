<?php

namespace App\Http\Controllers\Admin;

use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class AboutController extends Controller
{
    /**
     * Show the form for creating a new about page.
     */
    public function create(): View
    {
        return view('admin.about.create');
    }

    /**
     * Store a newly created about page in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        \Log::info('About store request received', [
            'keys' => array_keys($request->all()),
            'content_length' => strlen($request->input('content', '')),
        ]);

        $validated = $request->validate([
            'key' => 'required|string|max:255|unique:abouts,key',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        \Log::info('Validation passed', $validated);

        try {
            $about = About::create($validated + ['active' => true]);
            \Log::info('About created successfully', ['id' => $about->id, 'key' => $about->key]);

            return redirect()->route('admin.about.index')
                ->with('success', 'Konten tentang kami berhasil dibuat');
        } catch (\Exception $e) {
            \Log::error('Error creating about', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            
            return back()->withInput()->with('error', 'Gagal membuat konten: ' . $e->getMessage());
        }
    }

    /**
     * Display a listing of the about pages.
     */
    public function index(): View
    {
        $abouts = About::all();
        return view('admin.about.index', compact('abouts'));
    }

    /**
     * Show the form for editing the about page.
     */
    public function edit(About $about): View
    {
        return view('admin.about.edit', compact('about'));
    }

    /**
     * Update the about page in storage.
     */
    public function update(Request $request, About $about): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $about->update($validated);

        return redirect()->route('admin.about.index')
            ->with('success', 'Konten tentang kami berhasil diperbarui');
    }

    /**
     * Delete the about page from storage.
     */
    public function destroy(About $about)
    {
        try {
            $title = $about->title;
            $about->delete();

            // Return JSON response for AJAX delete modal
            if (request()->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => "Konten '{$title}' berhasil dihapus"
                ]);
            }

            return redirect()->route('admin.about.index')
                ->with('success', "Konten '{$title}' berhasil dihapus");
        } catch (\Exception $e) {
            if (request()->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal menghapus konten: ' . $e->getMessage()
                ], 500);
            }
            return redirect()->back()->with('error', 'Gagal menghapus konten');
        }
    }

    /**
     * Create default about content if not exists.
     */
    public function createDefaults(): void
    {
        $defaults = [
            [
                'key' => 'profil_institusi',
                'title' => 'Profil Institusi',
                'content' => 'Perpustakaan Jakarta (UPPJPDS) adalah institusi publik yang berkomitmen untuk menyediakan akses informasi berkualitas tinggi kepada seluruh masyarakat Jakarta. Kami berfungsi sebagai pusat pembelajaran, dokumentasi, dan pemeliharaan memori kolektif masyarakat.

Dengan koleksi lengkap, fasilitas modern, dan staf yang profesional, kami menawarkan lebih dari sekadar tempat meminjam buku. Kami adalah ruang untuk belajar, berkolaborasi, berinovasi, dan terhubung dengan komunitas pengetahuan.',
                'active' => true,
            ],
            [
                'key' => 'visi_misi',
                'title' => 'Visi & Misi',
                'content' => 'Visi kami adalah menjadi perpustakaan terdepan yang memberikan dampak positif bagi pengembangan masyarakat Jakarta.

Misi kami:
• Menyediakan akses informasi yang luas dan berkualitas
• Mendukung pembelajaran seumur hidup
• Mempromosikan literasi digital dan tradisional
• Menjadi pusat komunitas untuk kolaborasi dan inovasi',
                'active' => true,
            ],
        ];

        foreach ($defaults as $default) {
            About::firstOrCreate(['key' => $default['key']], $default);
        }
    }
}
