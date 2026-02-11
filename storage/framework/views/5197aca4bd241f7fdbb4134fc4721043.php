<?php $__env->startSection('content'); ?>

<?php echo $__env->make('components.image-cropper', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<?php if(session('success')): ?>
<div style="display:none" data-success-message="<?php echo e(session('success')); ?>"></div>
<?php endif; ?>
<?php if(session('error')): ?>
<div style="display:none" data-error-message="<?php echo e(session('error')); ?>"></div>
<?php endif; ?>
<?php if($errors->any()): ?>
<div style="display:none" data-validation-errors="<?php echo e(json_encode($errors->all())); ?>"></div>
<?php endif; ?>

<style>
    /* Toast Notification Styles */
    .toast-container {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 9999;
    }

    .toast {
        background: white;
        padding: 16px 20px;
        border-radius: 8px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        margin-bottom: 12px;
        min-width: 300px;
        display: flex;
        align-items: center;
        gap: 12px;
        animation: slideIn 0.3s ease-out;
    }

    @keyframes slideIn {
        from {
            transform: translateX(400px);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    @keyframes slideOut {
        from {
            transform: translateX(0);
            opacity: 1;
        }
        to {
            transform: translateX(400px);
            opacity: 0;
        }
    }

    .toast.fade-out {
        animation: slideOut 0.3s ease-out;
    }

    .toast.success {
        border-left: 4px solid #10b981;
        background: #f0fdf4;
    }

    .toast.success .toast-icon {
        color: #10b981;
        font-size: 20px;
    }

    .toast.error {
        border-left: 4px solid #ef4444;
        background: #fef2f2;
    }

    .toast.error .toast-icon {
        color: #ef4444;
        font-size: 20px;
    }

    .toast.info {
        border-left: 4px solid #3b82f6;
        background: #eff6ff;
    }

    .toast.info .toast-icon {
        color: #3b82f6;
        font-size: 20px;
    }

    .toast-content {
        flex: 1;
    }

    .toast-message {
        font-size: 14px;
        font-weight: 500;
        color: #1f2937;
    }

    .toast-close {
        background: none;
        border: none;
        color: #9ca3af;
        cursor: pointer;
        font-size: 18px;
        padding: 0;
    }

    .toast-close:hover {
        color: #1f2937;
    }
</style>

<div class="py-24 bg-white pt-28">
  <div class="max-w-6xl mx-auto px-6">
    <div class="admin-section">
        <div class="flex items-center justify-between mb-6">
            <h1 class="h2">Staff Of Month</h1>
            <div class="flex gap-3">
                <?php if (isset($component)) { $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['variant' => 'primary','size' => 'lg','id' => 'manage-jabatan-btn','icon' => 'briefcase']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'primary','size' => 'lg','id' => 'manage-jabatan-btn','icon' => 'briefcase']); ?>Kelola Posisi <?php echo $__env->renderComponent(); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['variant' => 'primary','size' => 'lg','type' => 'link','href' => ''.e(route('admin.staff-of-month.create')).'','icon' => 'plus']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'primary','size' => 'lg','type' => 'link','href' => ''.e(route('admin.staff-of-month.create')).'','icon' => 'plus']); ?>Buat Staff <?php echo $__env->renderComponent(); ?>
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
        </div>

        <!-- Daftar Staff -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden text-sm mb-8">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-50 border-b border-gray-100 font-bold">
                        <tr>
                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-600 border-b border-gray-100">Foto</th>
                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-600 border-b border-gray-100">Nama</th>
                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-600 border-b border-gray-100">Posisi</th>
                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-600 border-b border-gray-100 whitespace-nowrap">Bulan/Tahun</th>
                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-600 border-b border-gray-100 text-center">Status</th>
                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-600 border-b border-gray-100 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <?php $__empty_1 = true; $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="w-10 h-10 rounded-full overflow-hidden bg-gray-100 ring-2 ring-white shadow-sm mx-auto md:mx-0">
                                    <?php if($item->photo_path): ?>
                                        <img src="<?php echo e(asset('storage/' . $item->photo_path)); ?>" alt="<?php echo e($item->name); ?>" class="w-full h-full object-cover">
                                    <?php elseif($item->photo_link): ?>
                                        <img src="<?php echo e($item->photo_link); ?>" alt="<?php echo e($item->name); ?>" class="w-full h-full object-cover">
                                    <?php else: ?>
                                        <div class="w-full h-full flex items-center justify-center bg-teal-100 text-teal-600 text-xs font-bold">
                                            <?php echo e(strtoupper(substr($item->name, 0, 1))); ?>

                                        </div>
                                    <?php endif; ?>
                                </div>
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900"><?php echo e($item->name); ?></td>
                            <td class="px-6 py-4 text-gray-600"><?php echo e($item->position); ?></td>
                            <td class="px-6 py-4 text-gray-500 whitespace-nowrap">
                                <?php echo e($item->month ? $item->month . '/' : '-'); ?><?php echo e($item->year ?? '-'); ?>

                            </td>
                            <td class="px-6 py-4 text-center">
                                <?php if($item->is_active): ?>
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">AKTIF</span>
                                <?php else: ?>
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">NON-AKTIF</span>
                                <?php endif; ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center justify-end gap-2">
                                    <?php if (isset($component)) { $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['variant' => 'ghost','size' => 'sm','icon' => 'edit','onclick' => 'editStaff('.e($item->id).')']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'ghost','size' => 'sm','icon' => 'edit','onclick' => 'editStaff('.e($item->id).')']); ?>Edit <?php echo $__env->renderComponent(); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['variant' => 'ghost-danger','size' => 'sm','icon' => 'trash','onclick' => 'openDeleteModal(\'deleteStaffModal\', \''.e($item->name).'\', \'/admin/staff-of-month/'.e($item->id).'\')']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'ghost-danger','size' => 'sm','icon' => 'trash','onclick' => 'openDeleteModal(\'deleteStaffModal\', \''.e($item->name).'\', \'/admin/staff-of-month/'.e($item->id).'\')']); ?>Hapus <?php echo $__env->renderComponent(); ?>
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
                            <td colspan="6" class="px-6 py-10 text-center text-gray-400 italic">Belum ada data staff.</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            
            <?php if($items->hasPages()): ?>
                <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">
                    <?php echo e($items->links()); ?>

                </div>
            <?php endif; ?>
        </div>


        <!-- Modal untuk form create -->
        <div id="create-staff-modal" class="fixed inset-0 backdrop-blur-sm bg-white/30 hidden z-50">
            <div class="flex items-center justify-center min-h-screen p-4">
                <div class="bg-white rounded-lg max-w-lg w-full max-h-[90vh] overflow-y-auto">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-xl font-bold text-gray-900">Tambah Staff Of Month</h3>
                            <button id="close-create-modal-btn" class="text-gray-400 hover:text-gray-600">
                                <i class="fas fa-times text-xl"></i>
                            </button>
                        </div>
                        <form id="create-form" method="POST" class="space-y-4" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>

                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">Nama</label>
                                <input type="text" id="create-name" name="name" required class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500">
                            </div>

                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">Posisi</label>
                                <select id="create-position" name="position" required class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500">
                                    <option value="">-- Pilih Posisi --</option>
                                    <?php $__currentLoopData = $jabatans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jabatan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($jabatan->name); ?>"><?php echo e($jabatan->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-gray-700 font-semibold mb-2">Bulan</label>
                                    <input type="number" id="create-month" name="month" min="1" max="12" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500">
                                </div>
                                <div>
                                    <label class="block text-gray-700 font-semibold mb-2">Tahun</label>
                                    <input type="number" id="create-year" name="year" min="2000" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500">
                                </div>
                            </div>

                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">Biodata</label>
                                <textarea id="create-bio" name="bio" rows="4" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500"></textarea>
                            </div>

                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">🖼️ Foto</label>
                                <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 hover:border-teal-400 transition-colors">
                                    <input type="file" id="create-photo" name="photo" accept="image/*" onchange="previewImageWithCropper(event, 'create-photo-preview', 'create-crop-btn')" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500 mb-3">
                                    
                                    <div id="create-photo-preview" class="mb-3" style="display: none;"></div>
                                    
                                    <div class="text-center mt-4" style="position: relative; z-index: 10;">
                                        <button type="button" id="create-crop-btn" onclick="openImageCropper(document.getElementById('create-photo'), document.getElementById('create-photo-preview'))" class="crop-button-standard" style="display: none;">
                                            ✂️ Edit & Crop Foto
                                    </button>
                                </div>
                                <p class="text-xs text-gray-500 mt-1">📄 JPG, PNG • 📏 Maks: 10MB • ✂️ Bisa di-crop</p>
                            </div>

                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">Link Foto (Optional)</label>
                                <input type="url" id="create-photo_link" name="photo_link" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500">
                            </div>

                            <div class="flex items-center">
                                <input type="checkbox" id="create-is_active" name="is_active" checked class="w-4 h-4 text-teal-600 rounded focus:ring-2 focus:ring-teal-500">
                                <label for="create-is_active" class="ml-2 text-gray-700 font-semibold">Aktif</label>
                            </div>

                            <div class="flex justify-end gap-3 pt-4">
                                <?php if (isset($component)) { $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['variant' => 'secondary','size' => 'md','type' => 'button','onclick' => 'document.getElementById(\'create-staff-modal\').classList.add(\'hidden\')']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'secondary','size' => 'md','type' => 'button','onclick' => 'document.getElementById(\'create-staff-modal\').classList.add(\'hidden\')']); ?>Batal <?php echo $__env->renderComponent(); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['variant' => 'primary','size' => 'md','icon' => 'check','type' => 'submit']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'primary','size' => 'md','icon' => 'check','type' => 'submit']); ?>Simpan <?php echo $__env->renderComponent(); ?>
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
        </div>

        <!-- Modal untuk form edit -->
        <div id="edit-staff-modal" class="fixed inset-0 backdrop-blur-sm bg-white/30 hidden z-50">
            <div class="flex items-center justify-center min-h-screen p-4">
                <div class="bg-white rounded-lg max-w-lg w-full max-h-[90vh] overflow-y-auto">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-xl font-bold text-gray-900">Edit Staff Of Month</h3>
                            <button id="close-edit-modal-btn" class="text-gray-400 hover:text-gray-600">
                                <i class="fas fa-times text-xl"></i>
                            </button>
                        </div>
                        <form id="edit-form" method="POST" class="space-y-4" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>

                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">Nama</label>
                                <input type="text" id="edit-name" name="name" required class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500">
                            </div>

                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">Posisi</label>
                                <select id="edit-position" name="position" required class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500">
                                    <option value="">-- Pilih Posisi --</option>
                                    <?php $__currentLoopData = $jabatans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jabatan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($jabatan->name); ?>"><?php echo e($jabatan->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-gray-700 font-semibold mb-2">Bulan</label>
                                    <input type="number" id="edit-month" name="month" min="1" max="12" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500">
                                </div>
                                <div>
                                    <label class="block text-gray-700 font-semibold mb-2">Tahun</label>
                                    <input type="number" id="edit-year" name="year" min="2000" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500">
                                </div>
                            </div>

                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">Biodata</label>
                                <textarea id="edit-bio" name="bio" rows="4" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500"></textarea>
                            </div>

                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">🖼️ Foto</label>
                                
                                <!-- Foto Existing -->
                                <div id="edit-existing-photo-container" class="mb-4" style="display: none;">
                                    <p class="text-sm text-gray-600 mb-2">Foto Sekarang:</p>
                                    <div class="bg-white p-3 rounded border border-gray-200 mb-3">
                                        <img id="edit-existing-photo-img" src="" alt="Foto Staff" class="max-w-xs rounded" style="max-height: 200px; object-fit: cover;">
                                    </div>
                                    <button type="button" id="edit-delete-photo-btn" onclick="deleteExistingPhoto()" class="w-full px-4 py-2 bg-red-50 text-red-600 hover:bg-red-100 rounded font-semibold transition-colors mb-3">
                                        <i class="fas fa-trash mr-2"></i> Hapus Foto Ini
                                    </button>
                                </div>
                                
                                <!-- Upload Foto Baru -->
                                <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 hover:border-teal-400 transition-colors">
                                    <input type="file" id="edit-photo" name="photo" accept="image/*" onchange="previewImageWithCropper(event, 'edit-photo-preview', 'edit-crop-btn')" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500 mb-3">
                                    
                                    <div id="edit-photo-preview" class="mb-3" style="display: none;"></div>
                                    
                                    <div class="text-center mt-4" style="position: relative; z-index: 10;">
                                        <button type="button" id="edit-crop-btn" onclick="openImageCropper(document.getElementById('edit-photo'), document.getElementById('edit-photo-preview'))" class="crop-button-standard" style="display: none;">
                                            ✂️ Edit & Crop Foto
                                        </button>
                                    </div>
                                    <p class="text-xs text-gray-500 mt-1">📄 JPG, PNG • 📏 Maks: 10MB • ✂️ Bisa di-crop - Kosongkan jika tidak ingin mengubah</p>
                                </div>
                            
                            <!-- Hidden input untuk mark photo as deleted -->
                            <input type="hidden" id="edit-delete-photo-flag" name="delete_photo" value="0">

                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">Link Foto (Optional)</label>
                                <input type="url" id="edit-photo_link" name="photo_link" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500">
                            </div>

                            <div class="flex items-center">
                                <input type="checkbox" id="edit-is_active" name="is_active" class="w-4 h-4 text-teal-600 rounded focus:ring-2 focus:ring-teal-500">
                                <label for="edit-is_active" class="ml-2 text-gray-700 font-semibold">Aktif</label>
                            </div>

                            <div class="flex justify-end gap-3 pt-4">
                                <?php if (isset($component)) { $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['variant' => 'secondary','size' => 'md','type' => 'button','onclick' => 'document.getElementById(\'edit-staff-modal\').classList.add(\'hidden\')']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'secondary','size' => 'md','type' => 'button','onclick' => 'document.getElementById(\'edit-staff-modal\').classList.add(\'hidden\')']); ?>Batal <?php echo $__env->renderComponent(); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['variant' => 'primary','size' => 'md','icon' => 'check','type' => 'submit']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'primary','size' => 'md','icon' => 'check','type' => 'submit']); ?>Simpan <?php echo $__env->renderComponent(); ?>
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
        </div>

        <!-- Modal untuk manage jabatan -->
        <div id="manage-jabatan-modal" class="fixed inset-0 backdrop-blur-sm bg-white/30 hidden z-50">
            <div class="flex items-center justify-center min-h-screen p-4">
                <div class="bg-white rounded-lg max-w-lg w-full max-h-[90vh] overflow-y-auto">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-xl font-bold text-gray-900">Kelola Posisi/Jabatan</h3>
                            <button id="close-jabatan-modal-btn" class="text-gray-400 hover:text-gray-600">
                                <i class="fas fa-times text-xl"></i>
                            </button>
                        </div>

                        <!-- Form Tambah Jabatan -->
                        <div class="mb-6 pb-6 border-b border-gray-200">
                            <h4 class="text-lg font-semibold mb-4 text-gray-800">Tambah Posisi Baru</h4>
                            <form id="add-jabatan-form" action="<?php echo e(route('admin.staff-of-month.store-jabatan')); ?>" method="POST" class="space-y-4">
                                <?php echo csrf_field(); ?>
                                <div>
                                    <label class="block text-gray-700 font-semibold mb-2">Nama Posisi</label>
                                    <input type="text" name="name" required class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500" placeholder="Contoh: Pustakawan, Satpam, dll">
                                </div>
                                <?php if (isset($component)) { $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['variant' => 'primary','size' => 'md','type' => 'submit','class' => 'w-full justify-center']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'primary','size' => 'md','type' => 'submit','class' => 'w-full justify-center']); ?>Tambah Posisi <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $attributes = $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $component = $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
                            </form>
                        </div>

                        <!-- Daftar Jabatan -->
                        <div>
                            <h4 class="text-lg font-semibold mb-4 text-gray-800">Posisi yang Tersedia</h4>
                            <?php if($jabatans->isEmpty()): ?>
                                <p class="text-gray-500 text-center py-4">Belum ada posisi</p>
                            <?php else: ?>
                                <div class="space-y-2">
                                    <?php $__currentLoopData = $jabatans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jab): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="flex items-center justify-between bg-gray-50 p-4 rounded border border-gray-200">
                                        <span class="text-gray-800 font-medium"><?php echo e($jab->name); ?></span>
                                        <?php if (isset($component)) { $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['variant' => 'danger','size' => 'sm','icon' => 'trash','onclick' => 'openDeleteModal(\'deleteJabatanModal\', \''.e($jab->name).'\', \'/admin/staff-of-month/jabatan/'.e($jab->id).'\')']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'danger','size' => 'sm','icon' => 'trash','onclick' => 'openDeleteModal(\'deleteJabatanModal\', \''.e($jab->name).'\', \'/admin/staff-of-month/jabatan/'.e($jab->id).'\')']); ?>Hapus <?php echo $__env->renderComponent(); ?>
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
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="flex justify-end gap-3 pt-6 border-t border-gray-300 mt-6">
                            <?php if (isset($component)) { $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['variant' => 'secondary','size' => 'md','type' => 'button','onclick' => 'document.getElementById(\'manage-jabatan-modal\').classList.add(\'hidden\')']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'secondary','size' => 'md','type' => 'button','onclick' => 'document.getElementById(\'manage-jabatan-modal\').classList.add(\'hidden\')']); ?>Tutup <?php echo $__env->renderComponent(); ?>
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
                    </div>
                </div>
            </div>
        </div>





        <a href="<?php echo e(route('home')); ?>" class="inline-block mt-8 text-teal-600 hover:underline">
            ← Kembali
        </a>
    </div>
  </div>
</div>

<!-- Delete Modal Components -->
<?php $__env->startComponent('components.delete-modal', ['id' => 'deleteStaffModal', 'title' => 'Hapus Staff?']); ?> <?php echo $__env->renderComponent(); ?>
<?php $__env->startComponent('components.delete-modal', ['id' => 'deleteJabatanModal', 'title' => 'Hapus Posisi?']); ?> <?php echo $__env->renderComponent(); ?>

<!-- Toast Container -->
<div class="toast-container" id="toast-container"></div>

<script>
// Toast Notification Function
function showToast(message, type = 'success', duration = 3000) {
    const container = document.getElementById('toast-container');
    
    const toast = document.createElement('div');
    toast.className = `toast ${type}`;
    
    const iconMap = {
        success: 'fa-circle-check',
        error: 'fa-circle-xmark',
        info: 'fa-circle-info'
    };
    
    toast.innerHTML = `
        <i class="fas ${iconMap[type]} toast-icon"></i>
        <div class="toast-content">
            <p class="toast-message">${message}</p>
        </div>
        <button class="toast-close" onclick="this.parentElement.remove()">&times;</button>
    `;
    
    container.appendChild(toast);
    
    // Auto remove after duration
    setTimeout(() => {
        toast.classList.add('fade-out');
        setTimeout(() => {
            if (toast.parentElement) {
                toast.remove();
            }
        }, 300);
    }, duration);
}
document.addEventListener('DOMContentLoaded', function() {
    const createModal = document.getElementById('create-staff-modal');
    const editModal = document.getElementById('edit-staff-modal');
    const deleteModal = document.getElementById('delete-staff-modal');
    const manageJabatanModal = document.getElementById('manage-jabatan-modal');
    const deleteJabatanModal = document.getElementById('delete-jabatan-modal');
    const openBtn = document.getElementById('create-staff-btn');
    const closeCreateBtn = document.getElementById('close-create-modal-btn');
    const closeEditBtn = document.getElementById('close-edit-modal-btn');
    const manageJabatanBtn = document.getElementById('manage-jabatan-btn');
    const closeJabatanBtn = document.getElementById('close-jabatan-modal-btn');

    openBtn.addEventListener('click', function(e) {
        e.preventDefault();
        document.getElementById('create-form').action = "<?php echo e(route('admin.staff-of-month.store')); ?>";
        document.getElementById('create-form').reset();
        createModal.classList.remove('hidden');
    });

    manageJabatanBtn.addEventListener('click', function(e) {
        e.preventDefault();
        manageJabatanModal.classList.remove('hidden');
    });

    closeCreateBtn.addEventListener('click', function() {
        createModal.classList.add('hidden');
    });

    closeEditBtn.addEventListener('click', function() {
        editModal.classList.add('hidden');
    });

    closeJabatanBtn.addEventListener('click', function() {
        manageJabatanModal.classList.add('hidden');
    });

    createModal.addEventListener('click', function(e) {
        if (e.target === createModal) {
            createModal.classList.add('hidden');
        }
    });

    editModal.addEventListener('click', function(e) {
        if (e.target === editModal) {
            editModal.classList.add('hidden');
        }
    });

    deleteModal.addEventListener('click', function(e) {
        if (e.target === deleteModal) {
            deleteModal.classList.add('hidden');
        }
    });

    manageJabatanModal.addEventListener('click', function(e) {
        if (e.target === manageJabatanModal) {
            manageJabatanModal.classList.add('hidden');
        }
    });

    deleteJabatanModal.addEventListener('click', function(e) {
        if (e.target === deleteJabatanModal) {
            deleteJabatanModal.classList.add('hidden');
        }
    });
});

function editStaff(id) {
    const editModal = document.getElementById('edit-staff-modal');
    const editForm = document.getElementById('edit-form');
    
    fetch('/admin/staff-of-month/' + id + '/edit', {
        headers: {
            'Accept': 'application/json',
        }
    })
    .then(response => response.json())
    .then(data => {
        document.getElementById('edit-name').value = data.name || '';
        document.getElementById('edit-position').value = data.position || '';
        document.getElementById('edit-month').value = data.month || '';
        document.getElementById('edit-year').value = data.year || '';
        document.getElementById('edit-bio').value = data.bio || '';
        document.getElementById('edit-photo_link').value = data.photo_link || '';
        document.getElementById('edit-is_active').checked = data.is_active === 1;
        
        // Reset delete photo flag
        document.getElementById('edit-delete-photo-flag').value = '0';
        document.getElementById('edit-photo').value = '';
        document.getElementById('edit-photo-preview').style.display = 'none';
        document.getElementById('edit-crop-btn').style.display = 'none';
        
        // Show existing photo if available
        const existingPhotoContainer = document.getElementById('edit-existing-photo-container');
        const existingPhotoImg = document.getElementById('edit-existing-photo-img');
        
        if (data.photo_path) {
            existingPhotoImg.src = '/storage/' + data.photo_path;
            existingPhotoContainer.style.display = 'block';
        } else {
            existingPhotoContainer.style.display = 'none';
        }
        
        editForm.action = `/admin/staff-of-month/${id}`;
        
        editModal.classList.remove('hidden');
    })
    .catch(error => console.error('Error:', error));
}

function deleteExistingPhoto() {
    const confirmed = confirm('Yakin ingin menghapus foto ini?');
    if (confirmed) {
        document.getElementById('edit-delete-photo-flag').value = '1';
        document.getElementById('edit-existing-photo-container').style.display = 'none';
        showToast('Foto akan dihapus saat disimpan', 'info', 2000);
    }
}



// Form Submission Handlers with Toast Notifications
document.addEventListener('DOMContentLoaded', function() {
    // Create Staff Form
    const createForm = document.getElementById('create-form');
    if (createForm) {
        createForm.addEventListener('submit', function(e) {
            const submitBtn = this.querySelector('button[type="submit"]');
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Menyimpan...';
        });
    }

    // Edit Staff Form
    const editForm = document.getElementById('edit-form');
    if (editForm) {
        editForm.addEventListener('submit', function(e) {
            const submitBtn = this.querySelector('button[type="submit"]');
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Menyimpan...';
        });
    }

    // Delete Staff Form
    const deleteForm = document.getElementById('delete-form');
    if (deleteForm) {
        deleteForm.addEventListener('submit', function(e) {
            const submitBtn = this.querySelector('button[type="submit"]');
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Menghapus...';
        });
    }

    // Delete Jabatan Form
    const deleteJabatanForm = document.getElementById('delete-jabatan-form');
    if (deleteJabatanForm) {
        deleteJabatanForm.addEventListener('submit', function(e) {
            const submitBtn = this.querySelector('button[type="submit"]');
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Menghapus...';
        });
    }
});

// Check for success message from server redirect
window.addEventListener('load', function() {
    const urlParams = new URLSearchParams(window.location.search);
    
    // Get success message from session if exists
    const successElement = document.querySelector('[data-success-message]');
    if (successElement) {
        const message = successElement.getAttribute('data-success-message');
        if (message) {
            setTimeout(() => {
                showToast(message, 'success', 4000);
            }, 300);
        }
    }

    // Get error message from session if exists
    const errorElement = document.querySelector('[data-error-message]');
    if (errorElement) {
        const message = errorElement.getAttribute('data-error-message');
        if (message) {
            setTimeout(() => {
                showToast(message, 'error', 4000);
            }, 300);
        }
    }

    // Get validation errors if exists
    const validationElement = document.querySelector('[data-validation-errors]');
    if (validationElement) {
        try {
            const errors = JSON.parse(validationElement.getAttribute('data-validation-errors'));
            if (errors && errors.length > 0) {
                setTimeout(() => {
                    errors.forEach((error, index) => {
                        setTimeout(() => {
                            showToast(error, 'error', 4000);
                        }, index * 500);
                    });
                }, 300);
            }
        } catch (e) {
            console.error('Error parsing validation errors:', e);
        }
    }
});
</script>


<script src="<?php echo e(asset('js/image-cropper.js')); ?>"></script>
<script>
    // Setup Click-Outside Handlers for Delete Modals
    setupDeleteModalClickOutside('deleteStaffModal');
    setupDeleteModalClickOutside('deleteJabatanModal');
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Pemustaka\Desktop\Infobase_uppjpds\resources\views/admin/staff/index.blade.php ENDPATH**/ ?>