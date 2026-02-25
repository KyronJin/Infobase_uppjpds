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
                    <h1 class="text-2xl sm:text-3xl font-bold text-[#063A76]">Tambah Konten Baru</h1>
                    <p class="text-sm text-slate-500 mt-1">Buat section halaman about baru</p>
                </div>
            </div>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-5 sm:p-8 lg:p-10">
            @if($errors->any())
                <div class="mb-6 bg-red-50 border border-red-200 rounded-lg p-4">
                    <p class="text-red-700 font-semibold mb-2">⚠️ Terjadi kesalahan:</p>
                    <ul class="text-red-600 text-sm list-disc list-inside space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.about.store') }}" method="POST" id="aboutCreateForm" class="space-y-8">
                @csrf
                
                <!-- Key/Slug -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Kunci Unik (Key) *</label>
                    <input type="text" name="key" 
                        class="w-full px-4 py-3 border {{ $errors->has('key') ? 'border-red-300' : 'border-slate-300' }} rounded-xl focus:outline-none focus:ring-2 focus:ring-[#063A76] focus:border-[#063A76] transition-all" 
                        value="{{ old('key') }}" 
                        placeholder="misal: tentang_perpustakaan, sejarah_kami, dll" 
                        required>
                    <p class="text-xs text-slate-500 mt-1">💡 Gunakan huruf kecil dan garis bawah, tanpa spasi. Ini untuk identitas unik konten.</p>
                    @error('key')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Judul -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Judul *</label>
                    <input type="text" name="title" 
                        class="w-full px-4 py-3 border {{ $errors->has('title') ? 'border-red-300' : 'border-slate-300' }} rounded-xl focus:outline-none focus:ring-2 focus:ring-[#063A76] focus:border-[#063A76] transition-all" 
                        value="{{ old('title') }}" 
                        placeholder="Masukkan judul section" 
                        required>
                    @error('title')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Konten dengan Quill Editor -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Konten *</label>
                    <div id="editor-content" class="border border-slate-300 rounded-xl shadow-sm" style="overflow: hidden; min-height: 300px;">
                        {!! old('content', '') !!}
                    </div>
                    <textarea name="content" id="content" class="editor hidden" placeholder="Ketik konten di sini..."></textarea>
                    @error('content')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Form Actions -->
                <div class="flex gap-4 pt-6 border-t border-slate-200">
                    <button type="submit" class="inline-flex items-center justify-center gap-2 px-6 py-3 text-white font-semibold rounded-lg bg-[#063A76] hover:bg-[#052A57] transition-colors" id="submitBtn">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        <span>Buat Konten</span>
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
