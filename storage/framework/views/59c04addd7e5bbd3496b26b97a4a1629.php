<?php $__env->startPush('styles'); ?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<style>
    .font-cairo { font-family: 'Cairo', sans-serif; }
    
    /* Quill Editor Customization */
    .ql-toolbar {
        background-color: #f9fafb;
        border: 2px solid #e5e7eb;
        border-bottom: 1px solid #e5e7eb;
        border-radius: 0.5rem 0.5rem 0 0;
    }
    
    .ql-container {
        border: 2px solid #e5e7eb;
        border-top: none;
        border-radius: 0 0 0.5rem 0.5rem;
        font-family: inherit;
    }
    
    .ql-editor {
        min-height: 250px;
        padding: 1.25rem;
        font-size: 1rem;
        line-height: 1.75;
    }
    
    .ql-editor.ql-blank::before {
        color: #9ca3af;
        font-style: italic;
    }
    
    .ql-toolbar button:hover,
    .ql-toolbar button.ql-active {
        color: #063A76;
    }
    
    .ql-toolbar.ql-snow .ql-formats {
        margin-right: 1rem;
    }
    
    .ql-toolbar.ql-snow .ql-stroke {
        stroke: #6b7280;
    }
    
    .ql-toolbar.ql-snow .ql-fill {
        fill: #6b7280;
    }
    
    /* Preview Content Styling */
    #preview-content {
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
        font-size: 1rem;
        line-height: 1.75;
        color: #2d3748;
    }

    #preview-content h1,
    #preview-content h2,
    #preview-content h3,
    #preview-content h4,
    #preview-content h5,
    #preview-content h6 {
        font-weight: 700;
        margin-top: 1.5rem;
        margin-bottom: 0.75rem;
        color: #1a202c;
    }

    #preview-content h1 { font-size: 1.875rem; }
    #preview-content h2 { font-size: 1.5rem; }
    #preview-content h3 { font-size: 1.25rem; }
    #preview-content h4 { font-size: 1.125rem; }

    #preview-content p {
        margin-bottom: 1rem;
    }

    #preview-content strong,
    #preview-content b {
        font-weight: 700;
        color: #1a202c;
    }

    #preview-content em,
    #preview-content i {
        font-style: italic;
        color: #374151;
    }

    #preview-content ul,
    #preview-content ol {
        margin: 1rem 0;
        padding-left: 2rem;
    }

    #preview-content li {
        margin-bottom: 0.5rem;
        color: #374151;
    }

    #preview-content ol {
        list-style-type: decimal;
    }

    #preview-content ul {
        list-style-type: disc;
    }

    #preview-content blockquote {
        border-left: 4px solid #3b82f6;
        padding-left: 1rem;
        margin: 1rem 0;
        color: #4b5563;
        background: #eff6ff;
        padding: 1rem;
        border-radius: 0.5rem;
    }

    #preview-content code {
        background: #f3f4f6;
        padding: 0.25rem 0.5rem;
        border-radius: 0.25rem;
        font-family: 'Monaco', 'Menlo', 'Ubuntu Mono', monospace;
        font-size: 0.9rem;
        color: #7c3aed;
    }

    #preview-content pre {
        background: #1f2937;
        color: #f3f4f6;
        padding: 1rem;
        border-radius: 0.5rem;
        overflow-x: auto;
        margin: 1rem 0;
    }

    #preview-content pre code {
        background: none;
        color: #f3f4f6;
        padding: 0;
    }

    #preview-content table {
        width: 100%;
        border-collapse: collapse;
        margin: 1rem 0;
    }

    #preview-content th,
    #preview-content td {
        border: 1px solid #d1d5db;
        padding: 0.75rem;
        text-align: left;
    }

    #preview-content th {
        background: #f3f4f6;
        font-weight: 600;
        color: #1f2937;
    }

    #preview-content a {
        color: #3b82f6;
        text-decoration: underline;
    }

    #preview-content a:hover {
        color: #2563eb;
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="bg-[#f8fafc] min-h-screen py-6 sm:py-8 font-cairo">
    <div class="max-w-6xl mx-auto px-4 sm:px-6">
        
        <div class="flex flex-col md:flex-row items-center justify-between mb-8 bg-white p-5 sm:p-6 rounded-2xl shadow-sm border border-slate-200">
            <div>
                <h1 class="h2 text-[#063A76]">Manajemen Tata Tertib</h1>
                <p class="text-sm text-slate-500">Kelola daftar peraturan dan tata tertib sekolah di sini.</p>
            </div>
            <div class="relative mt-4 md:mt-0">
                <button id="dropdownButton" class="inline-flex items-center px-5 py-2.5 bg-[#063A76] hover:bg-[#052A57] text-white text-sm font-semibold rounded-xl transition-all duration-200 shadow-sm hover:shadow-md gap-2">
                    <i class="fas fa-plus"></i>
                    Tambah
                </button>
                <div id="dropdownMenu" class="absolute right-0 mt-2 w-56 bg-white border border-gray-200 rounded-xl shadow-lg z-10 hidden">
                    <button type="button" onclick="openModal('jenisModal'); return false;" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Tambah Jenis Tata Tertib</button>
                    <a href="<?php echo e(route('admin.tata_tertib.create')); ?>" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Tambah Tata Tertib</a>
                </div>
            </div>
        </div>

        <!-- Modal Jenis Tata Tertib -->
        <div id="jenisModal" class="fixed inset-0 backdrop-blur-sm bg-white/30 overflow-y-auto h-full w-full hidden z-50 flex items-center justify-center p-4">
            <div class="relative bg-white border border-gray-200 rounded-lg shadow-lg w-full max-w-md max-h-[85vh] flex flex-col">
                <!-- Header -->
                <div class="flex justify-between items-center p-6 border-b border-gray-200 flex-shrink-0">
                    <h3 class="text-lg font-medium text-gray-900">Kelola Jenis Tata Tertib</h3>
                    <button type="button" onclick="closeModal('jenisModal')" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>

                <!-- Form Tambah Jenis Baru -->
                <div class="border-b border-gray-200 p-6 bg-gray-50 flex-shrink-0">
                    <h4 class="text-sm font-semibold text-gray-700 mb-3">Tambah Jenis Baru</h4>
                    <form action="<?php echo e(route('admin.tata_tertib.store-jenis')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Jenis</label>
                            <input type="text" name="name" placeholder="Masukkan nama jenis tata tertib" class="w-full px-3 py-2 border border-slate-300 rounded-md shadow-sm focus:outline-none focus:ring-[#063A76] focus:border-[#063A76] text-sm" required>
                        </div>
                        <div class="flex justify-end gap-3">
                            <?php if (isset($component)) { $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['variant' => 'secondary','size' => 'md','type' => 'button','onclick' => 'closeModal(\'jenisModal\')']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'secondary','size' => 'md','type' => 'button','onclick' => 'closeModal(\'jenisModal\')']); ?>Batal <?php echo $__env->renderComponent(); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['variant' => 'primary','size' => 'md','type' => 'submit']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'primary','size' => 'md','type' => 'submit']); ?>Simpan <?php echo $__env->renderComponent(); ?>
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

                <!-- Scrollable List Section (Shows ~4 items, then scroll) -->
                <div class="overflow-y-auto flex-grow px-6 py-4 min-h-0">
                    <h4 class="text-sm font-semibold text-gray-700 mb-3">Daftar Jenis</h4>
                    <div class="space-y-2">
                        <?php $__empty_1 = true; $__currentLoopData = $jenis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg border border-gray-200 hover:bg-gray-100 transition-colors">
                                <div class="flex-1">
                                    <p class="font-medium text-gray-800 text-sm"><?php echo e($item->name); ?></p>
                                    <p class="text-xs text-gray-500"><?php echo e($item->tataTertibs->count()); ?> item<?php echo e($item->tataTertibs->count() !== 1 ? 's' : ''); ?></p>
                                </div>
                                <?php if (isset($component)) { $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['variant' => 'ghost-danger','size' => 'sm','type' => 'button','onclick' => 'openDeleteModal(\'deleteJenisModal\', \''.e($item->name).'\', \'/admin/tata-tertib/jenis/'.e($item->id).'\')','icon' => 'trash']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'ghost-danger','size' => 'sm','type' => 'button','onclick' => 'openDeleteModal(\'deleteJenisModal\', \''.e($item->name).'\', \'/admin/tata-tertib/jenis/'.e($item->id).'\')','icon' => 'trash']); ?>
                                    Hapus
                                 <?php echo $__env->renderComponent(); ?>
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
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <p class="text-center text-gray-400 text-sm py-4">Belum ada jenis tata tertib</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Preview Modal -->
        <div id="previewTataTertibModal" class="fixed inset-0 backdrop-blur-sm bg-black/40 hidden z-50 flex items-center justify-center p-4">
            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-3xl max-h-[90vh] overflow-hidden flex flex-col animate-in fade-in zoom-in duration-300">
                <!-- Header -->
                <div class="sticky top-0 bg-gradient-to-r from-blue-50 to-blue-100 border-b border-blue-200 p-6 flex items-center justify-between z-10">
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 bg-blue-200 rounded-xl flex items-center justify-center shadow-md">
                            <i class="fas fa-file-alt text-blue-700 text-2xl"></i>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900">Deskripsi Tata Tertib</h3>
                            <p id="preview-jenis" class="text-sm text-blue-600 font-semibold mt-1"></p>
                        </div>
                    </div>
                    <button type="button" onclick="closeModal('previewTataTertibModal')" class="w-10 h-10 flex items-center justify-center text-gray-400 hover:text-gray-600 hover:bg-white rounded-lg transition-all">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>

                <!-- Content -->
                <div class="overflow-y-auto flex-1 p-8">
                    <div id="preview-content" class="bg-white p-6 rounded-lg border border-gray-200 shadow-inner"></div>
                </div>

                <!-- Footer -->
                <div class="sticky bottom-0 bg-gray-50 border-t border-gray-200 p-6 flex justify-between items-center gap-3">
                    <div class="flex gap-2">
                        <button type="button" onclick="copyPreviewContent()" class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 rounded-lg font-semibold hover:bg-gray-200 transition-all duration-200 gap-2 group">
                            <i class="fas fa-copy group-hover:scale-110 transition-transform"></i>
                            <span>Salin Teks</span>
                        </button>
                        <button type="button" onclick="printPreview()" class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 rounded-lg font-semibold hover:bg-gray-200 transition-all duration-200 gap-2 group">
                            <i class="fas fa-print group-hover:scale-110 transition-transform"></i>
                            <span>Cetak</span>
                        </button>
                    </div>
                    <button type="button" onclick="closeModal('previewTataTertibModal')" class="inline-flex items-center px-6 py-2 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition-all duration-200 gap-2 group shadow-md hover:shadow-lg">
                        <i class="fas fa-check group-hover:scale-110 transition-transform"></i>
                        <span>Tutup</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Delete Modals -->
        <?php $__env->startComponent('components.delete-modal', ['id' => 'deleteJenisModal', 'title' => 'Hapus Jenis Tata Tertib?']); ?> <?php echo $__env->renderComponent(); ?>
        <?php $__env->startComponent('components.delete-modal', ['id' => 'deleteTataTertibModal', 'title' => 'Hapus Tata Tertib?']); ?> <?php echo $__env->renderComponent(); ?>

        <!-- Modal Edit Tata Tertib dengan Rich Text Editor -->
        <div id="editTataTertibModal" class="fixed inset-0 backdrop-blur-sm bg-black/40 overflow-y-auto hidden z-50 flex items-center justify-center p-4">
            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl">
                <div class="flex items-center gap-3 p-6 bg-gradient-to-r from-blue-50 to-blue-100 border-b">
                    <div class="w-12 h-12 bg-blue-200 rounded-full flex items-center justify-center">
                        <i class="fas fa-edit text-[#063A76] text-lg"></i>
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold text-gray-900">Edit Tata Tertib</h3>
                        <p class="text-sm text-gray-600">Perbarui peraturan perpustakaan dengan pemformatan</p>
                    </div>
                    <button type="button" onclick="closeModal('editTataTertibModal')" class="ml-auto text-gray-400 hover:text-gray-600 hover:bg-white w-10 h-10 rounded-lg transition-all">
                        <i class="fas fa-times text-2xl"></i>
                    </button>
                </div>
                
                <form id="editTataTertibForm" method="POST" class="p-6 space-y-5">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>
                    
                    <!-- Jenis Tata Tertib -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Jenis Tata Tertib *</label>
                        <select id="edit-jenis_id" name="jenis_tata_tertib_id" required class="w-full px-4 py-2.5 border-2 border-slate-200 rounded-lg focus:outline-none focus:border-[#063A76] focus:ring-2 focus:ring-[#063A76]/20 transition-all bg-slate-50">
                            <option value="">-- Pilih Jenis --</option>
                            <?php $__currentLoopData = $jenis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $j): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($j->id); ?>"><?php echo e($j->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    
                    <!-- Rich Text Editor -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Konten Tata Tertib *</label>
                        <div id="editQuillEditor" style="min-height: 300px;" class="bg-white border-2 border-slate-200 rounded-lg"></div>
                        <input type="hidden" id="edit-content" name="content">
                        <p class="text-xs text-gray-500 mt-2">Gunakan toolbar untuk formatting: header, bold, italic, underline, strikethrough, lists, dan clean</p>
                    </div>
                    
                    <!-- Status -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Status *</label>
                        <select id="edit-is_active" name="is_active" required class="w-full px-4 py-2.5 border-2 border-slate-200 rounded-lg focus:outline-none focus:border-[#063A76] focus:ring-2 focus:ring-[#063A76]/20 transition-all bg-slate-50">
                            <option value="1">✓ Aktif</option>
                            <option value="0">✗ Tidak Aktif</option>
                        </select>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="flex gap-3 pt-4 border-t border-gray-100">
                        <?php if (isset($component)) { $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['variant' => 'secondary','size' => 'md','class' => 'flex-1 justify-center','type' => 'button','onclick' => 'closeModal(\'editTataTertibModal\')']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'secondary','size' => 'md','class' => 'flex-1 justify-center','type' => 'button','onclick' => 'closeModal(\'editTataTertibModal\')']); ?>Batal <?php echo $__env->renderComponent(); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['variant' => 'primary','size' => 'md','icon' => 'save','class' => 'flex-1 justify-center','type' => 'submit']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'primary','size' => 'md','icon' => 'save','class' => 'flex-1 justify-center','type' => 'submit']); ?>Simpan Perubahan <?php echo $__env->renderComponent(); ?>
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

        <!-- Search Form -->
        <div class="mb-6 bg-white p-5 sm:p-6 rounded-2xl shadow-sm border border-slate-200">
            <form method="GET" action="<?php echo e(route('admin.tata_tertib.index')); ?>" class="flex gap-3">
                <div class="flex-1">
                    <input 
                        type="text" 
                        name="search" 
                        placeholder="Cari tata tertib berdasarkan jenis atau isi..." 
                        value="<?php echo e($search ?? ''); ?>"
                        class="w-full px-4 py-2.5 border border-slate-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#063A76] focus:border-[#063A76]"
                    >
                </div>
                <?php if (isset($component)) { $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['variant' => 'primary','size' => 'md','type' => 'submit']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'primary','size' => 'md','type' => 'submit']); ?>
                    <i class="fas fa-search mr-2"></i>Cari
                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $attributes = $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $component = $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
                <?php if(!empty($search)): ?>
                    <?php if (isset($component)) { $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['variant' => 'secondary','size' => 'md','type' => 'link','href' => ''.e(route('admin.tata_tertib.index')).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'secondary','size' => 'md','type' => 'link','href' => ''.e(route('admin.tata_tertib.index')).'']); ?>
                        <i class="fas fa-times"></i>
                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $attributes = $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $component = $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
                <?php endif; ?>
            </form>
            <?php if(!empty($search)): ?>
                <div class="mt-3 text-sm text-gray-600">
                    Hasil pencarian untuk: "<strong><?php echo e($search); ?></strong>" - <?php echo e($items->total()); ?> hasil ditemukan
                </div>
            <?php endif; ?>
        </div>

        <!-- Tabel -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-50 border-b border-gray-100">
                        <tr>
                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-600">Jenis</th>
                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-600">Isi</th>
                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-600 text-center">Status</th>
                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-600 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <?php $__empty_1 = true; $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-6 py-4">
                                <span class="text-sm font-medium text-gray-700"><?php echo e($item->jenisTataTertib->name); ?></span>
                            </td>
                            <td class="px-6 py-4">
                                <button type="button" onclick="previewTataTertib(<?php echo e($item->id); ?>)" class="inline-flex items-center px-4 py-2 bg-blue-50 text-blue-600 text-sm font-semibold rounded-lg border border-blue-200 hover:bg-blue-100 transition-all duration-200 gap-2 group">
                                    <i class="fas fa-file-alt group-hover:scale-110 transition-transform"></i>
                                    <span>Lihat Deskripsi</span>
                                    <?php if(strlen(strip_tags($item->content)) > 100): ?>
                                    <span class="text-blue-400">→</span>
                                    <?php endif; ?>
                                </button>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <?php if($item->is_active): ?>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">✓ Aktif</span>
                                <?php else: ?>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">✕ Non-Aktif</span>
                                <?php endif; ?>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-end gap-2">
                                <?php if (isset($component)) { $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['variant' => 'ghost','size' => 'sm','icon' => 'edit','onclick' => 'editTataTertib('.e($item->id).')']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'ghost','size' => 'sm','icon' => 'edit','onclick' => 'editTataTertib('.e($item->id).')']); ?>Edit <?php echo $__env->renderComponent(); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['variant' => 'ghost-danger','size' => 'sm','icon' => 'trash','onclick' => 'openDeleteModal(\'deleteTataTertibModal\', \''.e($item->jenisTataTertib->name).'\', \'/admin/tata-tertib/'.e($item->id).'\')']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'ghost-danger','size' => 'sm','icon' => 'trash','onclick' => 'openDeleteModal(\'deleteTataTertibModal\', \''.e($item->jenisTataTertib->name).'\', \'/admin/tata-tertib/'.e($item->id).'\')']); ?>Hapus <?php echo $__env->renderComponent(); ?>
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
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="4" class="px-6 py-10 text-center text-gray-400 italic text-sm">Belum ada data tata tertib.</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <?php if($items->hasPages()): ?>
                <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">
                    <?php echo e($items->appends(['search' => $search ?? ''])->links()); ?>

                </div>
            <?php endif; ?>
        </div>

    </div>
</div>

<script>
    function openModal(id) {
        document.getElementById(id).classList.remove('hidden');
        document.getElementById('dropdownMenu').classList.add('hidden');
    }
    
    function closeModal(id) {
        document.getElementById(id).classList.add('hidden');
    }

    function editTataTertib(id) {
        const modal = document.getElementById('editTataTertibModal');
        const form = document.getElementById('editTataTertibForm');
        
        fetch(`/admin/tata-tertib/${id}/edit`, {
            headers: {
                'Accept': 'application/json',
            }
        })
        .then(response => response.json())
        .then(data => {
            document.getElementById('edit-jenis_id').value = data.jenis_tata_tertib_id || '';
            document.getElementById('edit-is_active').value = data.is_active !== undefined ? data.is_active : '1';
            form.action = `/admin/tata-tertib/${id}`;
            
            // Set Quill editor content
            if (editQuill) {
                editQuill.root.innerHTML = data.content || '';
            }
            
            modal.classList.remove('hidden');
        })
        .catch(error => {
            console.error('Error:', error);
            alert('✗ Gagal memuat data');
        });
    }
    
    // Preview Tata Tertib Function
    function previewTataTertib(id) {
        fetch(`/admin/tata-tertib/${id}/edit`, {
            headers: {
                'Accept': 'application/json',
            }
        })
        .then(response => response.json())
        .then(data => {
            document.getElementById('preview-jenis').textContent = data.jenisTataTertib?.name || 'Tata Tertib';
            document.getElementById('preview-content').innerHTML = data.content || 'Tidak ada konten';
            document.getElementById('previewTataTertibModal').classList.remove('hidden');
        })
        .catch(error => console.error('Error:', error));
    }

    // Copy Preview Content
    function copyPreviewContent() {
        const content = document.getElementById('preview-content');
        const text = content.innerText;
        navigator.clipboard.writeText(text).then(() => {
            const copyBtn = event.target.closest('button');
            const originalContent = copyBtn.innerHTML;
            copyBtn.innerHTML = '<i class="fas fa-check"></i><span>Tersalin!</span>';
            copyBtn.style.background = '#10b981';
            setTimeout(() => {
                copyBtn.innerHTML = originalContent;
                copyBtn.style.background = '';
            }, 2000);
        }).catch(() => {
            alert('✗ Gagal menyalin konten');
        });
    }

    // Print Preview Content
    function printPreview() {
        const content = document.getElementById('preview-content');
        const jenis = document.getElementById('preview-jenis').textContent;
        const printWindow = window.open('', '_blank');
        printWindow.document.write(`
            <!DOCTYPE html>
            <html>
            <head>
                <title>Tata Tertib - ${jenis}</title>
                <style>
                    body {
                        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
                        line-height: 1.75;
                        color: #2d3748;
                        padding: 2rem;
                        max-width: 8.5in;
                        margin: 0 auto;
                    }
                    h1, h2, h3, h4, h5, h6 { color: #1a202c; font-weight: 700; }
                    h1 { font-size: 1.875rem; }
                    h2 { font-size: 1.5rem; }
                    h3 { font-size: 1.25rem; }
                    .header { border-bottom: 3px solid #3b82f6; padding-bottom: 1rem; margin-bottom: 2rem; }
                    .jenis { font-size: 0.9rem; color: #6b7280; text-transform: uppercase; letter-spacing: 1px; }
                    strong, b { font-weight: 700; }
                    ul, ol { margin: 1rem 0; padding-left: 2rem; }
                    table { width: 100%; border-collapse: collapse; margin: 1rem 0; }
                    th, td { border: 1px solid #d1d5db; padding: 0.75rem; text-align: left; }
                    th { background: #f3f4f6; font-weight: 600; }
                    blockquote { border-left: 4px solid #3b82f6; padding-left: 1rem; margin: 1rem 0; background: #f0f9ff; padding: 1rem; }
                    .footer { margin-top: 2rem; padding-top: 1rem; border-top: 1px solid #e5e7eb; font-size: 0.85rem; color: #6b7280; text-align: center; }
                    @media print { body { padding: 0; } }
                </style>
            </head>
            <body>
                <div class="header">
                    <div class="jenis">${jenis}</div>
                    <h1>Tata Tertib Perpustakaan</h1>
                </div>
                ${content.innerHTML}
                <div class="footer">
                    <p>Dicetak pada: ${new Date().toLocaleDateString('id-ID', { year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit' })}</p>
                </div>
            </body>
            </html>
        `);
        printWindow.document.close();
        printWindow.print();
    }

    document.getElementById('dropdownButton').addEventListener('click', function(e) {
        e.stopPropagation();
        document.getElementById('dropdownMenu').classList.toggle('hidden');
    });
    
    document.addEventListener('click', function() {
        document.getElementById('dropdownMenu').classList.add('hidden');
    });
    
    // Close modal when clicking outside
    window.onclick = function(event) {
        const jenisModal = document.getElementById('jenisModal');
        const editTataTertibModal = document.getElementById('editTataTertibModal');
        const previewTataTertibModal = document.getElementById('previewTataTertibModal');
        if (event.target == jenisModal) {
            jenisModal.classList.add('hidden');
        }
        if (event.target == editTataTertibModal) {
            editTataTertibModal.classList.add('hidden');
        }
        if (event.target == previewTataTertibModal) {
            previewTataTertibModal.classList.add('hidden');
        }
    }

    // Setup delete modals for click outside
    setupDeleteModalClickOutside('deleteJenisModal');
    setupDeleteModalClickOutside('deleteTataTertibModal');
</script>

<!-- Quill Editor Script -->
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script>
    // Initialize Quill editor for modal
    let editQuill = null;
    
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize edit modal Quill editor dengan toolbar yang sama seperti edit.blade.php
        editQuill = new Quill('#editQuillEditor', {
            theme: 'snow',
            modules: {
                toolbar: [
                    [{ 'header': [1, 2, 3, false] }],
                    ['bold', 'italic', 'underline', 'strike'],
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                    ['clean']
                ]
            }
        });

        // Handle form submission
        const form = document.getElementById('editTataTertibForm');
        if (form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                // Get Quill content
                const content = editQuill.root.innerHTML;
                document.getElementById('edit-content').value = content;
                
                // Submit form
                const formData = new FormData(form);
                const action = form.getAttribute('action');
                
                fetch(action, {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                        'X-HTTP-Method-Override': 'PUT'
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('✓ Perubahan berhasil disimpan');
                        document.getElementById('editTataTertibModal').classList.add('hidden');
                        location.reload();
                    } else {
                        alert('✗ Gagal menyimpan: ' + (data.message || 'Error'));
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('✗ Gagal menyimpan perubahan');
                });
            });
        }
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Pemustaka\Desktop\Infobase_uppjpds\resources\views/admin/tata_tertib/index.blade.php ENDPATH**/ ?>