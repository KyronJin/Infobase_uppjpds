@extends('layouts.app')

@section('content')
<div class="bg-[#f8fafc] min-h-screen py-6 sm:py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6">
        <!-- Header -->
        <div class="mb-6 sm:mb-8">
            <div class="flex items-center gap-3 mb-4">
                <a href="{{ route('admin.tata_tertib.index') }}" class="inline-flex items-center justify-center w-10 h-10 bg-white border border-slate-200 text-[#063A76] rounded-xl hover:bg-slate-50 transition-colors" title="Kembali">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                </a>
                <div>
                    <h1 class="text-2xl sm:text-3xl font-bold text-[#063A76]">Buat Tata Tertib Baru</h1>
                    <p class="text-sm text-slate-600 mt-1">Tambahkan peraturan atau panduan operasional baru dengan format WYSIWYG</p>
                </div>
            </div>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-5 sm:p-8">
            @if($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-700 px-6 py-4 rounded-lg mb-6">
                    <h3 class="font-semibold mb-2">Terjadi Kesalahan:</h3>
                    <ul class="list-disc list-inside space-y-1 text-sm">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.tata_tertib.store') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Jenis Tata Tertib -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Jenis Tata Tertib *</label>
                    <select name="jenis_tata_tertib_id" class="w-full px-4 py-3 border border-slate-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-[#063A76] focus:border-[#063A76] @error('jenis_tata_tertib_id') border-red-500 @enderror" required>
                        <option value="">-- Pilih Jenis Tata Tertib --</option>
                        @foreach($jenis as $item)
                            <option value="{{ $item->id }}" {{ old('jenis_tata_tertib_id') == $item->id ? 'selected' : '' }}>
                                {{ $item->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('jenis_tata_tertib_id')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Isi Konten dengan WYSIWYG Editor -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Isi Tata Tertib * <span class="text-xs font-normal text-gray-500">(Gunakan editor seperti Word di bawah)</span></label>
                    <div id="editor-content" class="border border-slate-300 rounded-xl shadow-sm bg-white overflow-hidden" style="min-height: 350px;"></div>
                    <textarea name="content" id="content" class="editor hidden" required>{{ old('content') }}</textarea>
                    @error('content')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Status -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Status *</label>
                    <select name="is_active" class="w-full px-4 py-3 border border-slate-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-[#063A76] focus:border-[#063A76] @error('is_active') border-red-500 @enderror" required>
                        <option value="">-- Pilih Status --</option>
                        <option value="1" {{ old('is_active', '1') == '1' ? 'selected' : '' }}>✓ Aktif</option>
                        <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>✗ Tidak Aktif</option>
                    </select>
                    @error('is_active')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Action Buttons -->
                <div class="flex gap-3 pt-6 border-t border-gray-200">
                    <x-button variant="secondary" size="lg" type="link" href="{{ route('admin.tata_tertib.index') }}">Batal</x-button>
                    <x-button variant="primary" size="lg" type="submit" icon="check">Buat Tata Tertib</x-button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
