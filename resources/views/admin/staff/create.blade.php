@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 py-12">
    <div class="admin-section">
        <h1 class="admin-header">Create Staff</h1>
        <form action="{{ route('admin.staff.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group"><label class="form-label">Name</label><input name="name" class="form-control" required></div>
            <div class="form-group"><label class="form-label">Position</label><input name="position" class="form-control"></div>
            <div class="form-group"><label class="form-label">Month</label><input name="month" type="number" min="1" max="12" class="form-control"></div>
            <div class="form-group"><label class="form-label">Year</label><input name="year" type="number" class="form-control"></div>
            <div class="form-group"><label class="form-label">Bio</label><textarea name="bio" class="form-control"></textarea></div>
            <div class="form-group"><label class="form-label">Foto</label><input name="foto" type="file" class="form-control" accept="image/*"></div>
            <div class="form-group"><label class="form-label inline-flex items-center"><input type="checkbox" name="is_active" value="1" class="mr-2"> Tampilkan (Active)</label></div>
            <button class="form-submit">Save</button>
        </form>
    </div>
</div>
@endsection
