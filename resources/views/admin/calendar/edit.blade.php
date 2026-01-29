@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 py-12">
    <div class="admin-section">
        <h1 class="admin-header">Edit Event</h1>

        <form action="{{ route('admin.calendar.update', $item) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label class="form-label">Judul</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $item->title) }}" required>
        </div>

        <div class="form-group">
            <label class="form-label">Deskripsi</label>
            <textarea name="description" class="form-control" rows="6">{{ old('description', $item->description) }}</textarea>
        </div>

        <div class="form-group">
            <label class="form-label">Mulai (datetime)</label>
            <input type="datetime-local" name="start_at" class="form-control" value="{{ optional($item->start_at)->format('Y-m-d\TH:i') }}">
        </div>

        <div class="form-group">
            <label class="form-label">Selesai (datetime)</label>
            <input type="datetime-local" name="end_at" class="form-control" value="{{ optional($item->end_at)->format('Y-m-d\TH:i') }}">
        </div>

        <div class="form-group">
            <label class="form-label">Lokasi</label>
            <input type="text" name="location" class="form-control" value="{{ old('location', $item->location) }}">
        </div>

        <div class="form-group">
            <label class="inline-flex items-center">
                <input type="checkbox" name="is_active" {{ $item->is_active ? 'checked' : '' }}>
                <span class="ml-2">Aktif</span>
            </label>
        </div>

            <div>
                <button class="form-submit">Simpan</button>
                <a href="{{ route('admin.calendar.index') }}" class="inline-block ml-3">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
