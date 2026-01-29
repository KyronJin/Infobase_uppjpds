@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 py-12">
    <div class="admin-section">
        <h1 class="admin-header">Buat Pengumuman</h1>

        <form action="{{ route('admin.pengumuman.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label class="form-label">Judul</label>
            <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
        </div>

        <div class="form-group">
            <label class="form-label">Konten</label>
            <textarea name="body" class="form-control" rows="8">{{ old('body') }}</textarea>
        </div>

        <div class="form-group">
            <label class="form-label">Tanggal Terbit</label>
            <input type="datetime-local" name="published_at" class="form-control" value="{{ old('published_at') }}">
        </div>

        <div class="form-group">
            <label class="inline-flex items-center">
                <input type="checkbox" name="is_active" checked>
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
