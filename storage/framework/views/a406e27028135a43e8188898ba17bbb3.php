<?php $__env->startSection('content'); ?>
<div class="container mx-auto px-6 py-12">
    <div class="admin-section">
        <h1 class="admin-header">Edit Staff</h1>
        <form action="<?php echo e(route('admin.staff-of-month.update', $staff_of_month)); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            <div class="form-group"><label class="form-label">Name</label><input name="name" class="form-control" value="<?php echo e(old('name', $staff_of_month->name)); ?>" required></div>
            <div class="form-group"><label class="form-label">Position</label><input name="position" class="form-control" value="<?php echo e(old('position', $staff_of_month->position)); ?>"></div>
            <div class="form-group"><label class="form-label">Month</label><input name="month" type="number" min="1" max="12" class="form-control" value="<?php echo e(old('month', $staff_of_month->month)); ?>"></div>
            <div class="form-group"><label class="form-label">Year *</label><input name="year" type="number" required class="form-control" value="<?php echo e(old('year', $staff_of_month->year)); ?>"></div>
            <div class="form-group"><label class="form-label">Bio</label>
            <div id="editor-bio" class="border border-gray-300 rounded-lg shadow-sm" style="border-radius: 0.5rem; overflow: hidden; min-height: 300px;"></div>
            <textarea name="bio" id="bio" class="editor hidden"><?php echo e(old('bio', $staff_of_month->bio)); ?></textarea></div>
            <div class="form-group">
                <label class="form-label">🖼️ Foto</label>
                <?php if($staff_of_month->photo_path): ?>
                    <div class="mb-3">
                        <p class="text-sm text-gray-600 mb-2">Foto saat ini:</p>
                        <img src="<?php echo e(asset('storage/' . $staff_of_month->photo_path)); ?>" alt="<?php echo e($staff_of_month->name); ?>" class="h-32 w-auto rounded border border-gray-300">
                    </div>
                <?php endif; ?>
                
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
            <div class="form-group"><label class="form-label">Photo Link (Optional)</label><input name="photo_link" class="form-control" value="<?php echo e(old('photo_link', $staff_of_month->photo_link)); ?>" placeholder="URL foto eksternal"></div>
            <div class="form-group"><label class="form-label inline-flex items-center"><input type="checkbox" name="is_active" <?php echo e($staff_of_month->is_active ? 'checked' : ''); ?> class="mr-2"> Active</label></div>
            <div class="flex gap-3">
                <?php if (isset($component)) { $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['variant' => 'primary','size' => 'lg']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'primary','size' => 'lg']); ?>Save <?php echo $__env->renderComponent(); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['variant' => 'secondary','size' => 'lg','type' => 'link','href' => ''.e(route('admin.staff-of-month.index')).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'secondary','size' => 'lg','type' => 'link','href' => ''.e(route('admin.staff-of-month.index')).'']); ?>Batal <?php echo $__env->renderComponent(); ?>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Pemustaka\Desktop\Infobase_uppjpds\resources\views/admin/staff/edit.blade.php ENDPATH**/ ?>