@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 py-12">
    <div class="admin-section">
        <h1 class="admin-header">Edit Staff</h1>
        <form action="{{ route('admin.staff.update', $staff_of_month) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group"><label class="form-label">Name</label><input name="name" class="form-control" value="{{ old('name', $staff_of_month->name) }}" required></div>
            <div class="form-group"><label class="form-label">Position</label><input name="position" class="form-control" value="{{ old('position', $staff_of_month->position) }}"></div>
            <div class="form-group"><label class="form-label">Month</label><input name="month" type="number" min="1" max="12" class="form-control" value="{{ old('month', $staff_of_month->month) }}"></div>
            <div class="form-group"><label class="form-label">Year</label><input name="year" type="number" class="form-control" value="{{ old('year', $staff_of_month->year) }}"></div>
            <div class="form-group"><label class="form-label">Bio</label><textarea name="bio" class="form-control">{{ old('bio', $staff_of_month->bio) }}</textarea></div>
            <div class="form-group">
                <label class="form-label">Foto</label>
                @if($staff_of_month->foto_path)
                    <div class="mb-2"><img src="{{ asset('storage/' . $staff_of_month->foto_path) }}" alt="{{ $staff_of_month->name }}" style="max-width: 200px; height: auto;"></div>
                @endif
                <input name="foto" type="file" class="form-control" accept="image/*">
                <small class="text-gray-500">Biarkan kosong jika tidak ingin mengubah foto</small>
            </div>
            <div class="form-group"><label class="form-label inline-flex items-center"><input type="checkbox" name="is_active" value="1" {{ $staff_of_month->is_active ? 'checked' : '' }} class="mr-2"> Tampilkan (Active)</label></div>
            <button class="form-submit">Save</button>
        </form>
    </div>
</div>
@endsection
