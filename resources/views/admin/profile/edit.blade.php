@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 py-12">
    <div class="admin-section">
        <h1 class="admin-header">Edit Profile Ruangan</h1>

        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.profile.update', $profile_ruangan) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label class="form-label">Nama Ruangan</label>
                <input type="text" name="room_name" class="form-control" value="{{ old('room_name', $profile_ruangan->room_name) }}" required>
            </div>

            <div class="form-group">
                <label class="form-label">Lantai</label>
                <input type="number" name="floor" class="form-control" min="1" max="7" value="{{ old('floor', $profile_ruangan->floor) }}">
            </div>

            <div class="form-group">
                <label class="form-label">Kapasitas</label>
                <input type="number" name="capacity" class="form-control" value="{{ old('capacity', $profile_ruangan->capacity) }}">
            </div>

            <div class="form-group">
                <label class="form-label">Deskripsi</label>
                <textarea name="description" class="form-control" rows="6">{{ old('description', $profile_ruangan->description) }}</textarea>
            </div>

            <div class="form-group">
                <label class="form-label">Gambar Ruangan</label>
                <input type="file" name="images[]" class="form-control" accept="image/*" multiple>
                <small class="text-gray-500">Anda dapat memilih multiple gambar. Biarkan kosong jika tidak ingin mengubah.</small>
            </div>

            @if($profile_ruangan->images && count($profile_ruangan->images) > 0)
                <div class="form-group">
                    <label class="form-label">Gambar yang Ada</label>
                    <div class="grid grid-cols-3 gap-4">
                        @foreach($profile_ruangan->images as $image)
                            <div class="relative border rounded p-2">
                                <img src="{{ Storage::url($image->image_path) }}" alt="Room image" class="w-full h-32 object-cover rounded">
                                <form action="{{ route('admin.profile.deleteImage', $image->id) }}" method="POST" style="position: absolute; top: 0; right: 0;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded text-sm" onclick="return confirm('Delete image?')">Hapus</button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <div class="form-group">
                <label class="form-label inline-flex items-center">
                    <input type="checkbox" name="is_active" class="mr-2" value="1" {{ $profile_ruangan->is_active ? 'checked' : '' }}>
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
