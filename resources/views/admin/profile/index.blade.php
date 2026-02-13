@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen py-24 pt-28 font-cairo">
    <div class="max-w-6xl mx-auto px-6">
        
        <div class="flex flex-col md:flex-row items-center justify-between mb-8 bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
            <div>
                <h1 class="h2 text-gray-800">Profile Ruangan</h1>
                <p class="text-sm text-gray-500">Kelola informasi dan fasilitas ruangan di sini.</p>
            </div>
            <x-button variant="primary" size="lg" type="link" href="#" onclick="openCreateModal()" icon="plus">Buat Ruangan Baru</x-button>
        </div>

        @if(session('success'))
            <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-6 py-4 rounded-2xl flex items-center gap-2 animate-in fade-in slide-in-from-top duration-300">
                <i class="fas fa-check-circle text-green-500"></i>
                <span class="font-bold">{{ session('success') }}</span>
            </div>
        @endif

        <!-- Search Form -->
        <div class="mb-6 bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
            <form method="GET" action="{{ route('admin.profile.index') }}" class="flex gap-3">
                <div class="flex-1">
                    <input 
                        type="text" 
                        name="search" 
                        placeholder="Cari ruangan berdasarkan nama, lantai, atau deskripsi..." 
                        value="{{ $search ?? '' }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500"
                    >
                </div>
                <x-button variant="primary" size="md" type="submit">
                    <i class="fas fa-search mr-2"></i>Cari
                </x-button>
                @if(!empty($search))
                    <x-button variant="secondary" size="md" type="link" href="{{ route('admin.profile.index') }}">
                        <i class="fas fa-times"></i>
                    </x-button>
                @endif
            </form>
            @if(!empty($search))
                <div class="mt-3 text-sm text-gray-600">
                    Hasil pencarian untuk: "<strong>{{ $search }}</strong>" - {{ $items->total() }} hasil ditemukan
                </div>
            @endif
        </div>

        <!-- Daftar Ruangan -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden text-sm">
            <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-50 border-b border-gray-100 font-bold">
                        <tr>
                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-600">Gambar</th>
                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-600">Ruangan</th>
                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-600">Kapasitas</th>
                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-600">Deskripsi</th>
                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-600 text-center">Status</th>
                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-600 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($items as $item)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex -space-x-4">
                                    @foreach($item->images->take(3) as $image)
                                        <div class="w-12 h-12 rounded-lg overflow-hidden bg-gray-100 ring-2 ring-white shadow-sm">
                                            <img src="{{ route('profile-ruangan.image', ['filename' => basename($image->image_path)]) }}" alt="Room" class="w-full h-full object-cover">
                                        </div>
                                    @endforeach
                                    @if($item->images->count() == 0)
                                        <div class="w-12 h-12 rounded-lg bg-gray-50 flex items-center justify-center text-gray-300 border-2 border-dashed border-gray-100 text-[8px] font-bold">—</div>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <p class="font-medium text-gray-900">{{ $item->room_name }}</p>
                                <p class="text-xs text-gray-500">Lantai {{ $item->floor ?? '-' }}</p>
                            </td>
                            <td class="px-6 py-4 text-gray-600">{{ $item->capacity ?? '—' }} Orang</td>
                            <td class="px-6 py-4 text-gray-500 text-xs max-w-xs truncate">
                                {{ $item->description ?? '-' }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if($item->is_active)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Aktif</span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">Non-Aktif</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-end gap-2">
                                    <x-button variant="ghost" size="sm" icon="edit" onclick="editProfileRuangan({{ $item->id }})">Edit</x-button>
                                    <x-button variant="ghost-danger" size="sm" icon="trash" onclick="openDeleteModal('deleteProfileRuanganModal', '{{ $item->room_name }}', '/admin/profile-ruangan/{{ $item->id }}')">Hapus</x-button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-10 text-center text-gray-400 italic text-sm">Belum ada profile ruangan yang terdaftar.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            
            @if($items->hasPages())
                <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">
                    {{ $items->appends(['search' => $search ?? ''])->links() }}
                </div>
            @endif
        </div>


        <!-- Modal Create -->
        <div id="createModal" class="fixed inset-0 backdrop-blur-sm bg-black/40 hidden z-50 flex items-center justify-center p-4">
            <div class="bg-white rounded-3xl shadow-2xl w-full max-w-2xl overflow-hidden animate-in fade-in zoom-in duration-300">
                <div class="p-8 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-teal-100 rounded-2xl flex items-center justify-center">
                            <i class="fas fa-plus text-teal-600"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900">Buat Profile Ruangan</h3>
                            <p class="text-xs text-gray-500">Tambahkan informasi ruangan baru</p>
                        </div>
                    </div>
                    <button onclick="closeModal('createModal')" class="text-gray-400 hover:text-gray-600 transition-colors">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
                
                <div class="p-8 max-h-[70vh] overflow-y-auto font-cairo">
                    <div id="createErrors" class="hidden bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded-xl mb-6 text-sm"></div>
                    
                    <form id="createForm" action="{{ route('admin.profile.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="col-span-2">
                                <label class="block text-sm font-bold text-gray-700 mb-2">Nama Ruangan <span class="text-red-500">*</span></label>
                                <input type="text" id="create-room_name" name="room_name" required class="w-full border-2 border-gray-100 rounded-xl px-4 py-3 focus:outline-none focus:border-teal-500 transition-all font-medium" placeholder="Contoh: Ruang Galeri">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Lantai</label>
                                <input type="number" id="create-floor" name="floor" min="1" max="7" class="w-full border-2 border-gray-100 rounded-xl px-4 py-3 focus:outline-none focus:border-teal-500 transition-all" placeholder="1-7">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Kapasitas</label>
                                <input type="number" id="create-capacity" name="capacity" class="w-full border-2 border-gray-100 rounded-xl px-4 py-3 focus:outline-none focus:border-teal-500 transition-all" placeholder="Orang">
                            </div>
                            <div class="col-span-2">
                                <label class="block text-sm font-bold text-gray-700 mb-2">Deskripsi</label>
                                <textarea id="create-description" name="description" rows="4" class="w-full border-2 border-gray-100 rounded-xl px-4 py-3 focus:outline-none focus:border-teal-500 transition-all" placeholder="Gunakan bahasa yang menarik..."></textarea>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-3">🖼️ Foto Ruangan (Maks 3)</label>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                @for($i = 1; $i <= 3; $i++)
                                <div class="border-2 border-dashed border-gray-200 rounded-xl p-3 hover:border-teal-400 transition-colors">
                                    <p class="text-[10px] uppercase font-bold text-gray-400 mb-1">Slot {{ $i }}</p>
                                    <input type="file" id="create-slot_{{ $i }}_image" name="slot_{{ $i }}_image" accept="image/*" class="text-xs w-full">
                                </div>
                                @endfor
                            </div>
                            <p class="text-[10px] text-gray-400 mt-2 italic">* Format JPG/PNG, Maks 20MB</p>
                        </div>

                        <div class="flex items-center gap-2 bg-gray-50 p-4 rounded-2xl">
                            <input type="checkbox" id="create-is_active" name="is_active" value="1" checked class="w-5 h-5 text-teal-600 rounded-lg focus:ring-teal-500">
                            <label for="create-is_active" class="text-sm font-bold text-gray-700 cursor-pointer">Tampilkan di Publik</label>
                        </div>

                        <div class="flex justify-end gap-3 pt-6 border-t border-gray-100">
                            <x-button variant="secondary" size="md" type="button" onclick="closeModal('createModal')">Batal</x-button>
                            <x-button variant="primary" size="md" icon="check" type="submit" id="createSubmitBtn">Simpan Profile</x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Edit -->
        <div id="editModal" class="fixed inset-0 backdrop-blur-sm bg-black/40 hidden z-50 flex items-center justify-center p-4">
            <div class="bg-white rounded-3xl shadow-2xl w-full max-w-2xl overflow-hidden animate-in fade-in zoom-in duration-300">
                <div class="p-8 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-orange-100 rounded-2xl flex items-center justify-center">
                            <i class="fas fa-edit text-orange-600"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900">Perbarui Profile Ruangan</h3>
                            <p class="text-xs text-gray-500">Edit informasi detail ruangan</p>
                        </div>
                    </div>
                    <button onclick="closeModal('editModal')" class="text-gray-400 hover:text-gray-600 transition-colors">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>

                <div class="p-8 max-h-[70vh] overflow-y-auto font-cairo">
                    <div id="editErrors" class="hidden bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded-xl mb-6 text-sm"></div>
                    
                    <form id="editForm" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="col-span-2">
                                <label class="block text-sm font-bold text-gray-700 mb-2">Nama Ruangan <span class="text-red-500">*</span></label>
                                <input type="text" id="edit-room_name" name="room_name" required class="w-full border-2 border-gray-100 rounded-xl px-4 py-3 focus:outline-none focus:border-orange-500 transition-all font-medium">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Lantai</label>
                                <input type="number" id="edit-floor" name="floor" min="1" max="7" class="w-full border-2 border-gray-100 rounded-xl px-4 py-3 focus:outline-none focus:border-orange-500 transition-all font-medium">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Kapasitas</label>
                                <input type="number" id="edit-capacity" name="capacity" class="w-full border-2 border-gray-100 rounded-xl px-4 py-3 focus:outline-none focus:border-orange-500 transition-all font-medium">
                            </div>
                            <div class="col-span-2">
                                <label class="block text-sm font-bold text-gray-700 mb-2">Deskripsi</label>
                                <textarea id="edit-description" name="description" rows="4" class="w-full border-2 border-gray-100 rounded-xl px-4 py-3 focus:outline-none focus:border-orange-500 transition-all font-medium"></textarea>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-3 uppercase tracking-wider text-[10px]">🖼️ Foto Saat Ini</label>
                            <div id="edit-images-preview" class="grid grid-cols-3 gap-4 mb-6 bg-gray-50/50 p-6 rounded-3xl border-2 border-dashed border-gray-100 min-h-[120px] flex items-center justify-center">
                                <!-- JS injects here -->
                            </div>

                            <label class="block text-sm font-bold text-gray-700 mb-3 uppercase tracking-wider text-[10px]">Ganti/Tambah Foto Baru</label>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                @for($i = 1; $i <= 3; $i++)
                                <div class="group relative border-2 border-dashed border-gray-100 rounded-2xl p-4 hover:border-orange-400 hover:bg-orange-50/30 transition-all duration-300">
                                    <p class="text-[10px] uppercase font-black text-gray-300 group-hover:text-orange-400 mb-2 transition-colors">Slot {{ $i }}</p>
                                    <input type="file" name="slot_{{ $i }}_image" accept="image/*" class="text-[10px] w-full file:mr-2 file:py-1 file:px-2 file:rounded-full file:border-0 file:text-[10px] file:font-bold file:bg-orange-100 file:text-orange-700 hover:file:bg-orange-200 cursor-pointer">
                                </div>
                                @endfor
                            </div>
                            <p class="text-[10px] text-gray-400 mt-3 italic flex items-center gap-1">
                                <i class="fas fa-info-circle"></i> Format JPG/PNG, Maks 20MB per file
                            </p>
                        </div>

                        <div class="flex items-center gap-2 bg-gray-50 p-4 rounded-2xl">
                            <input type="checkbox" id="edit-is_active" name="is_active" value="1" class="w-5 h-5 text-orange-600 rounded-lg focus:ring-orange-500">
                            <label for="edit-is_active" class="text-sm font-bold text-gray-700 cursor-pointer">Aktifkan di Halaman Publik</label>
                        </div>

                        <div class="flex justify-end gap-3 pt-6 border-t border-gray-100">
                            <x-button variant="secondary" size="md" type="button" onclick="closeModal('editModal')">Batal</x-button>
                            <x-button variant="primary" size="md" icon="check" type="submit">Simpan Perubahan</x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Delete -->
        <!-- Delete Modal Component -->
        @component('components.delete-modal', ['id' => 'deleteProfileRuanganModal', 'title' => 'Hapus Profile Ruangan?']) @endcomponent
    </div>
</div>

<script>
function openCreateModal() {
    document.getElementById('createForm').reset();
    document.getElementById('createErrors').classList.add('hidden');
    document.getElementById('createModal').classList.remove('hidden');
}

function closeModal(id) {
    document.getElementById(id).classList.add('hidden');
}

// Handle Create Form Submission
document.getElementById('createForm')?.addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const form = this;
    const formData = new FormData(form);
    const submitBtn = document.getElementById('createSubmitBtn');
    const errorDiv = document.getElementById('createErrors');
    const originalText = submitBtn.innerText;
    
    // Validate at least room_name is filled
    if (!document.getElementById('create-room_name').value.trim()) {
        errorDiv.innerHTML = '<strong>Error:</strong> Nama ruangan tidak boleh kosong';
        errorDiv.classList.remove('hidden');
        return;
    }
    
    // Log FormData content for debugging
    console.log('Create form submission:');
    console.log('Form action:', form.action);
    console.log('FormData entries:');
    let fileCount = 0;
    for (let [key, value] of formData.entries()) {
        if (value instanceof File) {
            fileCount++;
            console.log(`  ${key}: File(${value.name}, ${value.size} bytes, ${value.type})`);
        } else {
            console.log(`  ${key}: ${value}`);
        }
    }
    console.log(`Total files in FormData: ${fileCount}`);
    
    // Show loading state
    submitBtn.disabled = true;
    submitBtn.innerText = 'Menyimpan...';
    errorDiv.classList.add('hidden');
    
    try {
        const response = await fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
            }
        });
        
        console.log('Create response status:', response.status, 'OK:', response.ok);
        
        if (response.status === 422) {
            // Validation error
            const data = await response.json();
            console.log('Create validation errors:', data);
            let errorMsg = '<strong>Perbaiki kesalahan berikut:</strong><ul style="margin-top: 8px;">';
            if (data.errors) {
                for (const [field, messages] of Object.entries(data.errors)) {
                    messages.forEach(msg => {
                        errorMsg += `<li>• ${msg}</li>`;
                    });
                }
            }
            errorMsg += '</ul>';
            errorDiv.innerHTML = errorMsg;
            errorDiv.classList.remove('hidden');
            form.parentElement.scrollTop = 0;
        } else if (response.ok) {
            // Success - parse JSON response
            const data = await response.json();
            console.log('Create success:', data);
            setTimeout(() => {
                window.location.href = data.redirect || '{{ route("admin.profile.index") }}';
            }, 500);
        } else {
            // Error response - try to parse JSON
            try {
                const data = await response.json();
                console.log('Create error response:', data);
                let errorMsg = `<strong>Error:</strong> ${data.error || 'Terjadi kesalahan'}`;
                if (data.debug) {
                    errorMsg += `<br><small>File: ${data.debug.file}:${data.debug.line}</small>`;
                }
                errorDiv.innerHTML = errorMsg;
            } catch (e) {
                errorDiv.innerHTML = `<strong>Error:</strong> Terjadi kesalahan saat menyimpan (${response.status})`;
            }
            errorDiv.classList.remove('hidden');
        }
    } catch (error) {
        errorDiv.innerHTML = `<strong>Error:</strong> ${error.message}`;
        errorDiv.classList.remove('hidden');
    } finally {
        submitBtn.disabled = false;
        submitBtn.innerText = originalText;
    }
});

// Handle Edit Form Submission
document.getElementById('editForm')?.addEventListener('submit', function(e) {
    e.preventDefault();
    
    const form = this;
    const formData = new FormData(form);
    
    // Show loading state
    const submitBtn = form.querySelector('[type="submit"]');
    const originalText = submitBtn.innerText;
    submitBtn.disabled = true;
    submitBtn.innerText = 'Menyimpan...';
    
    const errorDiv = document.getElementById('editErrors');
    errorDiv.classList.add('hidden');
    
    console.log('Edit form action:', form.action);
    console.log('Edit form data keys:', Array.from(formData.keys()));
    
    fetch(form.action, {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        },
        redirect: 'follow'
    })
    .then(response => {
        console.log('Edit response status:', response.status, 'OK:', response.ok);
        
        if (response.status === 422) {
            return response.json().then(data => {
                console.log('Validation errors:', data);
                if (data.errors) {
                    let errorMsg = '<strong>Perbaiki kesalahan berikut:</strong><ul style="margin-top: 8px;">';
                    for (const [field, messages] of Object.entries(data.errors)) {
                        messages.forEach(msg => {
                            errorMsg += `<li>• ${msg}</li>`;
                        });
                    }
                    errorMsg += '</ul>';
                    errorDiv.innerHTML = errorMsg;
                    errorDiv.classList.remove('hidden');
                    form.parentElement.scrollTop = 0;
                }
                throw new Error('Validation error');
            });
        } else if (response.ok) {
            // Success - reload page (response.ok is true for 2xx)
            console.log('Edit success, reloading');
            setTimeout(() => {
                window.location.href = '{{ route("admin.profile.index") }}';
            }, 300);
        } else {
            console.log('Unexpected edit response status');
            // Try to parse as JSON for error details
            return response.text().then(text => {
                console.log('Response text:', text.substring(0, 200));
                throw new Error(`HTTP ${response.status}`);
            });
        }
    })
    .catch(error => {
        console.error('Complete edit error:', error);
        if (error.message !== 'Validation error') {
            errorDiv.innerHTML = `<strong>Error:</strong> ${error.message || 'Terjadi kesalahan saat menyimpan data'}`;
            errorDiv.classList.remove('hidden');
        }
        submitBtn.disabled = false;
        submitBtn.innerText = originalText;
    });
});

function editProfileRuangan(id) {
    const modal = document.getElementById('editModal');
    const form = document.getElementById('editForm');
    
    fetch(`/admin/profile-ruangan/${id}/edit`, {
        headers: {
            'Accept': 'application/json',
        }
    })
    .then(response => response.json())
    .then(data => {
        document.getElementById('edit-room_name').value = data.room_name || '';
        document.getElementById('edit-floor').value = data.floor || '';
        document.getElementById('edit-capacity').value = data.capacity || '';
        document.getElementById('edit-description').value = data.description || '';
        document.getElementById('edit-is_active').checked = data.is_active || false;
        form.action = `/admin/profile-ruangan/${id}`;
        
        // Display existing images
        const previewContainer = document.getElementById('edit-images-preview');
        previewContainer.innerHTML = '';
        
        if (data.images && data.images.length > 0) {
            data.images.forEach(image => {
                const imageDiv = document.createElement('div');
                imageDiv.className = 'relative group rounded-2xl overflow-hidden shadow-sm bg-white border border-gray-100 aspect-square ring-4 ring-white transition-transform hover:scale-105';
                imageDiv.innerHTML = `
                    <img src="/storage/${image.image_path}" alt="Room image" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                        <button type="button" onclick="deleteImageFromEdit(${image.id}, this)" class="bg-red-500 text-white w-8 h-8 rounded-full flex items-center justify-center hover:bg-red-600 transition-colors shadow-lg" title="Hapus gambar">
                            <i class="fas fa-trash text-xs"></i>
                        </button>
                    </div>
                `;
                previewContainer.appendChild(imageDiv);
            });
        } else {
            previewContainer.innerHTML = `
                <div class="col-span-3 flex flex-col items-center justify-center py-4">
                    <i class="fas fa-images text-gray-200 text-3xl mb-2"></i>
                    <p class="text-gray-400 text-xs italic">Belum ada foto terunggah</p>
                </div>
            `;
        }
        
        modal.classList.remove('hidden');
    })
    .catch(error => console.error('Error:', error));
}

function deleteImageFromEdit(imageId, buttonElement) {
    if (!confirm('Yakin ingin menghapus gambar ini?')) {
        return;
    }
    
    const previewContainer = document.getElementById('edit-images-preview');
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content || '';
    
    fetch(`/admin/profile-ruangan/image/${imageId}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json',
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Remove the image element from preview
            buttonElement.closest('div').remove();
            
            // Check if no images left
            if (previewContainer.children.length === 0) {
                previewContainer.innerHTML = '<p class="col-span-3 text-gray-500 text-sm">Belum ada gambar</p>';
            }
            
            // Show success message
            showNotification('Gambar berhasil dihapus!', 'success');
        } else {
            showNotification('Gagal menghapus gambar: ' + (data.message || 'Unknown error'), 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showNotification('Terjadi kesalahan saat menghapus gambar', 'error');
    });
}

function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `fixed top-4 right-4 p-4 rounded-lg text-white z-[9999] ${
        type === 'success' ? 'bg-green-500' : type === 'error' ? 'bg-red-500' : 'bg-blue-500'
    }`;
    notification.textContent = message;
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.remove();
    }, 3000);
}



// Close modals when clicking outside
document.getElementById('createModal')?.addEventListener('click', function(e) {
    if (e.target === this) closeModal('createModal');
});

document.getElementById('editModal')?.addEventListener('click', function(e) {
    if (e.target === this) closeModal('editModal');
});

// Setup Click-Outside Handler for Delete Modal
setupDeleteModalClickOutside('deleteProfileRuanganModal');
</script>

<script>
    setupDeleteModalClickOutside('deleteProfileRuanganModal');
</script>
@endsection
