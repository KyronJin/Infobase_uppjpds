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
            'slot_1_image'=> 'nullable|image|mimes:jpeg,png,jpg,gif|max:20480',
            'slot_2_image'=> 'nullable|image|mimes:jpeg,png,jpg,gif|max:20480',
            'slot_3_image'=> 'nullable|image|mimes:jpeg,png,jpg,gif|max:20480',
            'is_active'   => 'nullable|in:0,1,on,true,false',
        ];
    }

    private function saveImages(Request $request, ProfileRuangan $profileRuangan, $replace = false)
    {
        $uploadDir = storage_path('app/profile_ruangan_images');
        
        // Create directory if not exists
        if (!is_dir($uploadDir)) {
            @mkdir($uploadDir, 0755, true);
        }
        
        \Log::info('saveImages started', [
            'profileRuangan_id' => $profileRuangan->id,
            'upload_dir' => $uploadDir,
            'dir_exists' => is_dir($uploadDir),
            'dir_writable' => is_writable($uploadDir),
        ]);
        
        for ($i = 1; $i <= 3; $i++) {
            $slotName = "slot_{$i}_image";
            
            try {
                if (!$request->hasFile($slotName)) {
                    \Log::debug("No file for $slotName");
                    continue;
                }
                
                $file = $request->file($slotName);
                
                if (!$file || !$file->isValid()) {
                    \Log::warning("Invalid file for $slotName", [
                        'error' => $file ? $file->getErrorMessage() : 'File is null',
                    ]);
                    continue;
                }
                
                \Log::info("File valid for $slotName", [
                    'name' => $file->getClientOriginalName(),
                    'size' => $file->getSize(),
                    'mime' => $file->getMimeType(),
                ]);
                
                // Delete old image if replacing
                if ($replace) {
                    $oldImage = $profileRuangan->images()->where('slot', $i)->first();
                    if ($oldImage && $oldImage->image_path) {
                        $oldPath = storage_path('app/' . $oldImage->image_path);
                        if (file_exists($oldPath)) {
                            @unlink($oldPath);
                            \Log::info("Deleted old image: {$oldPath}");
                        }
                        $oldImage->delete();
                    }
                }
                
                // Generate filename
                $filename = uniqid('profile_' . $profileRuangan->id . '_slot_' . $i . '_', true) . '.' . $file->getClientOriginalExtension();
                $fullPath = $uploadDir . DIRECTORY_SEPARATOR . $filename;
                $relativePath = 'profile_ruangan_images/' . $filename;
                
                \Log::info("Attempting to move file", [
                    'from' => $file->getRealPath(),
                    'to' => $fullPath,
                    'filename' => $filename,
                ]);
                
                // Try to copy file first, then delete original
                if (!copy($file->getRealPath(), $fullPath)) {
                    \Log::error("Failed to copy file for $slotName");
                    throw new \Exception("Failed to copy file for slot $i");
                }
                
                \Log::info("File copied successfully", [
                    'fullPath' => $fullPath,
                    'exists' => file_exists($fullPath),
                    'size' => filesize($fullPath),
                ]);
                
                // Create database record
                ProfileRuanganImage::create([
                    'profile_ruangan_id' => $profileRuangan->id,
                    'slot'               => $i,
                    'image_path'         => $relativePath,
                ]);
                
                \Log::info("Image record created for slot $i", [
                    'image_path' => $relativePath,
                ]);
                
            } catch (\Exception $e) {
                \Log::error("Error saving image for $slotName: " . $e->getMessage(), [
                    'trace' => $e->getTraceAsString(),
                ]);
                // Continue with next slot instead of throwing
            }
        }
        
        \Log::info('saveImages completed');
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
                'slot_1' => $request->hasFile('slot_1_image'),
                'slot_2' => $request->hasFile('slot_2_image'),
                'slot_3' => $request->hasFile('slot_3_image'),
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
                'slot_1' => $request->hasFile('slot_1_image'),
                'slot_2' => $request->hasFile('slot_2_image'),
                'slot_3' => $request->hasFile('slot_3_image'),
            ]
        ]);

        try {
            $data = $request->validate($this->rules());
            \Log::info('Validation passed', ['data_keys' => array_keys($data)]);
            
            $data['is_active'] = $request->has('is_active');
            $data['description'] = strip_tags($data['description'] ?? '');

            $profileRuangan->update($data);
            \Log::info('Profile ruangan data updated');
            
            $this->saveImages($request, $profileRuangan, true);
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
            $imagePath = storage_path('app/' . $image->image_path);
            if (file_exists($imagePath)) {
                @unlink($imagePath);
            }
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
        
        // Delete physical file
        $imagePath = storage_path('app/' . $image->image_path);
        if (file_exists($imagePath)) {
            @unlink($imagePath);
            \Log::info('Deleted image file: ' . $image->image_path);
        }
        
        // Delete database record
        $image->delete();

        if (request()->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'Gambar berhasil dihapus']);
        }
        return redirect()->route('admin.profile.edit', $profileRuanganId)->with('success', '✓ Gambar berhasil dihapus!');
    }
}
