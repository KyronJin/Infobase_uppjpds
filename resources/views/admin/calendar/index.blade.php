@extends('layouts.app')

@section('content')
<div class="py-24 bg-white pt-28">
  <div class="max-w-6xl mx-auto px-6">
    <div class="admin-section">
        <div class="flex items-center justify-between mb-6">
            <h1 class="h2">Daftar Calendar Events</h1>
            <button onclick="openCreateModal()" class="admin-button">Buat Event</button>
        </div>

        @if(session('success'))
            <div class="content-box mb-4">{{ session('success') }}</div>
        @endif

        <div class="grid gap-4">
            @foreach($items as $item)
                    <div class="p-4 bg-white rounded-lg shadow-sm">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="h3">{{ $item->title }}</h3>
                            <p class="text-sm text-gray-600">{{ $item->start_at?->format('d M Y H:i') ?? '-' }} @if($item->location) • {{ $item->location }} @endif</p>
                        </div>
                        <div class="flex gap-2">
                            <button onclick="editCalendarEvent({{ $item->id }})" class="inline-block px-3 py-1 border rounded hover:bg-gray-50">Edit</button>
                            <button onclick="deleteCalendarEvent({{ $item->id }}, '{{ $item->title }}')" class="inline-block px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700">Hapus</button>
                        </div>
                    </div>
                    <div class="mt-3 text-gray-700">{!! nl2br(e($item->description)) !!}</div>
                </div>
            @endforeach
        </div>

        <div class="mt-6">{{ $items->links() }}</div>

        <!-- Modal Create Event -->
        <div id="createCalendarModal" class="fixed inset-0 backdrop-blur-sm bg-white/30 hidden z-50 flex items-center justify-center">
            <div class="flex items-center justify-center min-h-screen p-4">
                <div class="bg-white rounded-lg max-w-2xl w-full max-h-[90vh] overflow-y-auto">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-xl font-bold text-gray-900">Buat Event</h3>
                            <button onclick="closeModal('createCalendarModal')" class="text-gray-400 hover:text-gray-600">
                                <i class="fas fa-times text-xl"></i>
                            </button>
                        </div>
                        <form action="{{ route('admin.calendar.store') }}" method="POST" class="grid grid-cols-2 gap-4">
                            @csrf
                            <div class="col-span-2">
                                <label class="block text-gray-700 font-semibold mb-2">Judul <span class="text-red-500">*</span></label>
                                <input type="text" name="title" required class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500">
                            </div>
                            <div class="col-span-2">
                                <label class="block text-gray-700 font-semibold mb-2">Deskripsi</label>
                                <textarea name="description" rows="3" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500"></textarea>
                            </div>
                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">Mulai</label>
                                <input type="datetime-local" name="start_at" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500">
                            </div>
                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">Selesai</label>
                                <input type="datetime-local" name="end_at" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500">
                            </div>
                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">Lokasi</label>
                                <input type="text" name="location" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500">
                            </div>
                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">Kapasitas</label>
                                <input type="number" name="capacity" min="0" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500">
                            </div>
                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">Jumlah Peserta</label>
                                <input type="number" name="participants" min="0" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500">
                            </div>
                            <div>
                                <label class="flex items-center text-gray-700 font-semibold">
                                    <input type="checkbox" name="is_active" value="1" checked class="w-4 h-4 text-teal-600 rounded focus:ring-2 focus:ring-teal-500 mr-2">
                                    Aktif
                                </label>
                            </div>
                            <div class="col-span-2 flex justify-end gap-3 pt-4">
                                <button type="button" onclick="closeModal('createCalendarModal')" class="px-4 py-2 border border-gray-300 rounded text-gray-700 hover:bg-gray-50 font-semibold transition-colors">
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

        <!-- Modal Edit Event -->
        <div id="editCalendarModal" class="fixed inset-0 backdrop-blur-sm bg-white/30 hidden z-50 flex items-center justify-center">
            <div class="flex items-center justify-center min-h-screen p-4">
                <div class="bg-white rounded-lg max-w-2xl w-full max-h-[90vh] overflow-y-auto">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-xl font-bold text-gray-900">Edit Event</h3>
                            <button onclick="closeModal('editCalendarModal')" class="text-gray-400 hover:text-gray-600">
                                <i class="fas fa-times text-xl"></i>
                            </button>
                        </div>
                        <form id="editCalendarForm" method="POST" class="grid grid-cols-2 gap-4">
                            @csrf
                            @method('PUT')
                            <div class="col-span-2">
                                <label class="block text-gray-700 font-semibold mb-2">Judul <span class="text-red-500">*</span></label>
                                <input type="text" id="edit-title" name="title" required class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500">
                            </div>
                            <div class="col-span-2">
                                <label class="block text-gray-700 font-semibold mb-2">Deskripsi</label>
                                <textarea id="edit-description" name="description" rows="3" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500"></textarea>
                            </div>
                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">Mulai</label>
                                <input type="datetime-local" id="edit-start_at" name="start_at" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500">
                            </div>
                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">Selesai</label>
                                <input type="datetime-local" id="edit-end_at" name="end_at" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500">
                            </div>
                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">Lokasi</label>
                                <input type="text" id="edit-location" name="location" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500">
                            </div>
                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">Kapasitas</label>
                                <input type="number" id="edit-capacity" name="capacity" min="0" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500">
                            </div>
                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">Jumlah Peserta</label>
                                <input type="number" id="edit-participants" name="participants" min="0" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500">
                            </div>
                            <div>
                                <label class="flex items-center text-gray-700 font-semibold">
                                    <input type="checkbox" id="edit-is_active" name="is_active" value="1" class="w-4 h-4 text-teal-600 rounded focus:ring-2 focus:ring-teal-500 mr-2">
                                    Aktif
                                </label>
                            </div>
                            <div class="col-span-2 flex justify-end gap-3 pt-4">
                                <button type="button" onclick="closeModal('editCalendarModal')" class="px-4 py-2 border border-gray-300 rounded text-gray-700 hover:bg-gray-50 font-semibold transition-colors">
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

        <!-- Modal Delete Event -->
        <div id="deleteCalendarModal" class="fixed inset-0 backdrop-blur-sm bg-white/30 hidden z-50 flex items-center justify-center">
            <div class="flex items-center justify-center min-h-screen p-4">
                <div class="bg-white rounded-lg max-w-lg w-full">
                    <div class="p-8">
                        <div class="flex items-center justify-center w-16 h-16 mx-auto bg-red-100 rounded-full mb-6">
                            <i class="fas fa-exclamation-triangle text-red-600 text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 text-center mb-3">Hapus Event?</h3>
                        <p class="text-gray-700 text-center mb-2 text-lg font-semibold" id="delete-event-title"></p>
                        <p class="text-sm text-gray-500 text-center mb-8">Tindakan ini tidak dapat dibatalkan.</p>
                        
                        <form id="deleteCalendarForm" method="POST" class="space-y-0">
                            @csrf
                            @method('DELETE')
                            
                            <div class="flex gap-4">
                                <button type="button" onclick="closeModal('deleteCalendarModal')" class="flex-1 px-5 py-3 border-2 border-gray-300 rounded text-gray-700 hover:bg-gray-50 font-semibold transition-colors text-lg">
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
</div>

<script>
function openCreateModal() {
    document.getElementById('createCalendarModal').classList.remove('hidden');
}

function closeModal(id) {
    document.getElementById(id).classList.add('hidden');
}

function editCalendarEvent(id) {
    const modal = document.getElementById('editCalendarModal');
    const form = document.getElementById('editCalendarForm');
    
    fetch(`/admin/calendar/${id}/edit`, {
        headers: {
            'Accept': 'application/json',
        }
    })
    .then(response => response.json())
    .then(data => {
        document.getElementById('edit-title').value = data.title || '';
        document.getElementById('edit-description').value = data.description || '';
        document.getElementById('edit-start_at').value = data.start_at || '';
        document.getElementById('edit-end_at').value = data.end_at || '';
        document.getElementById('edit-location').value = data.location || '';
        document.getElementById('edit-capacity').value = data.capacity || '';
        document.getElementById('edit-participants').value = data.participants || '';
        document.getElementById('edit-is_active').checked = data.is_active || false;
        form.action = `/admin/calendar/${id}`;
        modal.classList.remove('hidden');
    })
    .catch(error => console.error('Error:', error));
}

function deleteCalendarEvent(id, title) {
    const modal = document.getElementById('deleteCalendarModal');
    const form = document.getElementById('deleteCalendarForm');
    document.getElementById('delete-event-title').textContent = `Yakin ingin menghapus "${title}"?`;
    form.action = `/admin/calendar/${id}`;
    modal.classList.remove('hidden');
}

// Close modals when clicking outside
document.getElementById('createCalendarModal')?.addEventListener('click', function(e) {
    if (e.target === this) closeModal('createCalendarModal');
});

document.getElementById('editCalendarModal')?.addEventListener('click', function(e) {
    if (e.target === this) closeModal('editCalendarModal');
});

document.getElementById('deleteCalendarModal')?.addEventListener('click', function(e) {
    if (e.target === this) closeModal('deleteCalendarModal');
});
</script>
@endsection

