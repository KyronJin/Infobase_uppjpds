@extends('layouts.app')

@section('content')
<div class="bg-[#f8fafc] min-h-screen py-6 sm:py-8">
    <div class="max-w-5xl mx-auto px-4 sm:px-6">
        <div class="mb-6 sm:mb-8 flex items-center gap-3">
            <a href="{{ route('admin.staff-of-month.index') }}" class="inline-flex items-center justify-center w-10 h-10 bg-white border border-slate-200 text-[#063A76] rounded-xl hover:bg-slate-50 transition-colors" title="Kembali">
                <i class="fas fa-arrow-left"></i>
            </a>
            <div>
                <h1 class="text-2xl sm:text-3xl font-bold text-[#063A76]">Edit Staff</h1>
                <p class="text-sm text-slate-500">Perbarui data staff of month.</p>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5 sm:p-8">
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

            <form action="{{ route('admin.staff-of-month.update', $item) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap *</label>
                    <input name="name" required class="w-full border border-slate-300 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-[#063A76] @error('name') border-red-500 @enderror" value="{{ old('name', $item->name) }}" placeholder="Nama Lengkap Staff">
                    @error('name')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Posisi / Jabatan *</label>
                    <select name="position" required class="w-full border border-slate-300 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-[#063A76] @error('position') border-red-500 @enderror">
                        <option value="">-- Pilih Posisi --</option>
                        @foreach($jabatans as $jabatan)
                            <option value="{{ $jabatan->name }}" {{ old('position', $item->position) === $jabatan->name ? 'selected' : '' }}>{{ $jabatan->name }}</option>
                        @endforeach
                    </select>
                    @error('position')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Bulan *</label>
                        <input name="month" type="number" min="1" max="12" required class="w-full border border-slate-300 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-[#063A76] @error('month') border-red-500 @enderror" value="{{ old('month', $item->month) }}" placeholder="1-12">
                        @error('month')
                            <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Tahun *</label>
                        <input name="year" type="number" required class="w-full border border-slate-300 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-[#063A76] @error('year') border-red-500 @enderror" value="{{ old('year', $item->year) }}">
                        @error('year')
                            <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Bio</label>
                    <textarea name="bio" rows="4" class="w-full border border-slate-300 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-[#063A76]">{{ old('bio', $item->bio) }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Foto</label>
                    @if($item->photo_path)
                        <img src="{{ asset('storage/' . $item->photo_path) }}" alt="{{ $item->name }}" class="h-32 w-auto rounded border border-gray-300 mb-3">
                    @endif
                    <input type="file" name="photo" accept="image/*" class="w-full border border-slate-300 rounded-xl px-4 py-2.5">
                    <label class="inline-flex items-center gap-2 mt-3 text-sm text-gray-600">
                        <input type="checkbox" name="delete_photo" value="1" class="w-4 h-4 rounded">
                        Hapus foto saat ini
                    </label>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Link Foto Eksternal (Opsional)</label>
                    <input name="photo_link" type="url" class="w-full border border-slate-300 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-[#063A76]" value="{{ old('photo_link', $item->photo_link) }}" placeholder="https://...">
                </div>

                <div>
                    <label class="text-sm font-semibold text-slate-700 inline-flex items-center">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $item->is_active) ? 'checked' : '' }} class="mr-2 w-4 h-4 text-[#063A76] rounded">
                        Aktif
                    </label>
                </div>

                <div class="flex gap-3 pt-6 border-t border-slate-200">
                    <x-button variant="primary" size="lg" type="submit">Simpan</x-button>
                    <x-button variant="secondary" size="lg" type="link" href="{{ route('admin.staff-of-month.index') }}">Batal</x-button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
