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
                <button id="dropdownButton" class="inline-flex items-center px-5 py-2.5 bg-orange-500 hover:bg-orange-600 text-white text-sm font-semibold rounded-lg transition-all duration-200 shadow-sm hover:shadow-md gap-2">
                    <i class="fas fa-plus"></i>
                    Tambah
                </button>
                <div id="dropdownMenu" class="absolute right-0 mt-2 w-56 bg-white border border-gray-200 rounded-xl shadow-lg z-10 hidden">
                    <button type="button" onclick="openModal('jenisModal'); return false;" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Tambah Jenis Tata Tertib</button>
                    <a href="{{ route('admin.tata_tertib.create') }}" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Tambah Tata Tertib</a>
                </div>
            </div>
        </div>

        <!-- Modal Jenis Tata Tertib -->
        <div id="jenisModal" class="fixed inset-0 backdrop-blur-sm bg-white/30 overflow-y-auto h-full w-full hidden z-50 flex items-center justify-center p-4">
            <div class="relative bg-white border border-gray-200 rounded-lg shadow-lg w-full max-w-md max-h-[85vh] flex flex-col">
                <!-- Header -->
                <div class="flex justify-between items-center p-6 border-b border-gray-200 flex-shrink-0">
                    <h3 class="text-lg font-medium text-gray-900">Kelola Jenis Tata Tertib</h3>
                    <button type="button" onclick="closeModal('jenisModal')" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>

                <!-- Form Tambah Jenis Baru -->
                <div class="border-b border-gray-200 p-6 bg-gray-50 flex-shrink-0">
                    <h4 class="text-sm font-semibold text-gray-700 mb-3">Tambah Jenis Baru</h4>
                    <form action="{{ route('admin.tata_tertib.store-jenis') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Jenis</label>
                            <input type="text" name="name" placeholder="Masukkan nama jenis tata tertib" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 text-sm" required>
                        </div>
                        <div class="flex justify-end gap-3">
                            <x-button variant="secondary" size="md" type="button" onclick="closeModal('jenisModal')">Batal</x-button>
                            <x-button variant="primary" size="md" type="submit">Simpan</x-button>
                        </div>
                    </form>
                </div>

                <!-- Scrollable List Section (Shows ~4 items, then scroll) -->
                <div class="overflow-y-auto flex-grow px-6 py-4 min-h-0">
                    <h4 class="text-sm font-semibold text-gray-700 mb-3">Daftar Jenis</h4>
                    <div class="space-y-2">
                        @forelse($jenis as $item)
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg border border-gray-200 hover:bg-gray-100 transition-colors">
                                <div class="flex-1">
                                    <p class="font-medium text-gray-800 text-sm">{{ $item->name }}</p>
                                    <p class="text-xs text-gray-500">{{ $item->tataTertibs->count() }} item{{ $item->tataTertibs->count() !== 1 ? 's' : '' }}</p>
                                </div>
                                <x-button variant="ghost-danger" size="sm" type="button" onclick="openDeleteModal('deleteJenisModal', '{{ $item->name }}', '/admin/tata-tertib/jenis/{{ $item->id }}')" icon="trash">
                                    Hapus
                                </x-button>
                            </div>
                        @empty
                            <p class="text-center text-gray-400 text-sm py-4">Belum ada jenis tata tertib</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <!-- Delete Modals -->
        @component('components.delete-modal', ['id' => 'deleteJenisModal', 'title' => 'Hapus Jenis Tata Tertib?']) @endcomponent
        @component('components.delete-modal', ['id' => 'deleteTataTertibModal', 'title' => 'Hapus Tata Tertib?']) @endcomponent

        <!-- Modal Edit Tata Tertib -->
        <div id="editTataTertibModal" class="fixed inset-0 backdrop-blur-sm bg-black/40 overflow-y-auto hidden z-50 flex items-center justify-center p-4">
            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg p-8">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-12 h-12 bg-orange-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-edit text-orange-600 text-lg"></i>
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold text-gray-900">Edit Tata Tertib</h3>
                        <p class="text-sm text-gray-500">Perbarui peraturan perpustakaan</p>
                    </div>
                    <button type="button" onclick="closeModal('editTataTertibModal')" class="ml-auto text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times text-2xl"></i>
                    </button>
                </div>
                
                <form id="editTataTertibForm" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')
                    
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Jenis Tata Tertib</label>
                        <select id="edit-jenis_id" name="jenis_tata_tertib_id" required class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-orange-500 transition-colors">
                            <option value="">-- Pilih Jenis --</option>
                            @foreach($jenis as $j)
                                <option value="{{ $j->id }}">{{ $j->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Konten</label>
                        <textarea id="edit-content" name="content" rows="4" placeholder="Masukkan isi peraturan" required class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-orange-500 transition-colors"></textarea>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Status</label>
                        <select id="edit-is_active" name="is_active" required class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-orange-500 transition-colors">
                            <option value="1">Aktif</option>
                            <option value="0">Tidak Aktif</option>
                        </select>
                    </div>
                    
                    <div class="flex gap-3 pt-4">
                        <x-button variant="secondary" size="md" class="flex-1 justify-center" type="button" onclick="closeModal('editTataTertibModal')">Batal</x-button>
                        <x-button variant="primary" size="md" icon="check" class="flex-1 justify-center bg-orange-500 hover:bg-orange-600 border-none" type="submit">Simpan Perubahan</x-button>
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
                <x-button variant="primary" size="md" type="submit">
                    <i class="fas fa-search mr-2"></i>Cari
                </x-button>
                @if(!empty($search))
                    <x-button variant="secondary" size="md" type="link" href="{{ route('admin.tata_tertib.index') }}">
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
                                <span class="text-sm text-gray-700">{{ Str::limit(strip_tags($item->content), 60) }}</span>
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
                                <x-button variant="ghost" size="sm" icon="edit" onclick="editTataTertib({{ $item->id }})">Edit</x-button>
                                <x-button variant="ghost-danger" size="sm" icon="trash" onclick="openDeleteModal('deleteTataTertibModal', '{{ $item->jenisTataTertib->name }}', '/admin/tata-tertib/{{ $item->id }}')">Hapus</x-button>
                                </div>
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

    </div>
</div>

<script>
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
            document.getElementById('edit-jenis_id').value = data.jenis_tata_tertib_id || '';
            document.getElementById('edit-content').value = data.content || '';
            document.getElementById('edit-is_active').value = data.is_active !== undefined ? data.is_active : '1';
            form.action = `/admin/tata-tertib/${id}`;
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
        const jenisModal = document.getElementById('jenisModal');
        const editTataTertibModal = document.getElementById('editTataTertibModal');
        if (event.target == jenisModal) {
            jenisModal.classList.add('hidden');
        }
        if (event.target == editTataTertibModal) {
            editTataTertibModal.classList.add('hidden');
        }
    }

    // Setup delete modals for click outside
    setupDeleteModalClickOutside('deleteJenisModal');
    setupDeleteModalClickOutside('deleteTataTertibModal');
</script>
@endsection
