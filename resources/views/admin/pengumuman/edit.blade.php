@extends('layouts.app')

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<style>
    .font-cairo { font-family: 'Cairo', sans-serif; }
</style>
@endpush

@section('content')
<div class="bg-gray-50 min-h-screen py-12 pt-28 font-cairo">
    <div class="max-w-6xl mx-auto px-6">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center gap-4 mb-4">
                <a href="{{ route('admin.pengumuman.index') }}" class="inline-flex items-center justify-center w-10 h-10 bg-white border border-gray-200 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors shadow-sm" title="Kembali">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                </a>
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Edit Pengumuman</h1>
                    <p class="text-sm text-gray-500 mt-1">Perbarui informasi pengumuman di sini.</p>
                </div>
            </div>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-10">
            <form action="{{ route('admin.pengumuman.update', $pengumuman) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf
                @method('PUT')
                
                <!-- Judul Pengumuman -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Judul Pengumuman *</label>
                    <input type="text" name="title" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-all" value="{{ old('title', $pengumuman->title) }}" placeholder="Masukkan judul pengumuman" required>
                    @error('title')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Isi Pengumuman dengan Quill Editor -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Isi Pengumuman *</label>
                    <div id="editor-description" class="border border-gray-300 rounded-lg shadow-sm" style="border-radius: 0.5rem; overflow: hidden; min-height: 300px;">
                        {!! $pengumuman->description !!}
                    </div>
                    <textarea name="description" id="description" class="editor hidden" placeholder="Ketik isi pengumuman di sini...">{!! old('description', $pengumuman->description) !!}</textarea>
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
                    <label class="block text-sm font-semibold text-gray-700 mb-4">Gambar Pengumuman</label>
                    
                    <!-- Current Image Preview -->
                    @if($pengumuman->image_path)
                        <div class="mb-4 p-4 bg-gray-50 rounded-lg border border-gray-200">
                            <p class="text-sm font-medium text-gray-700 mb-2">Gambar Saat Ini:</p>
                            <img src="{{ asset('storage/' . $pengumuman->image_path) }}" alt="Gambar Pengumuman" class="h-32 w-auto rounded border border-gray-300">
                        </div>
                    @endif
                    
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center cursor-pointer hover:border-blue-400 transition" onclick="document.getElementById('image-input').click()">
                        <div id="image-preview" class="hidden">
                            <img id="image-img" src="" alt="Gambar" class="w-full h-48 object-cover rounded mb-2">
                            <x-button size="sm" variant="primary">Ubah Gambar</x-button>
                        </div>
                        <div id="image-empty" class="flex flex-col items-center justify-center h-48">
                            <svg class="w-8 h-8 text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            <p class="text-sm font-semibold text-gray-700">Ganti Gambar (Opsional)</p>
                        </div>
                        <input type="file" id="image-input" name="image" accept="image/*" class="hidden" onchange="previewImage(this)">
                    </div>
                    <p class="text-sm text-gray-500 mt-3">Klik untuk mengganti gambar. Format: JPG, PNG, GIF • Maks: 2MB</p>
                    @error('image')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Tanggal Publikasi -->
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Publikasi</label>
                        <input type="datetime-local" name="published_at" class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" value="{{ old('published_at', $pengumuman->published_at?->format('Y-m-d\TH:i')) }}">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Unpublikasi</label>
                        <input type="datetime-local" name="unpublished_at" class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" value="{{ old('unpublished_at', $pengumuman->unpublished_at?->format('Y-m-d\TH:i')) }}">
                    </div>
                </div>

                <!-- Tanggal Berlaku -->
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Mulai Berlaku</label>
                        <input type="date" name="valid_from" class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" value="{{ old('valid_from', $pengumuman->valid_from?->format('Y-m-d')) }}">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Berakhir Berlaku</label>
                        <input type="date" name="valid_until" class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" value="{{ old('valid_until', $pengumuman->valid_until?->format('Y-m-d')) }}">
                    </div>
                </div>

                <!-- Status -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Status *</label>
                    <select name="status" class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('status') border-red-500 @enderror" required>
                        <option value="">-- Pilih Status --</option>
                        <option value="active" {{ old('status', $pengumuman->status) === 'active' ? 'selected' : '' }}>✓ Aktif</option>
                        <option value="inactive" {{ old('status', $pengumuman->status) === 'inactive' ? 'selected' : '' }}>✗ Tidak Aktif</option>
                    </select>
                    @error('status')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Action Buttons -->
                <div class="flex gap-3 pt-6 border-t border-gray-200">
                    <x-button variant="secondary" size="lg" type="link" href="{{ route('admin.pengumuman.index') }}">Batal</x-button>
                    <x-button variant="primary" size="lg" type="submit" icon="check">Update Pengumuman</x-button>
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
        document.querySelector('form').addEventListener('submit', function(e) {
            // Prevent double submit
            if (isFormSubmitting) {
                e.preventDefault();
                console.log('Form already submitting, preventing double submit');
                return;
            }
            
            console.log('Form submit triggered');
            
            // Cek apakah ada Excel data yang belum di-insert dari localStorage
            const pendingExcelData = localStorage.getItem('excelPreviewData');
            if (pendingExcelData) {
                console.log('Found pending Excel data, preventing submit to insert first');
                e.preventDefault();
                isFormSubmitting = true;
                
                try {
                    const excelData = JSON.parse(pendingExcelData);
                    console.log('Inserting pending table...');
                    insertExcelTable(excelData);
                    localStorage.removeItem('excelPreviewData');
                } catch (error) {
                    console.error('Error inserting pending data:', error);
                }
                
                // Wait for Quill to update, then sync and submit
                setTimeout(() => {
                    console.log('Syncing Quill content...');
                    const content = quillInstance.root.innerHTML;
                    console.log('Content length:', content.length, 'Has table:', content.includes('<table'));
                    document.getElementById('description').value = content;
                    console.log('Content synced, submitting form now...');
                    isFormSubmitting = false;
                    document.querySelector('form').submit();
                }, 200);
            } else {
                // No pending data, sync and allow normal submission
                console.log('No pending Excel data, syncing content normally');
                const content = quillInstance.root.innerHTML;
                document.getElementById('description').value = content;
                console.log('Content synced');
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
            console.log('Data stored, verification:', localStorage.getItem('excelPreviewData') ? 'OK' : 'FAILED');
            
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

// Insert Excel table into Quill editor
function insertExcelTable(excelData) {
    console.log('insertExcelTable called with data:', excelData);
    
    if (!excelData) {
        console.error('No excelData provided');
        return;
    }
    
    if (!quillInstance) {
        console.error('quillInstance not available');
        return;
    }
    
    const { rows, fileName } = excelData;
    console.log('Rows to insert:', rows.length);
    
    const htmlTable = convertToHtmlTable(rows, [], rows[0].length);
    console.log('HTML table created, length:', htmlTable.length);
    
    try {
        // Get current position in Quill
        const index = quillInstance.getLength() - 1;
        console.log('Inserting at index:', index);
        
        // Insert a newline first
        quillInstance.insertText(index, '\n');
        
        // Insert the HTML table
        quillInstance.clipboard.dangerouslyPasteHTML(index + 1, htmlTable);
        
        console.log('Table inserted successfully');
        showExcelSuccess(fileName, rows.length - 1);
        
    } catch (error) {
        console.error('Error inserting table:', error);
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
@endsection
