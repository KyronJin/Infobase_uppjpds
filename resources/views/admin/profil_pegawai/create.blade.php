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
<div class="bg-gray-50 min-h-screen py-12 font-cairo pt-28">
    <div class="max-w-6xl mx-auto px-6">
        <!-- Header dengan Navigation -->
        <div class="mb-8">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center gap-3">
                    <a href="{{ route('admin.profil_pegawai.index') }}" class="inline-flex items-center justify-center w-10 h-10 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors" title="Kembali">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                    </a>
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">Tambah Profil Pegawai Baru</h1>
                        <p class="text-sm text-gray-600 mt-1">Buatlah profil pegawai perpustakaan baru</p>
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

            <form id="formTambahPegawai" action="{{ route('admin.profil_pegawai.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- Nama Pegawai -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Pegawai *</label>
                    <input 
                        type="text" 
                        name="nama" 
                        value="{{ old('nama') }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-teal-600 focus:border-transparent @error('nama') border-red-500 @enderror" 
                        placeholder="Masukkan nama pegawai"
                        required>
                    @error('nama')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Jabatan -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Jabatan *</label>
                    <select 
                        name="jabatan_id" 
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-teal-600 focus:border-transparent @error('jabatan_id') border-red-500 @enderror"
                        required>
                        <option value="">-- Pilih Jabatan --</option>
                        @foreach($jabatans as $jabatan)
                            <option value="{{ $jabatan->id }}" {{ old('jabatan_id') == $jabatan->id ? 'selected' : '' }}>
                                {{ $jabatan->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('jabatan_id')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Deskripsi -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi *</label>
                    <textarea 
                        name="deskripsi" 
                        id="deskripsi"
                        rows="6"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-teal-600 focus:border-transparent @error('deskripsi') border-red-500 @enderror" 
                        placeholder="Masukkan deskripsi pegawai"
                        required>{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Foto Pegawai -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Foto Pegawai</label>
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-teal-600 transition cursor-pointer" onclick="document.getElementById('foto-input').click()">
                        <svg class="w-12 h-12 text-gray-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        <p class="text-gray-700 font-medium">Klik untuk upload foto</p>
                        <p class="text-gray-500 text-sm">Format: JPG, PNG, GIF • Maks: 2MB</p>
                    </div>
                    <input 
                        type="file" 
                        id="foto-input" 
                        name="foto" 
                        accept="image/*"
                        class="hidden"
                        onchange="previewFoto(this)">
                    <div id="foto-preview" class="mt-4" style="display:none;">
                        <p class="text-sm text-gray-600 mb-2">Preview Foto:</p>
                        <img id="preview-foto-img" src="" alt="Preview" class="max-w-xs rounded-lg border border-gray-300">
                    </div>
                    @error('foto')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Action Buttons -->
                <div class="flex gap-3 pt-6 border-t border-gray-200">
                    <x-button variant="secondary" size="lg" type="link" href="{{ route('admin.profil_pegawai.index') }}">Batal</x-button>
                    <x-button variant="primary" size="lg" type="submit" icon="check">Tambah Pegawai</x-button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function previewFoto(input) {
    const file = input.files[0];
    const previewArea = document.getElementById('foto-preview');
    const previewImg = document.getElementById('preview-foto-img');
    
    if (file) {
        previewImg.src = URL.createObjectURL(file);
        previewArea.style.display = 'block';
    } else {
        previewArea.style.display = 'none';
    }
}
</script>
@endsection
