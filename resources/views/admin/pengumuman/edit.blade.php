@extends('layouts.app')

@section('content')
<div class="py-24 bg-white pt-28">
  <div class="max-w-6xl mx-auto px-6">
    <div class="admin-section">
        <div class="flex items-center justify-between mb-6">
            <h1 class="h2">Edit Pengumuman</h1>
            <a href="{{ route('admin.pengumuman.index') }}" class="text-teal-600 hover:underline">← Kembali</a>
        </div>
        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                <strong>Terjadi kesalahan:</strong>
                <ul class="mt-2">
                    @foreach($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{ route('admin.pengumuman.update', $pengumuman) }}" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-gray-700 mb-1">Judul</label>
                <input type="text" name="title" value="{{ old('title', $pengumuman->title) }}" required 
                       class="w-full border rounded px-3 py-2 @error('title') border-red-500 @enderror">
                @error('title')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 mb-1">Isi Pengumuman</label>
                <div id="editor-description" class="border border-gray-300 rounded-lg shadow-sm" style="border-radius: 0.5rem; overflow: hidden; min-height: 300px;"></div>
                <textarea name="description" id="description" class="editor hidden" required>{{ old('description', $pengumuman->description) }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Gambar Pengumuman</label>
                
                @if($pengumuman->image_path)
                    <div class="mb-3">
                        <p class="text-sm text-gray-600 mb-2">Gambar saat ini:</p>
                        <img src="{{ asset('storage/' . $pengumuman->image_path) }}" alt="Current image" class="w-32 h-32 object-cover rounded border">
                    </div>
                @endif
                
                <input type="file" name="image" 
                       class="w-full border rounded px-3 py-2 @error('image') border-red-500 @enderror" 
                       accept="image/*"
                       onchange="previewImage(this)">
                <p class="text-sm text-gray-500 mt-1">Kosongkan jika tidak ingin mengubah gambar. Format: JPG, PNG, GIF. Maksimal 2MB.</p>
                @error('image')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
                
                <div id="imagePreview" class="mt-3" style="display: none;">
                    <p class="text-sm text-gray-600 mb-2">Preview gambar baru:</p>
                    <img id="previewImg" class="w-32 h-32 object-cover rounded border">
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 mb-1">Tanggal Publish</label>
                <input type="datetime-local" name="published_at" 
                       value="{{ old('published_at', $pengumuman->published_at?->format('Y-m-d\TH:i')) }}" 
                       class="w-full border rounded px-3 py-2 @error('published_at') border-red-500 @enderror">
                @error('published_at')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end space-x-3">
                <a href="{{ route('admin.pengumuman.index') }}" class="px-4 py-2 border border-gray-300 rounded text-gray-700 hover:bg-gray-50">
                    Batal
                </a>
                <button type="submit" class="bg-teal-600 text-white px-6 py-2 rounded hover:bg-teal-700">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
  </div>
</div>

<script>
function previewImage(input) {
    const file = input.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('previewImg').src = e.target.result;
            document.getElementById('imagePreview').style.display = 'block';
        };
        reader.readAsDataURL(file);
    } else {
        document.getElementById('imagePreview').style.display = 'none';
    }
}
</script>

@endsection
