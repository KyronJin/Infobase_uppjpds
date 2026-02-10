@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen py-12 pt-28">
    <div class="max-w-6xl mx-auto px-6">
        <!-- Header dengan Navigation -->
        <div class="mb-8">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center gap-3">
                    <a href="{{ route('admin.tata_tertib.index') }}" class="inline-flex items-center justify-center w-10 h-10 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors" title="Kembali">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                    </a>
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">Buat Tata Tertib Baru</h1>
                        <p class="text-sm text-gray-600 mt-1">Tambahkan peraturan atau panduan operasional baru</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8">
            @if($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-700 px-6 py-4 rounded-lg mb-6">
                    <h3 class="font-semibold mb-2">Terjadi Kesalahan:</h3>
                    <ul class="list-disc list-inside space-y-1">
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
                    <select name="jenis_tata_tertib_id" class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('jenis_tata_tertib_id') border-red-500 @enderror" required>
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

                <!-- Isi Konten -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Isi Tata Tertib *</label>
                    <div id="editor-content" class="border border-gray-300 rounded-lg shadow-sm" style="border-radius: 0.5rem; overflow: hidden; min-height: 300px;"></div>
                    <textarea name="content" id="content" class="editor hidden" placeholder="Ketik isi tata tertib di sini..." required>{{ old('content') }}</textarea>
                    @error('content')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Link Dokumen -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Link Dokumen</label>
                    <input type="url" name="document_link" class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('document_link') border-red-500 @enderror" value="{{ old('document_link') }}" placeholder="https://example.com/dokumen">
                    @error('document_link')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Status -->
                <div>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" checked class="w-4 h-4 text-blue-600 rounded focus:ring-2 focus:ring-blue-500">
                        <span class="text-sm font-semibold text-gray-700">Aktifkan Tata Tertib</span>
                    </label>
                </div>

                <!-- Action Buttons -->
                <div class="flex gap-3 pt-6 border-t border-gray-200">
                    <a href="{{ route('admin.tata_tertib.index') }}" class="flex-1 px-6 py-3 bg-gray-200 text-gray-800 font-medium rounded-lg hover:bg-gray-300 transition-colors text-center">
                        Batal
                    </a>
                    <button type="submit" class="flex-1 px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        Buat Tata Tertib
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
