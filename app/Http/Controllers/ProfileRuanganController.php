<?php

namespace App\Http\Controllers;

use App\Models\ProfileRuangan;
use App\Models\ProfileRuanganImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileRuanganController extends Controller
{
    private function rules()
    {
        return [
            'room_name'   => 'required|string|max:255',
            'floor'       => 'nullable|integer|min:1|max:7',
            'capacity'    => 'nullable|integer',
            'description' => 'nullable|string',
            'images'      => 'nullable|array',
            'images.*'    => 'nullable|image|mimes:jpeg,png,jpg,gif|max:20480',
            'is_active'   => 'nullable|in:0,1,on,true,false',
        ];
    }

    private function saveImages(Request $request, ProfileRuangan $profileRuangan)
    {
        // Get the next available slot number
        $lastSlot = (int) ($profileRuangan->images()->max('slot') ?? 0);

        // Save multiple files from images[] input
        if ($request->hasFile('images')) {
            foreach ((array) $request->file('images') as $file) {
                if (!$file || !$file->isValid()) {
                    continue;
                }

                $lastSlot++;
                $path = $file->store('profile_ruangan_images', 'public');

                ProfileRuanganImage::create([
                    'profile_ruangan_id' => $profileRuangan->id,
                    'slot' => $lastSlot,
                    'image_path' => $path,
                ]);
            }
        }
    }

    public function index(Request $request)
    {
        $search = $request->input('search');
        $query = ProfileRuangan::with('images');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('room_name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('floor', 'like', "%{$search}%");
            });
        }

        $items = $query->latest()->paginate(12);

        // Bersihkan description sebelum dikirim ke view
        $items->getCollection()->transform(function ($item) {
            $item->description = strip_tags($item->description);
            return $item;
        });

        return view('admin.profile.index', compact('items', 'search'));
    }

    public function create()
    {
        return view('admin.profile.create');
    }

    public function store(Request $request)
    {
        \Log::info('ProfileRuangan Create started', [
            'has_files' => [
                'images' => $request->hasFile('images'),
            ]
        ]);

        try {
            $data = $request->validate($this->rules());
            \Log::info('Validation passed', ['data_keys' => array_keys($data)]);

            $data['is_active'] = $request->has('is_active');
            $data['description'] = strip_tags($data['description'] ?? '');

            $profileRuangan = ProfileRuangan::create($data);
            \Log::info('Profile ruangan created', ['id' => $profileRuangan->id]);

            $this->saveImages($request, $profileRuangan);
            \Log::info('Images saved successfully');

            // Return JSON for fetch API
            if ($request->wantsJson() || $request->header('X-Requested-With') === 'XMLHttpRequest') {
                return response()->json([
                    'success' => true,
                    'message' => '✓ Profile ruangan berhasil ditambahkan!',
                    'redirect' => route('admin.profile.index')
                ]);
            }

            return redirect()->route('admin.profile.index')->with('success', '✓ Profile ruangan berhasil ditambahkan!');
        } catch (\Illuminate\Validation\ValidationException $ve) {
            \Log::warning('ProfileRuangan Validation Error', [
                'errors' => $ve->errors()
            ]);

            if ($request->wantsJson() || $request->header('X-Requested-With') === 'XMLHttpRequest') {
                return response()->json(['errors' => $ve->errors()], 422);
            }

            return back()->withErrors($ve->errors())->withInput();
        } catch (\Exception $e) {
            \Log::error('ProfileRuangan Store Error: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);
            
            if ($request->wantsJson() || $request->header('X-Requested-With') === 'XMLHttpRequest') {
                return response()->json([
                    'success' => false,
                    'error' => $e->getMessage(),
                    'debug' => [
                        'file' => $e->getFile(),
                        'line' => $e->getLine(),
                    ]
                ], 500);
            }
            
            return back()->withErrors(['error' => 'Gagal menambah profile ruangan: ' . $e->getMessage()])->withInput();
        }
    }

    public function edit(ProfileRuangan $profileRuangan)
    {
        $profileRuangan->load('images');
        $profileRuangan->description = strip_tags($profileRuangan->description);

        if (request()->wantsJson()) {
            return response()->json($profileRuangan);
        }
        return view('admin.profile.edit', compact('profileRuangan'));
    }

    public function update(Request $request, ProfileRuangan $profileRuangan)
    {
        \Log::info('ProfileRuangan Update started', [
            'id' => $profileRuangan->id,
            'has_files' => [
                'images' => $request->hasFile('images'),
            ]
        ]);

        try {
            $data = $request->validate($this->rules());
            \Log::info('Validation passed', ['data_keys' => array_keys($data)]);
            
            $data['is_active'] = $request->has('is_active');
            $data['description'] = strip_tags($data['description'] ?? '');

            $profileRuangan->update($data);
            \Log::info('Profile ruangan data updated');
            
            $this->saveImages($request, $profileRuangan);
            \Log::info('Images saved successfully');

            // Return JSON for fetch API
            if ($request->wantsJson() || $request->header('X-Requested-With') === 'XMLHttpRequest') {
                return response()->json([
                    'success' => true,
                    'message' => '✓ Profile ruangan berhasil diperbarui!',
                    'redirect' => route('admin.profile.index')
                ]);
            }

            return redirect()->route('admin.profile.index')->with('success', '✓ Profile ruangan berhasil diperbarui!');
        } catch (\Illuminate\Validation\ValidationException $ve) {
            \Log::warning('ProfileRuangan Validation Error', [
                'id' => $profileRuangan->id,
                'errors' => $ve->errors()
            ]);

            if ($request->wantsJson() || $request->header('X-Requested-With') === 'XMLHttpRequest') {
                return response()->json(['errors' => $ve->errors()], 422);
            }

            return back()->withErrors($ve->errors())->withInput();
        } catch (\Exception $e) {
            \Log::error('ProfileRuangan Update Error: ' . $e->getMessage(), [
                'id' => $profileRuangan->id ?? null,
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);
            
            if ($request->wantsJson() || $request->header('X-Requested-With') === 'XMLHttpRequest') {
                return response()->json([
                    'success' => false,
                    'error' => $e->getMessage(),
                    'debug' => [
                        'file' => $e->getFile(),
                        'line' => $e->getLine(),
                    ]
                ], 500);
            }
            
            return back()->withErrors(['error' => 'Gagal update profile ruangan: ' . $e->getMessage()])->withInput();
        }
    }

    public function destroy(ProfileRuangan $profileRuangan)
    {
        foreach ($profileRuangan->images as $image) {
            Storage::disk('public')->delete($image->image_path);
            Storage::disk('local')->delete($image->image_path);
            @unlink(storage_path('app/' . $image->image_path));
            @unlink(storage_path('app/private/' . $image->image_path));
            $image->delete();
        }
        $profileRuangan->delete();

        if (request()->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'Profile ruangan berhasil dihapus']);
        }
        return redirect()->route('admin.profile.index')->with('success', '✓ Profile ruangan berhasil dihapus!');
    }

    public function publicIndex()
    {
        $items = ProfileRuangan::with('images')->where('is_active', true)->latest()->get();

        // Bersihkan description sebelum dikirim ke view
        $items->transform(function ($item) {
            $item->description = strip_tags($item->description);
            return $item;
        });

        return view('infobase.profile-ruangan', compact('items'));
    }

    public function deleteImage(ProfileRuanganImage $image)
    {
        $profileRuanganId = $image->profile_ruangan_id;
        
        // Delete physical file from all possible storage locations
        Storage::disk('public')->delete($image->image_path);
        Storage::disk('local')->delete($image->image_path);
        @unlink(storage_path('app/' . $image->image_path));
        @unlink(storage_path('app/private/' . $image->image_path));
        \Log::info('Deleted image file: ' . $image->image_path);
        
        // Delete database record
        $image->delete();

        if (request()->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'Gambar berhasil dihapus']);
        }
        return redirect()->route('admin.profile.edit', $profileRuanganId)->with('success', '✓ Gambar berhasil dihapus!');
    }
}
