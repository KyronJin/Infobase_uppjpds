@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 py-12">
    <div class="admin-section">
        <h1 class="admin-header">Edit Profile Ruangan</h1>
        <form action="{{ route('admin.profile.update', $profile_ruangan) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group"><label class="form-label">Room Name</label><input name="room_name" class="form-control" value="{{ old('room_name', $profile_ruangan->room_name) }}" required></div>
            <div class="form-group"><label class="form-label">Floor</label><input name="floor" class="form-control" value="{{ old('floor', $profile_ruangan->floor) }}"></div>
            <div class="form-group"><label class="form-label">Capacity</label><input name="capacity" type="number" class="form-control" value="{{ old('capacity', $profile_ruangan->capacity) }}"></div>
            <div class="form-group"><label class="form-label">Description</label><textarea name="description" class="form-control">{{ old('description', $profile_ruangan->description) }}</textarea></div>
            <div class="form-group"><label class="form-label">Photo Link</label><input name="photo_link" class="form-control" value="{{ old('photo_link', $profile_ruangan->photo_link) }}"></div>
            <div class="form-group"><label class="form-label inline-flex items-center"><input type="checkbox" name="is_active" {{ $profile_ruangan->is_active ? 'checked' : '' }} class="mr-2"> Active</label></div>
            <button class="form-submit">Save</button>
        </form>
    </div>
</div>
@endsection
