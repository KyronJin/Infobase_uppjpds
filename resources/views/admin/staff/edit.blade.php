@extends('layouts.app')

@section('content')
<style>
    .edit-staff-container {
        display: flex;
        height: calc(100vh - 100px);
        width: 100vw;
        margin-left: calc(-50vw + 50%);
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    }

    .edit-form-section {
        flex: 1;
        overflow-y: auto;
        padding: 2rem;
        background: white;
    }

    .edit-preview-section {
        flex: 1;
        overflow-y: auto;
        padding: 2rem;
        background: #f9fafb;
        border-left: 1px solid #e5e7eb;
    }

    .form-compact {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
    }

    .form-compact > .form-full {
        grid-column: 1 / -1;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .form-label {
        font-weight: 600;
        color: #374151;
        font-size: 0.875rem;
    }

    .form-control {
        padding: 0.75rem;
        border: 2px solid #e5e7eb;
        border-radius: 0.5rem;
        font-size: 0.9rem;
        transition: all 0.2s;
    }

    .form-control:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    textarea.form-control {
        resize: vertical;
        min-height: 120px;
    }

    .editor-container {
        border: 2px solid #e5e7eb;
        border-radius: 0.5rem;
        overflow: hidden;
        min-height: 160px;
        max-height: 200px;
    }

    .preview-card {
        background: white;
        border-radius: 1rem;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }

    .preview-card h3 {
        font-weight: 600;
        color: #374151;
        margin-bottom: 1rem;
        font-size: 0.95rem;
    }

    .current-photo {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 1rem;
        background: #f3f4f6;
        border-radius: 0.75rem;
        margin-bottom: 1rem;
    }

    .current-photo img {
        max-width: 150px;
        height: auto;
        border-radius: 0.5rem;
        margin-bottom: 0.5rem;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    .current-photo p {
        font-size: 0.75rem;
        color: #6b7280;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .photo-upload {
        background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
        border: 2px dashed #f59e0b;
        border-radius: 0.75rem;
        padding: 1rem;
        margin-bottom: 1rem;
    }

    .photo-upload input[type="file"] {
        width: 100%;
        font-size: 0.75rem;
    }

    .preview-area {
        background: #eff6ff;
        border: 2px solid #0ea5e9;
        border-radius: 0.75rem;
        padding: 1rem;
        text-align: center;
    }

    .preview-area img {
        max-width: 140px;
        border-radius: 0.5rem;
        margin-bottom: 0.5rem;
    }

    .preview-area p {
        font-size: 0.8rem;
        color: #0369a1;
        font-weight: 500;
        margin-bottom: 0.75rem;
    }

    .test-btn {
        background: #dc2626;
        color: white;
        padding: 0.75rem 1.5rem;
        border: none;
        border-radius: 0.5rem;
        cursor: pointer;
        font-weight: 600;
        font-size: 0.85rem;
        transition: all 0.2s;
    }

    .test-btn:hover {
        background: #991b1b;
    }

    .checkbox-group {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 1rem;
        background: #f0f9ff;
        border-radius: 0.75rem;
        margin-top: 1rem;
    }

    .checkbox-group input[type="checkbox"] {
        width: 1.25rem;
        height: 1.25rem;
        cursor: pointer;
    }

    .checkbox-group label {
        flex: 1;
        cursor: pointer;
        font-weight: 500;
        color: #374151;
        font-size: 0.9rem;
    }

    .action-buttons {
        display: flex;
        gap: 1rem;
        margin-top: 2rem;
        padding-top: 1.5rem;
        border-top: 1px solid #e5e7eb;
    }

    .btn {
        flex: 1;
        padding: 0.875rem 1.5rem;
        border: none;
        border-radius: 0.75rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
        font-size: 0.95rem;
    }

    .btn-primary {
        background: #3b82f6;
        color: white;
    }

    .btn-primary:hover {
        background: #2563eb;
    }

    .btn-secondary {
        background: #6b7280;
        color: white;
        text-decoration: none;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .btn-secondary:hover {
        background: #4b5563;
    }

    .header-title {
        font-size: 1.75rem;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 0.5rem;
    }

    .header-subtitle {
        font-size: 0.9rem;
        color: #6b7280;
    }

    @media (max-width: 1024px) {
        .edit-staff-container {
            flex-direction: column;
            height: auto;
        }

        .edit-preview-section {
            border-left: none;
            border-top: 1px solid #e5e7eb;
        }

        .form-compact {
            grid-template-columns: 1fr;
        }
    }

    /* Scrollbar styling */
    .edit-form-section::-webkit-scrollbar,
    .edit-preview-section::-webkit-scrollbar {
        width: 8px;
    }

    .edit-form-section::-webkit-scrollbar-track,
    .edit-preview-section::-webkit-scrollbar-track {
        background: #f3f4f6;
    }

    .edit-form-section::-webkit-scrollbar-thumb,
    .edit-preview-section::-webkit-scrollbar-thumb {
        background: #d1d5db;
        border-radius: 4px;
    }

    .edit-form-section::-webkit-scrollbar-thumb:hover,
    .edit-preview-section::-webkit-scrollbar-thumb:hover {
        background: #9ca3af;
    }
</style>

<div class="edit-staff-container">
    <!-- Form Section (Left) -->
    <div class="edit-form-section">
        <div>
            <div class="header-title">Edit Staff of The Month</div>
            <div class="header-subtitle">Perbarui informasi staff terbaik</div>
        </div>

        <form action="{{ route('admin.staff-of-month.update', $staff_of_month) }}" method="POST" enctype="multipart/form-data" style="margin-top: 2rem;">
            @csrf
            @method('PUT')
            
            <div class="form-compact">
                <div class="form-group">
                    <label class="form-label">Nama Lengkap <span style="color: #ef4444;">*</span></label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $staff_of_month->name) }}" required placeholder="Nama staff">
                </div>

                <div class="form-group">
                    <label class="form-label">Posisi / Jabatan <span style="color: #ef4444;">*</span></label>
                    <input type="text" name="position" class="form-control" value="{{ old('position', $staff_of_month->position) }}" placeholder="Contoh: Pustakawan">
                </div>

                <div class="form-group">
                    <label class="form-label">Bulan</label>
                    <input type="number" name="month" min="1" max="12" class="form-control" value="{{ old('month', $staff_of_month->month) }}" placeholder="1-12">
                </div>

                <div class="form-group">
                    <label class="form-label">Tahun <span style="color: #ef4444;">*</span></label>
                    <input type="number" name="year" min="2000" class="form-control" value="{{ old('year', $staff_of_month->year) }}" required placeholder="2026">
                </div>

                <div class="form-group form-full">
                    <label class="form-label">Biodata / Kutipan</label>
                    <textarea name="bio" class="form-control" placeholder="Ketik biodata atau kutipan inspiratif...">{{ old('bio', $staff_of_month->bio) }}</textarea>
                </div>

                <div class="form-group form-full">
                    <label class="form-label">Photo Link (Optional)</label>
                    <input type="url" name="photo_link" class="form-control" value="{{ old('photo_link', $staff_of_month->photo_link) }}" placeholder="https://example.com/photo.jpg">
                </div>
            </div>

            <div class="checkbox-group">
                <input type="checkbox" id="is_active" name="is_active" value="1" {{ $staff_of_month->is_active ? 'checked' : '' }}>
                <label for="is_active">Aktifkan di Halaman Utama</label>
            </div>

            <div class="action-buttons">
                <button type="submit" class="btn btn-primary">💾 Simpan Perubahan</button>
                <a href="{{ route('admin.staff-of-month.index') }}" class="btn btn-secondary">← Kembali</a>
            </div>
        </form>
    </div>

    <!-- Preview Section (Right) -->
    <div class="edit-preview-section">
        <div>
            <div class="header-title">Preview</div>
            <div class="header-subtitle">Lihat perubahan data</div>
        </div>

        <div style="margin-top: 2rem;">
            <!-- Current Photo -->
            <div class="preview-card">
                <h3>📸 Foto Tersimpan</h3>
                @if($staff_of_month->photo_path)
                    <div class="current-photo">
                        <img src="{{ asset('storage/' . $staff_of_month->photo_path) }}" alt="{{ $staff_of_month->name }}">
                        <p>Foto Saat Ini</p>
                    </div>
                @else
                    <div style="text-align: center; padding: 2rem; color: #9ca3af;">
                        <i class="fas fa-image" style="font-size: 2.5rem; margin-bottom: 0.5rem; display: block;"></i>
                        <p style="font-size: 0.85rem;">Belum ada foto</p>
                    </div>
                @endif
            </div>

            <!-- Photo Upload -->
            <div class="preview-card">
                <h3>📤 Upload Foto Baru</h3>
                <div class="photo-upload">
                    <input type="file" name="photo" accept="image/*" onchange="showPreview(this)" id="photo-input">
                    <small style="display: block; margin-top: 0.5rem; color: #92400e;">JPG, PNG (Max 10MB)</small>
                </div>
                
                <div id="preview-area" style="display: none;" class="preview-area">
                    <img id="preview-img" alt="Preview">
                    <p>✅ Gambar siap disimpan</p>
                    <button type="button" onclick="testClick()" class="test-btn">🔄 Preview</button>
                </div>
            </div>

            <!-- Info Stats -->
            <div class="preview-card">
                <h3>ℹ️ Informasi</h3>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                    <div style="padding: 0.75rem; background: #f3f4f6; border-radius: 0.5rem;">
                        <p style="font-size: 0.75rem; color: #6b7280; text-transform: uppercase; margin-bottom: 0.25rem;">ID</p>
                        <p style="font-size: 1.25rem; font-weight: 700; color: #1f2937;">{{ $staff_of_month->id }}</p>
                    </div>
                    <div style="padding: 0.75rem; background: #f3f4f6; border-radius: 0.5rem;">
                        <p style="font-size: 0.75rem; color: #6b7280; text-transform: uppercase; margin-bottom: 0.25rem;">Status</p>
                        <p style="font-size: 1rem; font-weight: 600; color: {{ $staff_of_month->is_active ? '#16a34a' : '#dc2626' }};">
                            {{ $staff_of_month->is_active ? '✅ AKTIF' : '❌ TIDAK AKTIF' }}
                        </p>
                    </div>
                </div>
                <div style="margin-top: 1rem; padding: 0.75rem; background: #fef3c7; border-left: 4px solid #f59e0b; border-radius: 0.25rem;">
                    <p style="font-size: 0.75rem; color: #92400e;">Dibuat: {{ $staff_of_month->created_at->format('d M Y, H:i') }}</p>
                    <p style="font-size: 0.75rem; color: #92400e; margin-top: 0.25rem;">Diupdate: {{ $staff_of_month->updated_at->format('d M Y, H:i') }}</p>
                </div>
            </div>
        </div>
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
    const btn = event.target;
    btn.style.background = '#059669';
    btn.innerHTML = '✅ BERHASIL!';
    
    setTimeout(function() {
        btn.style.background = '#dc2626';
        btn.innerHTML = '🔄 Preview';
    }, 2000);
}

// Real-time form preview
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    const nameInput = form.querySelector('input[name="name"]');
    const positionInput = form.querySelector('input[name="position"]');
    const monthInput = form.querySelector('input[name="month"]');
    const yearInput = form.querySelector('input[name="year"]');
    
    // Simple validation feedback
    nameInput.addEventListener('change', function() {
        if (this.value.trim() === '') {
            this.style.borderColor = '#ef4444';
        } else {
            this.style.borderColor = '#10b981';
        }
    });
    
    form.addEventListener('submit', function(e) {
        const submitBtn = this.querySelector('button[type="submit"]');
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menyimpan...';
    });
});
</script>
@endsection
