@extends('layouts.app')

@section('content')
<div class="bg-[#f8fafc] min-h-screen py-6 sm:py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="mb-6 sm:mb-8 bg-white border border-slate-200 rounded-2xl p-5 sm:p-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl sm:text-3xl font-bold text-[#063A76]">Kelola Halaman About</h1>
                <p class="text-slate-600 mt-1">Edit konten halaman tentang kami</p>
            </div>
            <a href="{{ route('admin.about.create') }}" class="inline-flex items-center justify-center gap-2 px-5 py-3 text-white font-semibold rounded-xl bg-[#063A76] hover:bg-[#052A57] transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Tambah Konten Baru
            </a>
        </div>

        @if(session('success'))
            <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-6 py-4 rounded-lg">
                <p class="font-semibold">{{ session('success') }}</p>
            </div>
        @endif

        @if($abouts->count() > 0)
            <div class="space-y-4">
                @foreach($abouts as $about)
                    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 hover:shadow-md transition-shadow">
                        <div class="flex items-start gap-6 p-6">
                            <div class="flex-1">
                                <div class="flex items-center gap-3 mb-2">
                                    <h3 class="text-lg font-semibold text-[#063A76]">{{ $about->title }}</h3>
                                    <span class="text-xs px-2.5 py-1 rounded-full bg-slate-200 text-slate-700 font-mono">{{ $about->key }}</span>
                                </div>
                                <p class="text-slate-600 mt-2 line-clamp-2">{{ strip_tags($about->content) }}</p>
                                <div class="flex items-center gap-2 mt-3">
                                    <span class="text-xs px-3 py-1 rounded-full {{ $about->active ? 'bg-green-100 text-green-700' : 'bg-slate-100 text-slate-700' }}">
                                        {{ $about->active ? '✓ Aktif' : '✗ Tidak Aktif' }}
                                    </span>
                                    <span class="text-xs text-slate-500">
                                        Diupdate: {{ $about->updated_at->format('d M Y H:i') }}
                                    </span>
                                </div>
                            </div>
                            <div class="flex-shrink-0 flex gap-2">
                                <a href="{{ route('admin.about.edit', $about) }}" class="inline-flex items-center justify-center gap-2 px-4 py-2.5 text-white font-semibold rounded-lg bg-blue-600 hover:bg-blue-700 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    Edit
                                </a>
                                <button type="button" onclick="openDeleteModal('deleteAboutModal', '{{ addslashes($about->title) }}', '/admin/about/{{ $about->id }}')" class="inline-flex items-center justify-center gap-2 px-4 py-2.5 text-white font-semibold rounded-lg bg-red-600 hover:bg-red-700 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    Hapus
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-12 text-center">
                <svg class="w-16 h-16 mx-auto text-slate-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                <p class="text-slate-600 text-lg font-semibold">Belum ada konten about</p>
                <p class="text-slate-500 mt-1">Mulai dengan membuat konten pertama atau buat default content.</p>
                <div class="mt-6 flex gap-3 justify-center">
                    <a href="{{ route('admin.about.create') }}" class="px-6 py-3 bg-[#063A76] text-white font-semibold rounded-lg hover:bg-[#052A57] transition-colors inline-flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        Buat Konten Baru
                    </a>
                    <form action="{{ route('admin.about.create-defaults') }}" method="POST" class="inline-block">
                        @csrf
                        <button type="submit" class="px-6 py-3 bg-slate-200 text-slate-700 font-semibold rounded-lg hover:bg-slate-300 transition-colors inline-flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            Buat Konten Default
                        </button>
                    </form>
                </div>
            </div>
        @endif
    </div>
</div>

<!-- Delete Modal -->
@component('components.delete-modal', ['id' => 'deleteAboutModal', 'title' => 'Hapus Konten About?']) @endcomponent

@endsection
