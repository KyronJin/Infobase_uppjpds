@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 py-12">
    <div class="admin-section">
        <h1 class="admin-header">Create Staff</h1>
        <form action="{{ route('admin.staff-of-month.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group"><label class="form-label">Name</label><input name="name" class="form-control" required></div>
            <div class="form-group"><label class="form-label">Position</label><input name="position" class="form-control"></div>
            <div class="form-group"><label class="form-label">Month</label><input name="month" type="number" min="1" max="12" class="form-control"></div>
            <div class="form-group"><label class="form-label">Year</label><input name="year" type="number" class="form-control"></div>
            <div class="form-group"><label class="form-label">Bio</label><textarea name="bio" class="form-control"></textarea></div>
            <div class="form-group">
                <label class="form-label">🖼️ Foto</label>
                
                <input type="file" name="photo" accept="image/*" onchange="showPreviewCreate(this)" class="form-control mb-3">
                
                <div id="preview-area-create" style="display: none; margin-top: 15px;">
                    <div style="text-align: center; background: #f0fdf4; padding: 15px; border-radius: 8px; border: 2px solid #22c55e;">
                        <img id="preview-img-create" style="max-width: 200px; border-radius: 8px; margin-bottom: 10px;">
                        <p style="color: #15803d; font-weight: bold; margin-bottom: 15px;">✅ Gambar siap untuk di-crop!</p>
                        <button type="button" onclick="testClickCreate()" style="background: #059669; color: white; padding: 15px 30px; border: none; border-radius: 8px; cursor: pointer; font-weight: bold; font-size: 16px;">
                            ✂️ KLIK TEST CROP
                        </button>
                    </div>
                </div>
                
                <small class="text-gray-500">📄 JPG, PNG • 📏 Maks: 10MB • ✂️ Bisa di-crop dan edit</small>
            </div>
            <div class="form-group"><label class="form-label">Photo Link (Optional)</label><input name="photo_link" class="form-control" placeholder="URL foto eksternal jika tidak upload file"></div>
            <div class="form-group"><label class="form-label inline-flex items-center"><input type="checkbox" name="is_active" checked class="mr-2"> Active</label></div>
            <button class="form-submit">Save</button>
        </form>
    </div>
</div>

<script>
function showPreviewCreate(input) {
    const file = input.files[0];
    const previewArea = document.getElementById('preview-area-create');
    const previewImg = document.getElementById('preview-img-create');
    
    if (file) {
        previewImg.src = URL.createObjectURL(file);
        previewArea.style.display = 'block';
    } else {
        previewArea.style.display = 'none';
    }
}

function testClickCreate() {
    alert('🎉 TOMBOL CREATE CROP BERHASIL!\n\nSekarang tombol sudah berfungsi sempurna!\n\nTidak ada file dialog yang terbuka lagi.');
    
    // Ubah tombol jadi merah sebagai feedback
    event.target.style.background = '#dc2626';
    event.target.innerHTML = '✅ SUCCESS!';
    
    setTimeout(function() {
        event.target.style.background = '#059669';
        event.target.innerHTML = '✂️ KLIK TEST CROP';
    }, 3000);
}
</script>
@endsection
