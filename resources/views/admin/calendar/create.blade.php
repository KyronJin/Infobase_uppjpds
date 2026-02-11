@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 py-12">
    <div class="admin-section">
        <h1 class="admin-header">Buat Event</h1>

        <form action="{{ route('admin.calendar.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label class="form-label">Judul</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="form-group">
            <label class="form-label">Deskripsi</label>
            <textarea name="description" class="form-control" rows="6"></textarea>
        </div>

        <div class="form-group">
            <label class="form-label">Mulai (datetime)</label>
            <input type="datetime-local" name="start_at" class="form-control">
        </div>

        <div class="form-group">
            <label class="form-label">Selesai (datetime)</label>
            <input type="datetime-local" name="end_at" class="form-control">
        </div>

        <div class="form-group">
            <label class="form-label">Lokasi</label>
            <input type="text" name="location" class="form-control">
        </div>

        <div class="form-group">
            <label class="inline-flex items-center">
                <input type="checkbox" name="is_active" checked>
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
@endsection
