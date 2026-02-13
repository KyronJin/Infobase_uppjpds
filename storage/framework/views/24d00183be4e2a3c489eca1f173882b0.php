<?php $__env->startPush('styles'); ?>
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<style>
    .font-cairo { font-family: 'Cairo', sans-serif; }
    .quill-editor { min-height: 250px; }
    .image-slot { aspect-ratio: 16/9; overflow: hidden; }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="bg-gray-50 min-h-screen py-12 pt-28 font-cairo">
    <div class="max-w-4xl mx-auto px-6">
        
        <!-- Standardized Header -->
        <div class="flex flex-col md:flex-row items-center justify-between mb-8 bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
            <div class="flex items-center gap-4">
                <a href="<?php echo e(route('admin.profile.index')); ?>" class="w-10 h-10 flex items-center justify-center rounded-full bg-gray-50 text-gray-400 hover:bg-gray-100 transition-colors">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <div>
                    <h1 class="h2 text-gray-800">Edit Profile Ruangan</h1>
                    <p class="text-sm text-gray-500">Ubah informasi dan fasilitas ruangan.</p>
                </div>
            </div>
        </div>

        <?php if($errors->any()): ?>
        <div class="mb-6 bg-red-50 border-l-4 border-red-400 p-4 rounded-r-xl">
            <h3 class="text-sm font-bold text-red-800">Gagal Memperbarui</h3>
            <ul class="mt-1 text-sm text-red-700 list-disc list-inside">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
        <?php endif; ?>

        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-10">
                <form action="<?php echo e(route('admin.profile.update', $profile_ruangan)); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                        <div class="md:col-span-2">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Nama Ruangan</label>
                            <input type="text" name="room_name" value="<?php echo e(old('room_name', $profile_ruangan->room_name)); ?>" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition-all outline-none" required>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Lantai</label>
                            <input type="number" name="floor" value="<?php echo e(old('floor', $profile_ruangan->floor)); ?>" min="1" max="10" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition-all outline-none">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Kapasitas (Orang)</label>
                            <input type="number" name="capacity" value="<?php echo e(old('capacity', $profile_ruangan->capacity)); ?>" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition-all outline-none">
                        </div>
                    </div>

                    <div class="mb-8">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Deskripsi Ruangan</label>
                        <div id="editor-container" class="quill-editor bg-gray-50 border-gray-200 rounded-xl overflow-hidden">
                            <?php echo old('description', $profile_ruangan->description); ?>

                        </div>
                        <input type="hidden" name="description" id="description-input">
                    </div>

                    <div class="mb-10">
                        <label class="block text-sm font-bold text-gray-700 mb-4 text-center">Foto Ruangan (Maksimal 3)</label>
                        <div class="grid grid-cols-3 gap-6">
                            <?php for($i = 1; $i <= 3; $i++): ?>
                            <div class="relative group">
                                <div onclick="document.getElementById('slot-<?php echo e($i); ?>-input').click()" 
                                     class="image-slot bg-gray-50 border-2 border-dashed border-gray-200 rounded-2xl flex flex-col items-center justify-center cursor-pointer hover:border-teal-400 hover:bg-teal-50/30 transition-all group overflow-hidden">
                                    
                                    <div id="slot-<?php echo e($i); ?>-placeholder" class="flex flex-col items-center">
                                        <i class="fas fa-camera text-gray-300 text-3xl mb-2 group-hover:text-teal-400"></i>
                                        <span class="text-xs text-gray-400 font-medium">Slot <?php echo e($i); ?></span>
                                    </div>
                                    
                                    <img id="slot-<?php echo e($i); ?>-img" src="" class="hidden w-full h-full object-cover">
                                    
                                    <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                        <span class="text-white text-xs font-bold px-3 py-1 bg-white/20 backdrop-blur-md rounded-full border border-white/30">Ganti Foto</span>
                                    </div>
                                </div>
                                <input type="file" id="slot-<?php echo e($i); ?>-input" name="slot_<?php echo e($i); ?>_image" class="hidden" accept="image/*" onchange="previewSlotImage(<?php echo e($i); ?>, this)">
                            </div>
                            <?php endfor; ?>
                        </div>
                    </div>

                    <div class="mb-8">
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <div class="relative">
                                <input type="checkbox" name="is_active" value="1" <?php echo e($profile_ruangan->is_active ? 'checked' : ''); ?> class="sr-only peer">
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-teal-500"></div>
                            </div>
                            <span class="text-sm font-bold text-gray-700 group-hover:text-gray-900 transition-colors">Ruangan Aktif</span>
                        </label>
                    </div>

                    <div class="flex items-center gap-4 pt-8 border-t border-gray-100">
                        <?php if (isset($component)) { $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['variant' => 'primary','size' => 'lg','icon' => 'save','type' => 'submit','class' => 'flex-1']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'primary','size' => 'lg','icon' => 'save','type' => 'submit','class' => 'flex-1']); ?>Simpan Perubahan <?php echo $__env->renderComponent(); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['variant' => 'secondary','size' => 'lg','type' => 'link','href' => ''.e(route('admin.profile.index')).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'secondary','size' => 'lg','type' => 'link','href' => ''.e(route('admin.profile.index')).'']); ?>Batal <?php echo $__env->renderComponent(); ?>
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
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const quill = new Quill('#editor-container', {
            theme: 'snow',
            modules: {
                toolbar: [
                    ['bold', 'italic', 'underline'],
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                    ['clean']
                ]
            }
        });

        const form = document.querySelector('form');
        form.onsubmit = function() {
            const contentInput = document.querySelector('#description-input');
            contentInput.value = quill.root.innerHTML;
        };

        // Load existing images
        <?php if($profile_ruangan->images && count($profile_ruangan->images) > 0): ?>
            <?php $__currentLoopData = $profile_ruangan->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($index < 3): ?>
                    showSlotImage(<?php echo e($index + 1); ?>, '/storage/<?php echo e($image->image_path); ?>');
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    });

    function showSlotImage(slotNum, imagePath) {
        const placeholder = document.getElementById(`slot-${slotNum}-placeholder`);
        const img = document.getElementById(`slot-${slotNum}-img`);
        
        img.src = imagePath;
        img.classList.remove('hidden');
        placeholder.classList.add('hidden');
    }

    window.previewSlotImage = function(slotNum, input) {
        const file = input.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                showSlotImage(slotNum, e.target.result);
            };
            reader.readAsDataURL(file);
        }
    };
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Pemustaka\Desktop\Infobase_uppjpds\resources\views/admin/profile/edit.blade.php ENDPATH**/ ?>