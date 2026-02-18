

<?php $__env->startPush('styles'); ?>
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="bg-gray-50 min-h-screen py-12 pt-28">
    <div class="max-w-6xl mx-auto px-6">
        <!-- Header dengan Navigation -->
        <div class="mb-8">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center gap-3">
                    <a href="<?php echo e(route('admin.pengumuman.index')); ?>" class="inline-flex items-center justify-center w-10 h-10 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors" title="Kembali">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                    </a>
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">Buat Pengumuman Baru</h1>
                        <p class="text-sm text-gray-600 mt-1">Tambahkan pengumuman baru untuk tampil di halaman utama</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8">
            <?php if($errors->any()): ?>
                <div class="bg-red-50 border border-red-200 text-red-700 px-6 py-4 rounded-lg mb-6">
                    <h3 class="font-semibold mb-2">Terjadi Kesalahan:</h3>
                    <ul class="list-disc list-inside space-y-1">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form action="<?php echo e(route('admin.pengumuman.store')); ?>" method="POST" enctype="multipart/form-data" class="space-y-6">
                <?php echo csrf_field(); ?>
                
                <!-- Judul Pengumuman -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Judul Pengumuman *</label>
                    <input type="text" name="title" class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('title')); ?>" placeholder="Masukkan judul pengumuman" required>
                    <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="text-red-500 text-sm mt-1 block"><?php echo e($message); ?></span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Isi Pengumuman dengan Quill Editor -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Isi Pengumuman *</label>
                    <div id="editor-description" class="border border-gray-300 rounded-lg shadow-sm" style="border-radius: 0.5rem; overflow: hidden; min-height: 300px;"></div>
                    <textarea name="description" id="description" class="editor hidden" placeholder="Ketik isi pengumuman di sini..."><?php echo e(old('description')); ?></textarea>
                    <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="text-red-500 text-sm mt-1 block"><?php echo e($message); ?></span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
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
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center cursor-pointer hover:border-blue-400 transition" onclick="document.getElementById('image-input').click()">
                        <div id="image-preview" class="hidden">
                            <img id="image-img" src="" alt="Gambar" class="w-full h-48 object-cover rounded mb-2">
                            <?php if (isset($component)) { $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['size' => 'sm','variant' => 'primary']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['size' => 'sm','variant' => 'primary']); ?>Ubah Gambar <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $attributes = $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $component = $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
                        </div>
                        <div id="image-empty" class="flex flex-col items-center justify-center h-48">
                            <svg class="w-8 h-8 text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            <p class="text-sm font-semibold text-gray-700">Gambar Pengumuman</p>
                        </div>
                        <input type="file" id="image-input" name="image" accept="image/*" class="hidden" onchange="previewImage(this)">
                    </div>
                    <p class="text-sm text-gray-500 mt-3">Klik untuk menambah gambar. Format: JPG, PNG, GIF • Maks: 2MB</p>
                    <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="text-red-500 text-sm mt-1 block"><?php echo e($message); ?></span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Tanggal Publikasi -->
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Publikasi</label>
                        <input type="datetime-local" name="published_at" class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" value="<?php echo e(old('published_at')); ?>">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Unpublikasi</label>
                        <input type="datetime-local" name="unpublished_at" class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" value="<?php echo e(old('unpublished_at')); ?>">
                    </div>
                </div>

                <!-- Tanggal Berlaku -->
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Mulai Berlaku</label>
                        <input type="date" name="valid_from" class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" value="<?php echo e(old('valid_from')); ?>">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Berakhir Berlaku</label>
                        <input type="date" name="valid_until" class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" value="<?php echo e(old('valid_until')); ?>">
                    </div>
                </div>

                <!-- Status -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Status *</label>
                    <select name="status" class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                        <option value="">-- Pilih Status --</option>
                        <option value="active" <?php echo e(old('status', 'active') === 'active' ? 'selected' : ''); ?>>✓ Aktif</option>
                        <option value="inactive" <?php echo e(old('status') === 'inactive' ? 'selected' : ''); ?>>✗ Tidak Aktif</option>
                    </select>
                    <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="text-red-500 text-sm mt-1 block"><?php echo e($message); ?></span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="flex gap-3 pt-6 border-t border-gray-200">
                    <?php if (isset($component)) { $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['variant' => 'secondary','size' => 'lg','type' => 'link','href' => ''.e(route('admin.pengumuman.index')).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'secondary','size' => 'lg','type' => 'link','href' => ''.e(route('admin.pengumuman.index')).'']); ?>Batal <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $attributes = $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $component = $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
                    <?php if (isset($component)) { $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['variant' => 'primary','size' => 'lg','type' => 'submit','icon' => 'check']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'primary','size' => 'lg','type' => 'submit','icon' => 'check']); ?>Buat Pengumuman <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $attributes = $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $component = $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script src="<?php echo e(asset('js/xlsx.min.js')); ?>"></script>

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
        document.querySelector('form').addEventListener('submit', function() {
            // Cek apakah ada Excel data yang belum di-insert dari localStorage
            const pendingExcelData = localStorage.getItem('excelPreviewData');
            if (pendingExcelData) {
                try {
                    const excelData = JSON.parse(pendingExcelData);
                    insertExcelTable(excelData);
                    localStorage.removeItem('excelPreviewData');
                } catch (error) {
                    console.warn('Could not insert pending Excel data:', error);
                }
            }
            
            const content = quillInstance.root.innerHTML;
            document.getElementById('description').value = content;
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
            localStorage.setItem('excelPreviewData', JSON.stringify({
                rows: normalizedRows,
                colWidths: [],
                maxCol: maxCol,
                fileName: file.name
            }));
            
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
    const data = localStorage.getItem('excelPreviewData');
    if (!data) return;
    
    try {
        const excelData = JSON.parse(data);
        insertExcelTable(excelData);
        localStorage.removeItem('excelPreviewData');
    } catch (error) {
        console.error('Error parsing Excel data:', error);
        alert('❌ Error inserting table: ' + error.message);
    }
}

// Insert Excel table into Quill editor
function insertExcelTable(excelData) {
    if (!excelData || !quillInstance) return;
    
    const { rows, colWidths, maxCol, fileName } = excelData;
    const htmlTable = convertToHtmlTable(rows, colWidths, maxCol);
    
    const index = quillInstance.getLength() - 1;
    quillInstance.insertText(index, '\n');
    quillInstance.clipboard.dangerouslyPasteHTML(index + 1, htmlTable);
    
    showExcelSuccess(fileName, rows.length - 1);
}

// Get CSS for table preview
function getCssForTable() {
    return 'table { width: 100%; border-collapse: collapse; border: 1px solid #d1d5db; font-size: 13px; } th { background: #3b82f6; color: white; padding: 8px; text-align: center; font-weight: 700; border: 1px solid #d1d5db; } td { padding: 8px; border: 1px solid #d1d5db; } tr:nth-child(even) { background: #f0f4f8; } tr:hover { background: #e0e7ff; }';
}

// Convert Array to HTML Table with Column Width Support
function convertToHtmlTable(data, colWidths, maxCol) {
    // Calculate column widths (Excel uses character width, convert to approximate pixels)
    const getColWidth = (colIndex) => {
        if (colWidths && colWidths[colIndex]) {
            const excelWidth = colWidths[colIndex].wch || colWidths[colIndex].width || 10;
            return Math.max(excelWidth * 8, 60); // ~8px per character unit, min 60px
        }
        return 'auto';
    };

    let html = '<table class="excel-table" style="width:100%; border-collapse: collapse; margin: 1rem 0; border: 1px solid #d1d5db; font-size: 14px; table-layout: auto;">';
    
    data.forEach((row, rowIndex) => {
        const isHeader = rowIndex === 0;
        html += '<tr style="background-color: ' + (isHeader ? '#3b82f6' : (rowIndex % 2 === 0 ? '#ffffff' : '#f0f4f8')) + '; border-bottom: 1px solid #d1d5db;">';
        
        // Ensure we have enough cells (handle cases where rows have different lengths)
        const rowLength = Math.max(row.length, maxCol);
        
        for (let cellIndex = 0; cellIndex < rowLength; cellIndex++) {
            const cell = row[cellIndex] !== undefined ? row[cellIndex] : '';
            const tag = isHeader ? 'th' : 'td';
            const cellText = escapeHtml(String(cell || ''));
            const colWidth = getColWidth(cellIndex);
            const widthStyle = colWidth !== 'auto' ? 'min-width: ' + colWidth + 'px;' : '';
            
            const style = isHeader 
                ? 'style="border: 1px solid #d1d5db; padding: 0.75rem; text-align: center; font-weight: 700; color: white; background-color: #3b82f6; white-space: normal; word-wrap: break-word; ' + widthStyle + '"'
                : 'style="border: 1px solid #d1d5db; padding: 0.75rem; text-align: left; font-weight: 400; color: #374151; white-space: normal; word-wrap: break-word; word-break: break-word; ' + widthStyle + '"';
            
            html += '<' + tag + ' ' + style + '>' + cellText + '</' + tag + '>';
        }
        
        html += '</tr>';
    });
    
    html += '</table>';
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Pemustaka\Desktop\Infobase_uppjpds\resources\views/admin/pengumuman/create.blade.php ENDPATH**/ ?>