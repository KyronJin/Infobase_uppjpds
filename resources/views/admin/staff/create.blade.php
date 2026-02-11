@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen py-12 pt-28">
    <div class="max-w-6xl mx-auto px-6">
        <!-- Header dengan Navigation -->
        <div class="mb-8">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center gap-3">
                    <a href="{{ route('admin.staff-of-month.index') }}" class="inline-flex items-center justify-center w-10 h-10 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors" title="Kembali">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                    </a>
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">Buat Staff of the Month Baru</h1>
                        <p class="text-sm text-gray-600 mt-1">Tambahkan penghargaan karyawan terbaik bulan ini</p>
                    </div>
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

            <form action="{{ route('admin.staff-of-month.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                
                <!-- Nama -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nama *</label>
                    <input type="text" name="name" class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('name') border-red-500 @enderror" value="{{ old('name') }}" placeholder="Nama karyawan" required>
                    @error('name')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Posisi -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Posisi/Jabatan</label>
                    <input type="text" name="position" class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" value="{{ old('position') }}" placeholder="Posisi atau jabatan">
                    @error('position')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Bulan dan Tahun -->
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Bulan</label>
                        <input type="number" name="month" class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" min="1" max="12" value="{{ old('month') }}" placeholder="1-12">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Tahun</label>
                        <input type="number" name="year" class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" value="{{ old('year') }}" placeholder="2026">
                    </div>
                </div>

                <!-- Bio -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Bio / Pencapaian</label>
                    <div id="editor-bio" class="border border-gray-300 rounded-lg shadow-sm" style="border-radius: 0.5rem; overflow: hidden; min-height: 300px;"></div>
                    <textarea name="bio" id="bio" class="editor hidden" placeholder="Deskripsikan pencapaian dan kontribusi...">{{ old('bio') }}</textarea>
                    @error('bio')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Foto -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Foto</label>
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-blue-400 transition cursor-pointer" onclick="document.getElementById('photo-input').click()">
                        <svg class="w-12 h-12 text-gray-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        <p class="text-gray-700 font-medium">Klik untuk upload foto</p>
                        <p class="text-gray-500 text-sm">Format: JPG, PNG, GIF • Maks: 10MB</p>
                    </div>
                    <input type="file" id="photo-input" name="photo" accept="image/*" class="hidden" onchange="previewPhoto(this)">
                    <div id="photo-preview" class="mt-4" style="display:none;">
                        <p class="text-sm text-gray-600 mb-2">Preview Foto:</p>
                        <img id="preview-photo-img" src="" alt="Preview" class="max-w-xs rounded-lg border border-gray-300">
                    </div>
                    @error('photo')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Link Foto Eksternal -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Link Foto Eksternal (Opsional)</label>
                    <input type="url" name="photo_link" class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" value="{{ old('photo_link') }}" placeholder="https://...">
                </div>

                <!-- Status -->
                <div>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" checked class="w-4 h-4 text-blue-600 rounded focus:ring-2 focus:ring-blue-500">
                        <span class="text-sm font-semibold text-gray-700">Aktifkan Staff</span>
                    </label>
                </div>

                <!-- Action Buttons -->
                <div class="flex gap-3 pt-6 border-t border-gray-200">
                    <x-button variant="secondary" size="lg" type="link" href="{{ route('admin.staff-of-month.index') }}">Batal</x-button>
                    <x-button variant="primary" size="lg" type="submit" icon="check">Buat Staff</x-button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function previewPhoto(input) {
    const file = input.files[0];
    const previewArea = document.getElementById('photo-preview');
    const previewImg = document.getElementById('preview-photo-img');
    
    if (file) {
        previewImg.src = URL.createObjectURL(file);
        previewArea.style.display = 'block';
    } else {
        previewArea.style.display = 'none';
    }
}
</script>
@endsection
