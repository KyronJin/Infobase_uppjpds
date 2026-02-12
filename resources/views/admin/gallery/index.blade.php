
@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen py-12 pt-28">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex flex-col md:flex-row items-center justify-between mb-8 bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
            <div>
                <h1 class="h2 text-gray-800">Kelola Galeri Foto</h1>
                <p class="text-sm text-gray-500">Manage foto-foto perpustakaan di sini.</p>
            </div>
            <div class="flex gap-3 mt-4 md:mt-0">
                <x-button variant="secondary" size="lg" type="link" href="{{ route('home') }}" icon="arrow-left">Home</x-button>
                <x-button variant="primary" size="lg" type="link" href="{{ route('admin.gallery.create') }}" icon="plus">Tambah Foto</x-button>
            </div>
        </div>

        @if(session('success'))
            <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-800 rounded-xl flex items-center gap-2">
                <i class="fas fa-check-circle"></i>{{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden text-sm">
            
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-50 border-b border-gray-100 font-bold">
                        <tr>
                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-600">Foto</th>
                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-600">Info Foto</th>
                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-600">Kategori</th>
                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-600">Lokasi</th>
                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-600 text-center">Status</th>
                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-600 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($photos as $photo)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="w-16 h-12 rounded-lg overflow-hidden bg-gray-100 shadow-sm">
                                    <img src="{{ asset($photo->image_path) }}" alt="{{ $photo->title }}" class="w-full h-full object-cover">
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <p class="font-medium text-gray-900">{{ $photo->title }}</p>
                                <p class="text-xs text-gray-500 line-clamp-1">{{ $photo->description }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 rounded-md bg-gray-100 text-gray-700 text-xs font-medium">
                                    {{ $photo->category }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                @if($photo->location === 'home')
                                    <span class="inline-flex items-center gap-1 px-2 py-1 bg-slate-50 text-teal-700 rounded-md text-xs">
                                        <i class="fas fa-home text-[10px]"></i> Beranda
                                    </span>
                                @elseif($photo->location === 'about')
                                    <span class="inline-flex items-center gap-1 px-2 py-1 bg-purple-50 text-purple-700 rounded-md text-xs">
                                        <i class="fas fa-info-circle text-[10px]"></i> Tentang
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2 py-1 bg-green-50 text-green-700 rounded-md text-xs">
                                        <i class="fas fa-check-double text-[10px]"></i> Kedua
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if($photo->is_active)
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">AKTIF</span>
                                @else
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">NON-AKTIF</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center justify-end gap-2">
                                    <x-button variant="ghost" size="sm" icon="edit" onclick="editGallery({{ $photo->id }})">Edit</x-button>
                                    <x-button variant="ghost-danger" size="sm" icon="trash" onclick="openDeleteModal('deleteGalleryModal', '{{ $photo->title }}', '/admin/gallery/{{ $photo->id }}')">Hapus</x-button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-10 text-center text-gray-400 italic">Belum ada foto galeri.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            
            @if($photos->hasPages())
                <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">
                    {{ $photos->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
<!-- Delete Modal Component -->
@component('components.delete-modal', ['id' => 'deleteGalleryModal', 'title' => 'Hapus Foto Galeri?']) @endcomponent

<!-- Modal Edit Gallery -->
<div id="editGalleryModal" class="fixed inset-0 backdrop-blur-sm bg-black/40 overflow-y-auto hidden z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg p-8 my-8">
        <div class="flex items-center gap-3 mb-6">
            <div class="w-12 h-12 bg-indigo-100 rounded-full flex items-center justify-center">
                <i class="fas fa-camera text-indigo-600 text-lg"></i>
            </div>
            <div>
                <h3 class="text-2xl font-bold text-gray-900">Edit Foto Galeri</h3>
                <p class="text-sm text-gray-500">Perbarui informasi foto</p>
            </div>
            <button type="button" onclick="closeModal('editGalleryModal')" class="ml-auto text-gray-400 hover:text-gray-600">
                <i class="fas fa-times text-2xl"></i>
            </button>
        </div>
        
        <form id="editGalleryForm" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')
            
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Judul Foto</label>
                <input type="text" id="edit-title" name="title" placeholder="Masukkan judul foto" required class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-indigo-500 transition-colors">
            </div>
            
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi</label>
                <textarea id="edit-description" name="description" rows="2" placeholder="Masukkan deskripsi singkat" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-indigo-500 transition-colors"></textarea>
            </div>
            
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Kategori</label>
                    <input type="text" id="edit-category" name="category" placeholder="Contoh: Kegiatan" required class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-indigo-500 transition-colors">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Lokasi Tampil</label>
                    <select id="edit-location" name="location" required class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-indigo-500 transition-colors">
                        <option value="home">Beranda</option>
                        <option value="about">Tentang Kami</option>
                        <option value="both">Keduanya</option>
                        <option value="hero">Hero Banner</option>
                    </select>
                </div>
            </div>
            
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">🖼️ Ganti Foto (Opsional)</label>
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 hover:border-indigo-400 transition-colors cursor-pointer relative">
                    <input type="file" name="image" accept="image/*" class="w-full opacity-0 absolute inset-0 cursor-pointer" onchange="previewGalleryImage(event)">
                    <div class="text-center">
                        <i class="fas fa-cloud-upload-alt text-gray-400 text-2xl mb-2"></i>
                        <p class="text-xs text-gray-500">Klik atau drag foto ke sini</p>
                    </div>
                </div>
                <div id="edit-image-preview" class="mt-3 hidden text-center">
                    <p class="text-xs text-gray-500 mb-2 font-semibold">Preview Foto Baru:</p>
                    <img id="new-preview-img" src="" class="max-h-32 mx-auto rounded-lg shadow-sm">
                </div>
            </div>

            <div class="flex items-center gap-3">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" id="edit-is_active" name="is_active" value="1" class="w-4 h-4 text-indigo-600 rounded focus:ring-2 focus:ring-indigo-500">
                    <span class="text-sm font-semibold text-gray-700">Tampilkan di Website</span>
                </label>
            </div>
            
            <div class="flex gap-3 pt-4">
                <x-button variant="secondary" size="md" class="flex-1 justify-center" type="button" onclick="closeModal('editGalleryModal')">Batal</x-button>
                <x-button variant="primary" size="md" icon="check" class="flex-1 justify-center" type="submit">Simpan Perubahan</x-button>
            </div>
        </form>
    </div>
</div>

<script>
    function closeModal(id) {
        document.getElementById(id).classList.add('hidden');
    }

    function editGallery(id) {
        const modal = document.getElementById('editGalleryModal');
        const form = document.getElementById('editGalleryForm');
        
        fetch(`/admin/gallery/${id}/edit`, {
            headers: {
                'Accept': 'application/json',
            }
        })
        .then(response => response.json())
        .then(data => {
            document.getElementById('edit-title').value = data.title || '';
            document.getElementById('edit-description').value = data.description || '';
            document.getElementById('edit-category').value = data.category || '';
            document.getElementById('edit-location').value = data.location || 'both';
            document.getElementById('edit-is_active').checked = !!data.is_active;
            
            // Reset image preview
            document.getElementById('edit-image-preview').classList.add('hidden');
            
            form.action = `/admin/gallery/${id}`;
            modal.classList.remove('hidden');
        })
        .catch(error => console.error('Error:', error));
    }

    function previewGalleryImage(event) {
        const reader = new FileReader();
        reader.onload = function() {
            const preview = document.getElementById('new-preview-img');
            preview.src = reader.result;
            document.getElementById('edit-image-preview').classList.remove('hidden');
        };
        reader.readAsDataURL(event.target.files[0]);
    }

    // Close modal when clicking outside
    window.onclick = function(event) {
        const editGalleryModal = document.getElementById('editGalleryModal');
        if (event.target == editGalleryModal) {
            editGalleryModal.classList.add('hidden');
        }
    }

    setupDeleteModalClickOutside('deleteGalleryModal');
</script>
@endsection
