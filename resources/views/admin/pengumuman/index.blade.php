@extends('layouts.app')

@section('content')
<div class="bg-[#f8fafc] min-h-screen py-6 sm:py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="mb-6 sm:mb-8 bg-white border border-slate-200 rounded-2xl p-5 sm:p-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl sm:text-3xl font-bold text-[#063A76]">Pengumuman</h1>
                <p class="text-slate-600 mt-1">Kelola semua pengumuman organisasi Anda</p>
            </div>
            <a href="{{ route('admin.pengumuman.create') }}" class="inline-flex items-center justify-center gap-2 px-5 py-3 text-white font-semibold rounded-xl bg-[#063A76] hover:bg-[#052A57] transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Buat Pengumuman Baru
            </a>
        </div>

        @if(session('success'))
            <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-6 py-4 rounded-lg">
                <p class="font-semibold">{{ session('success') }}</p>
            </div>
        @endif

        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-5 sm:p-6 mb-6 sm:mb-8">
            <form action="{{ route('admin.pengumuman.index') }}" method="GET" class="flex flex-wrap gap-4 items-center">
                <div class="flex-1 min-w-[220px]">
                    <input type="text" name="search" value="{{ request('search', '') }}" placeholder="Cari berdasarkan judul atau isi..."
                        class="w-full px-4 py-2.5 border border-slate-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#063A76] focus:border-[#063A76]">
                </div>
                <select name="status" class="px-4 py-2.5 border border-slate-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#063A76] focus:border-[#063A76] bg-white">
                    <option value="">Semua Status</option>
                    <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>✓ Aktif</option>
                    <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>✗ Tidak Aktif</option>
                </select>
                <button type="submit" class="px-6 py-2.5 text-white rounded-xl font-semibold bg-[#063A76] hover:bg-[#052A57] transition-colors">
                    Cari
                </button>
                @if(request('search') || request('status'))
                    <a href="{{ route('admin.pengumuman.index') }}" class="px-4 py-2.5 text-slate-700 rounded-xl bg-slate-100 hover:bg-slate-200 transition-colors">
                        Reset
                    </a>
                @endif
            </form>
        </div>

        @if($pengumumans->count() > 0)
            <div class="space-y-4">
                @foreach($pengumumans as $item)
                    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 hover:shadow-md transition-shadow">
                        <div class="flex items-start gap-6 p-6">
                            <div class="flex-shrink-0 pt-1">
                                @if($item->status === 'active')
                                    <span class="inline-flex items-center justify-center w-10 h-10 bg-green-100 text-green-700 rounded-full text-lg">✓</span>
                                @else
                                    <span class="inline-flex items-center justify-center w-10 h-10 bg-gray-200 text-gray-600 rounded-full text-lg">✗</span>
                                @endif
                            </div>

                            <div class="flex-1 min-w-0">
                                <div class="flex items-baseline gap-3 mb-2">
                                    <h3 class="text-lg font-semibold text-gray-900">{{ $item->title }}</h3>
                                    @if($item->status === 'active')
                                        <span class="text-xs font-medium px-2.5 py-0.5 bg-green-100 text-green-800 rounded-full">AKTIF</span>
                                    @else
                                        <span class="text-xs font-medium px-2.5 py-0.5 bg-gray-100 text-gray-800 rounded-full">NONAKTIF</span>
                                    @endif
                                </div>
                                <p class="text-sm text-gray-600 mb-2 line-clamp-2">{{ strip_tags($item->description) }}</p>
                                @if($item->published_at)
                                    <p class="text-xs text-gray-500">Publikasi: {{ $item->published_at->timezone('Asia/Jakarta')->format('d M Y H:i') }}</p>
                                @endif
                            </div>

                            <div class="flex items-center gap-2 flex-shrink-0">
                                <a href="{{ route('admin.pengumuman.edit', $item) }}" class="w-9 h-9 flex items-center justify-center text-white rounded-lg bg-[#063A76] hover:bg-[#052A57] transition-colors" title="Edit">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path></svg>
                                </a>
                                <button type="button" class="w-9 h-9 flex items-center justify-center text-white rounded" style="background-color: #E83B2B;" onmouseover="this.style.backgroundColor='#D62B1C'" onmouseout="this.style.backgroundColor='#E83B2B'" title="Hapus"
                                    onclick="openDeleteModal('deletePengumumanModal', '{{ addslashes($item->title) }}', '/admin/pengumuman/{{ $item->id }}')">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if($pengumumans->hasPages())
                <div class="mt-8">
                    {{ $pengumumans->appends(request()->query())->links() }}
                </div>
            @endif
        @else
            <div class="bg-white rounded-2xl border border-slate-200 border-dashed p-12 text-center">
                <p class="text-gray-600 text-lg font-medium mb-4">Belum ada pengumuman</p>
                <a href="{{ route('admin.pengumuman.create') }}" class="inline-flex items-center gap-2 px-6 py-3 text-white rounded-xl bg-[#063A76] hover:bg-[#052A57] transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Buat Pengumuman Baru
                </a>
            </div>
        @endif
    </div>
</div>

<!-- Delete Modal -->
@component('components.delete-modal', ['id' => 'deletePengumumanModal', 'title' => 'Hapus Pengumuman?']) @endcomponent

@endsection
