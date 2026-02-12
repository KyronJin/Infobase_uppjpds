@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen py-12 pt-28">
    <div class="max-w-6xl mx-auto px-6">
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Tambah Profil Pegawai (Versi Sederhana)</h1>
            <p class="text-gray-600 mb-6">Form tanpa Quill editor untuk testing</p>

            @if($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-700 px-6 py-4 rounded-lg mb-6">
                    <h3 class="font-semibold mb-2">❌ Terjadi Kesalahan:</h3>
                    <ul class="list-disc list-inside space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(session('success'))
                <div class="bg-green-50 border border-green-200 text-green-700 px-6 py-4 rounded-lg mb-6">
                    <h3 class="font-semibold">✅ Berhasil!</h3>
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            <form action="{{ route('admin.profil_pegawai.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Nama Pegawai -->
                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Pegawai *</label>
                    <input 
                        type="text" 
                        name="nama" 
                        value="{{ old('nama') }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-teal-600 @error('nama') border-red-500 @enderror" 
                        placeholder="Contoh: Budi Santoso"
                        required>
                    @error('nama')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Jabatan -->
                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Jabatan *</label>
                    <select 
                        name="jabatan_id" 
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-teal-600 @error('jabatan_id') border-red-500 @enderror"
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

                <!-- Deskripsi (Simple Textarea) -->
                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi *</label>
                    <textarea 
                        name="deskripsi" 
                        rows="6"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-teal-600 @error('deskripsi') border-red-500 @enderror font-mono text-sm"
                        placeholder="Contoh: Seorang pustakawan profesional dengan pengalaman lebih dari 10 tahun di bidang pengelolaan perpustakaan."
                        required>{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Buttons -->
                <div class="flex gap-3 pt-6 border-t border-gray-200">
                    <a href="{{ route('admin.profil_pegawai.index') }}" class="flex-1 px-6 py-3 bg-gray-200 text-gray-800 font-medium rounded-lg hover:bg-gray-300 transition-colors text-center">
                        Batal
                    </a>
                    <button 
                        type="submit" 
                        class="flex-1 px-6 py-3 bg-teal-600 text-white font-medium rounded-lg hover:bg-teal-700 transition-colors">
                        Tambah Pegawai
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
