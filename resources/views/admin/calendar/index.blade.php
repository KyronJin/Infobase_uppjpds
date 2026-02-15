@extends('layouts.app')

@section('content')
<div class="bg-[#f8fafc] min-h-screen py-6 sm:py-8 font-cairo">
    <div class="max-w-6xl mx-auto px-4 sm:px-6">
        
        <div class="flex flex-col md:flex-row items-center justify-between mb-8 bg-white p-5 sm:p-6 rounded-2xl shadow-sm border border-slate-200">
            <div>
                <h1 class="h2 text-[#063A76]">Kalender Event</h1>
                <p class="text-sm text-slate-500">Kelola agenda kegiatan dan jadwal event perpustakaan.</p>
            </div>
            <div class="flex gap-2 mt-3 md:mt-0">
                <x-button variant="primary" size="md" type="link" href="{{ route('admin.agenda.login') }}" icon="right-to-bracket">Login AgendaCerdas   </x-button>
            </div>
        </div>

        <div class="mb-6 bg-blue-50 border border-blue-200 text-blue-800 px-4 py-3 rounded-xl flex items-center gap-3">
            <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'%3E%3Cpath fill='%2360A5FA' d='M13 20v-4h4.001v4H13zm-6 0v-4h4v4H7zm-6 0v-4h4v4H1zm12-6v-4h4v4h-4zm-6 0v-4h4v4H7zm-6 0v-4h4v4H1zm18-6V3.999h4V8h-4zm0 6v-4h4v4h-4zm-6-6V3.999h4.001V8H13zM7 8V3.999h4V8H7z'/%3E%3C/svg%3E" alt="AgendaCerdas" class="w-6 h-6">
            <span class="text-sm font-semibold">Terintegrasi dengan AgendaCerdas</span>
        </div>

        @if(session('success'))
            <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 rounded-xl mb-6 flex items-center gap-3">
                <i class="fas fa-check-circle text-green-500"></i>
                <span class="font-bold">{{ session('success') }}</span>
            </div>
        @endif

        <!-- Daftar Calendar Events -->
        <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden mb-8 text-sm">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-slate-50 border-b border-slate-100 font-bold text-slate-500">
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
                        <tr class="hover:bg-slate-50 transition-all duration-300">
                            <td class="px-8 py-4">
                                <div class="font-black text-gray-900 text-base leading-tight">{{ $item->title }}</div>
                                <div class="text-[10px] text-gray-400 font-medium italic truncate max-w-[200px]">{{ $item->description }}</div>
                            </td>
                            <td class="px-8 py-4">
                                <div class="flex flex-col">
                                    <span class="text-[11px] font-black uppercase text-[#063A76]">{{ $item->start_at?->translatedFormat('d F Y') ?? '-' }}</span>
                                    <span class="text-[10px] font-bold text-gray-400 tracking-tighter">{{ $item->start_at?->format('H:i') ?? '-' }} WIB</span>
                                </div>
                            </td>
                            <td class="px-8 py-4">
                                <div class="flex items-center gap-2">
                                    <i class="fas fa-map-marker-alt text-[10px] text-[#063A76]"></i>
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
                                <div class="flex items-center justify-end">
                                    <button type="button" onclick="openInfoModal('infoReadOnlyModal')" class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-blue-100 text-blue-600 hover:bg-blue-200 transition-colors" title="Info">
                                        <i class="fas fa-info text-sm"></i>
                                    </button>
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
        <!-- Info Read-Only Modal -->
        <div id="infoReadOnlyModal" class="fixed inset-0 backdrop-blur-sm bg-slate-900/40 hidden z-50 flex items-center justify-center">
            <div class="flex items-center justify-center min-h-screen p-4">
                <div class="bg-white rounded-2xl max-w-md w-full shadow-xl">
                    <div class="p-6 text-center">
                        <div class="flex justify-center mb-4">
                            <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-lock text-blue-600 text-xl"></i>
                            </div>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Read-Only</h3>
                        <p class="text-gray-600 mb-6">Hanya bisa dihapus dan diedit di <span class="font-semibold">AgendaCerdas</span></p>
                        
                        <!-- AgendaCerdas Branding -->
                        <div class="flex items-center justify-center gap-2 p-3 bg-blue-50 rounded-xl border border-blue-200 mb-4">
                            <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'%3E%3Cpath fill='%2360A5FA' d='M13 20v-4h4.001v4H13zm-6 0v-4h4v4H7zm-6 0v-4h4v4H1zm12-6v-4h4v4h-4zm-6 0v-4h4v4H7zm-6 0v-4h4v4H1zm18-6V3.999h4V8h-4zm0 6v-4h4v4h-4zm-6-6V3.999h4.001V8H13zM7 8V3.999h4V8H7z'/%3E%3C/svg%3E" alt="AgendaCerdas" class="w-5 h-5">
                            <span class="text-xs font-semibold text-blue-700">AgendaCerdas</span>
                        </div>
                        
                        <button onclick="closeModal('infoReadOnlyModal')" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 px-4 rounded-xl transition-colors">
                            Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function closeModal(id) {
    document.getElementById(id).classList.add('hidden');
}

function openInfoModal(id) {
    document.getElementById(id).classList.remove('hidden');
}

// Close modals when clicking outside
document.getElementById('infoReadOnlyModal')?.addEventListener('click', function(e) {
    if (e.target === this) closeModal('infoReadOnlyModal');
});
</script>

@endsection

