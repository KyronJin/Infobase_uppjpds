@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 py-12">
    <div class="admin-section">
        <h1 class="admin-header">Create Tata Tertib</h1>
        <form action="{{ route('admin.tata_tertib.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label class="form-label">Title</label>
                <input name="title" class="form-control" required>
            </div>
            <div class="form-group">
                <label class="form-label">Content</label>
                <textarea name="content" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label class="form-label">Document Link</label>
                <input name="document_link" class="form-control" placeholder="https://...">
            </div>
            <div class="form-group">
                <label class="form-label inline-flex items-center"><input type="checkbox" name="is_active" checked class="mr-2"> Active</label>
            </div>
            <button class="form-submit">Save</button>
        </form>
    </div>
</div>
@endsection
