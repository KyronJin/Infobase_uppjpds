@extends('layouts.app')

@section('content')
{{-- Include Image Cropper Component --}}
@include('components.image-cropper')

<div class="container mx-auto px-6 py-12">
    <div class="admin-section">
        <h1 class="admin-header">Buat Pengumuman</h1>

        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.pengumuman.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="form-label">Judul</label>
                <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
            </div>

            <div class="form-group">
                <label class="form-label">Deskripsi</label>
                <textarea name="description" class="form-control" rows="8">{{ old('description') }}</textarea>
            </div>

            <div class="form-group">
                <label class="form-label">Gambar Pengumuman</label>
                <input type="file" name="image" class="form-control" accept="image/*">
            </div>

            <div class="form-group">
                <label class="form-label">Tanggal Publikasi</label>
                <input type="datetime-local" name="published_at" class="form-control" value="{{ old('published_at') }}">
            </div>

            <div class="form-group">
                <label class="form-label">Tanggal Unpublikasi</label>
                <input type="datetime-local" name="unpublished_at" class="form-control" value="{{ old('unpublished_at') }}">
            </div>

            <div class="form-group">
                <label class="form-label">Tanggal Pengumuman Berlaku</label>
                <input type="datetime-local" name="valid_from" class="form-control" value="{{ old('valid_from') }}">
            </div>

            <div class="form-group">
                <label class="form-label">Tanggal Berakhir Pengumuman</label>
                <input type="datetime-local" name="valid_until" class="form-control" value="{{ old('valid_until') }}">
            </div>

            <div>
                <button class="form-submit">Simpan</button>
                <a href="{{ route('admin.pengumuman.index') }}" class="inline-block ml-3">Batal</a>
            </div>
        </form>
    </div>
</div>

{{-- Include Image Cropper JS --}}
<script src="{{ asset('js/image-cropper.js') }}"></script>
@endsection