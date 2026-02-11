<?php $__env->startSection('content'); ?>
<div class="bg-gray-50 min-h-screen py-24 pt-28 font-cairo">
    <div class="max-w-6xl mx-auto px-6">
        
        <div class="flex flex-col md:flex-row items-center justify-between mb-8 bg-white p-8 rounded-3xl shadow-sm border border-gray-100">
            <div>
                <h1 class="text-4xl font-extrabold text-gray-900 tracking-tight">Profile Ruangan</h1>
                <p class="text-gray-500 mt-2 font-medium">Kelola informasi dan fasilitas ruangan di sini.</p>
            </div>
            <?php if (isset($component)) { $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['variant' => 'primary','size' => 'lg','icon' => 'plus','class' => 'rounded-2xl shadow-lg shadow-teal-200','onclick' => 'openCreateModal()']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'primary','size' => 'lg','icon' => 'plus','class' => 'rounded-2xl shadow-lg shadow-teal-200','onclick' => 'openCreateModal()']); ?>Buat Ruangan Baru <?php echo $__env->renderComponent(); ?>
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

        <?php if(session('success')): ?>
            <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-6 py-4 rounded-2xl flex items-center gap-2 animate-in fade-in slide-in-from-top duration-300">
                <i class="fas fa-check-circle text-green-500"></i>
                <span class="font-bold"><?php echo e(session('success')); ?></span>
            </div>
        <?php endif; ?>

        <!-- Search Form -->
        <div class="mb-6">
            <form method="GET" action="<?php echo e(route('admin.profile.index')); ?>" class="flex gap-3">
                <div class="flex-1">
                    <input 
                        type="text" 
                        name="search" 
                        placeholder="Cari ruangan berdasarkan nama, lantai, atau deskripsi..." 
                        value="<?php echo e($search ?? ''); ?>"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500"
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['variant' => 'secondary','size' => 'md','type' => 'link','href' => ''.e(route('admin.profile.index')).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'secondary','size' => 'md','type' => 'link','href' => ''.e(route('admin.profile.index')).'']); ?>
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

        <!-- Daftar Ruangan -->
        <div class="bg-white rounded-3xl shadow-xl shadow-gray-200/50 border border-gray-100 overflow-hidden mb-8 text-sm">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-50/80 border-b border-gray-100 font-bold">
                        <tr>
                            <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest text-gray-400">Gambar</th>
                            <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest text-gray-400">Ruangan</th>
                            <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest text-gray-400">Kapasitas</th>
                            <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest text-gray-400">Deskripsi</th>
                            <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest text-gray-400 text-center">Status</th>
                            <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest text-gray-400 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        <?php $__empty_1 = true; $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="hover:bg-teal-50/30 transition-all duration-300">
                            <td class="px-8 py-4">
                                <div class="flex -space-x-4">
                                    <?php $__currentLoopData = $item->images->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="w-12 h-12 rounded-xl overflow-hidden shadow-sm bg-gray-100 ring-4 ring-white transition-transform hover:z-10 hover:scale-110">
                                            <img src="<?php echo e(asset('storage/' . $image->image_path)); ?>" alt="Room" class="w-full h-full object-cover">
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($item->images->count() == 0): ?>
                                        <div class="w-12 h-12 rounded-xl bg-gray-50 flex items-center justify-center text-gray-300 border-2 border-dashed border-gray-100 italic text-[10px]">No Pic</div>
                                    <?php endif; ?>
                                </div>
                            </td>
                            <td class="px-8 py-4 font-bold text-gray-900 leading-tight">
                                <?php echo e($item->room_name); ?>

                                <div class="text-[10px] text-gray-400 font-medium tracking-tight uppercase">LANTAI <?php echo e($item->floor ?? '-'); ?></div>
                            </td>
                            <td class="px-8 py-4 text-gray-600 font-semibold"><?php echo e($item->capacity ?? '—'); ?> Orang</td>
                            <td class="px-8 py-4 text-gray-500 text-xs italic max-w-xs truncate">
                                <?php echo e($item->description ?? '-'); ?>

                            </td>
                            <td class="px-8 py-4 text-center">
                                <?php if($item->is_active): ?>
                                    <span class="inline-flex items-center px-4 py-1 rounded-full text-[10px] font-black tracking-widest bg-green-100 text-green-700 border border-green-200 uppercase">AKTIF</span>
                                <?php else: ?>
                                    <span class="inline-flex items-center px-4 py-1 rounded-full text-[10px] font-black tracking-widest bg-gray-100 text-gray-500 border border-gray-200 uppercase">NON-AKTIF</span>
                                <?php endif; ?>
                            </td>
                            <td class="px-8 py-4 whitespace-nowrap">
                                <div class="flex items-center justify-end gap-2">
                                    <?php if (isset($component)) { $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['variant' => 'ghost','size' => 'sm','icon' => 'edit','class' => 'rounded-xl hover:bg-orange-50 hover:text-orange-600 font-bold','onclick' => 'editProfileRuangan('.e($item->id).')']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'ghost','size' => 'sm','icon' => 'edit','class' => 'rounded-xl hover:bg-orange-50 hover:text-orange-600 font-bold','onclick' => 'editProfileRuangan('.e($item->id).')']); ?>Edit <?php echo $__env->renderComponent(); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['variant' => 'ghost-danger','size' => 'sm','icon' => 'trash','class' => 'rounded-xl font-bold','onclick' => 'openDeleteModal(\'deleteProfileRuanganModal\', \''.e($item->room_name).'\', \'/admin/profile-ruangan/'.e($item->id).'\')']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'ghost-danger','size' => 'sm','icon' => 'trash','class' => 'rounded-xl font-bold','onclick' => 'openDeleteModal(\'deleteProfileRuanganModal\', \''.e($item->room_name).'\', \'/admin/profile-ruangan/'.e($item->id).'\')']); ?>Hapus <?php echo $__env->renderComponent(); ?>
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
                            <td colspan="6" class="px-8 py-20 text-center">
                                <div class="flex flex-col items-center">
                                    <i class="fas fa-folder-open text-gray-100 text-6xl mb-4"></i>
                                    <p class="text-gray-400 italic font-medium">Belum ada profile ruangan yang terdaftar.</p>
                                </div>
                            </td>
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


        <!-- Modal Create -->
        <div id="createModal" class="fixed inset-0 backdrop-blur-sm bg-black/40 hidden z-50 flex items-center justify-center p-4">
            <div class="bg-white rounded-3xl shadow-2xl w-full max-w-2xl overflow-hidden animate-in fade-in zoom-in duration-300">
                <div class="p-8 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-teal-100 rounded-2xl flex items-center justify-center">
                            <i class="fas fa-plus text-teal-600"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900">Buat Profile Ruangan</h3>
                            <p class="text-xs text-gray-500">Tambahkan informasi ruangan baru</p>
                        </div>
                    </div>
                    <button onclick="closeModal('createModal')" class="text-gray-400 hover:text-gray-600 transition-colors">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
                
                <div class="p-8 max-h-[70vh] overflow-y-auto font-cairo">
                    <div id="createErrors" class="hidden bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded-xl mb-6 text-sm"></div>
                    
                    <form id="createForm" action="<?php echo e(route('admin.profile.store')); ?>" method="POST" enctype="multipart/form-data" class="space-y-6">
                        <?php echo csrf_field(); ?>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="col-span-2">
                                <label class="block text-sm font-bold text-gray-700 mb-2">Nama Ruangan <span class="text-red-500">*</span></label>
                                <input type="text" id="create-room_name" name="room_name" required class="w-full border-2 border-gray-100 rounded-xl px-4 py-3 focus:outline-none focus:border-teal-500 transition-all font-medium" placeholder="Contoh: Ruang Galeri">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Lantai</label>
                                <input type="number" id="create-floor" name="floor" min="1" max="7" class="w-full border-2 border-gray-100 rounded-xl px-4 py-3 focus:outline-none focus:border-teal-500 transition-all" placeholder="1-7">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Kapasitas</label>
                                <input type="number" id="create-capacity" name="capacity" class="w-full border-2 border-gray-100 rounded-xl px-4 py-3 focus:outline-none focus:border-teal-500 transition-all" placeholder="Orang">
                            </div>
                            <div class="col-span-2">
                                <label class="block text-sm font-bold text-gray-700 mb-2">Deskripsi</label>
                                <textarea id="create-description" name="description" rows="4" class="w-full border-2 border-gray-100 rounded-xl px-4 py-3 focus:outline-none focus:border-teal-500 transition-all" placeholder="Gunakan bahasa yang menarik..."></textarea>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-3">🖼️ Foto Ruangan (Maks 3)</label>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <?php for($i = 1; $i <= 3; $i++): ?>
                                <div class="border-2 border-dashed border-gray-200 rounded-xl p-3 hover:border-teal-400 transition-colors">
                                    <p class="text-[10px] uppercase font-bold text-gray-400 mb-1">Slot <?php echo e($i); ?></p>
                                    <input type="file" id="create-slot_<?php echo e($i); ?>_image" name="slot_<?php echo e($i); ?>_image" accept="image/*" class="text-xs w-full">
                                </div>
                                <?php endfor; ?>
                            </div>
                            <p class="text-[10px] text-gray-400 mt-2 italic">* Format JPG/PNG, Maks 20MB</p>
                        </div>

                        <div class="flex items-center gap-2 bg-gray-50 p-4 rounded-2xl">
                            <input type="checkbox" id="create-is_active" name="is_active" value="1" checked class="w-5 h-5 text-teal-600 rounded-lg focus:ring-teal-500">
                            <label for="create-is_active" class="text-sm font-bold text-gray-700 cursor-pointer">Tampilkan di Publik</label>
                        </div>

                        <div class="flex justify-end gap-3 pt-6 border-t border-gray-100">
                            <?php if (isset($component)) { $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['variant' => 'secondary','size' => 'md','type' => 'button','onclick' => 'closeModal(\'createModal\')']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'secondary','size' => 'md','type' => 'button','onclick' => 'closeModal(\'createModal\')']); ?>Batal <?php echo $__env->renderComponent(); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['variant' => 'primary','size' => 'md','icon' => 'check','type' => 'submit','id' => 'createSubmitBtn']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'primary','size' => 'md','icon' => 'check','type' => 'submit','id' => 'createSubmitBtn']); ?>Simpan Profile <?php echo $__env->renderComponent(); ?>
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

        <!-- Modal Edit -->
        <div id="editModal" class="fixed inset-0 backdrop-blur-sm bg-black/40 hidden z-50 flex items-center justify-center p-4">
            <div class="bg-white rounded-3xl shadow-2xl w-full max-w-2xl overflow-hidden animate-in fade-in zoom-in duration-300">
                <div class="p-8 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-orange-100 rounded-2xl flex items-center justify-center">
                            <i class="fas fa-edit text-orange-600"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900">Perbarui Profile Ruangan</h3>
                            <p class="text-xs text-gray-500">Edit informasi detail ruangan</p>
                        </div>
                    </div>
                    <button onclick="closeModal('editModal')" class="text-gray-400 hover:text-gray-600 transition-colors">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>

                <div class="p-8 max-h-[70vh] overflow-y-auto font-cairo">
                    <div id="editErrors" class="hidden bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded-xl mb-6 text-sm"></div>
                    
                    <form id="editForm" method="POST" enctype="multipart/form-data" class="space-y-6">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="col-span-2">
                                <label class="block text-sm font-bold text-gray-700 mb-2">Nama Ruangan <span class="text-red-500">*</span></label>
                                <input type="text" id="edit-room_name" name="room_name" required class="w-full border-2 border-gray-100 rounded-xl px-4 py-3 focus:outline-none focus:border-orange-500 transition-all font-medium">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Lantai</label>
                                <input type="number" id="edit-floor" name="floor" min="1" max="7" class="w-full border-2 border-gray-100 rounded-xl px-4 py-3 focus:outline-none focus:border-orange-500 transition-all font-medium">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Kapasitas</label>
                                <input type="number" id="edit-capacity" name="capacity" class="w-full border-2 border-gray-100 rounded-xl px-4 py-3 focus:outline-none focus:border-orange-500 transition-all font-medium">
                            </div>
                            <div class="col-span-2">
                                <label class="block text-sm font-bold text-gray-700 mb-2">Deskripsi</label>
                                <textarea id="edit-description" name="description" rows="4" class="w-full border-2 border-gray-100 rounded-xl px-4 py-3 focus:outline-none focus:border-orange-500 transition-all font-medium"></textarea>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-3 uppercase tracking-wider text-[10px]">🖼️ Foto Saat Ini</label>
                            <div id="edit-images-preview" class="grid grid-cols-3 gap-4 mb-6 bg-gray-50/50 p-6 rounded-3xl border-2 border-dashed border-gray-100 min-h-[120px] flex items-center justify-center">
                                <!-- JS injects here -->
                            </div>

                            <label class="block text-sm font-bold text-gray-700 mb-3 uppercase tracking-wider text-[10px]">Ganti/Tambah Foto Baru</label>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <?php for($i = 1; $i <= 3; $i++): ?>
                                <div class="group relative border-2 border-dashed border-gray-100 rounded-2xl p-4 hover:border-orange-400 hover:bg-orange-50/30 transition-all duration-300">
                                    <p class="text-[10px] uppercase font-black text-gray-300 group-hover:text-orange-400 mb-2 transition-colors">Slot <?php echo e($i); ?></p>
                                    <input type="file" name="slot_<?php echo e($i); ?>_image" accept="image/*" class="text-[10px] w-full file:mr-2 file:py-1 file:px-2 file:rounded-full file:border-0 file:text-[10px] file:font-bold file:bg-orange-100 file:text-orange-700 hover:file:bg-orange-200 cursor-pointer">
                                </div>
                                <?php endfor; ?>
                            </div>
                            <p class="text-[10px] text-gray-400 mt-3 italic flex items-center gap-1">
                                <i class="fas fa-info-circle"></i> Format JPG/PNG, Maks 20MB per file
                            </p>
                        </div>

                        <div class="flex items-center gap-2 bg-gray-50 p-4 rounded-2xl">
                            <input type="checkbox" id="edit-is_active" name="is_active" value="1" class="w-5 h-5 text-orange-600 rounded-lg focus:ring-orange-500">
                            <label for="edit-is_active" class="text-sm font-bold text-gray-700 cursor-pointer">Aktifkan di Halaman Publik</label>
                        </div>

                        <div class="flex justify-end gap-3 pt-6 border-t border-gray-100">
                            <?php if (isset($component)) { $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['variant' => 'secondary','size' => 'md','type' => 'button','onclick' => 'closeModal(\'editModal\')']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'secondary','size' => 'md','type' => 'button','onclick' => 'closeModal(\'editModal\')']); ?>Batal <?php echo $__env->renderComponent(); ?>
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
<?php $component->withAttributes(['variant' => 'primary','size' => 'md','icon' => 'check','type' => 'submit']); ?>Simpan Perubahan <?php echo $__env->renderComponent(); ?>
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

        <!-- Modal Delete -->
        <!-- Delete Modal Component -->
        <?php $__env->startComponent('components.delete-modal', ['id' => 'deleteProfileRuanganModal', 'title' => 'Hapus Profile Ruangan?']); ?> <?php echo $__env->renderComponent(); ?>
    </div>
</div>

<script>
function openCreateModal() {
    document.getElementById('createForm').reset();
    document.getElementById('createErrors').classList.add('hidden');
    document.getElementById('createModal').classList.remove('hidden');
}

function closeModal(id) {
    document.getElementById(id).classList.add('hidden');
}

// Handle Create Form Submission
document.getElementById('createForm')?.addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const form = this;
    const formData = new FormData(form);
    const submitBtn = document.getElementById('createSubmitBtn');
    const errorDiv = document.getElementById('createErrors');
    const originalText = submitBtn.innerText;
    
    // Validate at least room_name is filled
    if (!document.getElementById('create-room_name').value.trim()) {
        errorDiv.innerHTML = '<strong>Error:</strong> Nama ruangan tidak boleh kosong';
        errorDiv.classList.remove('hidden');
        return;
    }
    
    // Show loading state
    submitBtn.disabled = true;
    submitBtn.innerText = 'Menyimpan...';
    errorDiv.classList.add('hidden');
    
    try {
        const response = await fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            },
            redirect: 'follow'
        });
        
        if (response.status === 422) {
            // Validation error
            const data = await response.json();
            let errorMsg = '<strong>Perbaiki kesalahan berikut:</strong><ul style="margin-top: 8px;">';
            if (data.errors) {
                for (const [field, messages] of Object.entries(data.errors)) {
                    messages.forEach(msg => {
                        errorMsg += `<li>• ${msg}</li>`;
                    });
                }
            }
            errorMsg += '</ul>';
            errorDiv.innerHTML = errorMsg;
            errorDiv.classList.remove('hidden');
            form.parentElement.scrollTop = 0;
        } else if (response.ok || response.redirected) {
            // Success - reload page after brief delay
            setTimeout(() => {
                window.location.href = '<?php echo e(route("admin.profile.index")); ?>';
            }, 500);
        } else {
            errorDiv.innerHTML = `<strong>Error:</strong> Terjadi kesalahan (${response.status})`;
            errorDiv.classList.remove('hidden');
        }
    } catch (error) {
        errorDiv.innerHTML = `<strong>Error:</strong> ${error.message}`;
        errorDiv.classList.remove('hidden');
    } finally {
        submitBtn.disabled = false;
        submitBtn.innerText = originalText;
    }
});

// Handle Edit Form Submission
document.getElementById('editForm')?.addEventListener('submit', function(e) {
    e.preventDefault();
    
    const form = this;
    const formData = new FormData(form);
    
    // Show loading state
    const submitBtn = form.querySelector('[type="submit"]');
    const originalText = submitBtn.innerText;
    submitBtn.disabled = true;
    submitBtn.innerText = 'Loading...';
    
    fetch(form.action, {
        method: 'POST',
        body: formData,
        headers: {
            'Accept': 'application/json'
        }
    })
    .then(response => {
        if (response.ok) {
            // Show success and reload page
            window.location.href = '<?php echo e(route("admin.profile.index")); ?>';
        } else if (response.status === 422) {
            return response.json().then(data => {
                throw data;
            });
        } else {
            throw new Error('Terjadi kesalahan');
        }
    })
    .catch(error => {
        const errorDiv = form.querySelector('[id*="Errors"]') || document.createElement('div');
        if (error.errors) {
            let errorMsg = '<strong>Perbaiki kesalahan berikut:</strong><ul style="margin-top: 8px;">';
            Object.values(error.errors).forEach(messages => {
                messages.forEach(msg => {
                    errorMsg += `<li>• ${msg}</li>`;
                });
            });
            errorMsg += '</ul>';
            errorDiv.innerHTML = errorMsg;
        } else {
            errorDiv.innerHTML = error.message || 'Terjadi kesalahan saat menyimpan data';
        }
        if (!errorDiv.parentNode) {
            errorDiv.className = 'bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded text-sm mb-4';
            form.insertBefore(errorDiv, form.firstChild);
        } else {
            errorDiv.classList.remove('hidden');
        }
        
        // Reset button
        submitBtn.disabled = false;
        submitBtn.innerText = originalText;
    });
});

function editProfileRuangan(id) {
    const modal = document.getElementById('editModal');
    const form = document.getElementById('editForm');
    
    fetch(`/admin/profile-ruangan/${id}/edit`, {
        headers: {
            'Accept': 'application/json',
        }
    })
    .then(response => response.json())
    .then(data => {
        document.getElementById('edit-room_name').value = data.room_name || '';
        document.getElementById('edit-floor').value = data.floor || '';
        document.getElementById('edit-capacity').value = data.capacity || '';
        document.getElementById('edit-description').value = data.description || '';
        document.getElementById('edit-is_active').checked = data.is_active || false;
        form.action = `/admin/profile-ruangan/${id}`;
        
        // Display existing images
        const previewContainer = document.getElementById('edit-images-preview');
        previewContainer.innerHTML = '';
        
        if (data.images && data.images.length > 0) {
            data.images.forEach(image => {
                const imageDiv = document.createElement('div');
                imageDiv.className = 'relative group rounded-2xl overflow-hidden shadow-sm bg-white border border-gray-100 aspect-square ring-4 ring-white transition-transform hover:scale-105';
                imageDiv.innerHTML = `
                    <img src="/storage/${image.image_path}" alt="Room image" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                        <button type="button" onclick="deleteImageFromEdit(${image.id}, this)" class="bg-red-500 text-white w-8 h-8 rounded-full flex items-center justify-center hover:bg-red-600 transition-colors shadow-lg" title="Hapus gambar">
                            <i class="fas fa-trash text-xs"></i>
                        </button>
                    </div>
                `;
                previewContainer.appendChild(imageDiv);
            });
        } else {
            previewContainer.innerHTML = `
                <div class="col-span-3 flex flex-col items-center justify-center py-4">
                    <i class="fas fa-images text-gray-200 text-3xl mb-2"></i>
                    <p class="text-gray-400 text-xs italic">Belum ada foto terunggah</p>
                </div>
            `;
        }
        
        modal.classList.remove('hidden');
    })
    .catch(error => console.error('Error:', error));
}

function deleteImageFromEdit(imageId, buttonElement) {
    if (!confirm('Yakin ingin menghapus gambar ini?')) {
        return;
    }
    
    const previewContainer = document.getElementById('edit-images-preview');
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content || '';
    
    fetch(`/admin/profile-ruangan/image/${imageId}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json',
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Remove the image element from preview
            buttonElement.closest('div').remove();
            
            // Check if no images left
            if (previewContainer.children.length === 0) {
                previewContainer.innerHTML = '<p class="col-span-3 text-gray-500 text-sm">Belum ada gambar</p>';
            }
            
            // Show success message
            showNotification('Gambar berhasil dihapus!', 'success');
        } else {
            showNotification('Gagal menghapus gambar: ' + (data.message || 'Unknown error'), 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showNotification('Terjadi kesalahan saat menghapus gambar', 'error');
    });
}

function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `fixed top-4 right-4 p-4 rounded-lg text-white z-[9999] ${
        type === 'success' ? 'bg-green-500' : type === 'error' ? 'bg-red-500' : 'bg-blue-500'
    }`;
    notification.textContent = message;
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.remove();
    }, 3000);
}



// Close modals when clicking outside
document.getElementById('createModal')?.addEventListener('click', function(e) {
    if (e.target === this) closeModal('createModal');
});

document.getElementById('editModal')?.addEventListener('click', function(e) {
    if (e.target === this) closeModal('editModal');
});

// Setup Click-Outside Handler for Delete Modal
setupDeleteModalClickOutside('deleteProfileRuanganModal');
</script>

<script>
    setupDeleteModalClickOutside('deleteProfileRuanganModal');
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Pemustaka\Desktop\Infobase_uppjpds\resources\views/admin/profile/index.blade.php ENDPATH**/ ?>