@extends('layouts.app')

@section('content')
<div class="bg-[#f8fafc] min-h-screen py-6 sm:py-8 font-cairo">
    <div class="max-w-6xl mx-auto px-4 sm:px-6">
        
        <div class="flex flex-col md:flex-row items-center justify-between mb-8 bg-white p-5 sm:p-6 rounded-2xl shadow-sm border border-slate-200">
            <div>
                <h1 class="h2 text-[#063A76]">Profile Ruangan</h1>
                <p class="text-sm text-slate-500">Kelola informasi dan fasilitas ruangan di sini.</p>
            </div>
            <x-button variant="primary" size="lg" type="link" href="{{ route('admin.profile.create') }}" icon="plus">Buat Ruangan Baru</x-button>
        </div>

        @if(session('success'))
            <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-6 py-4 rounded-2xl flex items-center gap-2 animate-in fade-in slide-in-from-top duration-300">
                <i class="fas fa-check-circle text-green-500"></i>
                <span class="font-bold">{{ session('success') }}</span>
            </div>
        @endif

        <!-- Search Form -->
        <div class="mb-6 bg-white p-5 sm:p-6 rounded-2xl shadow-sm border border-slate-200">
            <form method="GET" action="{{ route('admin.profile.index') }}" class="flex gap-3">
                <div class="flex-1">
                    <input 
                        type="text" 
                        name="search" 
                        placeholder="Cari ruangan berdasarkan nama, lantai, atau deskripsi..." 
                        value="{{ $search ?? '' }}"
                        class="w-full px-4 py-2.5 border border-slate-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#063A76] focus:border-[#063A76]"
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
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden text-sm">
            <table class="w-full text-left border-collapse">
                <thead class="bg-slate-50 border-b border-slate-100 font-bold">
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
                                    @if($item->images->count() > 3)
                                        <div class="w-12 h-12 rounded-lg bg-slate-100 ring-2 ring-white shadow-sm flex items-center justify-center text-[10px] font-bold text-slate-600">
                                            +{{ $item->images->count() - 3 }}
                                        </div>
                                    @endif
                                    @if($item->images->count() == 0)
                                        <div class="w-12 h-12 rounded-lg bg-gray-50 flex items-center justify-center text-gray-300 border-2 border-dashed border-gray-100 text-[8px] font-bold">—</div>
                                    @endif
                                </div>
                                @if($item->images->count() > 3)
                                    <p class="text-[10px] text-slate-500 mt-1">{{ $item->images->count() - 3 }} lainnya</p>
                                @endif
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
                                    <x-button variant="ghost" size="sm" icon="edit" type="link" href="{{ route('admin.profile.edit', $item) }}">Edit</x-button>
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

        <!-- Modal Delete -->
        @component('components.delete-modal', ['id' => 'deleteProfileRuanganModal', 'title' => 'Hapus Profile Ruangan?']) @endcomponent
    </div>
</div>

<script>
// Setup Click-Outside Handler for Delete Modal
setupDeleteModalClickOutside('deleteProfileRuanganModal');
</script>

@endsection
