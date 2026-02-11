@extends('layouts.app')

{{-- Include Image Cropper Component --}}
@include('components.image-cropper')

@section('content')
<div class="bg-gray-50 min-h-screen py-12 pt-28 font-cairo">
    <div class="max-w-6xl mx-auto px-6">
        
        <div class="flex flex-col md:flex-row items-center justify-between mb-8 bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
            <div>
                <h1 class="h2 text-gray-800">Manajemen Profil Pegawai</h1>
                <p class="text-sm text-gray-500">Kelola profil pegawai perpustakaan di sini.</p>
            </div>
            <div class="flex gap-3 mt-4 md:mt-0">
                <x-button variant="secondary" size="lg" icon="arrows-up-down" onclick="openModal('orderModal')">Atur Posisi</x-button>
                <x-button variant="secondary" size="lg" icon="plus" onclick="openModal('jabatanModal')">Tambah Jabatan</x-button>
                <x-button variant="primary" size="lg" icon="user-plus" type="link" href="{{ route('admin.profil_pegawai.create') }}">Tambah Pegawai</x-button>
            </div>
        </div>

        <!-- Flash Messages -->
        @if (session('success'))
            <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-6 py-4 rounded-xl flex items-start gap-3 animate-in fade-in slide-in-from-top">
                <i class="fas fa-check-circle text-green-600 mt-0.5"></i>
                <div>
                    <h3 class="font-semibold text-sm">Sukses</h3>
                    <p class="text-xs">{{ session('success') }}</p>
                </div>
                <button onclick="this.parentElement.style.display='none';" class="ml-auto text-green-600 hover:text-green-800">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        @endif

            @if (session('error'))
                <div class="mb-6 bg-red-50 border border-red-200 text-red-800 px-6 py-4 rounded-lg flex items-start gap-3 animate-in fade-in slide-in-from-top">
                    <i class="fas fa-exclamation-circle text-red-600 mt-0.5"></i>
                    <div>
                        <h3 class="font-semibold">Kesalahan</h3>
                        <p class="text-sm">{{ session('error') }}</p>
                    </div>
                    <button onclick="this.parentElement.style.display='none';" class="ml-auto text-red-600 hover:text-red-800">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            @endif

        <!-- Modal Jabatan -->
        <div id="jabatanModal" class="fixed inset-0 backdrop-blur-sm bg-black/40 hidden z-50 flex items-center justify-center">
            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md p-8">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-100 to-blue-50 rounded-full flex items-center justify-center">
                        <i class="fas fa-briefcase text-blue-600 text-lg"></i>
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold text-gray-900">Tambah Jabatan</h3>
                        <p class="text-sm text-gray-500">Tambahkan posisi baru</p>
                    </div>
                    <button type="button" onclick="closeModal('jabatanModal')" class="ml-auto text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times text-2xl"></i>
                    </button>
                </div>
                <form action="{{ route('admin.profil_pegawai.store-jabatan') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Jabatan</label>
                        <input type="text" name="name" placeholder="Masukkan nama jabatan" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-blue-500 transition-colors" required>
                    </div>
                    <div class="flex gap-3 pt-4">
                        <x-button variant="secondary" size="md" class="flex-1 justify-center" type="button" onclick="closeModal('jabatanModal')">Batal</x-button>
                        <x-button variant="primary" size="md" icon="check" class="flex-1 justify-center" type="submit">Simpan</x-button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal Profil Pegawai -->
        <div id="profilPegawaiModal" class="fixed inset-0 backdrop-blur-sm bg-black/40 hidden z-50 flex items-center justify-center overflow-y-auto">
            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg p-8 my-8">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-12 h-12 bg-gradient-to-br from-purple-100 to-purple-50 rounded-full flex items-center justify-center">
                        <i class="fas fa-user-plus text-purple-600 text-lg"></i>
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold text-gray-900">Tambah Profil Pegawai</h3>
                        <p class="text-sm text-gray-500">Tambahkan pegawai baru</p>
                    </div>
                    <button type="button" onclick="closeModal('profilPegawaiModal')" class="ml-auto text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times text-2xl"></i>
                    </button>
                </div>
                <form action="{{ route('admin.profil_pegawai.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">🖼️ Foto Pegawai</label>
                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 hover:border-purple-400 transition-colors cursor-pointer">
                            <input type="file" name="foto" accept="image/*" onchange="previewImageWithCropper(event, 'create-foto-preview', 'create-foto-crop-btn')" class="w-full">
                            <div id="create-foto-preview" class="mb-3" style="display: none;"></div>
                            <button type="button" id="create-foto-crop-btn" class="crop-button-standard" style="display:none;" onclick="window.imageCropper.openCropper(document.querySelector('input[name=foto]'))">
                                🎨 Edit & Crop Gambar
                            </button>
                        </div>
                        <p class="text-xs text-gray-500 mt-1">JPG, PNG • Maks 10MB • Bisa di-crop</p>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Pegawai</label>
                        <input type="text" name="nama" placeholder="Masukkan nama lengkap" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-purple-500 transition-colors" required>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Jabatan</label>
                        <select name="jabatan_id" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-purple-500 transition-colors" required>
                            <option value="">-- Pilih Jabatan --</option>
                            @foreach($jabatans as $j)
                                <option value="{{ $j->id }}">{{ $j->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi</label>
                        <textarea name="deskripsi" rows="3" placeholder="Jelaskan tugas dan tanggung jawab" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-purple-500 transition-colors" required></textarea>
                    </div>
                    <div class="flex gap-3 pt-4">
                        <x-button variant="secondary" size="md" class="flex-1 justify-center" type="button" onclick="closeModal('profilPegawaiModal')">Batal</x-button>
                        <x-button variant="primary" size="md" icon="check" class="flex-1 justify-center" type="submit">Simpan</x-button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal Atur Posisi Jabatan -->
        <div id="orderModal" class="fixed inset-0 backdrop-blur-sm bg-black/40 hidden z-50 flex items-center justify-center">
            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md p-8">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-12 h-12 bg-gradient-to-br from-green-100 to-green-50 rounded-full flex items-center justify-center">
                        <i class="fas fa-arrow-up-down text-green-600 text-lg"></i>
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold text-gray-900">Atur Posisi Jabatan</h3>
                        <p class="text-sm text-gray-500">Urutkan hierarki organisasi</p>
                    </div>
                    <button type="button" onclick="closeModal('orderModal')" class="ml-auto text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times text-2xl"></i>
                    </button>
                </div>
                
                <div class="bg-blue-50 border-l-4 border-blue-500 rounded-lg p-3 mb-6">
                    <p class="text-sm text-gray-700 flex items-start gap-2">
                        <i class="fas fa-info-circle text-blue-600 mt-0.5 flex-shrink-0"></i>
                        <span>Drag jabatan untuk mengatur urutan (atas = posisi tertinggi)</span>
                    </p>
                </div>
                
                <ul id="sortable" class="space-y-2 mb-6 bg-gray-50 p-4 rounded-lg">
                    @foreach($jabatans->sortBy('order') as $jabatan)
                        <li class="bg-white p-3 rounded-lg cursor-move border-2 border-gray-200 hover:border-green-400 transition-colors flex items-center gap-2 hover:shadow-md" data-id="{{ $jabatan->id }}">
                            <i class="fas fa-grip-vertical text-gray-400"></i>
                            <span class="font-medium text-gray-700">{{ $jabatan->name }}</span>
                        </li>
                    @endforeach
                </ul>
                
                <div class="flex gap-3">
                    <x-button variant="secondary" size="md" class="flex-1 justify-center" type="button" onclick="closeModal('orderModal')">Batal</x-button>
                    <x-button variant="primary" size="md" icon="check" class="flex-1 justify-center" type="button" id="saveOrder">Simpan</x-button>
                </div>
            </div>
        </div>

        <!-- Search Form -->
        <div class="mb-6 bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
            <form method="GET" action="{{ route('admin.profil_pegawai.index') }}" class="flex gap-3">
                <div class="flex-1">
                    <input 
                        type="text" 
                        name="search" 
                        placeholder="Cari pegawai berdasarkan nama, jabatan, atau deskripsi..." 
                        value="{{ $search ?? '' }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500"
                    >
                </div>
                <x-button variant="primary" size="md" type="submit"><i class="fas fa-search mr-2"></i>Cari</x-button>
                @if(!empty($search))
                    <x-button variant="secondary" size="md" type="link" href="{{ route('admin.profil_pegawai.index') }}"><i class="fas fa-times"></i></x-button>
                @endif
            </form>
            @if(!empty($search))
                <div class="mt-3 text-sm text-gray-600">
                    Hasil pencarian untuk: "<strong>{{ $search }}</strong>" - {{ $items->total() }} hasil ditemukan
                </div>
            @endif
        </div>

        <!-- Tabel -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden text-sm">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-50 border-b border-gray-100 font-bold">
                        <tr>
                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-600">Foto</th>
                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-600">Nama</th>
                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-600">Jabatan</th>
                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-600">Deskripsi</th>
                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-600 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($items as $item)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="w-12 h-12 rounded-full overflow-hidden bg-gray-100 ring-2 ring-white shadow-sm">
                                    @if($item->foto_path)
                                        <img src="{{ asset('storage/' . $item->foto_path) }}" alt="{{ $item->nama }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center bg-indigo-100 text-indigo-600 text-xs font-bold">
                                            {{ strtoupper(substr($item->nama, 0, 1)) }}
                                        </div>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900">{{ $item->nama }}</td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 rounded-md bg-indigo-50 text-indigo-700 font-medium">
                                    {{ $item->jabatan ? $item->jabatan->name : 'N/A' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-gray-600 max-w-xs truncate">{{ $item->deskripsi }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center justify-end gap-2">
                                    <x-button variant="ghost" size="sm" icon="edit" onclick="editProfilPegawai({{ $item->id }})">Edit</x-button>
                                    <x-button variant="ghost-danger" size="sm" icon="trash" onclick="openDeleteModal('deleteProfilPegawaiModal', '{{ $item->nama }}', '/admin/profil-pegawai/{{ $item->id }}')">Hapus</x-button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-10 text-center text-gray-400 italic">Belum ada data profil pegawai.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            @if($items->hasPages())
                <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">
                    {{ $items->appends(['search' => $search ?? ''])->links() }}
                </div>
            @endif
        </div>

    </div>
</div>

<!-- Modal Edit Profil Pegawai -->
<div id="editProfilPegawaiModal" class="fixed inset-0 backdrop-blur-sm bg-black/40 overflow-y-auto hidden z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg p-8 my-8">
        <div class="flex items-center gap-3 mb-6">
            <div class="w-12 h-12 bg-gradient-to-br from-indigo-100 to-indigo-50 rounded-full flex items-center justify-center">
                <i class="fas fa-edit text-indigo-600 text-lg"></i>
            </div>
            <div>
                <h3 class="text-2xl font-bold text-gray-900">Edit Profil Pegawai</h3>
                <p class="text-sm text-gray-500">Perbarui informasi pegawai</p>
            </div>
            <button type="button" onclick="closeModal('editProfilPegawaiModal')" class="ml-auto text-gray-400 hover:text-gray-600">
                <i class="fas fa-times text-2xl"></i>
            </button>
        </div>
        
        <form id="editProfilPegawaiForm" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')
            
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Pegawai</label>
                <input type="text" id="edit-nama" name="nama" placeholder="Masukkan nama lengkap" required class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-indigo-500 transition-colors">
            </div>
            
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Jabatan</label>
                <select id="edit-jabatan_id" name="jabatan_id" required class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-indigo-500 transition-colors">
                    <option value="">-- Pilih Jabatan --</option>
                    @foreach($jabatans as $jabatan)
                        <option value="{{ $jabatan->id }}">{{ $jabatan->name }}</option>
                    @endforeach
                </select>
            </div>
            
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi</label>
                <textarea id="edit-deskripsi" name="deskripsi" rows="3" placeholder="Jelaskan tugas dan tanggung jawab" required class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-indigo-500 transition-colors"></textarea>
            </div>
            
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">🖼️ Foto Pegawai</label>
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 hover:border-indigo-400 transition-colors cursor-pointer">
                    <input type="file" id="edit-foto" name="foto" accept="image/*" onchange="previewImageWithCropper(event, 'edit-foto-preview', 'edit-foto-crop-btn')" class="w-full">
                    <div id="edit-foto-preview" class="mb-3" style="display: none;"></div>
                    <button type="button" id="edit-foto-crop-btn" onclick="openImageCropper(document.getElementById('edit-foto'), document.getElementById('edit-foto-preview'))" class="crop-button-standard" style="display: none;">
                        ✂️ Edit & Crop Foto
                    </button>
                </div>
                <p class="text-xs text-gray-500 mt-1">JPG, PNG • Maks 10MB • Bisa di-crop - Kosongkan jika tidak ingin mengubah</p>
            </div>
            
            <div id="editFotoPreview" class="mt-2"></div>
            
            <div class="flex gap-3 pt-4">
                <x-button variant="secondary" size="md" class="flex-1 justify-center" type="button" onclick="closeModal('editProfilPegawaiModal')">Batal</x-button>
                <x-button variant="primary" size="md" icon="check" class="flex-1 justify-center" type="submit">Simpan</x-button>
            </div>
        </form>
    </div>
</div>

<!-- Delete Modal Component -->
@component('components.delete-modal', ['id' => 'deleteProfilPegawaiModal', 'title' => 'Hapus Profil Pegawai?']) @endcomponent

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
<script>
    function openModal(id) {
        document.getElementById(id).classList.remove('hidden');
        document.getElementById('dropdownMenu').classList.add('hidden');
    }
    
    function closeModal(id) {
        document.getElementById(id).classList.add('hidden');
    }

    function editProfilPegawai(id) {
        const modal = document.getElementById('editProfilPegawaiModal');
        const form = document.getElementById('editProfilPegawaiForm');
        
        fetch(`/admin/profil-pegawai/${id}/edit`, {
            headers: {
                'Accept': 'application/json',
            }
        })
        .then(response => response.json())
        .then(data => {
            document.getElementById('edit-nama').value = data.nama || '';
            document.getElementById('edit-jabatan_id').value = data.jabatan_id || '';
            document.getElementById('edit-deskripsi').value = data.deskripsi || '';
            form.action = `/admin/profil-pegawai/${id}`;
            modal.classList.remove('hidden');
        })
        .catch(error => console.error('Error:', error));
    }


    

    
    document.getElementById('dropdownButton').addEventListener('click', function(e) {
        e.stopPropagation();
        document.getElementById('dropdownMenu').classList.toggle('hidden');
    });
    
    document.addEventListener('click', function() {
        document.getElementById('dropdownMenu').classList.add('hidden');
    });
    
    // Close modal when clicking outside
    window.onclick = function(event) {
        const jabatanModal = document.getElementById('jabatanModal');
        const profilPegawaiModal = document.getElementById('profilPegawaiModal');
        const orderModal = document.getElementById('orderModal');
        const editProfilPegawaiModal = document.getElementById('editProfilPegawaiModal');
        
        if (event.target == jabatanModal) {
            jabatanModal.classList.add('hidden');
        }
        if (event.target == profilPegawaiModal) {
            profilPegawaiModal.classList.add('hidden');
        }
        if (event.target == orderModal) {
            orderModal.classList.add('hidden');
        }
        if (event.target == editProfilPegawaiModal) {
            editProfilPegawaiModal.classList.add('hidden');
        }
    }

    // Sortable for order modal
    $(function() {
        $("#sortable").sortable();
        $("#sortable").disableSelection();
    });

    document.getElementById('saveOrder').addEventListener('click', function() {
        const jabatanIds = [];
        document.querySelectorAll('#sortable li').forEach(li => {
            jabatanIds.push(parseInt(li.dataset.id));
        });

        fetch('{{ route("admin.profil_pegawai.update-order") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ jabatans: jabatanIds })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                closeModal('orderModal');
                location.reload(); // Reload to reflect changes
            }
        });
    });
</script>

<!-- Setup Click-Outside Handler for Delete Modal -->
<script>
    setupDeleteModalClickOutside('deleteProfilPegawaiModal');
</script>

{{-- Include Image Cropper JS --}}
<script src="{{ asset('js/image-cropper.js') }}"></script>

<script>
// Initialize cropper when page loads
document.addEventListener('DOMContentLoaded', function() {
    console.log('✅ Page loaded - Initializing delete functionality');
    
    // Initialize image cropper
    if (typeof window.ImageCropper === 'function') {
        window.imageCropper = new window.ImageCropper();
        console.log('✅ Image cropper initialized successfully');
    }
    
    // Delete modal is now managed by the reusable component
    console.log('✅ All delete functionality ready. Click "Hapus" button to show modal.');
});
</script>
@endsection