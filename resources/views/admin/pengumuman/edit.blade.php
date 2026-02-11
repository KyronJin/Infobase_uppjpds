@extends('layouts.app')

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">
<style>
    .font-cairo { font-family: 'Cairo', sans-serif; }
</style>
@endpush

@section('content')
<div class="bg-gray-50 min-h-screen py-12 pt-28 font-cairo">
    <div class="max-w-6xl mx-auto px-6">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center gap-4 mb-4">
                <a href="{{ route('admin.pengumuman.index') }}" class="inline-flex items-center justify-center w-10 h-10 bg-white border border-gray-200 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors shadow-sm" title="Kembali">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                </a>
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Edit Pengumuman</h1>
                    <p class="text-sm text-gray-500 mt-1">Perbarui informasi pengumuman di sini.</p>
                </div>
            </div>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-10">
            <form action="{{ route('admin.pengumuman.update', $pengumuman) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf
                @method('PUT')
                
                <!-- Judul Pengumuman -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Judul Pengumuman *</label>
                    <input type="text" name="title" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-all" value="{{ old('title', $pengumuman->title) }}" placeholder="Masukkan judul pengumuman" required>
                    @error('title')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Isi Pengumuman dengan Quill Editor -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Isi Pengumuman *</label>
                    <div id="editor-description" class="border border-gray-300 rounded-lg shadow-sm" style="border-radius: 0.5rem; overflow: hidden; min-height: 300px;">
                        {!! $pengumuman->description !!}
                    </div>
                    <textarea name="description" id="description" class="editor hidden" placeholder="Ketik isi pengumuman di sini...">{!! old('description', $pengumuman->description) !!}</textarea>
                    @error('description')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Gambar Pengumuman -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-4">Gambar Pengumuman</label>
                    
                    <!-- Current Image Preview -->
                    @if($pengumuman->image_path)
                        <div class="mb-4 p-4 bg-gray-50 rounded-lg border border-gray-200">
                            <p class="text-sm font-medium text-gray-700 mb-2">Gambar Saat Ini:</p>
                            <img src="{{ asset('storage/' . $pengumuman->image_path) }}" alt="Gambar Pengumuman" class="h-32 w-auto rounded border border-gray-300">
                        </div>
                    @endif
                    
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center cursor-pointer hover:border-blue-400 transition" onclick="document.getElementById('image-input').click()">
                        <div id="image-preview" class="hidden">
                            <img id="image-img" src="" alt="Gambar" class="w-full h-48 object-cover rounded mb-2">
                            <x-button size="sm" variant="primary">Ubah Gambar</x-button>
                        </div>
                        <div id="image-empty" class="flex flex-col items-center justify-center h-48">
                            <svg class="w-8 h-8 text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            <p class="text-sm font-semibold text-gray-700">Ganti Gambar (Opsional)</p>
                        </div>
                        <input type="file" id="image-input" name="image" accept="image/*" class="hidden" onchange="previewImage(this)">
                    </div>
                    <p class="text-sm text-gray-500 mt-3">Klik untuk mengganti gambar. Format: JPG, PNG, GIF • Maks: 2MB</p>
                    @error('image')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Tanggal Publikasi -->
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Publikasi</label>
                        <input type="datetime-local" name="published_at" class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" value="{{ old('published_at', $pengumuman->published_at?->format('Y-m-d\TH:i')) }}">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Unpublikasi</label>
                        <input type="datetime-local" name="unpublished_at" class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" value="{{ old('unpublished_at', $pengumuman->unpublished_at?->format('Y-m-d\TH:i')) }}">
                    </div>
                </div>

                <!-- Tanggal Berlaku -->
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Mulai Berlaku</label>
                        <input type="date" name="valid_from" class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" value="{{ old('valid_from', $pengumuman->valid_from?->format('Y-m-d')) }}">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Berakhir Berlaku</label>
                        <input type="date" name="valid_until" class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" value="{{ old('valid_until', $pengumuman->valid_until?->format('Y-m-d')) }}">
                    </div>
                </div>

                <!-- Status -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Status *</label>
                    <select name="status" class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('status') border-red-500 @enderror" required>
                        <option value="">-- Pilih Status --</option>
                        <option value="active" {{ old('status', $pengumuman->status) === 'active' ? 'selected' : '' }}>✓ Aktif</option>
                        <option value="inactive" {{ old('status', $pengumuman->status) === 'inactive' ? 'selected' : '' }}>✗ Tidak Aktif</option>
                    </select>
                    @error('status')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Action Buttons -->
                <div class="flex gap-3 pt-6 border-t border-gray-200">
                    <x-button variant="secondary" size="lg" type="link" href="{{ route('admin.pengumuman.index') }}">Batal</x-button>
                    <x-button variant="primary" size="lg" type="submit" icon="check">Update Pengumuman</x-button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    window.previewImage = function(input) {
        const file = input.files[0];
        
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById('image-preview');
                const empty = document.getElementById('image-empty');
                const img = document.getElementById('image-img');
                
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
