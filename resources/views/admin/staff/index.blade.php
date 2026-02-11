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

<div class="py-24 bg-white pt-28 font-cairo">
  <div class="max-w-6xl mx-auto px-6">
    <div class="admin-section">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-10">
            <div>
                <h1 class="text-3xl font-black text-gray-900 tracking-tight">Staff Of Month</h1>
                <p class="text-gray-500 text-sm mt-1">Kelola data penghargaan staff terbaik setiap bulan.</p>
            </div>
            <div class="flex items-center gap-3">
                <x-button variant="secondary" size="md" id="manage-jabatan-btn" icon="briefcase" class="rounded-2xl font-bold shadow-sm">Posisi</x-button>
                <x-button variant="primary" size="md" onclick="document.getElementById('create-staff-modal').classList.remove('hidden')" icon="plus" class="rounded-2xl font-bold shadow-teal-100 shadow-lg">Tambah Staff</x-button>
            </div>
        </div>

        <!-- Daftar Staff -->
        <div class="bg-white rounded-3xl shadow-xl shadow-gray-200/50 border border-gray-100 overflow-hidden mb-8 text-sm">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-50/80 border-b border-gray-100 font-bold text-gray-400">
                        <tr>
                            <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest">Profil</th>
                            <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest">Nama</th>
                            <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest font-cairo">Jabatan</th>
                            <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest whitespace-nowrap">Periode</th>
                            <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest text-center">Status</th>
                            <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($items as $item)
                        <tr class="hover:bg-teal-50/30 transition-all duration-300">
                            <td class="px-8 py-4">
                                <div class="w-12 h-12 rounded-2xl overflow-hidden bg-gray-100 ring-4 ring-white shadow-sm transition-transform hover:scale-110">
                                    @if($item->photo_path)
                                        <img src="{{ asset('storage/' . $item->photo_path) }}" alt="{{ $item->name }}" class="w-full h-full object-cover">
                                    @elseif($item->photo_link)
                                        <img src="{{ $item->photo_link }}" alt="{{ $item->name }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center bg-teal-100 text-teal-600 text-xs font-black uppercase">
                                            {{ strtoupper(substr($item->name, 0, 1)) }}
                                        </div>
                                    @endif
                                </div>
                            </td>
                            <td class="px-8 py-4 font-bold text-gray-900 leading-tight">
                                {{ $item->name }}
                            </td>
                            <td class="px-8 py-4 font-bold text-teal-600 italic">
                                {{ $item->position }}
                            </td>
                            <td class="px-8 py-4 text-gray-600 font-medium">
                                <span class="bg-gray-100 px-3 py-1 rounded-full text-[10px] font-black uppercase">
                                    {{ $item->month ? $item->month . '/' : '-' }}{{ $item->year ?? '-' }}
                                </span>
                            </td>
                            <td class="px-8 py-4 text-center">
                                @if($item->is_active)
                                    <span class="inline-flex items-center px-4 py-1 rounded-full text-[10px] font-black tracking-widest bg-green-100 text-green-700 border border-green-200 uppercase">AKTIF</span>
                                @else
                                    <span class="inline-flex items-center px-4 py-1 rounded-full text-[10px] font-black tracking-widest bg-gray-100 text-gray-500 border border-gray-200 uppercase">OFF</span>
                                @endif
                            </td>
                            <td class="px-8 py-4 whitespace-nowrap">
                                <div class="flex items-center justify-end gap-2">
                                    <x-button variant="ghost" size="sm" icon="edit" class="rounded-xl hover:bg-orange-50 hover:text-orange-600 font-bold" onclick="editStaff({{ $item->id }})">Edit</x-button>
                                    <x-button variant="ghost-danger" size="sm" icon="trash" class="rounded-xl font-bold" onclick="openDeleteModal('deleteStaffModal', '{{ $item->name }}', '/admin/staff-of-month/{{ $item->id }}')">Hapus</x-button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-8 py-20 text-center">
                                <div class="flex flex-col items-center">
                                    <i class="fas fa-user-tie text-gray-100 text-6xl mb-4"></i>
                                    <p class="text-gray-400 italic font-medium">Belum ada data staff of month.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            @if($items->hasPages())
                <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">
                    {{ $items->links() }}
                </div>
            @endif
        </div>


        <!-- Modal Create -->
        <div id="create-staff-modal" class="fixed inset-0 backdrop-blur-sm bg-black/40 hidden z-50 flex items-center justify-center p-4">
            <div class="bg-white rounded-3xl shadow-2xl w-full max-w-lg overflow-hidden animate-in fade-in zoom-in duration-300">
                <div class="p-8 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-teal-100 rounded-2xl flex items-center justify-center">
                            <i class="fas fa-plus text-teal-600"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900">Tambah Staff</h3>
                            <p class="text-xs text-gray-500">Input data penghargaan baru</p>
                        </div>
                    </div>
                    <button onclick="document.getElementById('create-staff-modal').classList.add('hidden')" class="text-gray-400 hover:text-gray-600 transition-colors">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
                
                <div class="p-8 max-h-[75vh] overflow-y-auto font-cairo">
                    <form id="create-form" method="POST" action="{{ route('admin.staff-of-month.store') }}" class="space-y-6" enctype="multipart/form-data">
                        @csrf
                        <div class="space-y-5">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Nama Lengkap <span class="text-red-500">*</span></label>
                                <input type="text" id="create-name" name="name" required class="w-full border-2 border-gray-100 rounded-2xl px-4 py-3 focus:outline-none focus:border-teal-500 transition-all font-medium" placeholder="Nama Lengkap Staff">
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Posisi / Jabatan <span class="text-red-500">*</span></label>
                                <select id="create-position" name="position" required class="w-full border-2 border-gray-100 rounded-2xl px-4 py-3 focus:outline-none focus:border-teal-500 transition-all font-medium appearance-none bg-no-repeat bg-[right_1rem_center] bg-[length:1em_1em]" style="background-image: url('data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A//www.w3.org/2000/svg%22%20width%3D%22292.4%22%20height%3D%22292.4%22%3E%3Cpath%20fill%3D%22%23666%22%20d%3D%22M287%2069.4a17.6%2017.6%200%200%200-13-5.4H18.4c-5%200-9.3%201.8-12.9%205.4A17.6%2017.6%200%200%200%200%2082.2c0%205%201.8%209.3%205.4%2012.9l128%20127.9c3.6%203.6%207.8%205.4%2012.8%205.4s9.2-1.8%2012.8-5.4L287%2095c3.5-3.5%205.4-7.8%205.4-12.8%200-5-1.9-9.2-5.5-12.8z%22/%3E%3C/svg%3E');">
                                    <option value="">-- Pilih Posisi --</option>
                                    @foreach($jabatans as $jabatan)
                                    <option value="{{ $jabatan->name }}">{{ $jabatan->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-2">Bulan</label>
                                    <input type="number" id="create-month" name="month" min="1" max="12" class="w-full border-2 border-gray-100 rounded-2xl px-4 py-3 focus:outline-none focus:border-teal-500 transition-all font-medium" placeholder="1-12">
                                </div>
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-2">Tahun</label>
                                    <input type="number" id="create-year" name="year" min="2026" class="w-full border-2 border-gray-100 rounded-2xl px-4 py-3 focus:outline-none focus:border-teal-500 transition-all font-medium" placeholder="2026">
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Biodata / Kutipan</label>
                                <textarea id="create-bio" name="bio" rows="3" class="w-full border-2 border-gray-100 rounded-2xl px-4 py-3 focus:outline-none focus:border-teal-500 transition-all font-medium" placeholder="Kata-kata mutiara atau biodata singkat..."></textarea>
                            </div>

                            <div class="bg-gray-50/80 p-6 rounded-3xl border-2 border-dashed border-gray-100 transition-all hover:border-teal-400 group">
                                <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-3 group-hover:text-teal-600 transition-colors">🖼️ Foto Staff</label>
                                <input type="file" id="create-photo" name="photo" accept="image/*" onchange="previewImageWithCropper(event, 'create-photo-preview', 'create-crop-btn')" class="w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-black file:bg-teal-100 file:text-teal-700 hover:file:bg-teal-200 cursor-pointer mb-4">
                                
                                <div id="create-photo-preview" class="mb-4 rounded-2xl overflow-hidden shadow-md" style="display: none;"></div>
                                
                                <div class="flex justify-center">
                                    <x-button variant="secondary" size="sm" type="button" id="create-crop-btn" onclick="openImageCropper(document.getElementById('create-photo'), document.getElementById('create-photo-preview'))" class="hidden rounded-xl font-bold bg-white border-2 border-teal-100 text-teal-600 hover:bg-teal-50">
                                        ✂️ Crop / Edit Foto
                                    </x-button>
                                </div>
                            </div>

                            <div class="flex items-center gap-3 bg-gray-50 p-4 rounded-2xl">
                                <input type="checkbox" id="create-is_active" name="is_active" value="1" checked class="w-5 h-5 text-teal-600 rounded-lg focus:ring-teal-500 cursor-pointer border-gray-300">
                                <label for="create-is_active" class="text-sm font-bold text-gray-700 cursor-pointer select-none tracking-tight">Aktifkan Profile di Halaman Utama</label>
                            </div>
                        </div>

                        <div class="flex justify-end gap-3 pt-6 border-t border-gray-100">
                            <x-button variant="secondary" size="md" type="button" onclick="document.getElementById('create-staff-modal').classList.add('hidden')" class="rounded-xl font-bold">Batal</x-button>
                            <x-button variant="primary" size="md" icon="check" type="submit" class="rounded-xl font-bold shadow-lg shadow-teal-100">Simpan Staff</x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Edit -->
        <div id="edit-staff-modal" class="fixed inset-0 backdrop-blur-sm bg-black/40 hidden z-50 flex items-center justify-center p-4">
            <div class="bg-white rounded-3xl shadow-2xl w-full max-w-lg overflow-hidden animate-in fade-in zoom-in duration-300">
                <div class="p-8 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-orange-100 rounded-2xl flex items-center justify-center">
                            <i class="fas fa-edit text-orange-600"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900">Perbarui Staff</h3>
                            <p class="text-xs text-gray-500">Edit data penghargaan staff</p>
                        </div>
                    </div>
                    <button onclick="document.getElementById('edit-staff-modal').classList.add('hidden')" class="text-gray-400 hover:text-gray-600 transition-colors">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
                
                <div class="p-8 max-h-[75vh] overflow-y-auto font-cairo">
                    <form id="edit-form" method="POST" class="space-y-6" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="space-y-5">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Nama Lengkap <span class="text-red-500">*</span></label>
                                <input type="text" id="edit-name" name="name" required class="w-full border-2 border-gray-100 rounded-2xl px-4 py-3 focus:outline-none focus:border-orange-500 transition-all font-medium">
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Posisi / Jabatan <span class="text-red-500">*</span></label>
                                <select id="edit-position" name="position" required class="w-full border-2 border-gray-100 rounded-2xl px-4 py-3 focus:outline-none focus:border-orange-500 transition-all font-medium appearance-none bg-no-repeat bg-[right_1rem_center] bg-[length:1em_1em]" style="background-image: url('data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A//www.w3.org/2000/svg%22%20width%3D%22292.4%22%20height%3D%22292.4%22%3E%3Cpath%20fill%3D%22%23666%22%20d%3D%22M287%2069.4a17.6%2017.6%200%200%200-13-5.4H18.4c-5%200-9.3%201.8-12.9%205.4A17.6%2017.6%200%200%200%200%2082.2c0%205%201.8%209.3%205.4%2012.9l128%20127.9c3.6%203.6%207.8%205.4%2012.8%205.4s9.2-1.8%2012.8-5.4L287%2095c3.5-3.5%205.4-7.8%205.4-12.8%200-5-1.9-9.2-5.5-12.8z%22/%3E%3C/svg%3E');">
                                    <option value="">-- Pilih Posisi --</option>
                                    @foreach($jabatans as $jabatan)
                                    <option value="{{ $jabatan->name }}">{{ $jabatan->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-2">Bulan</label>
                                    <input type="number" id="edit-month" name="month" min="1" max="12" class="w-full border-2 border-gray-100 rounded-2xl px-4 py-3 focus:outline-none focus:border-orange-500 transition-all font-medium">
                                </div>
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-2">Tahun</label>
                                    <input type="number" id="edit-year" name="year" min="2026" class="w-full border-2 border-gray-100 rounded-2xl px-4 py-3 focus:outline-none focus:border-orange-500 transition-all font-medium">
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Biodata / Kutipan</label>
                                <textarea id="edit-bio" name="bio" rows="3" class="w-full border-2 border-gray-100 rounded-2xl px-4 py-3 focus:outline-none focus:border-orange-500 transition-all font-medium"></textarea>
                            </div>

                            <div class="bg-gray-50/80 p-6 rounded-3xl border-2 border-dashed border-gray-100 transition-all hover:border-orange-400 group">
                                <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-3 group-hover:text-orange-600 transition-colors">🖼️ Foto Staff</label>
                                
                                <!-- Foto Existing -->
                                <div id="edit-existing-photo-container" class="mb-6 flex flex-col items-center" style="display: none;">
                                    <div class="relative group/photo rounded-2xl overflow-hidden shadow-lg border-4 ring-4 ring-white border-white mb-4">
                                        <img id="edit-existing-photo-img" src="" alt="Foto Staff" class="w-32 h-40 object-cover">
                                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover/photo:opacity-100 transition-opacity flex items-center justify-center">
                                            <button type="button" onclick="deleteExistingPhoto()" class="bg-red-500 text-white w-10 h-10 rounded-full flex items-center justify-center hover:bg-red-600 transition-all shadow-lg hover:scale-110" title="Hapus foto sekarang">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-tighter italic">Foto Tersimpan</p>
                                </div>
                                
                                <input type="file" id="edit-photo" name="photo" accept="image/*" onchange="previewImageWithCropper(event, 'edit-photo-preview', 'edit-crop-btn')" class="w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-black file:bg-orange-100 file:text-orange-700 hover:file:bg-orange-200 cursor-pointer mb-4">
                                
                                <div id="edit-photo-preview" class="mb-4 rounded-2xl overflow-hidden shadow-md flex justify-center" style="display: none;"></div>
                                
                                <div class="flex justify-center">
                                    <x-button variant="secondary" size="sm" type="button" id="edit-crop-btn" onclick="openImageCropper(document.getElementById('edit-photo'), document.getElementById('edit-photo-preview'))" class="hidden rounded-xl font-bold bg-white border-2 border-orange-100 text-orange-600 hover:bg-orange-50">
                                        ✂️ Crop / Edit Foto
                                    </x-button>
                                </div>
                            </div>
                            
                            <!-- Hidden input untuk mark photo as deleted -->
                            <input type="hidden" id="edit-delete-photo-flag" name="delete_photo" value="0">

                            <div class="flex items-center gap-3 bg-gray-50 p-4 rounded-2xl">
                                <input type="checkbox" id="edit-is_active" name="is_active" value="1" class="w-5 h-5 text-orange-600 rounded-lg focus:ring-orange-500 cursor-pointer border-gray-300">
                                <label for="edit-is_active" class="text-sm font-bold text-gray-700 cursor-pointer select-none tracking-tight">Aktifkan Profile di Halaman Utama</label>
                            </div>
                        </div>

                        <div class="flex justify-end gap-3 pt-6 border-t border-gray-100">
                            <x-button variant="secondary" size="md" type="button" onclick="document.getElementById('edit-staff-modal').classList.add('hidden')" class="rounded-xl font-bold">Batal</x-button>
                            <x-button variant="primary" size="md" icon="check" type="submit" class="rounded-xl font-bold shadow-lg shadow-orange-100 bg-orange-600 hover:bg-orange-700">Simpan Perubahan</x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Manage Jabatan -->
        <div id="manage-jabatan-modal" class="fixed inset-0 backdrop-blur-sm bg-black/40 hidden z-50 flex items-center justify-center p-4">
            <div class="bg-white rounded-3xl shadow-2xl w-full max-w-lg overflow-hidden animate-in fade-in zoom-in duration-300">
                <div class="p-8 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-indigo-100 rounded-2xl flex items-center justify-center">
                            <i class="fas fa-briefcase text-indigo-600"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900">Kelola Posisi</h3>
                            <p class="text-xs text-gray-500">Atur daftar jabatan staff</p>
                        </div>
                    </div>
                    <button onclick="document.getElementById('manage-jabatan-modal').classList.add('hidden')" class="text-gray-400 hover:text-gray-600 transition-colors">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>

                <div class="p-8 max-h-[75vh] overflow-y-auto font-cairo">
                    <!-- Form Tambah Jabatan -->
                    <div class="mb-8 p-6 bg-indigo-50/50 rounded-3xl border border-indigo-100">
                        <h4 class="text-xs font-black uppercase tracking-widest text-indigo-600 mb-4 flex items-center gap-2">
                            <i class="fas fa-plus-circle"></i> Tambah Posisi Baru
                        </h4>
                        <form id="add-jabatan-form" action="{{ route('admin.staff-of-month.store-jabatan') }}" method="POST" class="flex gap-2">
                            @csrf
                            <input type="text" name="name" required class="flex-1 border-2 border-white rounded-2xl px-4 py-3 focus:outline-none focus:border-indigo-500 transition-all font-medium placeholder:text-gray-300 shadow-sm" placeholder="Contoh: Pustakawan">
                            <x-button variant="primary" size="md" type="submit" class="rounded-2xl font-bold bg-indigo-600 hover:bg-indigo-700 shadow-lg shadow-indigo-100">Tambah</x-button>
                        </form>
                    </div>

                    <!-- Daftar Jabatan -->
                    <div>
                        <h4 class="text-xs font-black uppercase tracking-widest text-gray-400 mb-4 px-2 font-bold italic">Posisi Terdaftar</h4>
                        @if($jabatans->isEmpty())
                            <div class="text-center py-10 bg-gray-50 rounded-3xl border-2 border-dashed border-gray-100">
                                <i class="fas fa-folder-open text-gray-200 text-3xl mb-2"></i>
                                <p class="text-gray-400 text-xs italic">Belum ada posisi terdaftar</p>
                            </div>
                        @else
                            <div class="grid grid-cols-1 gap-3">
                                @foreach($jabatans as $jab)
                                <div class="group flex items-center justify-between bg-white p-4 rounded-2xl border border-gray-100 hover:border-indigo-200 hover:shadow-md transition-all duration-300">
                                    <span class="text-gray-700 font-bold px-2">{{ $jab->name }}</span>
                                    <x-button variant="ghost-danger" size="sm" icon="trash" onclick="openDeleteModal('deleteJabatanModal', '{{ $jab->name }}', '/admin/staff-of-month/jabatan/{{ $jab->id }}')" class="opacity-0 group-hover:opacity-100 transition-opacity rounded-xl font-bold">Hapus</x-button>
                                </div>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <div class="flex justify-end pt-8">
                        <x-button variant="secondary" size="md" type="button" onclick="document.getElementById('manage-jabatan-modal').classList.add('hidden')" class="rounded-xl font-bold">Tutup</x-button>
                    </div>
                </div>
            </div>




        <a href="{{ route('home') }}" class="inline-block mt-8 text-teal-600 hover:underline">
            ← Kembali
        </a>
    </div>
  </div>
</div>

<!-- Delete Modal Components -->
@component('components.delete-modal', ['id' => 'deleteStaffModal', 'title' => 'Hapus Staff?']) @endcomponent
@component('components.delete-modal', ['id' => 'deleteJabatanModal', 'title' => 'Hapus Posisi?']) @endcomponent

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
<script>
    // Setup Click-Outside Handlers for Delete Modals
    setupDeleteModalClickOutside('deleteStaffModal');
    setupDeleteModalClickOutside('deleteJabatanModal');
</script>
@endsection
