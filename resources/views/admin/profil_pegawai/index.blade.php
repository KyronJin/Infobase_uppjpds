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
                <h1 class="h2 text-gray-800">Manajemen Profil Pegawai</h1>
                <p class="text-sm text-gray-500">Kelola profil pegawai perpustakaan di sini.</p>
            </div>
            <div class="flex gap-4 mt-4 md:mt-0">
                <button onclick="openModal('orderModal')" class="inline-flex items-center px-5 py-2.5 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-xl transition-all duration-200 shadow-lg shadow-green-100">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path></svg>
                    Atur Posisi Jabatan
                </button>
                <div class="relative">
                    <button id="dropdownButton" class="inline-flex items-center px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-xl transition-all duration-200 shadow-lg shadow-indigo-100">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        Tambah
                    </button>
                    <div id="dropdownMenu" class="absolute right-0 mt-2 w-56 bg-white border border-gray-200 rounded-xl shadow-lg z-10 hidden">
                        <button type="button" onclick="openModal('jabatanModal'); return false;" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Tambah Jabatan</button>
                        <button type="button" onclick="openModal('profilPegawaiModal'); return false;" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Tambah Profil Pegawai</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Jabatan -->
        <div id="jabatanModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50 flex items-center justify-center">
            <div class="relative bg-white border border-gray-200 rounded-lg shadow-lg w-96 p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-medium text-gray-900">Tambah Jabatan</h3>
                    <button type="button" onclick="closeModal('jabatanModal')" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
                <form action="{{ route('admin.profil_pegawai.store-jabatan') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Nama Jabatan</label>
                        <input type="text" name="name" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required>
                    </div>
                    <div class="flex justify-end gap-3">
                        <button type="button" onclick="closeModal('jabatanModal')" class="px-4 py-2 bg-gray-300 text-gray-900 rounded-md hover:bg-gray-400">Batal</button>
                        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Simpan</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal Profil Pegawai -->
        <div id="profilPegawaiModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50 flex items-center justify-center">
            <div class="relative bg-white border border-gray-200 rounded-lg shadow-lg w-96 p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-medium text-gray-900">Tambah Profil Pegawai</h3>
                    <button type="button" onclick="closeModal('profilPegawaiModal')" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
                <form action="{{ route('admin.profil_pegawai.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Nama Pegawai</label>
                        <input type="text" name="nama" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Jabatan</label>
                        <select name="jabatan_id" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required>
                            <option value="">-- Pilih Jabatan --</option>
                            @foreach($jabatans as $j)
                                <option value="{{ $j->id }}">{{ $j->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Deskripsi</label>
                        <textarea name="deskripsi" rows="3" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required></textarea>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Foto Pegawai</label>
                        <input type="file" name="foto" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" accept="image/*">
                    </div>
                    <div class="flex justify-end gap-3">
                        <button type="button" onclick="closeModal('profilPegawaiModal')" class="px-4 py-2 bg-gray-300 text-gray-900 rounded-md hover:bg-gray-400">Batal</button>
                        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Simpan</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal Atur Posisi Jabatan -->
        <div id="orderModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50 flex items-center justify-center">
            <div class="relative bg-white border border-gray-200 rounded-lg shadow-lg w-96 p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-medium text-gray-900">Atur Posisi Jabatan</h3>
                    <button type="button" onclick="closeModal('orderModal')" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
                <p class="text-sm text-gray-600 mb-4">Drag jabatan untuk mengatur urutan (atas = posisi tertinggi).</p>
                <ul id="sortable" class="space-y-2">
                    @foreach($jabatans->sortBy('order') as $jabatan)
                        <li class="bg-gray-100 p-3 rounded-md cursor-move" data-id="{{ $jabatan->id }}">
                            {{ $jabatan->name }}
                        </li>
                    @endforeach
                </ul>
                <div class="flex justify-end gap-3 mt-4">
                    <button type="button" onclick="closeModal('orderModal')" class="px-4 py-2 bg-gray-300 text-gray-900 rounded-md hover:bg-gray-400">Batal</button>
                    <button id="saveOrder" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Simpan</button>
                </div>
            </div>
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
                                <a href="{{ route('admin.profil_pegawai.edit', $item) }}" class="inline-flex items-center px-3 py-1.5 bg-amber-50 text-amber-600 hover:bg-amber-100 rounded-lg text-xs font-semibold transition-colors">Edit</a>
                                <form action="{{ route('admin.profil_pegawai.destroy', $item) }}" method="POST" class="inline-block">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-red-50 text-red-600 hover:bg-red-100 rounded-lg text-xs font-semibold transition-colors" onclick="return confirm('Hapus?')">Hapus</button>
                                </form>
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
    
    document.getElementById('dropdownButton').addEventListener('click', function() {
        document.getElementById('dropdownMenu').classList.toggle('hidden');
    });
    
    // Close modal when clicking outside
    window.onclick = function(event) {
        const jabatanModal = document.getElementById('jabatanModal');
        const profilPegawaiModal = document.getElementById('profilPegawaiModal');
        const orderModal = document.getElementById('orderModal');
        
        if (event.target == jabatanModal) {
            jabatanModal.classList.add('hidden');
        }
        if (event.target == profilPegawaiModal) {
            profilPegawaiModal.classList.add('hidden');
        }
        if (event.target == orderModal) {
            orderModal.classList.add('hidden');
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
@endsection