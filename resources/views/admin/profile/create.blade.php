@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 py-12">
    <div class="admin-section">
        <h1 class="admin-header">Buat Profile Ruangan</h1>

        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.profile.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="form-label">Nama Ruangan</label>
                <input type="text" name="room_name" class="form-control" value="{{ old('room_name') }}" required>
            </div>

            <div class="form-group">
                <label class="form-label">Lantai</label>
                <input type="number" name="floor" class="form-control" min="1" max="7" value="{{ old('floor') }}">
            </div>

            <div class="form-group">
                <label class="form-label">Kapasitas</label>
                <input type="number" name="capacity" class="form-control" value="{{ old('capacity') }}">
            </div>

            <div class="form-group">
                <label class="form-label">Deskripsi</label>
                <textarea name="description" class="form-control" rows="6">{{ old('description') }}</textarea>
            </div>

            <div class="form-group">
                <label class="form-label">Gambar Ruangan</label>
                <input type="file" name="images[]" class="form-control" accept="image/*" multiple>
                <small class="text-gray-500">Anda dapat memilih multiple gambar</small>
            </div>

            <div class="form-group">
                <label class="form-label inline-flex items-center">
                    <input type="checkbox" name="is_active" class="mr-2" value="1">
                    Aktif
                </label>
            </div>

            <div>
                <button type="submit" class="form-submit">Simpan</button>
                <a href="{{ route('admin.profile.index') }}" class="inline-block ml-3">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection