@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen py-12 font-cairo pt-28">
    <div class="max-w-6xl mx-auto px-6">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Debug: Form Tambah Profil Pegawai</h1>
            <p class="text-sm text-gray-600 mt-1">Buka Developer Console (F12) untuk melihat logs</p>
        </div>

        <!-- Debug Info -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8 mb-8">
            <h2 class="text-lg font-bold mb-4">Status Debug</h2>
            <div id="debugInfo" class="space-y-2 font-mono text-sm">
                <p>Loading...</p>
            </div>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8">
            <form id="formTambahPegawai" action="{{ route('admin.profil_pegawai.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- Nama Pegawai -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Pegawai *</label>
                    <input 
                        type="text" 
                        name="nama" 
                        value="{{ old('nama') }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-teal-600 focus:border-transparent @error('nama') border-red-500 @enderror" 
                        placeholder="Masukkan nama pegawai"
                        required>
                    @error('nama')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Jabatan -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Jabatan *</label>
                    <select 
                        name="jabatan_id" 
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-teal-600 focus:border-transparent @error('jabatan_id') border-red-500 @enderror"
                        required>
                        <option value="">-- Pilih Jabatan --</option>
                        @foreach($jabatans as $jabatan)
                            <option value="{{ $jabatan->id }}" {{ old('jabatan_id') == $jabatan->id ? 'selected' : '' }}>
                                {{ $jabatan->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('jabatan_id')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Deskripsi -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi *</label>
                    <div id="editor-deskripsi" class="border border-gray-300 rounded-lg shadow-sm" style="border-radius: 0.5rem; overflow: hidden; min-height: 200px;"></div>
                    <textarea 
                        name="deskripsi" 
                        id="deskripsi"
                        class="editor hidden"
                        placeholder="Masukkan deskripsi pegawai"
                        required>{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Action Buttons -->
                <div class="flex gap-3 pt-6 border-t border-gray-200">
                    <a href="{{ route('admin.profil_pegawai.index') }}" class="flex-1 px-6 py-3 bg-gray-200 text-gray-800 font-medium rounded-lg hover:bg-gray-300 transition-colors text-center">
                        Batal
                    </a>
                    <button 
                        type="submit"
                        id="btnSubmit"
                        class="flex-1 px-6 py-3 bg-teal-600 text-white font-medium rounded-lg hover:bg-teal-700 transition-colors flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        Tambah Pegawai
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Debug script
function updateDebugInfo() {
    const debugEl = document.getElementById('debugInfo');
    let html = '';
    
    html += '<p><strong>Waktu:</strong> ' + new Date().toLocaleTimeString() + '</p>';
    html += '<p><strong>Quill Editors:</strong> ' + (window.quillEditors ? 'Tersedia' : 'Belum tersedia') + '</p>';
    
    if (window.quillEditors) {
        html += '<p><strong>Quill Fields:</strong></p><ul>';
        for (let key in window.quillEditors) {
            const editor = window.quillEditors[key];
            const content = editor.root.innerHTML;
            const plainText = content.replace(/<[^>]*>/g, '');
            html += '<li>' + key + ': ' + plainText.substring(0, 30) + '...</li>';
        }
        html += '</ul>';
    }
    
    const form = document.getElementById('formTambahPegawai');
    if (form) {
        html += '<p><strong>Form found:</strong> Yes</p>';
        html += '<p><strong>Nama value:</strong> ' + (form.elements['nama'].value || 'kosong') + '</p>';
        html += '<p><strong>Jabatan value:</strong> ' + (form.elements['jabatan_id'].value || 'kosong') + '</p>';
        html += '<p><strong>Deskripsi textarea value:</strong> ' + (form.elements['deskripsi'].value.substring(0, 30) || 'kosong') + '</p>';
    } else {
        html += '<p><strong>Form found:</strong> No - ERROR!</p>';
    }
    
    debugEl.innerHTML = html;
}

// Initial debug
document.addEventListener('DOMContentLoaded', function() {
    console.log('%c=== FORM DEBUG START ===', 'color: blue; font-size: 14px');
    
    // Update debug info immediately
    updateDebugInfo();
    
    // Update every 2 seconds
    setInterval(updateDebugInfo, 2000);
    
    // Setup form submission handler
    const form = document.getElementById('formTambahPegawai');
    if (form) {
        form.addEventListener('submit', function(e) {
            console.log('%c=== FORM SUBMIT ATTEMPT ===', 'color: green; font-size: 14px');
            
            // Check Quill
            if (window.quillEditors && window.quillEditors.deskripsi) {
                const content = window.quillEditors.deskripsi.root.innerHTML;
                const plainText = content.replace(/<[^>]*>/g, '').trim();
                
                console.log('Quill content found');
                console.log('HTML length:', content.length);
                console.log('Plain text length:', plainText.length);
                console.log('Content:', content.substring(0, 100));
                
                document.getElementById('deskripsi').value = content;
                
                if (!plainText) {
                    console.error('Deskripsi is empty!');
                    e.preventDefault();
                    alert('Deskripsi harus diisi!');
                    return false;
                }
            } else {
                console.warn('Quill editor not found, checking textarea');
                const textarea = document.getElementById('deskripsi');
                if (!textarea.value.trim()) {
                    console.error('Textarea is empty!');
                    e.preventDefault();
                    alert('Deskripsi harus diisi!');
                    return false;
                }
            }
            
            console.log('Form validation passed, submitting...');
            console.log('Form data:', {
                nama: form.elements['nama'].value,
                jabatan_id: form.elements['jabatan_id'].value,
                deskripsi: form.elements['deskripsi'].value.substring(0, 50) + '...'
            });
        });
        
        // Add button click handler
        document.getElementById('btnSubmit').addEventListener('click', function(e) {
            console.log('%c=== BUTTON CLICKED ===', 'color: yellow; font-size: 14px');
            console.log('Form is valid:', form.checkValidity());
        });
    } else {
        console.error('Form not found!');
    }
    
    console.log('%c=== FORM DEBUG INITIALIZED ===', 'color: blue; font-size: 14px');
});
</script>
@endsection
