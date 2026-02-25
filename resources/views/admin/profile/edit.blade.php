@extends('layouts.app')

@section('content')
<div class="bg-[#f8fafc] min-h-screen py-6 sm:py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6">
        <div class="mb-6 sm:mb-8 flex items-center gap-3">
            <a href="{{ route('admin.profile.index') }}" class="inline-flex items-center justify-center w-10 h-10 bg-white border border-slate-200 text-[#063A76] rounded-xl hover:bg-slate-50 transition-colors" title="Kembali">
                <i class="fas fa-arrow-left"></i>
            </a>
            <div>
                <h1 class="text-2xl sm:text-3xl font-bold text-[#063A76]">Edit Profile Ruangan</h1>
                <p class="text-sm text-slate-500">Perbarui informasi ruangan dan tambah gambar baru.</p>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-5 sm:p-8">
            @if($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-700 px-6 py-4 rounded-lg mb-6">
                    <h3 class="font-semibold mb-2">Terjadi Kesalahan:</h3>
                    <ul class="list-disc list-inside space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.profile.update', $profileRuangan) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Ruangan *</label>
                    <input type="text" name="room_name" required value="{{ old('room_name', $profileRuangan->room_name) }}" class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#063A76] @error('room_name') border-red-500 @enderror">
                    @error('room_name')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Lantai</label>
                        <input type="number" name="floor" min="1" max="7" value="{{ old('floor', $profileRuangan->floor) }}" class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#063A76]">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Kapasitas</label>
                        <input type="number" name="capacity" value="{{ old('capacity', $profileRuangan->capacity) }}" class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#063A76]">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi</label>
                    <textarea name="description" rows="6" class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#063A76]">{{ old('description', $profileRuangan->description) }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Gambar Tersimpan</label>
                    @if($profileRuangan->images->count())
                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 mb-4">
                            @foreach($profileRuangan->images->sortBy('slot') as $image)
                                <div class="border border-slate-200 rounded-lg p-2">
                                    <img src="{{ route('profile-ruangan.image', ['filename' => basename($image->image_path)]) }}" alt="Gambar" class="w-full h-24 object-cover rounded mb-2">
                                    <button type="button" onclick="openDeleteModal('deleteProfileImageModal', 'Gambar', '/admin/profile-ruangan/image/{{ $image->id }}', function() { location.reload(); })" class="w-full text-xs px-2 py-1 rounded bg-red-50 text-red-600 hover:bg-red-100">Hapus</button>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-sm text-slate-500 mb-4">Belum ada gambar tersimpan.</p>
                    @endif

                    <label class="block text-sm font-semibold text-gray-700 mb-2">Tambah Gambar Baru (Bisa Banyak)</label>
                    <input type="file" id="images-input" name="images[]" accept="image/*" multiple class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#063A76] @error('images') border-red-500 @enderror @error('images.*') border-red-500 @enderror">
                    <p class="text-xs text-slate-500 mt-2">File yang dipilih akan ditambahkan ke gambar yang sudah ada.</p>
                    @error('images')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                    @error('images.*')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                    <div id="images-preview" class="mt-4 grid grid-cols-2 sm:grid-cols-4 gap-3"></div>
                </div>

                <div>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $profileRuangan->is_active) ? 'checked' : '' }} class="w-4 h-4 text-[#063A76] rounded">
                        <span class="text-sm font-semibold text-gray-700">Aktifkan Ruangan</span>
                    </label>
                </div>

                <div class="flex gap-3 pt-6 border-t border-gray-200">
                    <x-button variant="secondary" size="lg" type="link" href="{{ route('admin.profile.index') }}">Batal</x-button>
                    <x-button variant="primary" size="lg" type="submit" icon="check">Simpan Perubahan</x-button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.getElementById('images-input')?.addEventListener('change', function (event) {
    const preview = document.getElementById('images-preview');
    preview.innerHTML = '';

    Array.from(event.target.files || []).forEach((file, index) => {
        const reader = new FileReader();
        reader.onload = function (e) {
            const item = document.createElement('div');
            item.className = 'border border-slate-200 rounded-lg p-2';
            item.innerHTML = `
                <img src="${e.target.result}" class="w-full h-24 object-cover rounded mb-2" alt="Preview ${index + 1}">
                <p class="text-xs text-slate-600 truncate">${file.name}</p>
            `;
            preview.appendChild(item);
        };
        reader.readAsDataURL(file);
    });
});

function deleteStoredImage(imageId, buttonElement) {
    if (!confirm('Hapus gambar ini?')) {
        return;
    }

    const csrf = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

    fetch(`/admin/profile-ruangan/image/${imageId}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': csrf,
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Gagal menghapus gambar');
        }
        return response.json();
    })
    .then(() => {
        const card = buttonElement.closest('.border');
        if (card) {
            card.remove();
        }
    })
    .catch((error) => {
        alert(error.message || 'Terjadi kesalahan saat menghapus gambar');
    });
}
</script>

<!-- Delete Modal for Images -->
@component('components.delete-modal', ['id' => 'deleteProfileImageModal', 'title' => 'Hapus Gambar?']) @endcomponent

@endsection
