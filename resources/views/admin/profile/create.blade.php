@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 py-12">
    <div class="admin-section">
        <h1 class="admin-header">Buat Profile Ruangan</h1>

        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.profile.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="form-label">Nama Ruangan</label>
                <input type="text" name="room_name" class="form-control" value="{{ old('room_name') }}" required>
            </div>

            <div class="form-group">
                <label class="form-label">Lantai</label>
                <input type="number" name="floor" class="form-control" min="1" max="7" value="{{ old('floor') }}">
            </div>

            <div class="form-group">
                <label class="form-label">Kapasitas</label>
                <input type="number" name="capacity" class="form-control" value="{{ old('capacity') }}">
            </div>

            <div class="form-group">
                <label class="form-label">Deskripsi</label>
                <textarea name="description" class="form-control" rows="6">{{ old('description') }}</textarea>
            </div>

            <div class="form-group">
                <label class="form-label">Gambar Ruangan (Maksimal 3)</label>
                <div class="grid grid-cols-3 gap-4 mt-4">
                    <!-- Slot 1 -->
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center cursor-pointer hover:border-blue-400 transition" onclick="document.getElementById('slot-1-input').click()">
                        <div id="slot-1-preview" class="hidden">
                            <img id="slot-1-img" src="" alt="Slot 1" class="w-full h-32 object-cover rounded mb-2">
                            <button type="button" class="text-xs bg-blue-600 text-white px-2 py-1 rounded w-full">Ubah</button>
                        </div>
                        <div id="slot-1-empty" class="flex flex-col items-center justify-center h-32">
                            <svg class="w-8 h-8 text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            <p class="text-sm font-semibold text-gray-700">Gambar 1</p>
                        </div>
                        <input type="file" id="slot-1-input" name="slot_1_image" accept="image/*" class="hidden" onchange="previewSlotImage(1, this)">
                    </div>

                    <!-- Slot 2 -->
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center cursor-pointer hover:border-blue-400 transition" onclick="document.getElementById('slot-2-input').click()">
                        <div id="slot-2-preview" class="hidden">
                            <img id="slot-2-img" src="" alt="Slot 2" class="w-full h-32 object-cover rounded mb-2">
                            <button type="button" class="text-xs bg-blue-600 text-white px-2 py-1 rounded w-full">Ubah</button>
                        </div>
                        <div id="slot-2-empty" class="flex flex-col items-center justify-center h-32">
                            <svg class="w-8 h-8 text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            <p class="text-sm font-semibold text-gray-700">Gambar 2</p>
                        </div>
                        <input type="file" id="slot-2-input" name="slot_2_image" accept="image/*" class="hidden" onchange="previewSlotImage(2, this)">
                    </div>

                    <!-- Slot 3 -->
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center cursor-pointer hover:border-blue-400 transition" onclick="document.getElementById('slot-3-input').click()">
                        <div id="slot-3-preview" class="hidden">
                            <img id="slot-3-img" src="" alt="Slot 3" class="w-full h-32 object-cover rounded mb-2">
                            <button type="button" class="text-xs bg-blue-600 text-white px-2 py-1 rounded w-full">Ubah</button>
                        </div>
                        <div id="slot-3-empty" class="flex flex-col items-center justify-center h-32">
                            <svg class="w-8 h-8 text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            <p class="text-sm font-semibold text-gray-700">Gambar 3</p>
                        </div>
                        <input type="file" id="slot-3-input" name="slot_3_image" accept="image/*" class="hidden" onchange="previewSlotImage(3, this)">
                    </div>
                </div>
                <small class="text-gray-500 block mt-3">Klik pada slot untuk menambah atau mengubah gambar. Maksimal 3 gambar.</small>
            </div>

            <div class="form-group">
                <label class="form-label inline-flex items-center">
                    <input type="checkbox" name="is_active" class="mr-2" value="1">
                    Aktif
                </label>
            </div>

            <div>
                <button type="submit" class="form-submit">Simpan</button>
                <a href="{{ route('admin.profile.index') }}" class="inline-block ml-3">Batal</a>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    window.previewSlotImage = function(slotNum, input) {
        const file = input.files[0];
        
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById(`slot-${slotNum}-preview`);
                const empty = document.getElementById(`slot-${slotNum}-empty`);
                const img = document.getElementById(`slot-${slotNum}-img`);
                
                img.src = e.target.result;
                preview.classList.remove('hidden');
                empty.classList.add('hidden');
            };
            reader.readAsDataURL(file);
        }
    };
});
</script>
@endsection