@extends('layouts.app')

@push('styles')
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
@endpush

@section('content')
<div class="bg-[#f8fafc] min-h-screen py-6 sm:py-8">
    <div class="max-w-6xl mx-auto px-4 sm:px-6">
        <!-- Header dengan Navigation -->
        <div class="mb-6 sm:mb-8">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center gap-3">
                    <a href="{{ route('admin.pengumuman.index') }}" class="inline-flex items-center justify-center w-10 h-10 bg-white border border-slate-200 text-[#063A76] rounded-xl hover:bg-slate-50 transition-colors" title="Kembali">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                    </a>
                    <div>
                        <h1 class="text-2xl sm:text-3xl font-bold text-[#063A76]">Buat Pengumuman Baru</h1>
                        <p class="text-sm text-slate-600 mt-1">Tambahkan pengumuman baru untuk tampil di halaman utama</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Card -->
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

            <form action="{{ route('admin.pengumuman.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                
                <!-- Judul Pengumuman -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Judul Pengumuman *</label>
                    <input type="text" name="title" class="w-full px-4 py-3 border border-slate-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-[#063A76] focus:border-[#063A76] @error('title') border-red-500 @enderror" value="{{ old('title') }}" placeholder="Masukkan judul pengumuman" required>
                    @error('title')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Isi Pengumuman dengan Quill Editor -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Isi Pengumuman *</label>
                    <div id="editor-description" class="border border-slate-300 rounded-xl shadow-sm" style="border-radius: 0.75rem; overflow: hidden; min-height: 300px;"></div>
                    <textarea name="description" id="description" class="editor hidden" placeholder="Ketik isi pengumuman di sini...">{{ old('description') }}</textarea>
                    @error('description')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Excel Table Import -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-3">📊 Insert Tabel dari Excel (Opsional)</label>
                    <div id="excel-dropzone" class="border-2 border-dashed border-blue-300 rounded-lg p-6 text-center cursor-pointer hover:border-blue-500 hover:bg-blue-50 transition-all bg-blue-50/50">
                        <div class="flex flex-col items-center justify-center">
                            <i class="fas fa-file-excel text-4xl text-blue-500 mb-3"></i>
                            <p class="text-sm font-semibold text-gray-700 mb-1">Drag & Drop file Excel di sini</p>
                            <p class="text-xs text-gray-500 mb-4">Atau klik untuk memilih file (.xlsx, .xls, .csv)</p>
                        </div>
                        <input type="file" id="excel-input" accept=".xlsx,.xls,.csv" class="hidden" onchange="handleExcelFile(this)">
                    </div>
                    <p class="text-xs text-gray-500 mt-2">💡 Tip: File Excel akan otomatis dikonversi menjadi tabel dan ditambahkan ke editor</p>
                </div>

                <!-- Gambar Pengumuman -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-4">Gambar Pengumuman (Maksimal 1)</label>
                    <div class="border-2 border-dashed border-slate-300 rounded-xl p-4 text-center cursor-pointer hover:border-[#063A76] transition" onclick="document.getElementById('image-input').click()">
                        <div id="image-preview" class="hidden">
                            <img id="image-img" src="" alt="Gambar" class="w-full h-48 object-cover rounded mb-2">
                            <x-button size="sm" variant="primary">Ubah Gambar</x-button>
                        </div>
                        <div id="image-empty" class="flex flex-col items-center justify-center h-48">
                            <svg class="w-8 h-8 text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            <p class="text-sm font-semibold text-gray-700">Gambar Pengumuman</p>
                        </div>
                        <input type="file" id="image-input" name="image" accept="image/*" class="hidden" onchange="previewImage(this)">
                    </div>
                    <p class="text-sm text-gray-500 mt-3">Klik untuk menambah gambar. Format: JPG, PNG, GIF • Maks: 2MB</p>
                    @error('image')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Tanggal Publikasi -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Publikasi *</label>
                        <input type="datetime-local" name="published_at" required class="w-full px-4 py-3 border border-slate-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-[#063A76] focus:border-[#063A76] @error('published_at') border-red-500 @enderror" value="{{ old('published_at') }}">
                        @error('published_at')
                            <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Unpublikasi *</label>
                        <input type="datetime-local" name="unpublished_at" required class="w-full px-4 py-3 border border-slate-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-[#063A76] focus:border-[#063A76] @error('unpublished_at') border-red-500 @enderror" value="{{ old('unpublished_at') }}">
                        @error('unpublished_at')
                            <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Tanggal Berlaku -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Mulai Berlaku *</label>
                        <input type="date" name="valid_from" required class="w-full px-4 py-3 border border-slate-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-[#063A76] focus:border-[#063A76] @error('valid_from') border-red-500 @enderror" value="{{ old('valid_from') }}">
                        @error('valid_from')
                            <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Berakhir Berlaku *</label>
                        <input type="date" name="valid_until" required class="w-full px-4 py-3 border border-slate-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-[#063A76] focus:border-[#063A76] @error('valid_until') border-red-500 @enderror" value="{{ old('valid_until') }}">
                        @error('valid_until')
                            <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Status -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Status *</label>
                    <select name="status" class="w-full px-4 py-3 border border-slate-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-[#063A76] focus:border-[#063A76] @error('status') border-red-500 @enderror" required>
                        <option value="">-- Pilih Status --</option>
                        <option value="active" {{ old('status', 'active') === 'active' ? 'selected' : '' }}>✓ Aktif</option>
                        <option value="inactive" {{ old('status') === 'inactive' ? 'selected' : '' }}>✗ Tidak Aktif</option>
                    </select>
                    @error('status')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex gap-3 pt-6 border-t border-gray-200">
                    <x-button variant="secondary" size="lg" type="link" href="{{ route('admin.pengumuman.index') }}">Batal</x-button>
                    <x-button variant="primary" size="lg" type="submit" icon="check">Buat Pengumuman</x-button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script src="{{ asset('js/xlsx.min.js') }}"></script>

<script>
// Global Quill instance
let quillInstance = null;

// Wait for all scripts to load
function waitForXLSX(callback, timeoutMs = 10000) {
    console.log('waitForXLSX started...');
    const startTime = Date.now();
    const checkInterval = setInterval(() => {
        console.log('Checking libraries... XLSX:', typeof XLSX, 'Quill:', typeof Quill);
        if (typeof XLSX !== 'undefined' && typeof Quill !== 'undefined') {
            console.log('Both libraries loaded! XLSX version:', XLSX.version);
            clearInterval(checkInterval);
            callback();
        } else if (Date.now() - startTime > timeoutMs) {
            clearInterval(checkInterval);
            console.error('Libraries failed to load after', timeoutMs, 'ms');
            alert('❌ Library tidak berhasil dimuat. Silakan refresh halaman.');
        }
    }, 100);
}

document.addEventListener('DOMContentLoaded', function() {
    waitForXLSX(function() {
        // Initialize Quill Editor
        quillInstance = new Quill('#editor-description', {
            theme: 'snow',
            modules: {
                toolbar: [
                    [{ 'header': [1, 2, 3, false] }],
                    ['bold', 'italic', 'underline', 'strike'],
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                    ['blockquote', 'code-block'],
                    ['link', 'image'],
                    ['clean']
                ]
            },
            placeholder: 'Ketik isi pengumuman di sini...'
        });

        // Handle form submit
        let isFormSubmitting = false;
        let isInsertingExcel = false;
        
        // CRITICAL: Always sync Quill to textarea before submitting
        function syncQuillToTextarea() {
            const content = quillInstance.root.innerHTML;
            const textarea = document.getElementById('description');
            
            console.log('=== SYNC QUILL TO TEXTAREA ===');
            console.log('Quill innerHTML length:', content.length);
            console.log('Current textarea value length:', textarea.value.length);
            console.log('Content includes <table>:', content.includes('<table'));
            console.log('Content includes <th>:', content.includes('<th'));
            
            textarea.value = content;
            
            console.log('AFTER SYNC:');
            console.log('Textarea value length:', textarea.value.length);
            console.log('Textarea value includes <table>:', textarea.value.includes('<table'));
            console.log('====  END SYNC ====');
            
            return content;
        }
        
        document.querySelector('form').addEventListener('submit', function(e) {
            // Prevent double submit
            if (isFormSubmitting) {
                e.preventDefault();
                console.log('⚠️ Form already submitting, preventing double submit');
                return;
            }
            
            console.log('\n🚀 FORM SUBMIT TRIGGERED');
            isFormSubmitting = true;
            
            // Jika sedang insert Excel, jangan process lagi
            if (isInsertingExcel) {
                e.preventDefault();
                isFormSubmitting = false;
                console.log('⚠️ Excel insert in progress, waiting...');
                return;
            }
            
            // Immediately sync Quill content ke textarea
            console.log('📝 Syncing Quill content to textarea FIRST...');
            const initialContent = syncQuillToTextarea();
            
            // Cek apakah ada Excel data yang belum di-insert dari localStorage
            const pendingExcelData = localStorage.getItem('excelPreviewData');
            console.log('📦 Checking localStorage for pending Excel data...');
            console.log('pendingExcelData found:', pendingExcelData ? '✓ YES' : '✗ NO');
            
            if (pendingExcelData) {
                console.log('⏳ Found pending Excel data, inserting now...');
                e.preventDefault();
                isInsertingExcel = true;
                
                try {
                    const excelData = JSON.parse(pendingExcelData);
                    console.log('📊 Inserting table with', excelData.rows.length, 'rows');
                    insertExcelTable(excelData);
                    console.log('✓ insertExcelTable() completed');
                    localStorage.removeItem('excelPreviewData');
                    console.log('🗑️ Cleared localStorage');
                } catch (error) {
                    console.error('❌ Error inserting pending data:', error);
                    isInsertingExcel = false;
                    isFormSubmitting = false;
                    return;
                }
                
                // Wait for Quill content to finish rendering
                setTimeout(() => {
                    console.log('⏱️ 300ms timeout completed, syncing final content...');
                    const finalContent = syncQuillToTextarea();
                    
                    if (!finalContent.includes('<table')) {
                        console.warn('⚠️ WARNING: Final content does NOT contain <table>');
                    } else {
                        console.log('✓ Final content verified to contain <table>');
                    }
                    
                    // Now actually submit the form
                    console.log('📤 Submitting form now...');
                    isFormSubmitting = false;
                    isInsertingExcel = false;
                    
                    // Double-check textarea value before submit
                    const finalValue = document.getElementById('description').value;
                    console.log('Final textarea value length:', finalValue.length);
                    console.log('Final textarea contains <table>:', finalValue.includes('<table'));
                    
                    document.querySelector('form').submit();
                }, 300);
            } else {
                // No pending data, form will submit normally
                console.log('✓ No pending Excel data, form will submit normally');
                
                // Make sure to sync Quill to textarea even if no pending data
                const descValue = document.getElementById('description').value;
                console.log('Final textarea check:');
                console.log('  Length:', descValue.length);
                console.log('  Contains <table>:', descValue.includes('<table'));
                console.log('  First 300 chars:', descValue.substring(0, 300));
                
                // If textarea is empty but Quill has content, sync it
                if (descValue.length === 0 && quillInstance.getLength() > 1) {
                    console.log('⚠️ Textarea empty but Quill has content - syncing now');
                    syncQuillToTextarea();
                }
                
                console.log('💾 FINAL description textarea length:', document.getElementById('description').value.length);
                console.log('📋 FINAL description contains <table>:', document.getElementById('description').value.includes('<table'));
                
                isFormSubmitting = false;
                // Form will submit naturally
            }
        });

        // Excel Dropzone Handler
        const dropzone = document.getElementById('excel-dropzone');
        const excelInput = document.getElementById('excel-input');

        if (dropzone && excelInput) {
            dropzone.addEventListener('click', () => excelInput.click());

            // Drag and drop
            dropzone.addEventListener('dragover', (e) => {
                e.preventDefault();
                dropzone.classList.add('border-blue-500', 'bg-blue-100');
                dropzone.classList.remove('border-blue-300', 'bg-blue-50/50');
            });

            dropzone.addEventListener('dragleave', () => {
                dropzone.classList.remove('border-blue-500', 'bg-blue-100');
                dropzone.classList.add('border-blue-300', 'bg-blue-50/50');
            });

            dropzone.addEventListener('drop', (e) => {
                e.preventDefault();
                dropzone.classList.remove('border-blue-500', 'bg-blue-100');
                dropzone.classList.add('border-blue-300', 'bg-blue-50/50');
                
                const files = e.dataTransfer.files;
                if (files.length > 0) {
                    const file = files[0];
                    // Handle file directly instead of trying to assign to excelInput.files
                    processExcelFile(file);
                }
            });
        }
    });

    // Preview Image (tidak memerlukan XLSX)
    window.previewImage = function(input) {
        const file = input.files[0];
        
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById('image-preview');
                const empty = document.getElementById('image-empty');
                const img = document.getElementById('image-img');
                
                img.src = e.target.result;
                preview.classList.remove('hidden');
                empty.classList.add('hidden');
            };
            reader.readAsDataURL(file);
        }
    };
});

// Handle Excel File Input
function handleExcelFile(input) {
    const file = input.files[0];
    if (!file) return;
    processExcelFile(file);
    // Reset input for re-upload same file
    input.value = '';
}

// Process Excel File directly
function processExcelFile(file) {
    console.log('Processing Excel file:', file.name);
    
    // Check if XLSX is loaded
    if (typeof XLSX === 'undefined') {
        console.error('XLSX library not loaded');
        alert('❌ Library Excel belum siap. Silakan tunggu beberapa detik dan coba lagi.');
        return;
    }
    
    console.log('XLSX library loaded, starting to read file...');

    const reader = new FileReader();
    reader.onload = function(e) {
        try {
            console.log('File read completed, parsing workbook...');
            const data = new Uint8Array(e.target.result);
            const workbook = XLSX.read(data, { type: 'array', cellFormula: false, cellDates: true });
            console.log('Workbook parsed:', workbook?.SheetNames?.length, 'sheets');
            
            if (!workbook || workbook.SheetNames.length === 0) {
                alert('❌ File Excel tidak valid atau tidak bisa dibaca!');
                return;
            }
            
            const sheetName = workbook.SheetNames[0];
            const sheet = workbook.Sheets[sheetName];
            
            if (!sheet || !sheet['!ref']) {
                alert('❌ Sheet Excel kosong atau tidak valid!');
                return;
            }

            // Parse sheet with CSV method for more accuracy
            const csvData = XLSX.utils.sheet_to_csv(sheet, { blankrows: true });
            console.log('CSV data length:', csvData.length);
            const csvLines = csvData.trim().split('\n');
            console.log('CSV lines:', csvLines.length);
            
            if (csvLines.length === 0) {
                alert('❌ File Excel kosong!');
                return;
            }

            // Parse CSV to get rows
            const rows = csvLines.map(line => {
                const cells = [];
                let current = '';
                let inQuotes = false;
                for (let i = 0; i < line.length; i++) {
                    const char = line[i];
                    if (char === '"') {
                        inQuotes = !inQuotes;
                    } else if (char === ',' && !inQuotes) {
                        cells.push(current.replace(/^"|"$/g, ''));
                        current = '';
                    } else {
                        current += char;
                    }
                }
                cells.push(current.replace(/^"|"$/g, ''));
                return cells;
            });

            if (rows.length === 0) {
                alert('❌ File Excel tidak memiliki data!');
                return;
            }

            // Find max columns
            const maxCol = Math.max(...rows.map(r => r.length));

            // Normalize all rows to have same column count
            const normalizedRows = rows.map(row => {
                const normalized = [...row];
                while (normalized.length < maxCol) {
                    normalized.push('');
                }
                return normalized.slice(0, maxCol);
            });

            // Show preview before inserting
            console.log('Data parsed. Rows:', normalizedRows.length, 'Columns:', maxCol);
            const previewHtml = convertToHtmlTable(normalizedRows, [], maxCol);
            console.log('Preview HTML generated, opening preview window...');
            const previewWindow = window.open('', '_blank', 'width=900,height=650');
            
            if (!previewWindow) {
                alert('❌ Pop-up blocked! Silakan izinkan pop-up dari halaman ini.');
                return;
            }
            
            previewWindow.document.write(`
                <!DOCTYPE html>
                <html>
                <head>
                    <meta charset="UTF-8">
                    <title>Preview Tabel Excel</title>
                    <style>
                        body { font-family: Arial, sans-serif; padding: 20px; background: #f5f5f5; }
                        .container { max-width: 100%; margin: 0 auto; background: white; padding: 20px; border-radius: 8px; }
                        h2 { margin-top: 0; }
                        .info { color: #666; margin-bottom: 15px; }
                        .preview { overflow-x: auto; margin: 20px 0; border: 1px solid #e5e7eb; border-radius: 4px; }
                        ${getCssForTable()}
                        .buttons { margin-top: 20px; text-align: center; }
                        button { padding: 10px 20px; margin: 0 5px; font-size: 14px; cursor: pointer; border: none; border-radius: 4px; }
                        .btn-insert { background: #10b981; color: white; }
                        .btn-cancel { background: #ef4444; color: white; }
                        button:hover { opacity: 0.9; }
                    </style>
                </head>
                <body>
                    <div class="container">
                        <h2>✓ Preview Data Excel</h2>
                        <div class="info">File: <strong>${file.name}</strong> | Baris: <strong>${normalizedRows.length}</strong> | Kolom: <strong>${maxCol}</strong></div>
                        <div class="preview">
                            ${previewHtml}
                        </div>
                        <div class="buttons">
                            <button class="btn-insert" onclick="window.opener.insertExcelTableFromPopup(); window.close();">Lanjutkan Insert</button>
                            <button class="btn-cancel" onclick="window.close();">Batal</button>
                        </div>
                    </div>
                </body>
                </html>
            `);
            previewWindow.focus();

            // Store data for later insertion using localStorage (more reliable cross-window)
            const dataToStore = {
                rows: normalizedRows,
                colWidths: [],
                maxCol: maxCol,
                fileName: file.name
            };
            console.log('Storing Excel data to localStorage:', dataToStore.rows.length, 'rows');
            localStorage.setItem('excelPreviewData', JSON.stringify(dataToStore));
            console.log('Data stored, verification:',  localStorage.getItem('excelPreviewData') ? 'OK' : 'FAILED');
            
            // Reset input
        } catch (error) {
            console.error('Error reading Excel:', error);
            alert('❌ Gagal membaca file Excel:\n' + error.message);
        }
    };
    
    reader.onerror = function(error) {
        console.error('File reading error:', error);
        alert('❌ Gagal membaca file. Silakan coba file lain.');
    };
    
    reader.readAsArrayBuffer(file);
}

// Insert Excel table after user confirms in preview
// Handle Excel insertion from popup window
function insertExcelTableFromPopup() {
    console.log('insertExcelTableFromPopup called from popup');
    const data = localStorage.getItem('excelPreviewData');
    console.log('Retrieved from localStorage:', data ? 'Found (' + data.length + ' bytes)' : 'NOT FOUND');
    
    if (!data) {
        console.error('No data in localStorage!');
        alert('❌ Data tidak ditemukan. Silakan coba lagi.');
        return;
    }
    
    try {
        const excelData = JSON.parse(data);
        console.log('Parsed data:', excelData.rows.length, 'rows');
        insertExcelTable(excelData);
        console.log('insertExcelTable completed');
        localStorage.removeItem('excelPreviewData');
        console.log('Data cleared from localStorage');
    } catch (error) {
        console.error('Error parsing or inserting Excel data:', error);
        alert('❌ Error: ' + error.message);
    }
}

// Insert Excel table into Quill editor - DIRECT DOM INSERTION
function insertExcelTable(excelData) {
    console.log('=== BEGIN insertExcelTable ===');
    console.log('Data received:', excelData);
    
    if (!excelData) {
        console.error('No excelData provided');
        return;
    }
    
    if (!quillInstance) {
        console.error('quillInstance not available');
        return;
    }
    
    const { rows, fileName } = excelData;
    console.log('Row count:', rows.length);
    
    // Generate clean HTML table
    const htmlTable = convertToHtmlTable(rows, [], rows[0].length);
    console.log('✓ Table HTML generated, size:', htmlTable.length, 'bytes');
    
    try {
        // Create temporary container to hold the table HTML
        console.log('Creating temporary container...');
        const tempContainer = document.createElement('div');
        tempContainer.style.display = 'none';
        tempContainer.innerHTML = htmlTable;
        document.body.appendChild(tempContainer);
        console.log('✓ Temporary container created');
        
        // Verify table was actually created
        const tableElement = tempContainer.querySelector('table');
        if (!tableElement) {
            throw new Error('Table element not found in temporary container');
        }
        console.log('✓ Table element verified in container');
        console.log('  - Table rows: ' + tableElement.querySelectorAll('tr').length);
        
        // Clone the table - this is CRITICAL
        const clonedTable = tableElement.cloneNode(true);
        console.log('✓ Table element cloned');
        
        // Insert directly into Quill's root DOM - BYPASSES SANITIZATION
        console.log('Inserting table directly into Quill root...');
        
        // Add spacing paragraph first if content exists
        const quillLength = quillInstance.getLength();
        if (quillLength > 1) {
            quillInstance.insertText(quillLength - 1, '\n');
        }
        
        // Insert the cloned table directly as DOM element
        quillInstance.root.appendChild(clonedTable);
        console.log('✓ Table inserted into DOM');
        
        // Check immediately after insert
        let checkHTML = quillInstance.root.innerHTML;
        console.log('CHECK 1 - Right after appendChild:');
        console.log('  HTML length:', checkHTML.length);
        console.log('  Has <table>:', checkHTML.includes('<table'));
        
        // NOTE: We do NOT call update() because that rebuilds from delta
        // and Quill might not recognize the table element properly
        // Instead, we just verify the DOM was modified and sync to textarea
        
        // CRITICAL: Immediately backup table HTML to textarea
        // This is the ONLY place we can reliably capture the table
        console.log('\n🔐 BACKING UP TABLE HTML TO TEXTAREA (IMMEDIATE)...');
        const textarea = document.getElementById('description');
        
        // Get the HTML right now, before anything else happens
        const tableHTML = quillInstance.root.innerHTML;
        console.log('Capturing from quill.root.innerHTML:');
        console.log('  Length:', tableHTML.length);
        console.log('  Has table:', tableHTML.includes('<table'));
        console.log('  Preview:', tableHTML.substring(0, 200));
        
        // Set textarea immediately
        textarea.value = tableHTML;
        console.log('✓ Textarea.value set immediately');
        console.log('  Textarea length:', textarea.value.length);
        console.log('  Textarea has table:', textarea.value.includes('<table'));
        
        // Clean up temp container immediately
        document.body.removeChild(tempContainer);
        console.log('✓ Temporary container removed');
        
        // Give browser time to render display
        setTimeout(() => {
            const verifyHTML = quillInstance.root.innerHTML;
            console.log('\n=== VERIFICATION (after timeout) ===');
            console.log('Quill root HTML length:', verifyHTML.length);
            console.log('Has <table>:', verifyHTML.includes('<table') ? '✓ YES' : '✗ NO');
            console.log('Textarea still has <table>:', textarea.value.includes('<table') ? '✓ YES' : '✗ NO');
            
            // Success
            console.log('✓✓✓ TABLE INSERTION COMPLETE!');
            showExcelSuccess(fileName, rows.length - 1);
            
        }, 100);
        
    } catch (error) {
        console.error('❌ ERROR:', error.message);
        console.error('Full error:', error);
        
        // Clean up temp container if it exists
        try {
            const temp = document.querySelector('div[style*="display"]');
            if (temp && temp.parentNode) {
                document.body.removeChild(temp);
            }
        } catch(e) {}
        
        alert('❌ Error inserting table: ' + error.message);
    }
}

// Get CSS for table preview
function getCssForTable() {
    return 'table { width: 100%; border-collapse: collapse; border: 1px solid #d1d5db; font-size: 13px; } th { background: #3b82f6; color: white; padding: 8px; text-align: center; font-weight: 700; border: 1px solid #d1d5db; } td { padding: 8px; border: 1px solid #d1d5db; } tr:nth-child(even) { background: #f0f4f8; } tr:hover { background: #e0e7ff; }';
}

// Convert Array to HTML Table - SIMPLIFIED VERSION
function convertToHtmlTable(data, colWidths, maxCol) {
    if (!data || data.length === 0) return '';
    
    console.log('Converting to HTML table. Rows:', data.length);
    
    let html = '<table style="width:100%; border-collapse: collapse; margin: 1rem 0; border: 1px solid #ccc;">';
    
    data.forEach((row, rowIndex) => {
        const isHeader = rowIndex === 0;
        const bgColor = isHeader ? '#3b82f6' : (rowIndex % 2 === 0 ? '#fff' : '#f9f9f9');
        
        html += '<tr>';
        
        row.forEach((cell, cellIndex) => {
            const tag = isHeader ? 'th' : 'td';
            const cellValue = String(cell || '').replace(/"/g, '&quot;');
            
            html += `<${tag} style="border: 1px solid #ccc; padding: 8px; background-color: ${bgColor}; color: ${isHeader ? '#fff' : '#000'}; font-weight: ${isHeader ? 'bold' : 'normal'};">`;
            html += cellValue;
            html += `</${tag}>`;
        });
        
        html += '</tr>';
    });
    
    html += '</table>';
    console.log('HTML table generated:', html.substring(0, 100) + '...');
    return html;
}

// Escape HTML to prevent injection
function escapeHtml(text) {
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}

// Show Success Message
function showExcelSuccess(fileName, rowCount) {
    if (typeof Swal !== 'undefined') {
        Swal.fire({
            icon: 'success',
            title: '✓ Tabel Berhasil Ditambahkan!',
            html: `<p style="color: #4b5563;">File: <strong>${fileName}</strong></p><p style="color: #4b5563;">Baris data: <strong>${rowCount}</strong></p>`,
            timer: 3000,
            timerProgressBar: false,
            showConfirmButton: false
        });
    } else {
        alert(`✓ Tabel dari Excel (${fileName}) berhasil ditambahkan!\n${rowCount} baris data.`);
    }
}
</script>

<style>
    #excel-dropzone {
        transition: all 0.3s ease;
    }

    #excel-dropzone:hover {
        transform: translateY(-2px);
    }
    
    /* Custom Quill Editor Styles */
    .ql-toolbar.ql-snow {
        border: 1px solid #d1d5db;
        border-radius: 0.5rem 0.5rem 0 0;
        background: #f9fafb;
    }

    .ql-container.ql-snow {
        border: 1px solid #d1d5db;
        border-radius: 0 0 0.5rem 0.5rem;
        font-size: 1rem;
    }

    #editor-description {
        background: white;
    }

    /* Excel Table Styles */
    .excel-table {
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    }

    .excel-table th {
        background: #f3f4f6 !important;
        font-weight: 600 !important;
        color: #1f2937;
    }

    .excel-table td {
        color: #374151;
    }

    .excel-table tr:hover {
        background: #f0f9ff !important;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    window.previewImage = function(input) {
        const file = input.files[0];
        
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById('image-preview');
                const empty = document.getElementById('image-empty');
                const img = document.getElementById('image-img');
                
                img.src = e.target.result;
                preview.classList.remove('hidden');
                empty.classList.add('hidden');
            };
            reader.readAsDataURL(file);
        }
    };
});
</script>
@endsection
