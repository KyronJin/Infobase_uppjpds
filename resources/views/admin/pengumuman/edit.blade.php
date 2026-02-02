@extends('layouts.app')

@section('content')
<div class="py-24 bg-white pt-28">
  <div class="max-w-6xl mx-auto px-6">
    <div class="admin-section">
        <div class="flex items-center justify-between mb-6">
            <h1 class="h2">Edit Pengumuman</h1>
            <a href="{{ route('admin.pengumuman.index') }}" class="text-teal-600 hover:underline">← Kembali</a>
        </div>

        <form method="POST" action="{{ route('admin.pengumuman.update', $pengumuman) }}" class="bg-white p-6 rounded-lg shadow">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-gray-700 mb-1">Judul</label>
                <input type="text" name="title" value="{{ $pengumuman->title }}" required class="w-full border rounded px-3 py-2">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 mb-1">Isi Pengumuman</label>
                <textarea name="description" rows="8" required class="w-full border rounded px-3 py-2">{{ $pengumuman->description }}</textarea>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 mb-1">Tanggal Publish</label>
                <input type="datetime-local" name="published_at" value="{{ $pengumuman->published_at?->format('Y-m-d\TH:i') }}" class="w-full border rounded px-3 py-2">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 mb-1">Tanggal Mulai Berlaku</label>
                <input type="date" name="valid_from" value="{{ $pengumuman->valid_from?->format('Y-m-d') }}" class="w-full border rounded px-3 py-2">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 mb-1">Tanggal Akhir Berlaku</label>
                <input type="date" name="valid_until" value="{{ $pengumuman->valid_until?->format('Y-m-d') }}" class="w-full border rounded px-3 py-2">
            </div>

            <div class="flex justify-end space-x-3">
                <a href="{{ route('admin.pengumuman.index') }}" class="px-4 py-2 border border-gray-300 rounded text-gray-700 hover:bg-gray-50">
                    Batal
                </a>
                <button type="submit" class="bg-teal-600 text-white px-6 py-2 rounded hover:bg-teal-700">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
  </div>
</div>
@endsection
                    Batal
                </a>
                <button type="submit" class="bg-teal-600 text-white px-6 py-2 rounded hover:bg-teal-700">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
  </div>
</div>
@endsection

        <div class="form-group">
            <label class="form-label">Judul</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $item->title) }}" required>
        </div>

        <div class="form-group">
            <label class="form-label">Konten</label>
            <textarea name="body" class="form-control" rows="8">{{ old('body', $item->body) }}</textarea>
        </div>

        <div class="form-group">
            <label class="form-label">Tanggal Terbit</label>
            <input type="datetime-local" name="published_at" class="form-control" value="{{ optional($item->published_at)->format('Y-m-d\TH:i') }}">
        </div>

        <div class="form-group">
            <label class="inline-flex items-center">
                <input type="checkbox" name="is_active" {{ $item->is_active ? 'checked' : '' }}>
                <span class="ml-2">Aktif</span>
            </label>
        </div>

            <div>
                <button class="form-submit">Simpan</button>
                <a href="{{ route('admin.pengumuman.index') }}" class="inline-block ml-3">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
