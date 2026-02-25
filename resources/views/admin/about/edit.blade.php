@extends('layouts.app')

@section('content')
<div class="bg-[#f8fafc] min-h-screen py-6 sm:py-8 font-cairo">
    <div class="max-w-6xl mx-auto px-4 sm:px-6">
        <!-- Header -->
        <div class="mb-6 sm:mb-8">
            <div class="flex items-center gap-4 mb-4">
                <a href="{{ route('admin.about.index') }}" class="inline-flex items-center justify-center w-10 h-10 bg-white border border-slate-200 text-[#063A76] rounded-xl hover:bg-slate-50 transition-colors shadow-sm" title="Kembali">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                </a>
                <div>
                    <h1 class="text-2xl sm:text-3xl font-bold text-[#063A76]">Edit Halaman About</h1>
                    <p class="text-sm text-slate-500 mt-1">{{ $about->title }}</p>
                </div>
            </div>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-5 sm:p-8 lg:p-10">
            <form action="{{ route('admin.about.update', $about) }}" method="POST" class="space-y-8" id="aboutEditForm">
                @csrf
                @method('PUT')
                
                <!-- Judul -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Judul *</label>
                    <input type="text" name="title" class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#063A76] focus:border-[#063A76] transition-all" value="{{ old('title', $about->title) }}" placeholder="Masukkan judul section" required>
                    @error('title')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Konten dengan Quill Editor -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Konten *</label>
                    <div id="editor-content" class="border border-slate-300 rounded-xl shadow-sm" style="overflow: hidden; min-height: 300px;">
                        {!! $about->content !!}
                    </div>
                    <textarea name="content" id="content" class="editor hidden" placeholder="Ketik konten di sini...">{!! old('content', $about->content) !!}</textarea>
                    @error('content')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Form Actions -->
                <div class="flex gap-4 pt-6 border-t border-slate-200">
                    <button type="submit" class="inline-flex items-center justify-center gap-2 px-6 py-3 text-white font-semibold rounded-lg bg-[#063A76] hover:bg-[#052A57] transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Simpan Perubahan
                    </button>
                    <a href="{{ route('admin.about.index') }}" class="inline-flex items-center justify-center gap-2 px-6 py-3 text-slate-700 font-semibold rounded-lg bg-slate-100 hover:bg-slate-200 transition-colors">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
