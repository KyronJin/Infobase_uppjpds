@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Edit Foto Galeri</h1>
        <p class="text-gray-600 mt-2">Edit foto: <span class="font-semibold">{{ $gallery->title }}</span></p>
    </div>

    @if($errors->any())
        <div class="mb-6 p-4 bg-red-100 text-red-800 rounded-lg border border-red-300">
            <h3 class="font-semibold mb-2">Ada kesalahan:</h3>
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white rounded-lg shadow-lg p-8">
        <form action="{{ route('admin.gallery.update', $gallery) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Judul -->
            <div>
                <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">Judul Foto <span class="text-red-600">*</span></label>
                <input 
                    type="text" 
                    name="title" 
                    id="title" 
                    value="{{ old('title', $gallery->title) }}"
                    required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition duration-200"
                    placeholder="Judul foto galeri"
                >
            </div>

            <!-- Deskripsi -->
            <div>
                <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi</label>
                <textarea 
                    name="description" 
                    id="description" 
                    rows="4"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition duration-200"
                    placeholder="Deskripsi foto"
                >{{ old('description', $gallery->description) }}</textarea>
            </div>

            <!-- Kategori -->
            <div>
                <label for="category" class="block text-sm font-semibold text-gray-700 mb-2">Kategori <span class="text-red-600">*</span></label>
                <select 
                    name="category" 
                    id="category"
                    required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition duration-200"
                >
                    <option value="">-- Pilih Kategori --</option>
                    <option value="building" {{ old('category', $gallery->category) === 'building' ? 'selected' : '' }}>Gedung</option>
                    <option value="interior" {{ old('category', $gallery->category) === 'interior' ? 'selected' : '' }}>Interior</option>
                    <option value="collection" {{ old('category', $gallery->category) === 'collection' ? 'selected' : '' }}>Koleksi</option>
                    <option value="service" {{ old('category', $gallery->category) === 'service' ? 'selected' : '' }}>Layanan</option>
                    <option value="facility" {{ old('category', $gallery->category) === 'facility' ? 'selected' : '' }}>Fasilitas</option>
                    <option value="activity" {{ old('category', $gallery->category) === 'activity' ? 'selected' : '' }}>Aktivitas</option>
                </select>
            </div>

            <!-- Lokasi Tampilan -->
            <div>
                <label for="location" class="block text-sm font-semibold text-gray-700 mb-2">Lokasi Tampilan <span class="text-red-600">*</span></label>
                <select 
                    name="location" 
                    id="location"
                    required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition duration-200"
                >
                    <option value="">-- Pilih Lokasi --</option>
                    <option value="home" {{ old('location', $gallery->location) === 'home' ? 'selected' : '' }}>Halaman Beranda</option>
                    <option value="about" {{ old('location', $gallery->location) === 'about' ? 'selected' : '' }}>Halaman Tentang</option>
                    <option value="both" {{ old('location', $gallery->location) === 'both' ? 'selected' : '' }}>Kedua Halaman</option>
                </select>
            </div>

            <!-- Foto Saat Ini -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Foto Saat Ini</label>
                <div class="relative w-48 h-48 rounded-lg overflow-hidden bg-gray-100 border border-gray-300">
                    <img src="{{ asset($gallery->image_path) }}" alt="{{ $gallery->title }}" class="w-full h-full object-cover">
                </div>
            </div>

            <!-- Upload Foto Baru -->
            <div>
                <label for="image" class="block text-sm font-semibold text-gray-700 mb-2">Ganti Foto (Opsional)</label>
                <div class="relative border-2 border-dashed border-gray-300 rounded-lg p-8 text-center hover:border-blue-500 hover:bg-blue-50 transition duration-200 cursor-pointer"
                    onclick="document.getElementById('image').click()">
                    <input 
                        type="file" 
                        name="image" 
                        id="image" 
                        accept="image/*"
                        class="hidden"
                        onchange="handleImageChange(event)"
                    >
                    <div id="imagePreview" class="hidden">
                        <img id="previewImg" src="" alt="Preview" class="max-h-64 mx-auto rounded-lg mb-4">
                        <p id="fileName" class="text-sm text-gray-600"></p>
                    </div>
                    <div id="placeholder">
                        <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-2 block"></i>
                        <p class="text-gray-500">Klik atau drag-drop foto baru di sini</p>
                        <p class="text-sm text-gray-400 mt-1">Abaikan jika tidak ingin mengubah foto</p>
                    </div>
                </div>
            </div>

            <!-- Urutan -->
            <div>
                <label for="order" class="block text-sm font-semibold text-gray-700 mb-2">Urutan Tampilan</label>
                <input 
                    type="number" 
                    name="order" 
                    id="order" 
                    value="{{ old('order', $gallery->order) }}"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition duration-200"
                    min="0"
                >
            </div>

            <!-- Status Aktif -->
            <div>
                <label class="flex items-center cursor-pointer">
                    <input 
                        type="checkbox" 
                        name="is_active" 
                        {{ old('is_active', $gallery->is_active) ? 'checked' : '' }}
                        class="w-5 h-5 text-blue-600 rounded border-gray-300 focus:ring-2 focus:ring-blue-200"
                    >
                    <span class="ml-3 text-sm font-medium text-gray-700">Aktif</span>
                </label>
            </div>

            <!-- Tombol -->
            <div class="flex gap-4 pt-6 border-t">
                <button 
                    type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-8 rounded-lg transition duration-300"
                >
                    <i class="fas fa-save mr-2"></i>Simpan Perubahan
                </button>
                <a 
                    href="{{ route('admin.gallery.index') }}"
                    class="bg-gray-400 hover:bg-gray-500 text-white font-semibold py-3 px-8 rounded-lg transition duration-300"
                >
                    <i class="fas fa-times mr-2"></i>Batal
                </a>
            </div>
        </form>
    </div>
</div>

<script>
function handleImageChange(event) {
    const file = event.target.files[0];
    if (!file) return;

    const reader = new FileReader();
    reader.onload = function(e) {
        document.getElementById('previewImg').src = e.target.result;
        document.getElementById('fileName').textContent = file.name + ' (' + (file.size / 1024 / 1024).toFixed(2) + ' MB)';
        document.getElementById('placeholder').classList.add('hidden');
        document.getElementById('imagePreview').classList.remove('hidden');
    };
    reader.readAsDataURL(file);
}
</script>
@endsection
