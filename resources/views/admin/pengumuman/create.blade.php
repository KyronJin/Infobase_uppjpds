@extends('layouts.app')

@section('content')
{{-- Include Image Cropper Component --}}
@include('components.image-cropper')

<div class="bg-gray-50 min-h-screen py-12 pt-28">
    <div class="max-w-6xl mx-auto px-6">
        <!-- Header dengan Navigation -->
        <div class="mb-8">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center gap-3">
                    <a href="{{ route('admin.pengumuman.index') }}" class="inline-flex items-center justify-center w-10 h-10 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors" title="Kembali">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                    </a>
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">Buat Pengumuman Baru</h1>
                        <p class="text-sm text-gray-600 mt-1">Tambahkan pengumuman baru untuk tampil di halaman utama</p>
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

            <form action="{{ route('admin.pengumuman.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                
                <!-- Judul -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Judul Pengumuman *</label>
                    <input type="text" name="title" class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('title') border-red-500 @enderror" value="{{ old('title') }}" placeholder="Masukkan judul pengumuman" required>
                    @error('title')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Deskripsi -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Isi Pengumuman *</label>
                    <div id="editor-description" class="border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" style="border-radius: 0.5rem; overflow: hidden;"></div>
                    <textarea name="description" id="description" class="editor hidden" placeholder="Ketik isi pengumuman di sini...">{{ old('description') }}</textarea>
                    @error('description')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Gambar -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Gambar Pengumuman</label>
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-blue-400 transition cursor-pointer" onclick="document.getElementById('image-input').click()">
                        <svg class="w-12 h-12 text-gray-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        <p class="text-gray-700 font-medium">Klik untuk upload gambar</p>
                        <p class="text-gray-500 text-sm">atau drag & drop file gambar</p>
                        <p class="text-gray-400 text-xs mt-2">Format: JPG, PNG, GIF • Maks: 2MB</p>
                    </div>
                    <input type="file" id="image-input" name="image" accept="image/*" class="hidden" onchange="previewImage(this)">
                    <div id="image-preview" class="mt-4" style="display:none;">
                        <p class="text-sm text-gray-600 mb-2">Preview Gambar:</p>
                        <img id="preview-img" src="" alt="Preview" class="max-w-xs rounded-lg border border-gray-300">
                    </div>
                    @error('image')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Tanggal Publikasi -->
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Publikasi</label>
                        <input type="datetime-local" name="published_at" class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" value="{{ old('published_at') }}">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Unpublikasi</label>
                        <input type="datetime-local" name="unpublished_at" class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" value="{{ old('unpublished_at') }}">
                    </div>
                </div>

                <!-- Tanggal Berlaku -->
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Mulai Berlaku</label>
                        <input type="datetime-local" name="valid_from" class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" value="{{ old('valid_from') }}">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Berakhir Berlaku</label>
                        <input type="datetime-local" name="valid_until" class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" value="{{ old('valid_until') }}">
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex gap-3 pt-6 border-t border-gray-200">
                    <a href="{{ route('admin.pengumuman.index') }}" class="flex-1 px-6 py-3 bg-gray-200 text-gray-800 font-medium rounded-lg hover:bg-gray-300 transition-colors text-center">
                        Batal
                    </a>
                    <button type="submit" class="flex-1 px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        Buat Pengumuman
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function previewImage(input) {
    const file = input.files[0];
    const previewArea = document.getElementById('image-preview');
    const previewImg = document.getElementById('preview-img');
    
    if (file) {
        previewImg.src = URL.createObjectURL(file);
        previewArea.style.display = 'block';
    } else {
        previewArea.style.display = 'none';
    }
}
</script>
@endsection