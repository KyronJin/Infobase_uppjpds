@extends('layouts.app')

@section('content')
<div class="bg-[#f8fafc] min-h-screen py-6 sm:py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6">
        <div class="mb-6 sm:mb-8 flex items-center gap-3">
            <a href="{{ route('admin.calendar.index') }}" class="inline-flex items-center justify-center w-10 h-10 bg-white border border-slate-200 text-[#063A76] rounded-xl hover:bg-slate-50 transition-colors" title="Kembali">
                <i class="fas fa-arrow-left"></i>
            </a>
            <div>
                <h1 class="text-2xl sm:text-3xl font-bold text-[#063A76]">Edit Event</h1>
                <p class="text-sm text-slate-500">Perbarui data event kalender.</p>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5 sm:p-8">

        <form action="{{ route('admin.calendar.update', $item) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-5">
            <label class="block text-sm font-semibold text-slate-700 mb-2">Judul</label>
            <input type="text" name="title" class="w-full border border-slate-300 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-[#063A76]" value="{{ old('title', $item->title) }}" required>
        </div>

        <div class="mb-5">
            <label class="block text-sm font-semibold text-slate-700 mb-2">Deskripsi</label>
            <textarea name="description" class="w-full border border-slate-300 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-[#063A76]" rows="6">{{ old('description', $item->description) }}</textarea>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-5">
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Mulai (datetime)</label>
                <input type="datetime-local" name="start_at" class="w-full border border-slate-300 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-[#063A76]" value="{{ optional($item->start_at)->format('Y-m-d\TH:i') }}">
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Selesai (datetime)</label>
                <input type="datetime-local" name="end_at" class="w-full border border-slate-300 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-[#063A76]" value="{{ optional($item->end_at)->format('Y-m-d\TH:i') }}">
            </div>
        </div>

        <div class="mb-5">
            <label class="block text-sm font-semibold text-slate-700 mb-2">Lokasi</label>
            <input type="text" name="location" class="w-full border border-slate-300 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-[#063A76]" value="{{ old('location', $item->location) }}">
        </div>

        <div class="mb-6">
            <label class="inline-flex items-center">
                <input type="checkbox" name="is_active" {{ $item->is_active ? 'checked' : '' }} class="w-4 h-4 text-[#063A76] rounded focus:ring-[#063A76]">
                <span class="ml-2">Aktif</span>
            </label>
        </div>

            <div class="flex gap-3">
                <x-button variant="primary" size="lg">Simpan</x-button>
                <x-button variant="secondary" size="lg" type="link" href="{{ route('admin.calendar.index') }}">Batal</x-button>
            </div>
        </form>
    </div>
</div>
</div>
@endsection
