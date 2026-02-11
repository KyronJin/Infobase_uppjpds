@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen py-12 pt-28">
    <div class="max-w-7xl mx-auto px-6">
        <div class="mb-8 flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Pengumuman</h1>
                <p class="text-gray-600 mt-1">Kelola semua pengumuman organisasi Anda</p>
            </div>
            <a href="{{ route('admin.pengumuman.create') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Buat Pengumuman Baru
            </a>
        </div>

        @if(session('success'))
            <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-6 py-4 rounded-lg">
                <p class="font-semibold">{{ session('success') }}</p>
            </div>
        @endif

        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-8">
            <form action="{{ route('admin.pengumuman.index') }}" method="GET" class="flex flex-wrap gap-4 items-center">
                <div class="flex-1 min-w-64">
                    <input type="text" name="search" value="{{ request('search', '') }}" placeholder="Cari berdasarkan judul atau isi..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <select name="status" class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
                    <option value="">Semua Status</option>
                    <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Aktif</option>
                    <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Tidak Aktif</option>
                </select>
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-medium">Cari</button>
                @if(request('search') || request('status'))
                    <a href="{{ route('admin.pengumuman.index') }}" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400">Reset</a>
                @endif
            </form>
        </div>

        @if($pengumumans->count() > 0)
            <div class="space-y-4">
                @foreach($pengumumans as $item)
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 hover:shadow-md transition-shadow">
                        <div class="flex items-start gap-6 p-6">
                            <div class="flex-shrink-0 pt-1">
                                @if($item->status === 'active')
                                    <span class="inline-flex items-center justify-center w-10 h-10 bg-green-100 text-green-700 rounded-full"></span>
                                @else
                                    <span class="inline-flex items-center justify-center w-10 h-10 bg-gray-200 text-gray-600 rounded-full"></span>
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
                                <p class="text-sm text-gray-600 mb-2">{{ strip_tags($item->description) }}</p>
                                @if($item->published_at)
                                    <p class="text-xs text-gray-500">Publikasi: {{ $item->published_at->timezone('Asia/Jakarta')->format('d M Y H:i') }}</p>
                                @endif
                            </div>
                            <div class="flex items-center gap-2 flex-shrink-0">
                                <a href="{{ route('admin.pengumuman.edit', $item) }}" class="inline-flex items-center justify-center w-9 h-9 text-blue-600 hover:bg-blue-50 rounded transition-colors" title="Edit">Edit</a>
                                <form method="POST" action="{{ route('admin.pengumuman.destroy', $item) }}" style="display:inline;" onsubmit="return confirm('Hapus pengumuman ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center justify-center w-9 h-9 text-red-600 hover:bg-red-50 rounded transition-colors" title="Hapus">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            @if($pengumumans->hasPages())
                <div class="mt-8">{{ $pengumumans->appends(request()->query())->links() }}</div>
            @endif
        @else
            <div class="bg-white rounded-lg border border-gray-200 border-dashed p-12 text-center">
                <p class="text-gray-600 text-lg font-medium mb-4">Belum ada pengumuman</p>
                <a href="{{ route('admin.pengumuman.create') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Buat Pengumuman Baru
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
