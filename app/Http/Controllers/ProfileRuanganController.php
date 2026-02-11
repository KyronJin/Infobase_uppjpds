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
        for ($i = 1; $i <= 3; $i++) {
            $slotName = "slot_{$i}_image";
            if ($request->hasFile($slotName)) {
                if ($replace) {
                    $oldImage = $profileRuangan->images()->where('slot', $i)->first();
                    if ($oldImage) {
                        Storage::disk('public')->delete($oldImage->image_path);
                        $oldImage->delete();
                    }
                }
                $path = $request->file($slotName)->store('profile_ruangan_images', 'public');
                ProfileRuanganImage::create([
                    'profile_ruangan_id' => $profileRuangan->id,
                    'slot'               => $i,
                    'image_path'         => $path,
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
        $data = $request->validate($this->rules());
        $data['is_active'] = $request->has('is_active');
        $data['description'] = strip_tags($data['description'] ?? '');

        $profileRuangan = ProfileRuangan::create($data);
        $this->saveImages($request, $profileRuangan);

        return redirect()->route('admin.profile.index')->with('success', '✓ Profile ruangan berhasil ditambahkan!');
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
        $data = $request->validate($this->rules());
        $data['is_active'] = $request->has('is_active');
        $data['description'] = strip_tags($data['description'] ?? '');

        $profileRuangan->update($data);
        $this->saveImages($request, $profileRuangan, true);

        return redirect()->route('admin.profile.edit', $profileRuangan->id)->with('success', '✓ Profile ruangan berhasil diperbarui!');
    }

    public function destroy(ProfileRuangan $profileRuangan)
    {
        foreach ($profileRuangan->images as $image) {
            Storage::disk('public')->delete($image->image_path);
            $image->delete();
        }
        $profileRuangan->delete();
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
        Storage::disk('public')->delete($image->image_path);
        $image->delete();

        if (request()->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'Gambar berhasil dihapus']);
        }
        return redirect()->route('admin.profile.edit', $profileRuanganId)->with('success', '✓ Gambar berhasil dihapus!');
    }
}
