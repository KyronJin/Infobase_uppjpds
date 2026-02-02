@extends('layouts.app')

@section('content')
<div class="py-24 bg-white pt-28">
  <div class="max-w-6xl mx-auto px-6">
    <div class="admin-section">
        <div class="flex items-center justify-between mb-6">
            <h1 class="h2">Profile Ruangan</h1>
            <button onclick="openCreateModal()" class="admin-button">Create</button>
        </div>

        <div class="space-y-4">
            @if($items->isEmpty())
                <div class="bg-gray-50 p-8 rounded-lg text-center text-gray-600">
                    Belum ada profile ruangan saat ini
                </div>
            @else
                @foreach($items as $item)
                <div class="flex gap-6 bg-gray-50 p-6 rounded hover:shadow-md transition-shadow">
                    <!-- Badge Lantai -->
                    <div class="flex-shrink-0">
                        <div class="w-24 h-24 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex flex-col items-center justify-center text-white shadow-lg">
                            <div class="text-3xl font-bold">{{ $item->floor ?? '—' }}</div>
                            <div class="text-xs font-semibold uppercase">LANTAI</div>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="flex-1 min-w-0">
                        <h3 class="h3 mb-2 text-gray-800">{{ $item->room_name }}</h3>
                        
                        <div class="grid grid-cols-2 gap-4 mb-3 text-sm">
                            <div>
                                <p class="text-gray-500 font-semibold mb-1">Kapasitas</p>
                                <p class="text-gray-800">{{ $item->capacity ?? '—' }} orang</p>
                            </div>
                            <div>
                                <p class="text-gray-500 font-semibold mb-1">Status</p>
                                <p>
                                    @if($item->is_active)
                                        <span class="inline-block px-2 py-1 bg-green-100 text-green-800 rounded text-xs font-semibold">Aktif</span>
                                    @else
                                        <span class="inline-block px-2 py-1 bg-gray-100 text-gray-800 rounded text-xs font-semibold">Tidak Aktif</span>
                                    @endif
                                </p>
                            </div>
                        </div>

                        <!-- Deskripsi -->
                        @if($item->description)
                        <p class="text-gray-600 text-sm mb-3">{{ Str::limit($item->description, 80) }}</p>
                        @endif
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="flex-shrink-0 flex gap-2 self-center">
                        <button type="button" onclick="editProfileRuangan({{ $item->id }})" class="px-3 py-1.5 bg-amber-50 text-amber-600 hover:bg-amber-100 rounded text-xs font-semibold transition-colors flex items-center gap-1">
                            <i class="fas fa-edit"></i> Edit
                        </button>
                        <button type="button" onclick="deleteProfileRuangan({{ $item->id }}, '{{ $item->room_name }}')" class="px-3 py-1.5 bg-red-50 text-red-600 hover:bg-red-100 rounded text-xs font-semibold transition-colors flex items-center gap-1">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    </div>
                </div>
                @endforeach
            @endif
        </div>

        <!-- Modal Create -->
        <div id="createModal" class="fixed inset-0 backdrop-blur-sm bg-white/30 hidden z-50 flex items-center justify-center">
            <div class="bg-white rounded-lg max-w-lg w-full max-h-[90vh] overflow-y-auto">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-xl font-bold text-gray-900">Buat Profile Ruangan</h3>
                        <button onclick="closeModal('createModal')" class="text-gray-400 hover:text-gray-600">
                            <i class="fas fa-times text-xl"></i>
                        </button>
                    </div>
                    <form action="{{ route('admin.profile.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Nama Ruangan</label>
                            <input type="text" name="room_name" required class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500">
                        </div>
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Lantai</label>
                            <input type="number" name="floor" min="1" max="7" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500">
                        </div>
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Kapasitas</label>
                            <input type="number" name="capacity" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500">
                        </div>
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Deskripsi</label>
                            <textarea name="description" rows="4" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500"></textarea>
                        </div>
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Gambar</label>
                            <input type="file" name="images[]" multiple accept="image/*" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500">
                            <p class="text-xs text-gray-500 mt-1">Maksimal 2MB per file</p>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" name="is_active" checked class="w-4 h-4 text-teal-600 rounded focus:ring-2 focus:ring-teal-500">
                            <label class="ml-2 text-gray-700 font-semibold">Aktif</label>
                        </div>
                        <div class="flex justify-end gap-3 pt-4">
                            <button type="button" onclick="closeModal('createModal')" class="px-4 py-2 border border-gray-300 rounded text-gray-700 hover:bg-gray-50 font-semibold transition-colors">
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

        <!-- Modal Edit -->
        <div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center">
            <div class="bg-white rounded-lg max-w-lg w-full max-h-[90vh] overflow-y-auto">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-xl font-bold text-gray-900">Edit Profile Ruangan</h3>
                        <button onclick="closeModal('editModal')" class="text-gray-400 hover:text-gray-600">
                            <i class="fas fa-times text-xl"></i>
                        </button>
                    </div>
                    <form id="editForm" method="POST" enctype="multipart/form-data" class="space-y-4">
                        @csrf
                        @method('PUT')
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Nama Ruangan</label>
                            <input type="text" id="edit-room_name" name="room_name" required class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500">
                        </div>
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Lantai</label>
                            <input type="number" id="edit-floor" name="floor" min="1" max="7" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500">
                        </div>
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Kapasitas</label>
                            <input type="number" id="edit-capacity" name="capacity" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500">
                        </div>
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Deskripsi</label>
                            <textarea id="edit-description" name="description" rows="4" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500"></textarea>
                        </div>
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Gambar</label>
                            <input type="file" name="images[]" multiple accept="image/*" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500">
                            <p class="text-xs text-gray-500 mt-1">Maksimal 2MB per file - Kosongkan jika tidak ingin mengubah</p>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" id="edit-is_active" name="is_active" class="w-4 h-4 text-teal-600 rounded focus:ring-2 focus:ring-teal-500">
                            <label class="ml-2 text-gray-700 font-semibold">Aktif</label>
                        </div>
                        <div class="flex justify-end gap-3 pt-4">
                            <button type="button" onclick="closeModal('editModal')" class="px-4 py-2 border border-gray-300 rounded text-gray-700 hover:bg-gray-50 font-semibold transition-colors">
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

        <!-- Modal Delete -->
        <div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center">
            <div class="bg-white rounded-lg max-w-lg w-full">
                <div class="p-8">
                    <div class="flex items-center justify-center w-16 h-16 mx-auto bg-red-100 rounded-full mb-6">
                        <i class="fas fa-exclamation-triangle text-red-600 text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 text-center mb-3">Hapus Ruangan?</h3>
                    <p class="text-gray-700 text-center mb-2 text-lg font-semibold" id="delete-room-name"></p>
                    <p class="text-sm text-gray-500 text-center mb-8">Tindakan ini tidak dapat dibatalkan.</p>
                    
                    <form id="deleteForm" method="POST" class="space-y-0">
                        @csrf
                        @method('DELETE')
                        
                        <div class="flex gap-4">
                            <button type="button" onclick="closeModal('deleteModal')" class="flex-1 px-5 py-3 border-2 border-gray-300 rounded text-gray-700 hover:bg-gray-50 font-semibold transition-colors text-lg">
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
</div>

<script>
function openCreateModal() {
    document.getElementById('createModal').classList.remove('hidden');
}

function closeModal(id) {
    document.getElementById(id).classList.add('hidden');
}

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
        modal.classList.remove('hidden');
    })
    .catch(error => console.error('Error:', error));
}

function deleteProfileRuangan(id, roomName) {
    const modal = document.getElementById('deleteModal');
    const form = document.getElementById('deleteForm');
    document.getElementById('delete-room-name').textContent = `Yakin ingin menghapus "${roomName}"?`;
    form.action = `/admin/profile-ruangan/${id}`;
    modal.classList.remove('hidden');
}

// Close modals when clicking outside
document.getElementById('createModal')?.addEventListener('click', function(e) {
    if (e.target === this) closeModal('createModal');
});

document.getElementById('editModal')?.addEventListener('click', function(e) {
    if (e.target === this) closeModal('editModal');
});

document.getElementById('deleteModal')?.addEventListener('click', function(e) {
    if (e.target === this) closeModal('deleteModal');
});
</script>
@endsection


        <!-- Modal Create -->
        <div id="createModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center">
            <div class="bg-white rounded-lg max-w-lg w-full max-h-[90vh] overflow-y-auto">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-xl font-bold text-gray-900">Buat Profile Ruangan</h3>
                        <button onclick="closeModal('createModal')" class="text-gray-400 hover:text-gray-600">
                            <i class="fas fa-times text-xl"></i>
                        </button>
                    </div>
                    <form action="{{ route('admin.profile.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Nama Ruangan</label>
                            <input type="text" name="room_name" required class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500">
                        </div>
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Lantai</label>
                            <input type="number" name="floor" min="1" max="7" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500">
                        </div>
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Kapasitas</label>
                            <input type="number" name="capacity" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500">
                        </div>
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Deskripsi</label>
                            <textarea name="description" rows="4" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500"></textarea>
                        </div>
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Gambar</label>
                            <input type="file" name="images[]" multiple accept="image/*" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500">
                            <p class="text-xs text-gray-500 mt-1">Maksimal 2MB per file</p>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" name="is_active" checked class="w-4 h-4 text-teal-600 rounded focus:ring-2 focus:ring-teal-500">
                            <label class="ml-2 text-gray-700 font-semibold">Aktif</label>
                        </div>
                        <div class="flex justify-end gap-3 pt-4">
                            <button type="button" onclick="closeModal('createModal')" class="px-4 py-2 border border-gray-300 rounded text-gray-700 hover:bg-gray-50 font-semibold transition-colors">
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

        <!-- Modal Edit -->
        <div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center">
            <div class="bg-white rounded-lg max-w-lg w-full max-h-[90vh] overflow-y-auto">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-xl font-bold text-gray-900">Edit Profile Ruangan</h3>
                        <button onclick="closeModal('editModal')" class="text-gray-400 hover:text-gray-600">
                            <i class="fas fa-times text-xl"></i>
                        </button>
                    </div>
                    <form id="editForm" method="POST" enctype="multipart/form-data" class="space-y-4">
                        @csrf
                        @method('PUT')
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Nama Ruangan</label>
                            <input type="text" id="edit-room_name" name="room_name" required class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500">
                        </div>
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Lantai</label>
                            <input type="number" id="edit-floor" name="floor" min="1" max="7" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500">
                        </div>
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Kapasitas</label>
                            <input type="number" id="edit-capacity" name="capacity" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500">
                        </div>
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Deskripsi</label>
                            <textarea id="edit-description" name="description" rows="4" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500"></textarea>
                        </div>
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Gambar</label>
                            <input type="file" name="images[]" multiple accept="image/*" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500">
                            <p class="text-xs text-gray-500 mt-1">Maksimal 2MB per file - Kosongkan jika tidak ingin mengubah</p>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" id="edit-is_active" name="is_active" class="w-4 h-4 text-teal-600 rounded focus:ring-2 focus:ring-teal-500">
                            <label class="ml-2 text-gray-700 font-semibold">Aktif</label>
                        </div>
                        <div class="flex justify-end gap-3 pt-4">
                            <button type="button" onclick="closeModal('editModal')" class="px-4 py-2 border border-gray-300 rounded text-gray-700 hover:bg-gray-50 font-semibold transition-colors">
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

        <!-- Modal Delete -->
        <div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center">
            <div class="bg-white rounded-lg max-w-lg w-full">
                <div class="p-8">
                    <div class="flex items-center justify-center w-16 h-16 mx-auto bg-red-100 rounded-full mb-6">
                        <i class="fas fa-exclamation-triangle text-red-600 text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 text-center mb-3">Hapus Ruangan?</h3>
                    <p class="text-gray-700 text-center mb-2 text-lg font-semibold" id="delete-room-name"></p>
                    <p class="text-sm text-gray-500 text-center mb-8">Tindakan ini tidak dapat dibatalkan.</p>
                    
                    <form id="deleteForm" method="POST" class="space-y-0">
                        @csrf
                        @method('DELETE')
                        
                        <div class="flex gap-4">
                            <button type="button" onclick="closeModal('deleteModal')" class="flex-1 px-5 py-3 border-2 border-gray-300 rounded text-gray-700 hover:bg-gray-50 font-semibold transition-colors text-lg">
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
</div>

<script>
function openCreateModal() {
    document.getElementById('createModal').classList.remove('hidden');
}

function closeModal(id) {
    document.getElementById(id).classList.add('hidden');
}

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
        modal.classList.remove('hidden');
    })
    .catch(error => console.error('Error:', error));
}

function deleteProfileRuangan(id, roomName) {
    const modal = document.getElementById('deleteModal');
    const form = document.getElementById('deleteForm');
    document.getElementById('delete-room-name').textContent = `Yakin ingin menghapus "${roomName}"?`;
    form.action = `/admin/profile-ruangan/${id}`;
    modal.classList.remove('hidden');
}

// Close modals when clicking outside
document.getElementById('createModal')?.addEventListener('click', function(e) {
    if (e.target === this) closeModal('createModal');
});

document.getElementById('editModal')?.addEventListener('click', function(e) {
    if (e.target === this) closeModal('editModal');
});

document.getElementById('deleteModal')?.addEventListener('click', function(e) {
    if (e.target === this) closeModal('deleteModal');
});
</script>
