@extends('layouts.app')

@section('content')
{{-- Include Image Cropper Component --}}
@include('components.image-cropper')
{{-- Hidden elements to pass messages to JavaScript --}}
@if(session('success'))
<div style="display:none" data-success-message="{{ session('success') }}"></div>
@endif
@if(session('error'))
<div style="display:none" data-error-message="{{ session('error') }}"></div>
@endif
@if($errors->any())
<div style="display:none" data-validation-errors="{{ json_encode($errors->all()) }}"></div>
@endif

<style>
    /* Toast Notification Styles */
    .toast-container {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 9999;
    }

    .toast {
        background: white;
        padding: 16px 20px;
        border-radius: 8px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        margin-bottom: 12px;
        min-width: 300px;
        display: flex;
        align-items: center;
        gap: 12px;
        animation: slideIn 0.3s ease-out;
    }

    @keyframes slideIn {
        from {
            transform: translateX(400px);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    @keyframes slideOut {
        from {
            transform: translateX(0);
            opacity: 1;
        }
        to {
            transform: translateX(400px);
            opacity: 0;
        }
    }

    .toast.fade-out {
        animation: slideOut 0.3s ease-out;
    }

    .toast.success {
        border-left: 4px solid #10b981;
        background: #f0fdf4;
    }

    .toast.success .toast-icon {
        color: #10b981;
        font-size: 20px;
    }

    .toast.error {
        border-left: 4px solid #ef4444;
        background: #fef2f2;
    }

    .toast.error .toast-icon {
        color: #ef4444;
        font-size: 20px;
    }

    .toast.info {
        border-left: 4px solid #3b82f6;
        background: #eff6ff;
    }

    .toast.info .toast-icon {
        color: #3b82f6;
        font-size: 20px;
    }

    .toast-content {
        flex: 1;
    }

    .toast-message {
        font-size: 14px;
        font-weight: 500;
        color: #1f2937;
    }

    .toast-close {
        background: none;
        border: none;
        color: #9ca3af;
        cursor: pointer;
        font-size: 18px;
        padding: 0;
    }

    .toast-close:hover {
        color: #1f2937;
    }
</style>

<div class="py-24 bg-white pt-28">
  <div class="max-w-6xl mx-auto px-6">
    <div class="admin-section">
        <div class="flex items-center justify-between mb-6">
            <h1 class="h2">Staff Of Month</h1>
            <div class="flex gap-3">
                <button id="manage-jabatan-btn" class="admin-button bg-green-600 hover:bg-green-700">
                    <i class="fas fa-briefcase mr-2"></i> Kelola Posisi
                </button>
                <a href="#" class="admin-button" id="create-staff-btn">
                    <i class="fas fa-plus mr-2"></i> Create
                </a>
            </div>
        </div>

        <!-- Daftar Staff -->
        <div class="space-y-8 w-full">
            <h2 class="h3 text-teal-700">Data Staff</h2>

            <div class="text-gray-600">Jumlah staff: <span class="font-semibold text-gray-900">{{ $items->count() }}</span></div>

            @if($items->isEmpty())
                <div class="bg-gray-50 p-8 rounded-lg text-center text-gray-600">
                    Belum ada data staff saat ini
                </div>
            @else
                @foreach($items as $item)
                <div class="border-l-4 border-teal-500 pl-6 bg-gray-50 p-8 rounded space-y-6">
                    <div>
                        <h3 class="h1 mb-4">{{ $item->name }}</h3>
                        
                        <!-- Informasi Staff -->
                        <div class="grid grid-cols-2 gap-8 mb-6 text-sm">
                            <div>
                                <p class="text-gray-500 font-semibold mb-1">Posisi</p>
                                <p class="text-gray-800 text-lg">
                                    {{ $item->position }}
                                </p>
                            </div>
                            <div>
                                <p class="text-gray-500 font-semibold mb-1">Bulan/Tahun</p>
                                <p class="text-gray-800 text-lg">
                                    @if($item->month && $item->year)
                                        {{ $item->month }}/{{ $item->year }}
                                    @else
                                        —
                                    @endif
                                </p>
                            </div>
                        </div>

                        <!-- Status Aktif -->
                        <div class="mb-6">
                            <p class="text-gray-500 font-semibold mb-1">Status</p>
                            <p class="text-gray-800">
                                @if($item->is_active)
                                    <span class="inline-block px-3 py-1 bg-green-100 text-green-800 rounded text-sm font-semibold">Aktif</span>
                                @else
                                    <span class="inline-block px-3 py-1 bg-gray-100 text-gray-800 rounded text-sm font-semibold">Tidak Aktif</span>
                                @endif
                            </p>
                        </div>

                        <!-- Biodata -->
                        @if($item->bio)
                        <div class="mt-6">
                            <p class="text-gray-500 font-semibold text-sm mb-3">Biodata</p>
                            <div class="text-gray-700 prose prose-lg max-w-none bg-white p-6 rounded border border-gray-200 leading-relaxed">
                                {!! nl2br(e($item->bio)) !!}
                            </div>
                        </div>
                        @endif

                        <!-- Photo -->
                        @if($item->photo_path)
                        <div class="mt-6">
                            <p class="text-gray-500 font-semibold text-sm mb-3">Foto</p>
                            <div class="bg-white p-4 rounded border border-gray-200">
                                <img src="{{ asset('storage/' . $item->photo_path) }}" alt="{{ $item->name }}" class="max-w-sm rounded" style="max-height: 300px; object-fit: cover;">
                            </div>
                        </div>
                        @endif

                        <!-- Photo Link -->
                        @if($item->photo_link)
                        <div class="mt-6">
                            <p class="text-gray-500 font-semibold text-sm mb-3">Link Foto</p>
                            <div class="bg-white p-4 rounded border border-gray-200">
                                <a href="{{ $item->photo_link }}" target="_blank" class="text-teal-600 hover:underline break-all">
                                    {{ $item->photo_link }}
                                </a>
                            </div>
                        </div>
                        @endif
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="flex justify-end gap-3 pt-6 border-t border-gray-300">
                        <button onclick="editStaff({{ $item->id }})" class="px-5 py-2 bg-amber-50 text-amber-600 hover:bg-amber-100 rounded font-semibold transition-colors flex items-center gap-2">
                            <i class="fas fa-edit"></i> Edit
                        </button>
                        <button onclick="deleteStaff({{ $item->id }}, '{{ $item->name }}')" class="px-5 py-2 bg-red-50 text-red-600 hover:bg-red-100 rounded font-semibold transition-colors flex items-center gap-2">
                            <i class="fas fa-trash"></i> Hapus
                        </button>
                    </div>
                </div>
                @endforeach
            @endif
        </div>

        <!-- Modal untuk form create -->
        <div id="create-staff-modal" class="fixed inset-0 backdrop-blur-sm bg-white/30 hidden z-50">
            <div class="flex items-center justify-center min-h-screen p-4">
                <div class="bg-white rounded-lg max-w-lg w-full max-h-[90vh] overflow-y-auto">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-xl font-bold text-gray-900">Tambah Staff Of Month</h3>
                            <button id="close-create-modal-btn" class="text-gray-400 hover:text-gray-600">
                                <i class="fas fa-times text-xl"></i>
                            </button>
                        </div>
                        <form id="create-form" method="POST" class="space-y-4" enctype="multipart/form-data">
                            @csrf

                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">Nama</label>
                                <input type="text" id="create-name" name="name" required class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500">
                            </div>

                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">Posisi</label>
                                <select id="create-position" name="position" required class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500">
                                    <option value="">-- Pilih Posisi --</option>
                                    @foreach($jabatans as $jabatan)
                                    <option value="{{ $jabatan->name }}">{{ $jabatan->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-gray-700 font-semibold mb-2">Bulan</label>
                                    <input type="number" id="create-month" name="month" min="1" max="12" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500">
                                </div>
                                <div>
                                    <label class="block text-gray-700 font-semibold mb-2">Tahun</label>
                                    <input type="number" id="create-year" name="year" min="2000" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500">
                                </div>
                            </div>

                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">Biodata</label>
                                <textarea id="create-bio" name="bio" rows="4" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500"></textarea>
                            </div>

                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">🖼️ Foto</label>
                                <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 hover:border-teal-400 transition-colors">
                                    <input type="file" id="create-photo" name="photo" accept="image/*" onchange="previewImageWithCropper(event, 'create-photo-preview', 'create-crop-btn')" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500 mb-3">
                                    
                                    <div id="create-photo-preview" class="mb-3" style="display: none;"></div>
                                    
                                    <div class="text-center mt-4" style="position: relative; z-index: 10;">
                                        <button type="button" id="create-crop-btn" onclick="openImageCropper(document.getElementById('create-photo'), document.getElementById('create-photo-preview'))" class="crop-button-standard" style="display: none;">
                                            ✂️ Edit & Crop Foto
                                    </button>
                                </div>
                                <p class="text-xs text-gray-500 mt-1">📄 JPG, PNG • 📏 Maks: 10MB • ✂️ Bisa di-crop</p>
                            </div>

                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">Link Foto (Optional)</label>
                                <input type="url" id="create-photo_link" name="photo_link" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500">
                            </div>

                            <div class="flex items-center">
                                <input type="checkbox" id="create-is_active" name="is_active" checked class="w-4 h-4 text-teal-600 rounded focus:ring-2 focus:ring-teal-500">
                                <label for="create-is_active" class="ml-2 text-gray-700 font-semibold">Aktif</label>
                            </div>

                            <div class="flex justify-end gap-3 pt-4">
                                <button type="button" onclick="document.getElementById('create-staff-modal').classList.add('hidden')" class="px-4 py-2 border border-gray-300 rounded text-gray-700 hover:bg-gray-50 font-semibold transition-colors">
                                    Batal
                                </button>
                                <button type="submit" class="px-4 py-2 bg-teal-600 text-white rounded hover:bg-teal-700 font-semibold transition-colors">
                                    Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal untuk form edit -->
        <div id="edit-staff-modal" class="fixed inset-0 backdrop-blur-sm bg-white/30 hidden z-50">
            <div class="flex items-center justify-center min-h-screen p-4">
                <div class="bg-white rounded-lg max-w-lg w-full max-h-[90vh] overflow-y-auto">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-xl font-bold text-gray-900">Edit Staff Of Month</h3>
                            <button id="close-edit-modal-btn" class="text-gray-400 hover:text-gray-600">
                                <i class="fas fa-times text-xl"></i>
                            </button>
                        </div>
                        <form id="edit-form" method="POST" class="space-y-4" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">Nama</label>
                                <input type="text" id="edit-name" name="name" required class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500">
                            </div>

                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">Posisi</label>
                                <select id="edit-position" name="position" required class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500">
                                    <option value="">-- Pilih Posisi --</option>
                                    @foreach($jabatans as $jabatan)
                                    <option value="{{ $jabatan->name }}">{{ $jabatan->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-gray-700 font-semibold mb-2">Bulan</label>
                                    <input type="number" id="edit-month" name="month" min="1" max="12" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500">
                                </div>
                                <div>
                                    <label class="block text-gray-700 font-semibold mb-2">Tahun</label>
                                    <input type="number" id="edit-year" name="year" min="2000" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500">
                                </div>
                            </div>

                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">Biodata</label>
                                <textarea id="edit-bio" name="bio" rows="4" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500"></textarea>
                            </div>

                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">🖼️ Foto</label>
                                
                                <!-- Foto Existing -->
                                <div id="edit-existing-photo-container" class="mb-4" style="display: none;">
                                    <p class="text-sm text-gray-600 mb-2">Foto Sekarang:</p>
                                    <div class="bg-white p-3 rounded border border-gray-200 mb-3">
                                        <img id="edit-existing-photo-img" src="" alt="Foto Staff" class="max-w-xs rounded" style="max-height: 200px; object-fit: cover;">
                                    </div>
                                    <button type="button" id="edit-delete-photo-btn" onclick="deleteExistingPhoto()" class="w-full px-4 py-2 bg-red-50 text-red-600 hover:bg-red-100 rounded font-semibold transition-colors mb-3">
                                        <i class="fas fa-trash mr-2"></i> Hapus Foto Ini
                                    </button>
                                </div>
                                
                                <!-- Upload Foto Baru -->
                                <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 hover:border-teal-400 transition-colors">
                                    <input type="file" id="edit-photo" name="photo" accept="image/*" onchange="previewImageWithCropper(event, 'edit-photo-preview', 'edit-crop-btn')" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500 mb-3">
                                    
                                    <div id="edit-photo-preview" class="mb-3" style="display: none;"></div>
                                    
                                    <div class="text-center mt-4" style="position: relative; z-index: 10;">
                                        <button type="button" id="edit-crop-btn" onclick="openImageCropper(document.getElementById('edit-photo'), document.getElementById('edit-photo-preview'))" class="crop-button-standard" style="display: none;">
                                            ✂️ Edit & Crop Foto
                                        </button>
                                    </div>
                                    <p class="text-xs text-gray-500 mt-1">📄 JPG, PNG • 📏 Maks: 10MB • ✂️ Bisa di-crop - Kosongkan jika tidak ingin mengubah</p>
                                </div>
                            
                            <!-- Hidden input untuk mark photo as deleted -->
                            <input type="hidden" id="edit-delete-photo-flag" name="delete_photo" value="0">

                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">Link Foto (Optional)</label>
                                <input type="url" id="edit-photo_link" name="photo_link" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500">
                            </div>

                            <div class="flex items-center">
                                <input type="checkbox" id="edit-is_active" name="is_active" class="w-4 h-4 text-teal-600 rounded focus:ring-2 focus:ring-teal-500">
                                <label for="edit-is_active" class="ml-2 text-gray-700 font-semibold">Aktif</label>
                            </div>

                            <div class="flex justify-end gap-3 pt-4">
                                <button type="button" onclick="document.getElementById('edit-staff-modal').classList.add('hidden')" class="px-4 py-2 border border-gray-300 rounded text-gray-700 hover:bg-gray-50 font-semibold transition-colors">
                                    Batal
                                </button>
                                <button type="submit" class="px-4 py-2 bg-teal-600 text-white rounded hover:bg-teal-700 font-semibold transition-colors">
                                    Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal untuk manage jabatan -->
        <div id="manage-jabatan-modal" class="fixed inset-0 backdrop-blur-sm bg-white/30 hidden z-50">
            <div class="flex items-center justify-center min-h-screen p-4">
                <div class="bg-white rounded-lg max-w-lg w-full max-h-[90vh] overflow-y-auto">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-xl font-bold text-gray-900">Kelola Posisi/Jabatan</h3>
                            <button id="close-jabatan-modal-btn" class="text-gray-400 hover:text-gray-600">
                                <i class="fas fa-times text-xl"></i>
                            </button>
                        </div>

                        <!-- Form Tambah Jabatan -->
                        <div class="mb-6 pb-6 border-b border-gray-200">
                            <h4 class="text-lg font-semibold mb-4 text-gray-800">Tambah Posisi Baru</h4>
                            <form id="add-jabatan-form" action="{{ route('admin.staff-of-month.store-jabatan') }}" method="POST" class="space-y-4">
                                @csrf
                                <div>
                                    <label class="block text-gray-700 font-semibold mb-2">Nama Posisi</label>
                                    <input type="text" name="name" required class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500" placeholder="Contoh: Pustakawan, Satpam, dll">
                                </div>
                                <button type="submit" class="w-full px-4 py-2 bg-teal-600 text-white rounded hover:bg-teal-700 font-semibold transition-colors">
                                    Tambah Posisi
                                </button>
                            </form>
                        </div>

                        <!-- Daftar Jabatan -->
                        <div>
                            <h4 class="text-lg font-semibold mb-4 text-gray-800">Posisi yang Tersedia</h4>
                            @if($jabatans->isEmpty())
                                <p class="text-gray-500 text-center py-4">Belum ada posisi</p>
                            @else
                                <div class="space-y-2">
                                    @foreach($jabatans as $jab)
                                    <div class="flex items-center justify-between bg-gray-50 p-4 rounded border border-gray-200">
                                        <span class="text-gray-800 font-medium">{{ $jab->name }}</span>
                                        <button onclick="deleteJabatan({{ $jab->id }}, '{{ $jab->name }}')" class="px-3 py-1 bg-red-50 text-red-600 hover:bg-red-100 rounded text-sm font-semibold transition-colors">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>

                        <div class="flex justify-end gap-3 pt-6 border-t border-gray-300 mt-6">
                            <button type="button" onclick="document.getElementById('manage-jabatan-modal').classList.add('hidden')" class="px-4 py-2 border border-gray-300 rounded text-gray-700 hover:bg-gray-50 font-semibold transition-colors">
                                Tutup
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal untuk konfirmasi hapus jabatan -->
        <div id="delete-jabatan-modal" class="fixed inset-0 backdrop-blur-sm bg-white/30 hidden z-50">
            <div class="flex items-center justify-center min-h-screen p-4">
                <div class="bg-white rounded-lg max-w-lg w-full">
                    <div class="p-8">
                        <div class="flex items-center justify-center w-16 h-16 mx-auto bg-red-100 rounded-full mb-6">
                            <i class="fas fa-exclamation-triangle text-red-600 text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 text-center mb-3">Hapus Posisi?</h3>
                        <p class="text-gray-700 text-center mb-2 text-lg font-semibold" id="delete-jabatan-name"></p>
                        <p class="text-sm text-gray-500 text-center mb-8">Posisi yang dihapus tidak bisa dikembalikan.</p>
                        
                        <form id="delete-jabatan-form" method="POST" class="space-y-0">
                            @csrf
                            @method('DELETE')
                            
                            <div class="flex gap-4">
                                <button type="button" onclick="document.getElementById('delete-jabatan-modal').classList.add('hidden')" class="flex-1 px-5 py-3 border-2 border-gray-300 rounded text-gray-700 hover:bg-gray-50 font-semibold transition-colors text-lg">
                                    Batal
                                </button>
                                <button type="submit" class="flex-1 px-5 py-3 bg-red-600 text-white rounded hover:bg-red-700 font-semibold transition-colors text-lg">
                                    Hapus
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal untuk konfirmasi hapus staff -->
        <div id="delete-staff-modal" class="fixed inset-0 backdrop-blur-sm bg-white/30 hidden z-50">
            <div class="flex items-center justify-center min-h-screen p-4">
                <div class="bg-white rounded-lg max-w-lg w-full">
                    <div class="p-8">
                        <div class="flex items-center justify-center w-16 h-16 mx-auto bg-red-100 rounded-full mb-6">
                            <i class="fas fa-exclamation-triangle text-red-600 text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 text-center mb-3">Hapus Staff?</h3>
                        <p class="text-gray-700 text-center mb-2 text-lg font-semibold" id="delete-name-confirm"></p>
                        <p class="text-sm text-gray-500 text-center mb-8">Tindakan ini tidak dapat dibatalkan.</p>
                        
                        <form id="delete-form" method="POST" class="space-y-0">
                            @csrf
                            @method('DELETE')
                            
                            <div class="flex gap-4">
                                <button type="button" onclick="document.getElementById('delete-staff-modal').classList.add('hidden')" class="flex-1 px-5 py-3 border-2 border-gray-300 rounded text-gray-700 hover:bg-gray-50 font-semibold transition-colors text-lg">
                                    Batal
                                </button>
                                <button type="submit" class="flex-1 px-5 py-3 bg-red-600 text-white rounded hover:bg-red-700 font-semibold transition-colors text-lg">
                                    Hapus
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <a href="{{ route('home') }}" class="inline-block mt-8 text-teal-600 hover:underline">
            ← Kembali
        </a>
    </div>
  </div>
</div>

<!-- Toast Container -->
<div class="toast-container" id="toast-container"></div>

<script>
// Toast Notification Function
function showToast(message, type = 'success', duration = 3000) {
    const container = document.getElementById('toast-container');
    
    const toast = document.createElement('div');
    toast.className = `toast ${type}`;
    
    const iconMap = {
        success: 'fa-circle-check',
        error: 'fa-circle-xmark',
        info: 'fa-circle-info'
    };
    
    toast.innerHTML = `
        <i class="fas ${iconMap[type]} toast-icon"></i>
        <div class="toast-content">
            <p class="toast-message">${message}</p>
        </div>
        <button class="toast-close" onclick="this.parentElement.remove()">&times;</button>
    `;
    
    container.appendChild(toast);
    
    // Auto remove after duration
    setTimeout(() => {
        toast.classList.add('fade-out');
        setTimeout(() => {
            if (toast.parentElement) {
                toast.remove();
            }
        }, 300);
    }, duration);
}
document.addEventListener('DOMContentLoaded', function() {
    const createModal = document.getElementById('create-staff-modal');
    const editModal = document.getElementById('edit-staff-modal');
    const deleteModal = document.getElementById('delete-staff-modal');
    const manageJabatanModal = document.getElementById('manage-jabatan-modal');
    const deleteJabatanModal = document.getElementById('delete-jabatan-modal');
    const openBtn = document.getElementById('create-staff-btn');
    const closeCreateBtn = document.getElementById('close-create-modal-btn');
    const closeEditBtn = document.getElementById('close-edit-modal-btn');
    const manageJabatanBtn = document.getElementById('manage-jabatan-btn');
    const closeJabatanBtn = document.getElementById('close-jabatan-modal-btn');

    openBtn.addEventListener('click', function(e) {
        e.preventDefault();
        document.getElementById('create-form').action = "{{ route('admin.staff-of-month.store') }}";
        document.getElementById('create-form').reset();
        createModal.classList.remove('hidden');
    });

    manageJabatanBtn.addEventListener('click', function(e) {
        e.preventDefault();
        manageJabatanModal.classList.remove('hidden');
    });

    closeCreateBtn.addEventListener('click', function() {
        createModal.classList.add('hidden');
    });

    closeEditBtn.addEventListener('click', function() {
        editModal.classList.add('hidden');
    });

    closeJabatanBtn.addEventListener('click', function() {
        manageJabatanModal.classList.add('hidden');
    });

    createModal.addEventListener('click', function(e) {
        if (e.target === createModal) {
            createModal.classList.add('hidden');
        }
    });

    editModal.addEventListener('click', function(e) {
        if (e.target === editModal) {
            editModal.classList.add('hidden');
        }
    });

    deleteModal.addEventListener('click', function(e) {
        if (e.target === deleteModal) {
            deleteModal.classList.add('hidden');
        }
    });

    manageJabatanModal.addEventListener('click', function(e) {
        if (e.target === manageJabatanModal) {
            manageJabatanModal.classList.add('hidden');
        }
    });

    deleteJabatanModal.addEventListener('click', function(e) {
        if (e.target === deleteJabatanModal) {
            deleteJabatanModal.classList.add('hidden');
        }
    });
});

function editStaff(id) {
    const editModal = document.getElementById('edit-staff-modal');
    const editForm = document.getElementById('edit-form');
    
    fetch('/admin/staff-of-month/' + id + '/edit', {
        headers: {
            'Accept': 'application/json',
        }
    })
    .then(response => response.json())
    .then(data => {
        document.getElementById('edit-name').value = data.name || '';
        document.getElementById('edit-position').value = data.position || '';
        document.getElementById('edit-month').value = data.month || '';
        document.getElementById('edit-year').value = data.year || '';
        document.getElementById('edit-bio').value = data.bio || '';
        document.getElementById('edit-photo_link').value = data.photo_link || '';
        document.getElementById('edit-is_active').checked = data.is_active === 1;
        
        // Reset delete photo flag
        document.getElementById('edit-delete-photo-flag').value = '0';
        document.getElementById('edit-photo').value = '';
        document.getElementById('edit-photo-preview').style.display = 'none';
        document.getElementById('edit-crop-btn').style.display = 'none';
        
        // Show existing photo if available
        const existingPhotoContainer = document.getElementById('edit-existing-photo-container');
        const existingPhotoImg = document.getElementById('edit-existing-photo-img');
        
        if (data.photo_path) {
            existingPhotoImg.src = '/storage/' + data.photo_path;
            existingPhotoContainer.style.display = 'block';
        } else {
            existingPhotoContainer.style.display = 'none';
        }
        
        editForm.action = `/admin/staff-of-month/${id}`;
        
        editModal.classList.remove('hidden');
    })
    .catch(error => console.error('Error:', error));
}

function deleteExistingPhoto() {
    const confirmed = confirm('Yakin ingin menghapus foto ini?');
    if (confirmed) {
        document.getElementById('edit-delete-photo-flag').value = '1';
        document.getElementById('edit-existing-photo-container').style.display = 'none';
        showToast('Foto akan dihapus saat disimpan', 'info', 2000);
    }
}

function deleteStaff(id, name) {
    const deleteModal = document.getElementById('delete-staff-modal');
    const deleteForm = document.getElementById('delete-form');
    
    document.getElementById('delete-name-confirm').textContent = `Yakin ingin menghapus "${name}"?`;
    deleteForm.action = `/admin/staff-of-month/${id}`;
    
    deleteModal.classList.remove('hidden');
}

function deleteJabatan(id, name) {
    const deleteJabatanModal = document.getElementById('delete-jabatan-modal');
    const deleteJabatanForm = document.getElementById('delete-jabatan-form');
    
    document.getElementById('delete-jabatan-name').textContent = `Yakin ingin menghapus posisi "${name}"?`;
    deleteJabatanForm.action = `/admin/staff-of-month/jabatan/${id}`;
    
    deleteJabatanModal.classList.remove('hidden');
}

// Form Submission Handlers with Toast Notifications
document.addEventListener('DOMContentLoaded', function() {
    // Create Staff Form
    const createForm = document.getElementById('create-form');
    if (createForm) {
        createForm.addEventListener('submit', function(e) {
            const submitBtn = this.querySelector('button[type="submit"]');
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Menyimpan...';
        });
    }

    // Edit Staff Form
    const editForm = document.getElementById('edit-form');
    if (editForm) {
        editForm.addEventListener('submit', function(e) {
            const submitBtn = this.querySelector('button[type="submit"]');
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Menyimpan...';
        });
    }

    // Delete Staff Form
    const deleteForm = document.getElementById('delete-form');
    if (deleteForm) {
        deleteForm.addEventListener('submit', function(e) {
            const submitBtn = this.querySelector('button[type="submit"]');
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Menghapus...';
        });
    }

    // Delete Jabatan Form
    const deleteJabatanForm = document.getElementById('delete-jabatan-form');
    if (deleteJabatanForm) {
        deleteJabatanForm.addEventListener('submit', function(e) {
            const submitBtn = this.querySelector('button[type="submit"]');
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Menghapus...';
        });
    }
});

// Check for success message from server redirect
window.addEventListener('load', function() {
    const urlParams = new URLSearchParams(window.location.search);
    
    // Get success message from session if exists
    const successElement = document.querySelector('[data-success-message]');
    if (successElement) {
        const message = successElement.getAttribute('data-success-message');
        if (message) {
            setTimeout(() => {
                showToast(message, 'success', 4000);
            }, 300);
        }
    }

    // Get error message from session if exists
    const errorElement = document.querySelector('[data-error-message]');
    if (errorElement) {
        const message = errorElement.getAttribute('data-error-message');
        if (message) {
            setTimeout(() => {
                showToast(message, 'error', 4000);
            }, 300);
        }
    }

    // Get validation errors if exists
    const validationElement = document.querySelector('[data-validation-errors]');
    if (validationElement) {
        try {
            const errors = JSON.parse(validationElement.getAttribute('data-validation-errors'));
            if (errors && errors.length > 0) {
                setTimeout(() => {
                    errors.forEach((error, index) => {
                        setTimeout(() => {
                            showToast(error, 'error', 4000);
                        }, index * 500);
                    });
                }, 300);
            }
        } catch (e) {
            console.error('Error parsing validation errors:', e);
        }
    }
});
</script>

{{-- Include Image Cropper JS --}}
<script src="{{ asset('js/image-cropper.js') }}"></script>
@endsection
