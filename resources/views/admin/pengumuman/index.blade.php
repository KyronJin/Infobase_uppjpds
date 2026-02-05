@extends('layouts.app')

@section('content')
{{-- Include Image Cropper Component --}}
@include('components.image-cropper')
<div class="py-24 bg-white pt-28">
  <div class="max-w-6xl mx-auto px-6">
    <div class="admin-section">
        <div class="flex items-center justify-between mb-6">
            <h1 class="h2">Pengumuman</h1>
            <a href="#" class="admin-button" id="create-announcement-btn">Create</a>
        </div>

        <!-- Search Form -->
        <div class="mb-6">
            <form method="GET" action="{{ route('admin.pengumuman.index') }}" class="flex gap-3">
                <div class="flex-1">
                    <input 
                        type="text" 
                        name="search" 
                        placeholder="Cari pengumuman berdasarkan judul atau isi..." 
                        value="{{ $search ?? '' }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500"
                    >
                </div>
                <button 
                    type="submit" 
                    class="px-6 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition duration-300"
                >
                    <i class="fas fa-search mr-2"></i>Cari
                </button>
                @if(!empty($search))
                    <a 
                        href="{{ route('admin.pengumuman.index') }}" 
                        class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition duration-300"
                    >
                        <i class="fas fa-times"></i>
                    </a>
                @endif
            </form>
            @if(!empty($search))
                <div class="mt-3 text-sm text-gray-600">
                    Hasil pencarian untuk: "<strong>{{ $search }}</strong>" - {{ $pengumumans->total() }} hasil ditemukan
                </div>
            @endif
        </div>

            <!-- Inbox / Daftar Pengumuman -->
            <div class="space-y-8 w-full">
                <h2 class="h3 text-teal-700">Inbox</h2>

                <!-- atau lebih simpel -->
                <div class="text-gray-600">Jumlah pengumuman: <span class="font-semibold text-gray-900">{{ $pengumumans->count() }}</span></div>

                @if($pengumumans->isEmpty())
                    <div class="bg-gray-50 p-8 rounded-lg text-center text-gray-600">
                        Belum ada pengumuman saat ini
                    </div>
                @else
                    @foreach($pengumumans as $item)
                    <div class="border-l-4 border-teal-500 pl-6 bg-gray-50 p-8 rounded space-y-6">
                        <div>
                            <h3 class="h1 mb-4">{{ $item->title }}</h3>
                            
                            <!-- Tanggal Publikasi -->
                            <div class="grid grid-cols-2 gap-8 mb-6 text-sm">
                                <div>
                                    <p class="text-gray-500 font-semibold mb-1">Dipublikasikan</p>
                                    <p class="text-gray-800 text-lg">
                                        {{ $item->published_at?->format('d F Y H:i') ?? '—' }}
                                    </p>
                                </div>
                                <div>
                                    <p class="text-gray-500 font-semibold mb-1">Status</p>
                                    <p class="text-gray-800">
                                        @if($item->published_at && $item->published_at <= now())
                                            <span class="inline-block px-3 py-1 bg-green-100 text-green-800 rounded text-sm font-semibold">Aktif</span>
                                        @else
                                            <span class="inline-block px-3 py-1 bg-yellow-100 text-yellow-800 rounded text-sm font-semibold">Scheduled</span>
                                        @endif
                                    </p>
                                </div>
                            </div>

                            <!-- Tanggal Berlaku -->
                            @if($item->valid_from || $item->valid_until)
                            <div class="grid grid-cols-2 gap-8 mb-6 bg-blue-50 p-5 rounded border border-blue-200">
                                <div>
                                    <p class="text-blue-700 font-semibold mb-1">Berlaku Dari</p>
                                    <p class="text-blue-900 text-lg">
                                        {{ $item->valid_from?->format('d F Y') ?? '—' }}
                                    </p>
                                </div>
                                <div>
                                    <p class="text-blue-700 font-semibold mb-1">Berlaku Hingga</p>
                                    <p class="text-blue-900 text-lg">
                                        {{ $item->valid_until?->format('d F Y') ?? '—' }}
                                    </p>
                                </div>
                            </div>
                            @endif

                            <!-- Isi Pengumuman -->
                            <div class="mt-6">
                                <p class="text-gray-500 font-semibold text-sm mb-3">Isi Pengumuman</p>
                                <div class="text-gray-700 prose prose-lg max-w-none bg-white p-6 rounded border border-gray-200 leading-relaxed">
                                    {!! nl2br(e($item->description)) !!}
                                </div>
                            </div>

                            <!-- Gambar Pengumuman -->
                            @if($item->image_path)
                            <div class="mt-6">
                                <p class="text-gray-500 font-semibold text-sm mb-3">Gambar</p>
                                <div class="bg-white p-4 rounded border border-gray-200">
                                    <img src="{{ asset('storage/' . $item->image_path) }}" 
                                         alt="Gambar {{ $item->title }}" 
                                         class="max-w-full h-auto max-h-64 rounded border border-gray-300">
                                </div>
                            </div>
                            @endif
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="flex justify-end gap-3 pt-6 border-t border-gray-300">
                            <button onclick="editPengumuman({{ $item->id }})" class="px-5 py-2 bg-amber-50 text-amber-600 hover:bg-amber-100 rounded font-semibold transition-colors flex items-center gap-2">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                            <button onclick="deletePengumuman({{ $item->id }}, '{{ $item->title }}')" class="px-5 py-2 bg-red-50 text-red-600 hover:bg-red-100 rounded font-semibold transition-colors flex items-center gap-2">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </div>
                    </div>
                    @endforeach
                @endif
                
                <!-- Pagination -->
                @if($pengumumans->hasPages())
                    <div class="mt-8 flex justify-center">
                        {{ $pengumumans->appends(['search' => $search ?? ''])->links() }}
                    </div>
                @endif
            </div>
        </div>

        <!-- Modal untuk form create -->
        <div id="create-announcement-modal" class="fixed inset-0 backdrop-blur-sm bg-white/30 hidden z-50">
            <div class="flex items-center justify-center min-h-screen p-4">
                <div class="bg-white rounded-lg max-w-lg w-full max-h-[90vh] overflow-y-auto">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-xl font-bold text-gray-900">Buat Pengumuman Baru</h3>
                            <button id="close-modal-btn" class="text-gray-400 hover:text-gray-600">
                                <i class="fas fa-times text-xl"></i>
                            </button>
                        </div>
                        @include('admin.pengumuman.form')
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal untuk form edit -->
        <div id="edit-announcement-modal" class="fixed inset-0 backdrop-blur-sm bg-white/30 hidden z-50">
            <div class="flex items-center justify-center min-h-screen p-4">
                <div class="bg-white rounded-lg max-w-lg w-full max-h-[90vh] overflow-y-auto">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-xl font-bold text-gray-900">Edit Pengumuman</h3>
                            <button id="close-edit-modal-btn" class="text-gray-400 hover:text-gray-600">
                                <i class="fas fa-times text-xl"></i>
                            </button>
                        </div>
                        <form id="edit-form" method="POST" enctype="multipart/form-data" class="space-y-4">
                            @csrf
                            @method('PUT')

                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">Judul</label>
                                <input type="text" id="edit-title" name="title" required class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500">
                            </div>

                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">Isi Pengumuman</label>
                                <textarea id="edit-description" name="description" rows="6" required class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500"></textarea>
                            </div>

                            <!-- Input Gambar with Cropper -->
                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">🖼️ Gambar</label>
                                <div id="edit-current-image" class="mb-3" style="display: none;">
                                    <p class="text-sm text-gray-600 mb-2">Gambar saat ini:</p>
                                    <img id="edit-current-image-preview" src="" alt="Gambar saat ini" class="h-32 w-auto rounded border border-gray-300">
                                </div>
                                
                                <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 hover:border-teal-400 transition-colors bg-gray-50">
                                    <div class="text-center mb-3">
                                        <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-2"></i>
                                        <p class="text-gray-600 font-medium">Upload Gambar Baru</p>
                                        <p class="text-xs text-gray-500">Klik untuk pilih file, kemudian edit dengan cropper</p>
                                    </div>
                                    
                                    <input type="file" id="edit-image" name="image" accept="image/*" onchange="handleImageUpload(this, 'edit-image-preview', 'edit-crop-btn')" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500 mb-3">
                                    
                                    <div id="edit-image-preview" class="mb-3" style="display: none;"></div>
                                    
                                    <div class="flex gap-2 justify-center mt-4" style="position: relative; z-index: 10;">
                                        <button type="button" id="edit-crop-btn" onclick="openImageCropper(document.getElementById('edit-image'), document.getElementById('edit-image-preview'))" class="crop-button-standard" style="display: none;">
                                            ✂️ Edit & Crop Gambar
                                        </button>
                                    </div>
                                </div>
                                
                                <p class="text-sm text-gray-500 mt-2">
                                    📄 Format: JPG, PNG • 📏 Maks: 10MB • ✂️ Bisa di-crop dan edit
                                </p>
                            </div>

                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">Tanggal Publikasi</label>
                                <input type="datetime-local" id="edit-published_at" name="published_at" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500">
                            </div>

                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">Berlaku Dari</label>
                                <input type="date" id="edit-valid_from" name="valid_from" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500">
                            </div>

                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">Berlaku Hingga</label>
                                <input type="date" id="edit-valid_until" name="valid_until" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500">
                            </div>

                            <div class="flex justify-end gap-3 pt-4">
                                <button type="button" onclick="document.getElementById('edit-announcement-modal').classList.add('hidden')" class="px-4 py-2 border border-gray-300 rounded text-gray-700 hover:bg-gray-50 font-semibold transition-colors">
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

        <!-- Modal untuk konfirmasi delete -->
        <div id="delete-announcement-modal" class="fixed inset-0 backdrop-blur-sm bg-white/30 hidden z-50">
            <div class="flex items-center justify-center min-h-screen p-4">
                <div class="bg-white rounded-lg max-w-lg w-full">
                    <div class="p-8">
                        <div class="flex items-center justify-center w-16 h-16 mx-auto bg-red-100 rounded-full mb-6">
                            <i class="fas fa-exclamation-triangle text-red-600 text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 text-center mb-3">Hapus Pengumuman?</h3>
                        <p class="text-gray-700 text-center mb-2 text-lg font-semibold" id="delete-title-confirm"></p>
                        <p class="text-sm text-gray-500 text-center mb-8">Tindakan ini tidak dapat dibatalkan.</p>
                        
                        <form id="delete-form" method="POST" class="space-y-0">
                            @csrf
                            @method('DELETE')
                            
                            <div class="flex gap-4">
                                <button type="button" onclick="document.getElementById('delete-announcement-modal').classList.add('hidden')" class="flex-1 px-5 py-3 border-2 border-gray-300 rounded text-gray-700 hover:bg-gray-50 font-semibold transition-colors text-lg">
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    const createModal = document.getElementById('create-announcement-modal');
    const editModal = document.getElementById('edit-announcement-modal');
    const deleteModal = document.getElementById('delete-announcement-modal');
    const openBtn = document.getElementById('create-announcement-btn');
    const closeCreateBtn = document.getElementById('close-modal-btn');
    const closeEditBtn = document.getElementById('close-edit-modal-btn');

    openBtn.addEventListener('click', function(e) {
        e.preventDefault();
        createModal.classList.remove('hidden');
    });

    closeCreateBtn.addEventListener('click', function() {
        createModal.classList.add('hidden');
    });

    closeEditBtn.addEventListener('click', function() {
        editModal.classList.add('hidden');
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
});

function editPengumuman(id) {
    const editModal = document.getElementById('edit-announcement-modal');
    const editForm = document.getElementById('edit-form');
    
    // Fetch data pengumuman dengan Accept header JSON
    fetch('/admin/pengumuman/' + id + '/edit', {
        headers: {
            'Accept': 'application/json',
        }
    })
    .then(response => response.json())
    .then(data => {
        // Populate form dengan data
        document.getElementById('edit-title').value = data.title || '';
        document.getElementById('edit-description').value = data.description || '';
        document.getElementById('edit-published_at').value = data.published_at || '';
        document.getElementById('edit-valid_from').value = data.valid_from || '';
        document.getElementById('edit-valid_until').value = data.valid_until || '';
        
        // Tampilkan gambar saat ini jika ada
        const currentImageDiv = document.getElementById('edit-current-image');
        const currentImagePreview = document.getElementById('edit-current-image-preview');
        
        if (data.image_path) {
            currentImagePreview.src = '/storage/' + data.image_path;
            currentImageDiv.style.display = 'block';
        } else {
            currentImageDiv.style.display = 'none';
        }
        
        // Reset preview gambar baru
        const newImagePreview = document.getElementById('edit-image-preview');
        const imageInput = document.getElementById('edit-image');
        const cropButton = document.getElementById('edit-crop-btn');
        
        if (newImagePreview) newImagePreview.style.display = 'none';
        if (imageInput) imageInput.value = '';
        if (cropButton) cropButton.style.display = 'none';
        
        // Update form action
        editForm.action = `/admin/pengumuman/${id}`;
        
        // Show modal
        editModal.classList.remove('hidden');
    })
    .catch(error => console.error('Error:', error));
}

function deletePengumuman(id, title) {
    const deleteModal = document.getElementById('delete-announcement-modal');
    const deleteForm = document.getElementById('delete-form');
    
    // Set title konfirmasi
    document.getElementById('delete-title-confirm').textContent = `Yakin ingin menghapus "${title}"?`;
    
    // Update form action
    deleteForm.action = `/admin/pengumuman/${id}`;
    
    // Show modal
    deleteModal.classList.remove('hidden');
}
</script>

<script>
// Custom image upload handler untuk edit pengumuman
function handleImageUpload(input, previewId, buttonId) {
    console.log('handleImageUpload called:', input.files?.length || 0);
    
    const preview = document.getElementById(previewId);
    const button = document.getElementById(buttonId);
    const file = input.files?.[0];
    
    if (file) {
        console.log('File selected:', file.name, file.size);
        
        // Validate file
        if (!file.type.startsWith('image/')) {
            alert('File harus berupa gambar!');
            return;
        }
        
        // Show loading
        if (preview) {
            preview.innerHTML = `
                <div class="text-center py-4 bg-blue-50 border border-blue-200 rounded-lg">
                    <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600 mx-auto mb-2"></div>
                    <p class="text-sm text-blue-600 font-semibold">Memuat preview...</p>
                </div>
            `;
            preview.style.display = 'block';
        }
        
        const reader = new FileReader();
        reader.onload = function(e) {
            const fileSize = (file.size / 1024).toFixed(1);
            
            if (preview) {
                preview.innerHTML = `
                    <div class="text-center bg-green-50 border-2 border-green-200 rounded-lg p-4">
                        <img src="${e.target.result}" 
                             alt="Preview gambar" 
                             class="h-32 w-auto rounded-lg border border-green-300 object-cover mx-auto mb-3 shadow-md">
                        <div class="text-sm">
                            <p class="font-bold text-green-800">✓ ${file.name}</p>
                            <p class="text-green-600">📏 ${fileSize} KB • ✅ Siap untuk diedit!</p>
                            <p class="text-xs text-blue-600 mt-1 font-semibold">➡️ Klik tombol "Edit & Crop" di bawah</p>
                        </div>
                    </div>
                `;
            }
            
            // Show crop button with animation
            if (button) {
                button.style.display = 'block';
                button.classList.remove('animate-pulse');
                button.classList.add('animate-bounce');
                setTimeout(() => {
                    button.classList.remove('animate-bounce');
                    button.classList.add('animate-pulse');
                }, 2000);
                console.log('Crop button shown and animated');
                
                // Show notification
                if (window.imageCropper && typeof window.imageCropper.showNotification === 'function') {
                    window.imageCropper.showNotification('📸 Gambar siap! Klik tombol biru untuk edit', 'info', 4000);
                }
            } else {
                console.error('Button not found:', buttonId);
            }
        };
        
        reader.onerror = function() {
            alert('Gagal membaca file gambar!');
        };
        
        reader.readAsDataURL(file);
    } else {
        console.log('No file selected');
        if (preview) preview.style.display = 'none';
        if (button) button.style.display = 'none';
    }
}
</script>
    console.log('handleImageUpload called:', input.files?.length || 0);
    
    const preview = document.getElementById(previewId);
    const button = document.getElementById(buttonId);
    const file = input.files?.[0];
    
    if (file) {
        console.log('File selected:', file.name, file.size);
        
        // Validate file
        if (!file.type.startsWith('image/')) {
            alert('File harus berupa gambar!');
            return;
        }
        
        // Show loading
        if (preview) {
            preview.innerHTML = `
                <div class="text-center py-4 bg-blue-50 border border-blue-200 rounded-lg">
                    <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600 mx-auto mb-2"></div>
                    <p class="text-sm text-blue-600 font-semibold">Memuat preview...</p>
                </div>
            `;
            preview.style.display = 'block';
        }
        
        const reader = new FileReader();
        reader.onload = function(e) {
            const fileSize = (file.size / 1024).toFixed(1);
            
            if (preview) {
                preview.innerHTML = `
                    <div class="text-center bg-green-50 border-2 border-green-200 rounded-lg p-4">
                        <img src="${e.target.result}" 
                             alt="Preview gambar" 
                             class="h-32 w-auto rounded-lg border border-green-300 object-cover mx-auto mb-3 shadow-md">
                        <div class="text-sm">
                            <p class="font-bold text-green-800">✓ ${file.name}</p>
                            <p class="text-green-600">📏 ${fileSize} KB • ✅ Siap untuk diedit!</p>
                            <p class="text-xs text-blue-600 mt-1 font-semibold">➡️ Klik tombol "Edit & Crop" di bawah</p>
                        </div>
                    </div>
                `;
            }
            
            // Show crop button with animation
            if (button) {
                button.style.display = 'block';
                button.classList.remove('animate-pulse');
                button.classList.add('animate-bounce');
                setTimeout(() => {
                    button.classList.remove('animate-bounce');
                    button.classList.add('animate-pulse');
                }, 2000);
                console.log('Crop button shown and animated');
            } else {
                console.error('Button not found:', buttonId);
            }
        };
        
        reader.onerror = function() {
            alert('Gagal membaca file gambar!');
        };
        
        reader.readAsDataURL(file);
    } else {
        console.log('No file selected');
        if (preview) preview.style.display = 'none';
        if (button) button.style.display = 'none';
    }
}
</script>

{{-- Include Image Cropper JS --}}
<script src="{{ asset('js/image-cropper.js') }}"></script>
@endsection