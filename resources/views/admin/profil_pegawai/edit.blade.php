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
    <div class="max-w-2xl mx-auto px-6">
        <!-- Header -->
        <div class="mb-8">
            <a href="{{ route('admin.profil_pegawai.index') }}" class="inline-flex items-center text-indigo-600 hover:text-indigo-700 text-sm font-medium mb-4">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                Kembali ke Daftar
            </a>
            <h1 class="h2 text-gray-800">Edit Profil Pegawai</h1>
            <p class="text-sm text-gray-500 mt-2">Perbarui informasi profil pegawai perpustakaan.</p>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
            <form action="{{ route('admin.profil_pegawai.update', $profil_pegawai) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Nama Pegawai -->
                <div class="mb-6">
                    <label for="nama" class="block text-sm font-semibold text-gray-700 mb-2">Nama Pegawai</label>
                    <input 
                        type="text" 
                        id="nama" 
                        name="nama" 
                        value="{{ old('nama', $profil_pegawai->nama) }}"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all" 
                        placeholder="Masukkan nama pegawai"
                        required>
                    @error('nama')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Jabatan -->
                <div class="mb-6">
                    <label for="jabatan_id" class="block text-sm font-semibold text-gray-700 mb-2">Jabatan</label>
                    <select 
                        id="jabatan_id" 
                        name="jabatan_id" 
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all"
                        required>
                        <option value="">-- Pilih Jabatan --</option>
                        @foreach($jabatans as $jabatan)
                            <option value="{{ $jabatan->id }}" {{ $profil_pegawai->jabatan_id == $jabatan->id ? 'selected' : '' }}>
                                {{ $jabatan->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('jabatan_id')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Deskripsi -->
                <div class="mb-6">
                    <label for="deskripsi" class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi</label>
                    <textarea 
                        id="deskripsi" 
                        name="deskripsi" 
                        rows="5"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all"
                        placeholder="Masukkan deskripsi pegawai"
                        required>{{ old('deskripsi', $profil_pegawai->deskripsi) }}</textarea>
                    @error('deskripsi')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Foto Pegawai -->
                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Foto Pegawai</label>
                    
                    <!-- Foto Saat Ini -->
                    @if($profil_pegawai->foto_path)
                    <div class="mb-4">
                        <p class="text-xs text-gray-600 font-medium mb-2">Foto Saat Ini:</p>
                        <div class="flex items-center gap-4">
                            <img 
                                src="{{ asset('storage/' . $profil_pegawai->foto_path) }}" 
                                alt="{{ $profil_pegawai->nama }}"
                                class="w-24 h-24 rounded-lg object-cover border border-gray-200">
                            <div>
                                <p class="text-sm text-gray-600">Klik input di bawah untuk mengganti foto</p>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Upload Foto Baru -->
                    <div class="relative">
                        <input 
                            type="file" 
                            id="foto" 
                            name="foto" 
                            accept="image/*"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all cursor-pointer"
                            onchange="previewFoto(this)">
                        <p class="text-xs text-gray-500 mt-2">Biarkan kosong jika tidak ingin mengubah foto. Format: JPEG, PNG, JPG, GIF. Maksimal 2MB.</p>
                    </div>

                    <!-- Preview Foto Baru -->
                    <div id="fotoPreview" class="mt-4"></div>

                    @error('foto')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Tombol -->
                <div class="flex gap-4 pt-6 border-t border-gray-100">
                    <a href="{{ route('admin.profil_pegawai.index') }}" class="flex-1 px-6 py-2.5 bg-gray-200 text-gray-800 font-medium rounded-lg hover:bg-gray-300 transition-colors text-center">
                        Batal
                    </a>
                    <button 
                        type="submit" 
                        class="flex-1 px-6 py-2.5 bg-indigo-600 text-white font-medium rounded-lg hover:bg-indigo-700 transition-colors flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function previewFoto(input) {
    const previewDiv = document.getElementById('fotoPreview');
    previewDiv.innerHTML = '';
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const img = document.createElement('img');
            img.src = e.target.result;
            img.className = 'w-24 h-24 rounded-lg object-cover border border-gray-200 mt-2';
            previewDiv.innerHTML = '<p class="text-xs text-gray-600 font-medium mb-2">Preview Foto Baru:</p>';
            previewDiv.appendChild(img);
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection
