@extends('layouts.app')

{{-- Include Image Cropper Component --}}
@include('components.image-cropper')

@section('content')
<div class="bg-gray-50 min-h-screen py-12 pt-28">
    <div class="max-w-6xl mx-auto px-6">
        <div class="admin-section">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h1 class="h2">Manajemen Profil Pegawai</h1>
                    <p class="text-sm text-gray-500">Kelola profil pegawai perpustakaan di sini.</p>
                </div>
                <div class="flex gap-3 items-center">
                    <button type="button" onclick="openModal('orderModal')" class="px-4 py-2.5 bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white font-semibold rounded-lg shadow-md hover:shadow-lg transition-all duration-200 flex items-center gap-2">
                        <i class="fas fa-arrow-up-down text-sm"></i> Atur Posisi Jabatan
                    </button>
                    <button type="button" onclick="openModal('jabatanModal')" class="px-4 py-2.5 bg-white border-2 border-blue-500 text-blue-600 hover:bg-blue-50 font-semibold rounded-lg shadow-sm hover:shadow-md transition-all duration-200 flex items-center gap-2">
                        <i class="fas fa-plus text-sm"></i> Tambah Jabatan
                    </button>
                    <a href="{{ route('admin.profil_pegawai.create') }}" class="px-4 py-2.5 bg-white border-2 border-indigo-500 text-indigo-600 hover:bg-indigo-50 font-semibold rounded-lg shadow-sm hover:shadow-md transition-all duration-200 flex items-center gap-2">
                        <i class="fas fa-user-plus text-sm"></i> Tambah Profil Pegawai
                    </a>
                </div>
            </div>

            <!-- Flash Messages -->
            @if (session('success'))
                <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-6 py-4 rounded-lg flex items-start gap-3 animate-in fade-in slide-in-from-top">
                    <i class="fas fa-check-circle text-green-600 mt-0.5"></i>
                    <div>
                        <h3 class="font-semibold">Sukses</h3>
                        <p class="text-sm">{{ session('success') }}</p>
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
                        <button type="button" onclick="closeModal('jabatanModal')" class="flex-1 px-4 py-2.5 border-2 border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 font-semibold transition-colors">Batal</button>
                        <button type="submit" class="flex-1 px-4 py-2.5 bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-lg hover:from-blue-600 hover:to-blue-700 font-semibold transition-colors flex items-center justify-center gap-2">
                            <i class="fas fa-plus"></i> Simpan
                        </button>
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
                        <button type="button" onclick="closeModal('profilPegawaiModal')" class="flex-1 px-4 py-2.5 border-2 border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 font-semibold transition-colors">Batal</button>
                        <button type="submit" class="flex-1 px-4 py-2.5 bg-gradient-to-r from-purple-500 to-purple-600 text-white rounded-lg hover:from-purple-600 hover:to-purple-700 font-semibold transition-colors flex items-center justify-center gap-2">
                            <i class="fas fa-save"></i> Simpan
                        </button>
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
                    <button type="button" onclick="closeModal('orderModal')" class="flex-1 px-4 py-2.5 border-2 border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 font-semibold transition-colors">Batal</button>
                    <button type="button" id="saveOrder" class="flex-1 px-4 py-2.5 bg-gradient-to-r from-green-500 to-green-600 text-white rounded-lg hover:from-green-600 hover:to-green-700 font-semibold transition-colors flex items-center justify-center gap-2">
                        <i class="fas fa-check"></i> Simpan
                    </button>
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
                <button 
                    type="submit" 
                    class="px-6 py-2 bg-indigo-600 text-white font-medium rounded-lg hover:bg-indigo-700 transition duration-300"
                >
                    <i class="fas fa-search mr-2"></i>Cari
                </button>
                @if(!empty($search))
                    <a 
                        href="{{ route('admin.profil_pegawai.index') }}" 
                        class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition duration-300"
                    >
                        <i class="fas fa-times"></i>
                    </a>
                @endif
            </form>
            @if(!empty($search))
                <div class="mt-3 text-sm text-gray-600">
                    Hasil pencarian untuk: "<strong>{{ $search }}</strong>" - {{ $items->total() }} hasil ditemukan
                </div>
            @endif
        </div>

        <!-- Tabel -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-50 border-b border-gray-100">
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
                                @if($item->foto_path)
                                    <img src="{{ asset('storage/' . $item->foto_path) }}" alt="{{ $item->nama }}" class="w-12 h-12 rounded-full object-cover">
                                @else
                                    <div class="w-12 h-12 bg-gray-200 rounded-full flex items-center justify-center">
                                        <i class="fas fa-user text-gray-400"></i>
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-sm font-medium text-gray-700">{{ $item->nama }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-sm text-gray-700">{{ $item->jabatan ? $item->jabatan->name : 'Jabatan Tidak Ditemukan' }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-sm text-gray-700">{{ Str::limit($item->deskripsi, 50) }}</span>
                            </td>
                            <td class="px-6 py-4 text-right space-x-2">
                                <button type="button" onclick="editProfilPegawai({{ $item->id }})" class="inline-flex items-center px-3 py-1.5 bg-amber-50 text-amber-600 hover:bg-amber-100 rounded-lg text-xs font-semibold transition-colors">Edit</button>
                                <button type="button" onclick="deleteProfilPegawai({{ $item->id }}, '{{ $item->nama }}')" class="inline-flex items-center px-3 py-1.5 bg-red-50 text-red-600 hover:bg-red-100 rounded-lg text-xs font-semibold transition-colors">Hapus</button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-10 text-center text-gray-400 italic text-sm">Belum ada data profil pegawai.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
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
                <button type="button" onclick="closeModal('editProfilPegawaiModal')" class="flex-1 px-4 py-2.5 border-2 border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 font-semibold transition-colors">Batal</button>
                <button type="submit" class="flex-1 px-4 py-2.5 bg-gradient-to-r from-indigo-500 to-indigo-600 text-white rounded-lg hover:from-indigo-600 hover:to-indigo-700 font-semibold transition-colors flex items-center justify-center gap-2">
                    <i class="fas fa-save"></i> Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Delete Profil Pegawai -->
<div id="deleteProfilPegawaiModal" class="fixed inset-0 backdrop-blur-sm bg-black/40 hidden z-50 flex items-center justify-center">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md p-8 transform transition-all">
        <div class="flex justify-center mb-6">
            <div class="w-16 h-16 bg-gradient-to-br from-red-100 to-red-50 rounded-full flex items-center justify-center">
                <i class="fas fa-exclamation-triangle text-red-600 text-3xl"></i>
            </div>
        </div>
        
        <h3 class="text-2xl font-bold text-center text-gray-900 mb-2">Hapus Profil Pegawai?</h3>
        
        <div class="bg-red-50 border-l-4 border-red-500 rounded-lg p-4 mb-6">
            <p class="text-gray-700 text-center">
                Yakin ingin menghapus profil <br>
                <strong id="delete-nama" class="text-red-600 text-lg">nama pegawai</strong>?
            </p>
            <p class="text-sm text-gray-500 text-center mt-2">
                <i class="fas fa-info-circle mr-1"></i>
                Data dan foto akan dihapus secara permanen
            </p>
        </div>
        
        <div class="flex gap-3 justify-center">
            <button type="button" onclick="closeModal('deleteProfilPegawaiModal')" class="px-6 py-2.5 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 font-semibold transition-all duration-200 flex-1">
                Batal
            </button>
            <button type="button" id="confirmDeleteBtn" class="px-6 py-2.5 bg-gradient-to-r from-red-500 to-red-600 text-white rounded-lg hover:from-red-600 hover:to-red-700 font-semibold transition-all duration-200 flex-1 flex items-center justify-center gap-2">
                <i class="fas fa-trash-alt"></i> Hapus Sekarang
            </button>
        </div>
    </div>
</div>

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

    function deleteProfilPegawai(id, nama) {
        const modal = document.getElementById('deleteProfilPegawaiModal');
        const deleteNama = document.getElementById('delete-nama');
        
        deleteNama.textContent = nama;
        modal.classList.remove('hidden');
        
        // Set action button
        document.getElementById('confirmDeleteBtn').onclick = function() {
            performDelete(id);
        };
    }
    
    function performDelete(id) {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const modal = document.getElementById('deleteProfilPegawaiModal');
        
        // Show loading state
        const confirmBtn = document.getElementById('confirmDeleteBtn');
        const originalText = confirmBtn.innerText;
        confirmBtn.innerText = 'Menghapus...';
        confirmBtn.disabled = true;
        
        fetch(`/admin/profil-pegawai/${id}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                modal.classList.add('hidden');
                // Show success toast
                showSuccessToast('✓ Profil pegawai berhasil dihapus!');
                setTimeout(() => location.reload(), 1500);
            } else {
                showErrorToast('✗ Gagal menghapus: ' + (data.message || 'Kesalahan tidak diketahui'));
                confirmBtn.innerText = originalText;
                confirmBtn.disabled = false;
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showErrorToast('✗ Terjadi kesalahan saat menghapus data');
            confirmBtn.innerText = originalText;
            confirmBtn.disabled = false;
        });
    }
    
    function showSuccessToast(message) {
        const toast = document.createElement('div');
        toast.className = 'fixed top-6 right-6 bg-gradient-to-r from-green-500 to-green-600 text-white px-6 py-4 rounded-lg shadow-lg flex items-center gap-3 animate-in fade-in slide-in-from-top z-50';
        toast.innerHTML = `<i class="fas fa-check-circle text-lg"></i><span>${message}</span>`;
        document.body.appendChild(toast);
        setTimeout(() => toast.remove(), 3000);
    }
    
    function showErrorToast(message) {
        const toast = document.createElement('div');
        toast.className = 'fixed top-6 right-6 bg-gradient-to-r from-red-500 to-red-600 text-white px-6 py-4 rounded-lg shadow-lg flex items-center gap-3 animate-in fade-in slide-in-from-top z-50';
        toast.innerHTML = `<i class="fas fa-exclamation-circle text-lg"></i><span>${message}</span>`;
        document.body.appendChild(toast);
        setTimeout(() => toast.remove(), 3000);
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
    
    // Make sure delete modal is hidden by default
    const deleteModal = document.getElementById('deleteProfilPegawaiModal');
    if (deleteModal) {
        deleteModal.classList.add('hidden');
        console.log('✅ Delete modal initialized and hidden');
    } else {
        console.error('❌ Delete modal element not found!');
    }
    
    // Verify delete form exists
    const deleteForm = document.getElementById('deleteProfilPegawaiForm');
    if (deleteForm) {
        console.log('✅ Delete form found');
    } else {
        console.error('❌ Delete form not found!');
    }
    
    console.log('✅ All delete functionality ready. Click "Hapus" button to show modal.');
});
</script>
@endsection