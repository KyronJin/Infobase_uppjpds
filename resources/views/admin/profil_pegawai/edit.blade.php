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
    <div class="max-w-4xl mx-auto px-6">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center gap-4 mb-4">
                <a href="{{ route('admin.profil_pegawai.index') }}" class="inline-flex items-center justify-center w-10 h-10 bg-white border border-gray-200 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors shadow-sm" title="Kembali">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                </a>
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Edit Profil Pegawai</h1>
                    <p class="text-sm text-gray-500 mt-1">Perbarui informasi profil pegawai perpustakaan di sini.</p>
                </div>
            </div>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-10">
            <form id="formEditPegawai" action="{{ route('admin.profil_pegawai.update', $profil_pegawai) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Nama Pegawai -->
                <div>
                    <label for="nama" class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap *</label>
                    <input 
                        type="text" 
                        id="nama" 
                        name="nama" 
                        value="{{ old('nama', $profil_pegawai->nama) }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-all" 
                        placeholder="Masukkan nama lengkap"
                        required>
                    @error('nama')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Jabatan -->
                    <div>
                        <label for="jabatan_id" class="block text-sm font-semibold text-gray-700 mb-2">Jabatan *</label>
                        <select 
                            id="jabatan_id" 
                            name="jabatan_id" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-all"
                            required>
                            <option value="">-- Pilih Jabatan --</option>
                            @foreach($jabatans as $jabatan)
                                <option value="{{ $jabatan->id }}" {{ old('jabatan_id', $profil_pegawai->jabatan_id) == $jabatan->id ? 'selected' : '' }}>
                                    {{ $jabatan->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('jabatan_id')
                            <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Deskripsi -->
                <div>
                    <label for="deskripsi" class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi / Tugas *</label>
                    <textarea 
                        id="deskripsi" 
                        name="deskripsi"
                        rows="5"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-all @error('deskripsi') border-red-500 @enderror"
                        placeholder="Jelaskan peran dan tanggung jawab pegawai..."
                        required>{{ old('deskripsi', $profil_pegawai->deskripsi) }}</textarea>
                    @error('deskripsi')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Foto Pegawai -->
                <div class="bg-gray-50 p-6 rounded-2xl border border-dashed border-gray-200">
                    <label class="block text-sm font-semibold text-gray-700 mb-3 text-center md:text-left">Foto Pegawai</label>
                    
                    <div class="flex flex-col md:flex-row items-center gap-8">
                        @if($profil_pegawai->foto_path)
                        <div class="flex-shrink-0 text-center">
                            <p class="text-[10px] uppercase font-bold text-gray-400 mb-2">Foto Saat Ini</p>
                            <div class="w-32 h-32 rounded-2xl overflow-hidden ring-4 ring-white shadow-md">
                                <img src="{{ asset('storage/' . $profil_pegawai->foto_path) }}" 
                                     alt="{{ $profil_pegawai->nama }}"
                                     class="w-full h-full object-cover">
                            </div>
                        </div>
                        @endif

                        <div class="flex-1 w-full">
                            <div class="relative group">
                                <input 
                                    type="file" 
                                    id="foto" 
                                    name="foto" 
                                    accept="image/*"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl bg-white focus:outline-none focus:ring-2 focus:ring-teal-500 transition-all cursor-pointer"
                                    onchange="previewImageWithCropper(event, 'fotoPreview', 'crop-foto')">
                                <p class="text-xs text-gray-500 mt-2 italic">Format: JPG, PNG. Maks 2MB. Biarkan kosong jika tidak ingin ganti.</p>
                            </div>

                            <div id="fotoPreview" class="mt-4 hidden animate-in zoom-in duration-300"></div>

                            <button 
                                type="button" 
                                id="crop-foto" 
                                class="mt-3 w-full md:w-auto px-4 py-2 bg-teal-600 text-white rounded-lg text-sm font-semibold hover:bg-teal-700 transition-colors shadow-sm hidden"
                                onclick="window.imageCropper.openCropper('foto')">
                                <i class="fas fa-crop-alt mr-2"></i>Edit & Crop Foto
                            </button>
                        </div>
                    </div>

                    @error('foto')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center justify-between pt-6 border-t border-gray-100">
                    <x-button variant="secondary" size="lg" type="link" href="{{ route('admin.profil_pegawai.index') }}">Batal</x-button>
                    <x-button variant="primary" size="lg" type="submit" icon="check">Update Profil</x-button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Include Image Cropper -->
@include('components.image-cropper')

<script>
function previewImageWithCropper(event, previewId, cropBtnId) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById(previewId).innerHTML = '<img src="' + e.target.result + '" class="max-w-xs rounded-lg border border-gray-300">';
            document.getElementById(previewId).style.display = 'block';
            document.getElementById(cropBtnId).style.display = 'block';
        };
        reader.readAsDataURL(file);
    }
}
</script>

<script>
// Initialize cropper when page loads
document.addEventListener('DOMContentLoaded', function() {
    if (typeof window.ImageCropper === 'function') {
        window.imageCropper = new window.ImageCropper();
    }
});
</script>
@endsection
