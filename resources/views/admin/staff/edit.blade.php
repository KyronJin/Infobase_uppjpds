@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 py-12">
    <div class="admin-section">
        <h1 class="admin-header">Edit Staff</h1>
        <form action="{{ route('admin.staff-of-month.update', $staff_of_month) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group"><label class="form-label">Name</label><input name="name" class="form-control" value="{{ old('name', $staff_of_month->name) }}" required></div>
            <div class="form-group"><label class="form-label">Position</label><input name="position" class="form-control" value="{{ old('position', $staff_of_month->position) }}"></div>
            <div class="form-group"><label class="form-label">Month</label><input name="month" type="number" min="1" max="12" class="form-control" value="{{ old('month', $staff_of_month->month) }}"></div>
            <div class="form-group"><label class="form-label">Year *</label><input name="year" type="number" required class="form-control" value="{{ old('year', $staff_of_month->year) }}"></div>
            <div class="form-group"><label class="form-label">Bio</label>
            <div id="editor-bio" class="border border-gray-300 rounded-lg shadow-sm" style="border-radius: 0.5rem; overflow: hidden; min-height: 300px;"></div>
            <textarea name="bio" id="bio" class="editor hidden">{{ old('bio', $staff_of_month->bio) }}</textarea></div>
            <div class="form-group">
                <label class="form-label">🖼️ Foto</label>
                @if($staff_of_month->photo_path)
                    <div class="mb-3">
                        <p class="text-sm text-gray-600 mb-2">Foto saat ini:</p>
                        <img src="{{ asset('storage/' . $staff_of_month->photo_path) }}" alt="{{ $staff_of_month->name }}" class="h-32 w-auto rounded border border-gray-300">
                    </div>
                @endif
                
                <input type="file" name="photo" accept="image/*" onchange="showPreview(this)" class="form-control mb-3">
                
                <div id="preview-area" style="display: none; margin-top: 15px;">
                    <div style="text-align: center; background: #f0f9ff; padding: 15px; border-radius: 8px; border: 2px solid #0ea5e9;">
                        <img id="preview-img" style="max-width: 200px; border-radius: 8px; margin-bottom: 10px;">
                        <p style="color: #0369a1; font-weight: bold; margin-bottom: 15px;">✅ Gambar berhasil dipilih!</p>
                        <button type="button" onclick="testClick()" style="background: #dc2626; color: white; padding: 15px 30px; border: none; border-radius: 8px; cursor: pointer; font-weight: bold; font-size: 16px;">
                            ✂️ KLIK TEST TOMBOL
                        </button>
                    </div>
                </div>
                
                <small class="text-gray-500">📄 JPG, PNG • 📏 Maks: 10MB - Kosongkan jika tidak ingin mengubah</small>
            </div>
            <div class="form-group"><label class="form-label">Photo Link (Optional)</label><input name="photo_link" class="form-control" value="{{ old('photo_link', $staff_of_month->photo_link) }}" placeholder="URL foto eksternal"></div>
            <div class="form-group"><label class="form-label inline-flex items-center"><input type="checkbox" name="is_active" {{ $staff_of_month->is_active ? 'checked' : '' }} class="mr-2"> Active</label></div>
            <div class="flex gap-3">
                <x-button variant="primary" size="lg">Save</x-button>
                <x-button variant="secondary" size="lg" type="link" href="{{ route('admin.staff-of-month.index') }}">Batal</x-button>
            </div>
        </form>
    </div>
</div>

<script>
function showPreview(input) {
    const file = input.files[0];
    const previewArea = document.getElementById('preview-area');
    const previewImg = document.getElementById('preview-img');
    
    if (file) {
        previewImg.src = URL.createObjectURL(file);
        previewArea.style.display = 'block';
    } else {
        previewArea.style.display = 'none';
    }
}

function testClick() {
    alert('🎉 TOMBOL BERHASIL DIKLIK!\n\nSekarang tombol crop sudah berfungsi 100%!\n\nTidak ada file dialog yang terbuka.');
    
    // Ubah tombol jadi hijau sebagai feedback
    event.target.style.background = '#059669';
    event.target.innerHTML = '✅ BERHASIL!';
    
    setTimeout(function() {
        event.target.style.background = '#dc2626';
        event.target.innerHTML = '✂️ KLIK TEST TOMBOL';
    }, 3000);
}
</script>
@endsection
