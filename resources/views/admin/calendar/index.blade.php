@extends('layouts.app')

@section('content')
<div class="py-24 bg-white pt-28 font-cairo">
  <div class="max-w-6xl mx-auto px-6">
    <div class="admin-section">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-10">
            <div>
                <h1 class="text-3xl font-black text-gray-900 tracking-tight">Calendar Events</h1>
                <p class="text-gray-500 text-sm mt-1">Kelola agenda kegiatan dan jadwal event perpustakaan.</p>
            </div>
            <x-button variant="primary" size="md" icon="plus" onclick="openCreateModal()" class="rounded-2xl font-bold shadow-teal-100 shadow-lg">Buat Event</x-button>
        </div>

        @if(session('success'))
            <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 rounded-xl mb-6 flex items-center gap-3">
                <i class="fas fa-check-circle text-green-500"></i>
                <span class="font-bold">{{ session('success') }}</span>
            </div>
        @endif

        <!-- Daftar Calendar Events -->
        <div class="bg-white rounded-3xl shadow-xl shadow-gray-200/50 border border-gray-100 overflow-hidden mb-8 text-sm">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-50/80 border-b border-gray-100 font-bold text-gray-400">
                        <tr>
                            <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest">Event</th>
                            <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest">Jadwal</th>
                            <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest">Lokasi</th>
                            <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest text-center">Peserta</th>
                            <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest text-center">Status</th>
                            <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 text-gray-600">
                        @forelse($items as $item)
                        <tr class="hover:bg-teal-50/30 transition-all duration-300">
                            <td class="px-8 py-4">
                                <div class="font-black text-gray-900 text-base leading-tight">{{ $item->title }}</div>
                                <div class="text-[10px] text-gray-400 font-medium italic truncate max-w-[200px]">{{ $item->description }}</div>
                            </td>
                            <td class="px-8 py-4">
                                <div class="flex flex-col">
                                    <span class="text-[11px] font-black uppercase text-teal-600">{{ $item->start_at?->translatedFormat('d F Y') ?? '-' }}</span>
                                    <span class="text-[10px] font-bold text-gray-400 tracking-tighter">{{ $item->start_at?->format('H:i') ?? '-' }} WIB</span>
                                </div>
                            </td>
                            <td class="px-8 py-4">
                                <div class="flex items-center gap-2">
                                    <i class="fas fa-map-marker-alt text-[10px] text-teal-400"></i>
                                    <span class="font-bold text-xs">{{ $item->location ?? '-' }}</span>
                                </div>
                            </td>
                            <td class="px-8 py-4 text-center whitespace-nowrap">
                                <span class="bg-gray-100 px-3 py-1 rounded-full text-[10px] font-black text-gray-600 border border-gray-200">
                                    {{ $item->participants ?? 0 }} / {{ $item->capacity ?? '∞' }}
                                </span>
                            </td>
                            <td class="px-8 py-4 text-center">
                                @if($item->is_active)
                                    <span class="inline-flex items-center px-4 py-1 rounded-full text-[10px] font-black tracking-widest bg-green-100 text-green-700 border border-green-200 uppercase">AKTIF</span>
                                @else
                                    <span class="inline-flex items-center px-4 py-1 rounded-full text-[10px] font-black tracking-widest bg-gray-100 text-gray-500 border border-gray-200 uppercase">OFF</span>
                                @endif
                            </td>
                            <td class="px-8 py-4 whitespace-nowrap">
                                <div class="flex items-center justify-end gap-2">
                                    <x-button variant="ghost" size="sm" icon="edit" class="rounded-xl hover:bg-orange-50 hover:text-orange-600 font-bold" onclick="editCalendarEvent({{ $item->id }})">Edit</x-button>
                                    <x-button variant="ghost-danger" size="sm" icon="trash" class="rounded-xl font-bold" onclick="openDeleteModal('deleteCalendarModal', '{{ $item->title }}', '/admin/calendar/{{ $item->id }}')">Hapus</x-button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-8 py-20 text-center">
                                <div class="flex flex-col items-center text-gray-200">
                                    <i class="fas fa-calendar-alt text-6xl mb-4"></i>
                                    <p class="text-gray-400 italic font-medium">Belum ada calendar events.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            @if($items->hasPages())
                <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">
                    {{ $items->links() }}
                </div>
            @endif
        </div>


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
                                <x-button variant="secondary" size="md" type="button" onclick="closeModal('createCalendarModal')">Batal</x-button>
                                <x-button variant="primary" size="md" type="submit">Simpan</x-button>
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
                                <x-button variant="secondary" size="md" type="button" onclick="closeModal('editCalendarModal')">Batal</x-button>
                                <x-button variant="primary" size="md" type="submit">Simpan</x-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Delete Modal Component -->
        @component('components.delete-modal', ['id' => 'deleteCalendarModal', 'title' => 'Hapus Calendar Event?']) @endcomponent
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



// Close modals when clicking outside
document.getElementById('createCalendarModal')?.addEventListener('click', function(e) {
    if (e.target === this) closeModal('createCalendarModal');
});

document.getElementById('editCalendarModal')?.addEventListener('click', function(e) {
    if (e.target === this) closeModal('editCalendarModal');
});

// Setup Click-Outside Handler for Delete Modal
setupDeleteModalClickOutside('deleteCalendarModal');
</script>

<script>
    setupDeleteModalClickOutside('deleteCalendarModal');
</script>
@endsection

