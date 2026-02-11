@extends('layouts.app')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<style>
    .font-cairo { font-family: 'Cairo', sans-serif; }
    .quill-editor { min-height: 250px; }
    .image-slot { aspect-ratio: 16/9; overflow: hidden; }
</style>
@endpush

@section('content')
<div class="bg-gray-50 min-h-screen py-12 pt-28 font-cairo">
    <div class="max-w-4xl mx-auto px-6">
        
        <!-- Standardized Header -->
        <div class="flex flex-col md:flex-row items-center justify-between mb-8 bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
            <div class="flex items-center gap-4">
                <a href="{{ route('admin.profile.index') }}" class="w-10 h-10 flex items-center justify-center rounded-full bg-gray-50 text-gray-400 hover:bg-gray-100 transition-colors">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <div>
                    <h1 class="h2 text-gray-800">Buat Profile Ruangan</h1>
                    <p class="text-sm text-gray-500">Tambahkan informasi dan fasilitas ruangan baru.</p>
                </div>
            </div>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8">
            @if($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-700 px-6 py-4 rounded-lg mb-6">
                    <h3 class="font-semibold mb-2">Terjadi Kesalahan:</h3>
                    <ul class="list-disc list-inside space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.profile.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                
                <!-- Nama Ruangan -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Ruangan *</label>
                    <input type="text" name="room_name" class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('room_name') border-red-500 @enderror" value="{{ old('room_name') }}" placeholder="Contoh: Ruang Baca Utama" required>
                    @error('room_name')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Lantai dan Kapasitas -->
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Lantai</label>
                        <input type="number" name="floor" class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" min="1" max="7" value="{{ old('floor') }}" placeholder="Lantai ke...">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Kapasitas</label>
                        <input type="number" name="capacity" class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" value="{{ old('capacity') }}" placeholder="Jumlah orang">
                    </div>
                </div>

                <!-- Deskripsi -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi Ruangan *</label>
                    <div id="editor-description" class="border border-gray-300 rounded-lg shadow-sm" style="border-radius: 0.5rem; overflow: hidden; min-height: 300px;"></div>
                    <textarea name="description" id="description" class="editor hidden" placeholder="Deskripsikan fasilitas dan keunggulan ruangan ini...">{{ old('description') }}</textarea>
                    @error('description')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Gambar Ruangan -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-4">Gambar Ruangan (Maksimal 3)</label>
                    <div class="grid grid-cols-3 gap-4">
                        <!-- Slot 1 -->
                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center cursor-pointer hover:border-blue-400 transition" onclick="document.getElementById('slot-1-input').click()">
                            <div id="slot-1-preview" class="hidden">
                                <img id="slot-1-img" src="" alt="Slot 1" class="w-full h-40 object-cover rounded mb-2">
                                <button type="button" class="text-xs bg-blue-600 text-white px-3 py-1 rounded w-full">Ubah Gambar</button>
                            </div>
                            <div id="slot-1-empty" class="flex flex-col items-center justify-center h-40">
                                <svg class="w-8 h-8 text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                <p class="text-sm font-semibold text-gray-700">Gambar 1</p>
                            </div>
                            <input type="file" id="slot-1-input" name="slot_1_image" accept="image/*" class="hidden" onchange="previewSlotImage(1, this)">
                        </div>

                        <!-- Slot 2 -->
                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center cursor-pointer hover:border-blue-400 transition" onclick="document.getElementById('slot-2-input').click()">
                            <div id="slot-2-preview" class="hidden">
                                <img id="slot-2-img" src="" alt="Slot 2" class="w-full h-40 object-cover rounded mb-2">
                                <button type="button" class="text-xs bg-blue-600 text-white px-3 py-1 rounded w-full">Ubah Gambar</button>
                            </div>
                            <div id="slot-2-empty" class="flex flex-col items-center justify-center h-40">
                                <svg class="w-8 h-8 text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                <p class="text-sm font-semibold text-gray-700">Gambar 2</p>
                            </div>
                            <input type="file" id="slot-2-input" name="slot_2_image" accept="image/*" class="hidden" onchange="previewSlotImage(2, this)">
                        </div>

                        <!-- Slot 3 -->
                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center cursor-pointer hover:border-blue-400 transition" onclick="document.getElementById('slot-3-input').click()">
                            <div id="slot-3-preview" class="hidden">
                                <img id="slot-3-img" src="" alt="Slot 3" class="w-full h-40 object-cover rounded mb-2">
                                <button type="button" class="text-xs bg-blue-600 text-white px-3 py-1 rounded w-full">Ubah Gambar</button>
                            </div>
                            <div id="slot-3-empty" class="flex flex-col items-center justify-center h-40">
                                <svg class="w-8 h-8 text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                <p class="text-sm font-semibold text-gray-700">Gambar 3</p>
                            </div>
                            <input type="file" id="slot-3-input" name="slot_3_image" accept="image/*" class="hidden" onchange="previewSlotImage(3, this)">
                        </div>
                    </div>
                    <p class="text-sm text-gray-500 mt-3">Klik pada slot untuk menambah gambar. Format: JPG, PNG, GIF • Maks: 2MB per gambar</p>
                </div>

                <!-- Status -->
                <div>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" class="w-4 h-4 text-blue-600 rounded focus:ring-2 focus:ring-blue-500">
                        <span class="text-sm font-semibold text-gray-700">Aktifkan Ruangan</span>
                    </label>
                </div>

                <!-- Action Buttons -->
                <div class="flex gap-3 pt-6 border-t border-gray-200">
                    <x-button variant="secondary" size="lg" type="link" href="{{ route('admin.profile.index') }}">Batal</x-button>
                    <x-button variant="primary" size="lg" type="submit" icon="check">Buat Ruangan</x-button>
                </div>
            </form>
        </div>
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