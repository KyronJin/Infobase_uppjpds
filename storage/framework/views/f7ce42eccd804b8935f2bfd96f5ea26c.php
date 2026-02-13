<?php echo $__env->make('components.image-cropper', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<?php $__env->startPush('styles'); ?>
<style>
    #sortable {
        list-style: none;
        padding: 1rem !important;
        background: #f3f4f6 !important;
        border-radius: 0.5rem !important;
    }
    
    #sortable li {
        background: white;
        padding: 12px;
        margin-bottom: 8px;
        border: 2px solid #e5e7eb;
        border-radius: 0.5rem;
        cursor: grab;
        display: flex;
        align-items: center;
        gap: 12px;
        user-select: none;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
    }
    
    #sortable li:active {
        cursor: grabbing;
    }
    
    #sortable li:hover {
        border-color: #10b981;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transform: translateY(-2px);
    }
    
    #sortable li.ui-sortable-helper {
        opacity: 0.95;
        background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
        border: 2px solid #10b981;
        box-shadow: 0 12px 32px rgba(16, 185, 129, 0.25), 0 0 30px rgba(16, 185, 129, 0.15);
        transform: scale(1.02) rotate(1deg);
        transition: none;
        z-index: 1000 !important;
    }
    
    #sortable li.ui-sortable-helper i.fa-grip-vertical {
        color: #10b981 !important;
        transform: scale(1.1);
    }
    
    .ui-state-highlight {
        background: linear-gradient(135deg, #e0f2fe 0%, #cfe9ff 100%) !important;
        border: 2px dashed #0ea5e9 !important;
        border-radius: 0.5rem !important;
        min-height: 50px !important;
        animation: pulseHighlight 1.5s ease-in-out infinite;
    }
    
    @keyframes pulseHighlight {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.7; }
    }
    
    #sortable li.ui-sortable-helper::before {
        content: '';
        position: absolute;
        inset: 0;
        border-radius: 0.5rem;
        background: radial-gradient(circle at 50% 50%, rgba(16, 185, 129, 0.1) 0%, transparent 70%);
        pointer-events: none;
    }
    
    /* Smooth transitions for list reordering */
    #sortable li {
        animation: slideIn 0.2s ease-out;
    }
    
    @keyframes slideIn {
        from {
            opacity: 0.8;
            transform: translateY(4px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    /* Grip icon styling */
    #sortable li i.fa-grip-vertical {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        flex-shrink: 0;
    }
    
    #sortable li:hover i.fa-grip-vertical {
        color: #10b981 !important;
        transform: scale(1.1);
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="bg-gray-50 min-h-screen py-12 pt-28 font-cairo">
    <div class="max-w-6xl mx-auto px-6">
        
        <div class="flex flex-col md:flex-row items-center justify-between mb-8 bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
            <div>
                <h1 class="h2 text-gray-800"> Profil Pegawai</h1>
                <p class="text-sm text-gray-500">Kelola profil pegawai perpustakaan di sini.</p>
            </div>
            <div class="flex gap-3 mt-4 md:mt-0">
                <?php if (isset($component)) { $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['variant' => 'secondary','size' => 'lg','icon' => 'arrows-up-down','onclick' => 'openModal(\'orderModal\')']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'secondary','size' => 'lg','icon' => 'arrows-up-down','onclick' => 'openModal(\'orderModal\')']); ?>Atur Posisi <?php echo $__env->renderComponent(); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['variant' => 'secondary','size' => 'lg','icon' => 'plus','onclick' => 'openModal(\'jabatanModal\')']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'secondary','size' => 'lg','icon' => 'plus','onclick' => 'openModal(\'jabatanModal\')']); ?>Tambah Jabatan <?php echo $__env->renderComponent(); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['variant' => 'primary','size' => 'lg','icon' => 'user-plus','type' => 'link','href' => ''.e(route('admin.profil_pegawai.create')).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'primary','size' => 'lg','icon' => 'user-plus','type' => 'link','href' => ''.e(route('admin.profil_pegawai.create')).'']); ?>Tambah Pegawai <?php echo $__env->renderComponent(); ?>
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

        <!-- Flash Messages -->
        <?php if(session('success')): ?>
            <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-6 py-4 rounded-xl flex items-start gap-3 animate-in fade-in slide-in-from-top">
                <i class="fas fa-check-circle text-green-600 mt-0.5"></i>
                <div>
                    <h3 class="font-semibold text-sm">Sukses</h3>
                    <p class="text-xs"><?php echo e(session('success')); ?></p>
                </div>
                <button onclick="this.parentElement.style.display='none';" class="ml-auto text-green-600 hover:text-green-800">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        <?php endif; ?>

            <?php if(session('error')): ?>
                <div class="mb-6 bg-red-50 border border-red-200 text-red-800 px-6 py-4 rounded-lg flex items-start gap-3 animate-in fade-in slide-in-from-top">
                    <i class="fas fa-exclamation-circle text-red-600 mt-0.5"></i>
                    <div>
                        <h3 class="font-semibold">Kesalahan</h3>
                        <p class="text-sm"><?php echo e(session('error')); ?></p>
                    </div>
                    <button onclick="this.parentElement.style.display='none';" class="ml-auto text-red-600 hover:text-red-800">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            <?php endif; ?>

        <!-- Modal Jabatan -->
        <div id="jabatanModal" class="fixed inset-0 backdrop-blur-sm bg-black/40 hidden z-50 flex items-center justify-center">
            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md p-8">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-12 h-12 bg-gradient-to-br from-slate-100 to-slate-50 rounded-full flex items-center justify-center">
                        <i class="fas fa-briefcase text-teal-600 text-lg"></i>
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold text-gray-900">Tambah Jabatan</h3>
                        <p class="text-sm text-gray-500">Tambahkan posisi baru</p>
                    </div>
                    <button type="button" onclick="closeModal('jabatanModal')" class="ml-auto text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times text-2xl"></i>
                    </button>
                </div>
                <form action="<?php echo e(route('admin.profil_pegawai.store-jabatan')); ?>" method="POST" class="space-y-4">
                    <?php echo csrf_field(); ?>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Jabatan</label>
                        <input type="text" name="name" placeholder="Masukkan nama jabatan" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-teal-600 transition-colors" required>
                    </div>
                    <div class="flex gap-3 pt-4">
                        <?php if (isset($component)) { $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['variant' => 'secondary','size' => 'md','class' => 'flex-1 justify-center','type' => 'button','onclick' => 'closeModal(\'jabatanModal\')']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'secondary','size' => 'md','class' => 'flex-1 justify-center','type' => 'button','onclick' => 'closeModal(\'jabatanModal\')']); ?>Batal <?php echo $__env->renderComponent(); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['variant' => 'primary','size' => 'md','icon' => 'check','class' => 'flex-1 justify-center','type' => 'submit']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'primary','size' => 'md','icon' => 'check','class' => 'flex-1 justify-center','type' => 'submit']); ?>Simpan <?php echo $__env->renderComponent(); ?>
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

        <!-- Modal Profil Pegawai -->
        <div id="profilPegawaiModal" class="fixed inset-0 backdrop-blur-sm bg-black/40 hidden z-50 flex items-center justify-center overflow-y-auto">
            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg p-8 my-8">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-12 h-12 bg-gradient-to-br from-purple-100 to-purple-50 rounded-full flex items-center justify-center">
                        <i class="fas fa-user-plus text-purple-600 text-lg"></i>
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold text-gray-900">Tambah Profil Pegawai</h3>
                        <p class="text-sm text-gray-500">Tambahkan pegawai baru</p>
                    </div>
                    <button type="button" onclick="closeModal('profilPegawaiModal')" class="ml-auto text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times text-2xl"></i>
                    </button>
                </div>
                <form action="<?php echo e(route('admin.profil_pegawai.store')); ?>" method="POST" enctype="multipart/form-data" class="space-y-4">
                    <?php echo csrf_field(); ?>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">🖼️ Foto Pegawai</label>
                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 hover:border-purple-400 transition-colors cursor-pointer">
                            <input type="file" name="foto" accept="image/*" onchange="previewImageWithCropper(event, 'create-foto-preview', 'create-foto-crop-btn')" class="w-full">
                            <div id="create-foto-preview" class="mb-3" style="display: none;"></div>
                            <button type="button" id="create-foto-crop-btn" class="crop-button-standard" style="display:none;" onclick="window.imageCropper.openCropper(document.querySelector('input[name=foto]'))">
                                🎨 Edit & Crop Gambar
                            </button>
                        </div>
                        <p class="text-xs text-gray-500 mt-1">JPG, PNG • Maks 10MB • Bisa di-crop</p>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Pegawai</label>
                        <input type="text" name="nama" placeholder="Masukkan nama lengkap" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-purple-500 transition-colors" required>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Jabatan</label>
                        <select name="jabatan_id" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-purple-500 transition-colors" required>
                            <option value="">-- Pilih Jabatan --</option>
                            <?php $__currentLoopData = $jabatans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $j): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($j->id); ?>"><?php echo e($j->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi</label>
                        <textarea name="deskripsi" rows="3" placeholder="Jelaskan tugas dan tanggung jawab" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-purple-500 transition-colors" required></textarea>
                    </div>
                    <div class="flex gap-3 pt-4">
                        <?php if (isset($component)) { $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['variant' => 'secondary','size' => 'md','class' => 'flex-1 justify-center','type' => 'button','onclick' => 'closeModal(\'profilPegawaiModal\')']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'secondary','size' => 'md','class' => 'flex-1 justify-center','type' => 'button','onclick' => 'closeModal(\'profilPegawaiModal\')']); ?>Batal <?php echo $__env->renderComponent(); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['variant' => 'primary','size' => 'md','icon' => 'check','class' => 'flex-1 justify-center','type' => 'submit']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'primary','size' => 'md','icon' => 'check','class' => 'flex-1 justify-center','type' => 'submit']); ?>Simpan <?php echo $__env->renderComponent(); ?>
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

        <!-- Modal Atur Posisi Jabatan -->
        <div id="orderModal" class="fixed inset-0 backdrop-blur-sm bg-black/40 hidden z-50 flex items-center justify-center">
            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md p-8">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-12 h-12 bg-gradient-to-br from-green-100 to-green-50 rounded-full flex items-center justify-center">
                        <i class="fas fa-arrow-up-down text-green-600 text-lg"></i>
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold text-gray-900">Atur Posisi Jabatan</h3>
                        <p class="text-sm text-gray-500">Urutkan hierarki organisasi</p>
                    </div>
                    <button type="button" onclick="closeModal('orderModal')" class="ml-auto text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times text-2xl"></i>
                    </button>
                </div>
                
                <div class="bg-slate-50 border-l-4 border-teal-600 rounded-lg p-3 mb-6">
                    <p class="text-sm text-gray-700 flex items-start gap-2">
                        <i class="fas fa-info-circle text-teal-600 mt-0.5 flex-shrink-0"></i>
                        <span>Drag jabatan untuk mengatur urutan (atas = posisi tertinggi)</span>
                    </p>
                </div>
                
                <ul id="sortable" class="mb-6 bg-gray-50 p-4 rounded-lg" style="list-style: none; margin: 0; padding: 1rem;">
                    <?php $__currentLoopData = $jabatans->sortBy('order'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jabatan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li data-id="<?php echo e($jabatan->id); ?>" style="background: white; padding: 12px; margin-bottom: 8px; border: 2px solid #e5e7eb; border-radius: 0.5rem; cursor: grab; display: flex; align-items: center; gap: 12px; user-select: none; transition: all 0.2s;">
                            <i class="fas fa-grip-vertical" style="color: #9ca3af; font-size: 18px; cursor: grab;"></i>
                            <span style="font-weight: 500; color: #374151; flex: 1;"><?php echo e($jabatan->name); ?></span>
                            <button type="button" onclick="openDeleteJabatanModal('<?php echo e(addslashes($jabatan->name)); ?>', <?php echo e($jabatan->id); ?>)" class="px-3 py-1 bg-red-50 text-red-600 text-sm font-semibold rounded-lg hover:bg-red-100 transition-colors flex items-center gap-1">
                                <i class="fas fa-trash text-sm"></i> Hapus
                            </button>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
                
                <div class="flex gap-3">
                    <button type="button" onclick="closeModal('orderModal')" class="flex-1 px-4 py-2 bg-gray-300 text-gray-700 font-semibold rounded-lg hover:bg-gray-400 transition-colors">Batal</button>
                    <button type="button" id="saveOrder" onclick="saveSortableOrder()" class="flex-1 px-4 py-2 bg-orange-500 text-white font-semibold rounded-lg hover:bg-orange-600 transition-colors flex items-center justify-center gap-2">
                        <i class="fas fa-check"></i> Simpan
                    </button>
                </div>
            </div>
        </div>

        <!-- Search Form -->
        <div class="mb-6 bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
            <form method="GET" action="<?php echo e(route('admin.profil_pegawai.index')); ?>" class="flex gap-3">
                <div class="flex-1">
                    <input 
                        type="text" 
                        name="search" 
                        placeholder="Cari pegawai berdasarkan nama, jabatan, atau deskripsi..." 
                        value="<?php echo e($search ?? ''); ?>"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500"
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
<?php $component->withAttributes(['variant' => 'primary','size' => 'md','type' => 'submit']); ?><i class="fas fa-search mr-2"></i>Cari <?php echo $__env->renderComponent(); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['variant' => 'secondary','size' => 'md','type' => 'link','href' => ''.e(route('admin.profil_pegawai.index')).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'secondary','size' => 'md','type' => 'link','href' => ''.e(route('admin.profil_pegawai.index')).'']); ?><i class="fas fa-times"></i> <?php echo $__env->renderComponent(); ?>
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
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden text-sm">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-50 border-b border-gray-100 font-bold">
                        <tr>
                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-600">Foto</th>
                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-600">Nama</th>
                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-600">Jabatan</th>
                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-600">Deskripsi</th>
                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-600 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <?php $__empty_1 = true; $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="w-12 h-12 rounded-full overflow-hidden bg-gray-100 ring-2 ring-white shadow-sm">
                                    <?php if($item->foto_path): ?>
                                        <img src="<?php echo e(asset('storage/' . $item->foto_path)); ?>" alt="<?php echo e($item->nama); ?>" class="w-full h-full object-cover">
                                    <?php else: ?>
                                        <div class="w-full h-full flex items-center justify-center bg-indigo-100 text-indigo-600 text-xs font-bold">
                                            <?php echo e(strtoupper(substr($item->nama, 0, 1))); ?>

                                        </div>
                                    <?php endif; ?>
                                </div>
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900"><?php echo e($item->nama); ?></td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 rounded-md bg-indigo-50 text-indigo-700 font-medium">
                                    <?php echo e($item->jabatan ? $item->jabatan->name : 'N/A'); ?>

                                </span>
                            </td>
                            <td class="px-6 py-4 text-gray-600 max-w-xs truncate"><?php echo e($item->deskripsi); ?></td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center justify-end gap-2">
                                    <?php if (isset($component)) { $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['variant' => 'ghost','size' => 'sm','icon' => 'edit','onclick' => 'editProfilPegawai('.e($item->id).')']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'ghost','size' => 'sm','icon' => 'edit','onclick' => 'editProfilPegawai('.e($item->id).')']); ?>Edit <?php echo $__env->renderComponent(); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['variant' => 'ghost-danger','size' => 'sm','icon' => 'trash','onclick' => 'openDeleteModal(\'deleteProfilPegawaiModal\', \''.e($item->nama).'\', \'/admin/profil-pegawai/'.e($item->id).'\')']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'ghost-danger','size' => 'sm','icon' => 'trash','onclick' => 'openDeleteModal(\'deleteProfilPegawaiModal\', \''.e($item->nama).'\', \'/admin/profil-pegawai/'.e($item->id).'\')']); ?>Hapus <?php echo $__env->renderComponent(); ?>
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
                            <td colspan="5" class="px-6 py-10 text-center text-gray-400 italic">Belum ada data profil pegawai.</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            
            <?php if($items->hasPages()): ?>
                <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">
                    <?php echo e($items->appends(['search' => $search ?? ''])->links()); ?>

                </div>
            <?php endif; ?>
        </div>

    </div>
</div>

<!-- Modal Edit Profil Pegawai -->
<div id="editProfilPegawaiModal" class="fixed inset-0 backdrop-blur-sm bg-black/40 overflow-y-auto hidden z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg p-8 my-8">
        <div class="flex items-center gap-3 mb-6">
            <div class="w-12 h-12 bg-gradient-to-br from-indigo-100 to-indigo-50 rounded-full flex items-center justify-center">
                <i class="fas fa-edit text-indigo-600 text-lg"></i>
            </div>
            <div>
                <h3 class="text-2xl font-bold text-gray-900">Edit Profil Pegawai</h3>
                <p class="text-sm text-gray-500">Perbarui informasi pegawai</p>
            </div>
            <button type="button" onclick="closeModal('editProfilPegawaiModal')" class="ml-auto text-gray-400 hover:text-gray-600">
                <i class="fas fa-times text-2xl"></i>
            </button>
        </div>
        
        <form id="editProfilPegawaiForm" method="POST" enctype="multipart/form-data" class="space-y-4">
            <?php echo csrf_field(); ?>
            
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Pegawai</label>
                <input type="text" id="edit-nama" name="nama" placeholder="Masukkan nama lengkap" required class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-indigo-500 transition-colors">
            </div>
            
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Jabatan</label>
                <select id="edit-jabatan_id" name="jabatan_id" required class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-indigo-500 transition-colors">
                    <option value="">-- Pilih Jabatan --</option>
                    <?php $__currentLoopData = $jabatans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jabatan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($jabatan->id); ?>"><?php echo e($jabatan->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi</label>
                <textarea id="edit-deskripsi" name="deskripsi" rows="3" placeholder="Jelaskan tugas dan tanggung jawab" required class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-indigo-500 transition-colors"></textarea>
            </div>
            
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">🖼️ Foto Pegawai</label>
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 hover:border-indigo-400 transition-colors cursor-pointer">
                    <input type="file" id="edit-foto" name="foto" accept="image/*" onchange="previewImageWithCropper(event, 'edit-foto-preview', 'edit-foto-crop-btn')" class="w-full">
                    <div id="edit-foto-preview" class="mb-3" style="display: none;"></div>
                    <button type="button" id="edit-foto-crop-btn" onclick="openImageCropper(document.getElementById('edit-foto'), document.getElementById('edit-foto-preview'))" class="crop-button-standard" style="display: none;">
                        ✂️ Edit & Crop Foto
                    </button>
                </div>
                <p class="text-xs text-gray-500 mt-1">JPG, PNG • Maks 10MB • Bisa di-crop - Kosongkan jika tidak ingin mengubah</p>
            </div>
            
            <div id="editFotoPreview" class="mt-2"></div>
            
            <div class="flex gap-3 pt-4">
                <?php if (isset($component)) { $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['variant' => 'secondary','size' => 'md','class' => 'flex-1 justify-center','type' => 'button','onclick' => 'closeModal(\'editProfilPegawaiModal\')']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'secondary','size' => 'md','class' => 'flex-1 justify-center','type' => 'button','onclick' => 'closeModal(\'editProfilPegawaiModal\')']); ?>Batal <?php echo $__env->renderComponent(); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['variant' => 'primary','size' => 'md','icon' => 'check','class' => 'flex-1 justify-center','type' => 'submit']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'primary','size' => 'md','icon' => 'check','class' => 'flex-1 justify-center','type' => 'submit']); ?>Simpan <?php echo $__env->renderComponent(); ?>
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

<!-- Delete Modal Components -->
<?php $__env->startComponent('components.delete-modal', ['id' => 'deleteProfilPegawaiModal', 'title' => 'Hapus Profil Pegawai?']); ?> <?php echo $__env->renderComponent(); ?>

<!-- Delete Jabatan Modal -->
<div id="deleteJabatanModal" class="fixed inset-0 backdrop-blur-sm bg-black/40 overflow-y-auto hidden z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-sm p-8 my-8">
        <div class="flex items-center justify-center mb-6">
            <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center">
                <i class="fas fa-exclamation-triangle text-red-600 text-2xl"></i>
            </div>
        </div>
        
        <h3 class="text-lg font-bold text-center text-gray-900 mb-2">Hapus Jabatan?</h3>
        
        <div class="bg-red-50 border-l-4 border-red-500 rounded-lg p-4 mb-6">
            <p class="text-sm text-gray-700">
                Yakin ingin menghapus jabatan <strong id="deleteJabatanName"></strong>?
            </p>
            <p class="text-xs text-gray-600 mt-2">
                ⚠️ Pegawai dengan jabatan ini akan tetap ada, tapi jabatan akan dihapus dari daftar.
            </p>
        </div>
        
        <div class="flex gap-3">
            <button type="button" onclick="closeDeleteJabatanModal()" class="flex-1 px-4 py-2.5 bg-gray-300 text-gray-700 font-semibold rounded-lg hover:bg-gray-400 transition-colors">Batal</button>
            <button type="button" id="confirmDeleteJabatanBtn" onclick="confirmDeleteJabatan()" class="flex-1 px-4 py-2.5 bg-red-600 text-white font-semibold rounded-lg hover:bg-red-700 transition-colors flex items-center justify-center gap-2">
                <i class="fas fa-trash"></i> Hapus
            </button>
        </div>
    </div>
</div>



<script>
// Toast Notification
function showNotification(msg, type = 'success') {
    let container = document.getElementById('notifContainer');
    if (!container) {
        container = document.createElement('div');
        container.id = 'notifContainer';
        container.style = 'position:fixed;top:20px;right:20px;z-index:9999';
        document.body.appendChild(container);
    }
    
    const bgColor = type === 'success' ? '#22c55e' : type === 'error' ? '#ef4444' : '#3b82f6';
    const icon = type === 'success' ? '✓' : type === 'error' ? '❌' : 'ℹ';
    
    const notif = document.createElement('div');
    notif.style = `background:${bgColor};color:white;padding:16px 24px;border-radius:8px;margin-bottom:12px;font-weight:600;box-shadow:0 10px 25px rgba(0,0,0,0.2)`;
    notif.innerHTML = `${icon} ${msg}`;
    
    container.appendChild(notif);
    setTimeout(() => notif.remove(), type === 'success' ? 2000 : 3500);
}

// Save Sortable Order
function saveSortableOrder() {
    console.log('Saving order...');
    
    const ids = [];
    document.querySelectorAll('#sortable li').forEach(li => {
        if (li.dataset.id) ids.push(parseInt(li.dataset.id));
    });
    
    if (!ids.length) {
        showNotification('Tidak ada jabatan!', 'warning');
        return;
    }
    
    const btn = document.getElementById('saveOrder');
    if (!btn) return;
    
    btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menyimpan...';
    btn.disabled = true;
    
    const csrf = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '<?php echo e(csrf_token()); ?>';
    
    fetch('<?php echo e(route("admin.profil_pegawai.update-order")); ?>', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrf
        },
        body: JSON.stringify({ jabatans: ids })
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            showNotification('✓ Urutan berhasil disimpan!', 'success');
            setTimeout(() => {
                closeModal('orderModal');
                location.reload();
            }, 1000);
        } else {
            throw new Error('Gagal');
        }
    })
    .catch(e => {
        showNotification('Error: ' + e.message, 'error');
        btn.innerHTML = '<i class="fas fa-check"></i> Simpan';
        btn.disabled = false;
    });
}

// Modal functions
function openModal(id) {
    document.getElementById(id)?.classList.remove('hidden');
}

function closeModal(id) {
    document.getElementById(id)?.classList.add('hidden');
}

// Edit Profil Pegawai
function editProfilPegawai(id) {
    console.log('Editing profil ID:', id);
    
    fetch(`/admin/profil-pegawai/${id}/edit`, {
        headers: {
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
        }
    })
    .then(response => {
        if (!response.ok) throw new Error('Failed to fetch');
        return response.json();
    })
    .then(data => {
        console.log('Data fetched:', data);
        
        // Fill form with data
        document.getElementById('edit-nama').value = data.nama || '';
        document.getElementById('edit-jabatan_id').value = data.jabatan_id || '';
        document.getElementById('edit-deskripsi').value = data.deskripsi || '';
        
        // Set form action
        const form = document.getElementById('editProfilPegawaiForm');
        form.action = `/admin/profil-pegawai/${id}`;
        form.dataset.pegawaiId = id;
        
        // Reset file input
        document.getElementById('edit-foto').value = '';
        
        // Open modal
        openModal('editProfilPegawaiModal');
    })
    .catch(error => {
        console.error('Error:', error);
        showNotification('Error: ' + error.message, 'error');
    });
}

// Handle Edit Form Submit
document.addEventListener('DOMContentLoaded', function() {
    const editForm = document.getElementById('editProfilPegawaiForm');
    if (editForm) {
        editForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            formData.append('_method', 'PUT'); // Add method override
            const pegawaiId = this.dataset.pegawaiId;
            
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalHTML = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menyimpan...';
            submitBtn.disabled = true;
            
            fetch(`/admin/profil-pegawai/${pegawaiId}`, {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content'),
                    'X-HTTP-METHOD-OVERRIDE': 'PUT'
                },
                body: formData
            })
            .then(response => {
                console.log('Response status:', response.status);
                if (response.status === 422) {
                    return response.json().then(data => {
                        throw { errors: data.errors, message: 'Validasi gagal' };
                    });
                }
                if (!response.ok) throw new Error('Update failed: ' + response.statusText);
                return response.json();
            })
            .then(data => {
                console.log('Success data:', data);
                showNotification('✓ Profil berhasil diperbarui!', 'success');
                setTimeout(() => {
                    closeModal('editProfilPegawaiModal');
                    location.reload();
                }, 1000);
            })
            .catch(error => {
                console.error('Error:', error);
                let errorMsg = error.message;
                if (error.errors) {
                    const firstError = Object.values(error.errors)[0];
                    errorMsg = Array.isArray(firstError) ? firstError[0] : firstError;
                }
                showNotification('❌ ' + errorMsg, 'error');
                submitBtn.innerHTML = originalHTML;
                submitBtn.disabled = false;
            });
        });
    }
});

// Delete Jabatan Functions
let deleteJabatanData = {};

function openDeleteJabatanModal(jabatanName, jabatanId) {
    deleteJabatanData = {
        id: jabatanId,
        name: jabatanName
    };
    document.getElementById('deleteJabatanName').textContent = jabatanName;
    document.getElementById('deleteJabatanModal').classList.remove('hidden');
}

function closeDeleteJabatanModal() {
    document.getElementById('deleteJabatanModal').classList.add('hidden');
    deleteJabatanData = {};
}

function confirmDeleteJabatan() {
    if (!deleteJabatanData.id) {
        showNotification('Data tidak valid', 'error');
        return;
    }

    const btn = document.getElementById('confirmDeleteJabatanBtn');
    const originalHTML = btn.innerHTML;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menghapus...';
    btn.disabled = true;

    fetch(`/admin/profil-pegawai/jabatan/${deleteJabatanData.id}`, {
        method: 'POST',
        headers: {
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content'),
            'X-HTTP-METHOD-OVERRIDE': 'DELETE',
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Gagal menghapus jabatan: ' + response.statusText);
        }
        return response.json();
    })
    .then(data => {
        showNotification('✓ Jabatan berhasil dihapus!', 'success');
        setTimeout(() => {
            closeDeleteJabatanModal();
            location.reload();
        }, 1000);
    })
    .catch(error => {
        console.error('Error:', error);
        showNotification('❌ ' + error.message, 'error');
        btn.innerHTML = originalHTML;
        btn.disabled = false;
    });
}

// Initialize on load
document.addEventListener('DOMContentLoaded', function() {
    // Sortable
    if (typeof $ !== 'undefined' && typeof $.ui !== 'undefined') {
        $(document).ready(function() {
            $("#sortable").sortable({
                items: "li",
                cursor: "grab",
                opacity: 0.95,
                placeholder: "ui-state-highlight",
                revert: 200,
                animation: 250,
                distance: 5,
                tolerance: "pointer",
                delay: 50
            });
        });
    }
});
</script>

<!-- Setup Click-Outside Handler for Delete Modal -->
<script>
    setupDeleteModalClickOutside('deleteProfilPegawaiModal');
</script>


<script src="<?php echo e(asset('js/image-cropper.js')); ?>"></script>

<script>
// Initialize cropper when page loads
document.addEventListener('DOMContentLoaded', function() {
    console.log('✅ Page loaded - Initializing delete functionality');
    
    // Initialize image cropper
    if (typeof window.ImageCropper === 'function') {
        window.imageCropper = new window.ImageCropper();
        console.log('✅ Image cropper initialized successfully');
    }
    
    // Delete modal is now managed by the reusable component
    console.log('✅ All delete functionality ready. Click "Hapus" button to show modal.');
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Pemustaka\Desktop\Infobase_uppjpds\resources\views/admin/profil_pegawai/index.blade.php ENDPATH**/ ?>