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
    <div class="max-w-6xl mx-auto px-6">
        
        <div class="flex flex-col md:flex-row items-center justify-between mb-8 bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
            <div>
                <h1 class="h2 text-gray-800">Manajemen Tata Tertib</h1>
                <p class="text-sm text-gray-500">Kelola daftar peraturan dan tata tertib sekolah di sini.</p>
            </div>
            <div class="relative mt-4 md:mt-0">
                <button id="dropdownButton" class="inline-flex items-center px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-xl transition-all duration-200 shadow-lg shadow-indigo-100">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Tambah
                </button>
                <div id="dropdownMenu" class="absolute right-0 mt-2 w-56 bg-white border border-gray-200 rounded-xl shadow-lg z-10 hidden">
                    <button type="button" onclick="openModal('jenisModal'); return false;" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Tambah Jenis Tata Tertib</button>
                    <button type="button" onclick="openModal('tataTertibModal'); return false;" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Tambah Tata Tertib</button>
                </div>
            </div>
        </div>

        <!-- Modal Jenis Tata Tertib -->
        <div id="jenisModal" class="fixed inset-0 backdrop-blur-sm bg-white/30 overflow-y-auto h-full w-full hidden z-50 flex items-center justify-center">
            <div class="relative bg-white border border-gray-200 rounded-lg shadow-lg w-96 p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-medium text-gray-900">Tambah Jenis Tata Tertib</h3>
                    <button type="button" onclick="closeModal('jenisModal')" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
                <form action="{{ route('admin.tata_tertib.store-jenis') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Jenis Tata Tertib</label>
                        <input type="text" name="name" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required>
                    </div>
                    <div class="flex justify-end gap-3">
                        <button type="button" onclick="closeModal('jenisModal')" class="px-4 py-2 bg-gray-300 text-gray-900 rounded-md hover:bg-gray-400">Batal</button>
                        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Simpan</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal Tata Tertib -->
        <div id="tataTertibModal" class="fixed inset-0 backdrop-blur-sm bg-white/30 overflow-y-auto h-full w-full hidden z-50 flex items-center justify-center">
            <div class="relative bg-white border border-gray-200 rounded-lg shadow-lg w-96 p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-medium text-gray-900">Tambah Tata Tertib</h3>
                    <button type="button" onclick="closeModal('tataTertibModal')" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
                <form action="{{ route('admin.tata_tertib.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Jenis Tata Tertib</label>
                        <select name="jenis_tata_tertib_id" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required>
                            <option value="">-- Pilih Jenis --</option>
                            @foreach($jenis as $j)
                                <option value="{{ $j->id }}">{{ $j->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Isi Tata Tertib (Setiap baris = 1 item)</label>
                        <textarea name="content" id="tataTertibContent" rows="5" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required></textarea>
                        <p class="text-xs text-gray-500 mt-1">Contoh: Tulis setiap poin di baris baru</p>
                    </div>
                    <div class="mb-4 p-3 bg-gray-50 rounded-md border border-gray-200">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Preview:</label>
                        <ol id="tataTertibPreview" class="list-decimal list-inside text-sm text-gray-700 space-y-1">
                            <li class="text-gray-400">Ketik untuk melihat preview poin-poin...</li>
                        </ol>
                    </div>
                    <div class="mb-4">
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="is_active" checked class="mr-2"> 
                            <span class="text-sm text-gray-700">Aktif</span>
                        </label>
                    </div>
                    <div class="flex justify-end gap-3">
                        <button type="button" onclick="closeModal('tataTertibModal')" class="px-4 py-2 bg-gray-300 text-gray-900 rounded-md hover:bg-gray-400">Batal</button>
                        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Simpan</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Search Form -->
        <div class="mb-6 bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
            <form method="GET" action="{{ route('admin.tata_tertib.index') }}" class="flex gap-3">
                <div class="flex-1">
                    <input 
                        type="text" 
                        name="search" 
                        placeholder="Cari tata tertib berdasarkan jenis atau isi..." 
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
                        href="{{ route('admin.tata_tertib.index') }}" 
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
                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-600">Jenis</th>
                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-600">Isi</th>
                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-600 text-center">Status</th>
                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-600 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($items as $item)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-6 py-4">
                                <span class="text-sm font-medium text-gray-700">{{ $item->jenisTataTertib->name }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-sm text-gray-700">{{ Str::limit($item->content, 50) }}</span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if($item->is_active)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Aktif</span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">Non-Aktif</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right space-x-2">
                                <button type="button" onclick="editTataTertib({{ $item->id }})" class="inline-flex items-center px-3 py-1.5 bg-amber-50 text-amber-600 hover:bg-amber-100 rounded-lg text-xs font-semibold transition-colors">Edit</button>
                                <button type="button" onclick="deleteTataTertib({{ $item->id }}, '{{ $item->jenisTataTertib->name }}')" class="inline-flex items-center px-3 py-1.5 bg-red-50 text-red-600 hover:bg-red-100 rounded-lg text-xs font-semibold transition-colors">Hapus</button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-10 text-center text-gray-400 italic text-sm">Belum ada data tata tertib.</td>
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

        <!-- Modal Edit Tata Tertib -->
        <div id="editTataTertibModal" class="fixed inset-0 backdrop-blur-sm bg-white/30 overflow-y-auto h-full w-full hidden z-50 flex items-center justify-center">
            <div class="relative bg-white border border-gray-200 rounded-lg shadow-lg w-96 p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-medium text-gray-900">Edit Tata Tertib</h3>
                    <button type="button" onclick="closeModal('editTataTertibModal')" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
                <form id="editTataTertibForm" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Jenis Tata Tertib</label>
                        <select id="edit-jenis_tata_tertib_id" name="jenis_tata_tertib_id" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required>
                            <option value="">-- Pilih Jenis --</option>
                            @foreach($jenis as $j)
                                <option value="{{ $j->id }}">{{ $j->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Isi Tata Tertib</label>
                        <textarea id="edit-content" name="content" rows="5" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required></textarea>
                        <p class="text-xs text-gray-500 mt-1">Contoh: Tulis setiap poin di baris baru</p>
                    </div>
                    <div class="mb-4 p-3 bg-gray-50 rounded-md border border-gray-200">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Preview:</label>
                        <ol id="editTataTertibPreview" class="list-decimal list-inside text-sm text-gray-700 space-y-1">
                            <li class="text-gray-400">Ketik untuk melihat preview poin-poin...</li>
                        </ol>
                    </div>
                    <div>
                        <label class="inline-flex items-center">
                            <input id="edit-is_active" type="checkbox" name="is_active" class="mr-2"> 
                            <span class="text-sm text-gray-700">Aktif</span>
                        </label>
                    </div>
                    <div class="flex justify-end gap-3">
                        <button type="button" onclick="closeModal('editTataTertibModal')" class="px-4 py-2 bg-gray-300 text-gray-900 rounded-md hover:bg-gray-400">Batal</button>
                        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Simpan</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal Delete Tata Tertib -->
        <div id="deleteTataTertibModal" class="fixed inset-0 backdrop-blur-sm bg-white/30 overflow-y-auto h-full w-full hidden z-50 flex items-center justify-center">
            <div class="relative bg-white border border-gray-200 rounded-lg shadow-lg w-96 p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-medium text-gray-900">Hapus Tata Tertib</h3>
                    <button type="button" onclick="closeModal('deleteTataTertibModal')" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
                <p class="text-gray-700 mb-4">Yakin ingin menghapus tata tertib "<span id="delete-jenis-name"></span>"?</p>
                <form id="deleteTataTertibForm" method="POST" class="space-y-0">
                    @csrf
                    @method('DELETE')
                    <div class="flex justify-end gap-3">
                        <button type="button" onclick="closeModal('deleteTataTertibModal')" class="px-4 py-2 bg-gray-300 text-gray-900 rounded-md hover:bg-gray-400">Batal</button>
                        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Function to update preview
    function updatePreview(textareaId, previewId) {
        const textarea = document.getElementById(textareaId);
        const preview = document.getElementById(previewId);
        
        if (!textarea || !preview) return;
        
        const lines = textarea.value.trim().split('\n').filter(line => line.trim() !== '');
        
        if (lines.length === 0) {
            preview.innerHTML = '<li class="text-gray-400">Ketik untuk melihat preview poin-poin...</li>';
            return;
        }
        
        preview.innerHTML = lines.map(line => `<li>${line.trim()}</li>`).join('');
    }
    
    // Add event listeners for create modal
    const createContentTextarea = document.getElementById('tataTertibContent');
    if (createContentTextarea) {
        createContentTextarea.addEventListener('input', function() {
            updatePreview('tataTertibContent', 'tataTertibPreview');
        });
    }
    
    // Add event listeners for edit modal
    const editContentTextarea = document.getElementById('edit-content');
    if (editContentTextarea) {
        editContentTextarea.addEventListener('input', function() {
            updatePreview('edit-content', 'editTataTertibPreview');
        });
    }
    
    function openModal(id) {
        document.getElementById(id).classList.remove('hidden');
        document.getElementById('dropdownMenu').classList.add('hidden');
    }
    
    function closeModal(id) {
        document.getElementById(id).classList.add('hidden');
    }

    function editTataTertib(id) {
        const modal = document.getElementById('editTataTertibModal');
        const form = document.getElementById('editTataTertibForm');
        
        fetch(`/admin/tata-tertib/${id}/edit`, {
            headers: {
                'Accept': 'application/json',
            }
        })
        .then(response => response.json())
        .then(data => {
            document.getElementById('edit-jenis_tata_tertib_id').value = data.jenis_tata_tertib_id || '';
            document.getElementById('edit-content').value = data.content || '';
            document.getElementById('edit-is_active').checked = data.is_active || false;
            form.action = `/admin/tata-tertib/${id}`;
            modal.classList.remove('hidden');
            // Update preview setelah modal ditampilkan
            updatePreview('edit-content', 'editTataTertibPreview');
        })
        .catch(error => console.error('Error:', error));
    }

    function deleteTataTertib(id, jenisName) {
        const modal = document.getElementById('deleteTataTertibModal');
        const form = document.getElementById('deleteTataTertibForm');
        document.getElementById('delete-jenis-name').textContent = jenisName;
        form.action = `/admin/tata-tertib/${id}`;
        modal.classList.remove('hidden');
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
        const jenisModal = document.getElementById('jenisModal');
        const tataTertibModal = document.getElementById('tataTertibModal');
        const editTataTertibModal = document.getElementById('editTataTertibModal');
        const deleteTataTertibModal = document.getElementById('deleteTataTertibModal');
        
        if (event.target == jenisModal) {
            jenisModal.classList.add('hidden');
        }
        if (event.target == tataTertibModal) {
            tataTertibModal.classList.add('hidden');
        }
        if (event.target == editTataTertibModal) {
            editTataTertibModal.classList.add('hidden');
        }
        if (event.target == deleteTataTertibModal) {
            deleteTataTertibModal.classList.add('hidden');
        }
    }
</script>
@endsection