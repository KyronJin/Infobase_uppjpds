<?php $__env->startSection('content'); ?>
<div class="py-24 bg-white pt-28">
  <div class="max-w-6xl mx-auto px-6">
    <div class="admin-section">
        <div class="flex items-center justify-between mb-6">
            <h1 class="h2">Daftar Calendar Events</h1>
            <?php if (isset($component)) { $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['variant' => 'primary','size' => 'lg','icon' => 'plus','onclick' => 'openCreateModal()']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'primary','size' => 'lg','icon' => 'plus','onclick' => 'openCreateModal()']); ?>Buat Event <?php echo $__env->renderComponent(); ?>
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
            <div class="content-box mb-4"><?php echo e(session('success')); ?></div>
        <?php endif; ?>

        <!-- Daftar Calendar Events -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden text-sm mb-8">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-50 border-b border-gray-100 font-bold">
                        <tr>
                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-600">Judul</th>
                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-600">Jadwal</th>
                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-600">Lokasi</th>
                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-600">Kapasitas</th>
                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-600 text-center">Status</th>
                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-600 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <?php $__empty_1 = true; $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="font-medium text-gray-900"><?php echo e($item->title); ?></div>
                                <div class="text-xs text-gray-500 line-clamp-1 truncate max-w-[200px]"><?php echo e($item->description); ?></div>
                            </td>
                            <td class="px-6 py-4 text-gray-600 whitespace-nowrap">
                                <?php echo e($item->start_at?->format('d M Y, H:i') ?? '-'); ?>

                            </td>
                            <td class="px-6 py-4 text-gray-500"><?php echo e($item->location ?? '-'); ?></td>
                            <td class="px-6 py-4 text-gray-500">
                                <?php echo e($item->participants ?? 0); ?> / <?php echo e($item->capacity ?? '∞'); ?>

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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['variant' => 'ghost','size' => 'sm','icon' => 'edit','onclick' => 'editCalendarEvent('.e($item->id).')']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'ghost','size' => 'sm','icon' => 'edit','onclick' => 'editCalendarEvent('.e($item->id).')']); ?>Edit <?php echo $__env->renderComponent(); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['variant' => 'ghost-danger','size' => 'sm','icon' => 'trash','onclick' => 'openDeleteModal(\'deleteCalendarModal\', \''.e($item->title).'\', \'/admin/calendar/'.e($item->id).'\')']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'ghost-danger','size' => 'sm','icon' => 'trash','onclick' => 'openDeleteModal(\'deleteCalendarModal\', \''.e($item->title).'\', \'/admin/calendar/'.e($item->id).'\')']); ?>Hapus <?php echo $__env->renderComponent(); ?>
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
                            <td colspan="6" class="px-6 py-10 text-center text-gray-400 italic">Belum ada calendar events.</td>
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


        <!-- Modal Create Event -->
        <div id="createCalendarModal" class="fixed inset-0 backdrop-blur-sm bg-white/30 hidden z-50 flex items-center justify-center">
            <div class="flex items-center justify-center min-h-screen p-4">
                <div class="bg-white rounded-lg max-w-2xl w-full max-h-[90vh] overflow-y-auto">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-xl font-bold text-gray-900">Buat Event</h3>
                            <button onclick="closeModal('createCalendarModal')" class="text-gray-400 hover:text-gray-600">
                                <i class="fas fa-times text-xl"></i>
                            </button>
                        </div>
                        <form action="<?php echo e(route('admin.calendar.store')); ?>" method="POST" class="grid grid-cols-2 gap-4">
                            <?php echo csrf_field(); ?>
                            <div class="col-span-2">
                                <label class="block text-gray-700 font-semibold mb-2">Judul <span class="text-red-500">*</span></label>
                                <input type="text" name="title" required class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500">
                            </div>
                            <div class="col-span-2">
                                <label class="block text-gray-700 font-semibold mb-2">Deskripsi</label>
                                <textarea name="description" rows="3" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500"></textarea>
                            </div>
                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">Mulai</label>
                                <input type="datetime-local" name="start_at" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500">
                            </div>
                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">Selesai</label>
                                <input type="datetime-local" name="end_at" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500">
                            </div>
                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">Lokasi</label>
                                <input type="text" name="location" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500">
                            </div>
                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">Kapasitas</label>
                                <input type="number" name="capacity" min="0" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500">
                            </div>
                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">Jumlah Peserta</label>
                                <input type="number" name="participants" min="0" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500">
                            </div>
                            <div>
                                <label class="flex items-center text-gray-700 font-semibold">
                                    <input type="checkbox" name="is_active" value="1" checked class="w-4 h-4 text-teal-600 rounded focus:ring-2 focus:ring-teal-500 mr-2">
                                    Aktif
                                </label>
                            </div>
                            <div class="col-span-2 flex justify-end gap-3 pt-4">
                                <?php if (isset($component)) { $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['variant' => 'secondary','size' => 'md','type' => 'button','onclick' => 'closeModal(\'createCalendarModal\')']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'secondary','size' => 'md','type' => 'button','onclick' => 'closeModal(\'createCalendarModal\')']); ?>Batal <?php echo $__env->renderComponent(); ?>
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
                </div>
            </div>
        </div>

        <!-- Modal Edit Event -->
        <div id="editCalendarModal" class="fixed inset-0 backdrop-blur-sm bg-white/30 hidden z-50 flex items-center justify-center">
            <div class="flex items-center justify-center min-h-screen p-4">
                <div class="bg-white rounded-lg max-w-2xl w-full max-h-[90vh] overflow-y-auto">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-xl font-bold text-gray-900">Edit Event</h3>
                            <button onclick="closeModal('editCalendarModal')" class="text-gray-400 hover:text-gray-600">
                                <i class="fas fa-times text-xl"></i>
                            </button>
                        </div>
                        <form id="editCalendarForm" method="POST" class="grid grid-cols-2 gap-4">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>
                            <div class="col-span-2">
                                <label class="block text-gray-700 font-semibold mb-2">Judul <span class="text-red-500">*</span></label>
                                <input type="text" id="edit-title" name="title" required class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500">
                            </div>
                            <div class="col-span-2">
                                <label class="block text-gray-700 font-semibold mb-2">Deskripsi</label>
                                <textarea id="edit-description" name="description" rows="3" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500"></textarea>
                            </div>
                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">Mulai</label>
                                <input type="datetime-local" id="edit-start_at" name="start_at" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500">
                            </div>
                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">Selesai</label>
                                <input type="datetime-local" id="edit-end_at" name="end_at" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500">
                            </div>
                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">Lokasi</label>
                                <input type="text" id="edit-location" name="location" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500">
                            </div>
                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">Kapasitas</label>
                                <input type="number" id="edit-capacity" name="capacity" min="0" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500">
                            </div>
                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">Jumlah Peserta</label>
                                <input type="number" id="edit-participants" name="participants" min="0" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500">
                            </div>
                            <div>
                                <label class="flex items-center text-gray-700 font-semibold">
                                    <input type="checkbox" id="edit-is_active" name="is_active" value="1" class="w-4 h-4 text-teal-600 rounded focus:ring-2 focus:ring-teal-500 mr-2">
                                    Aktif
                                </label>
                            </div>
                            <div class="col-span-2 flex justify-end gap-3 pt-4">
                                <?php if (isset($component)) { $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['variant' => 'secondary','size' => 'md','type' => 'button','onclick' => 'closeModal(\'editCalendarModal\')']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'secondary','size' => 'md','type' => 'button','onclick' => 'closeModal(\'editCalendarModal\')']); ?>Batal <?php echo $__env->renderComponent(); ?>
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
                </div>
            </div>
        </div>

        <!-- Delete Modal Component -->
        <?php $__env->startComponent('components.delete-modal', ['id' => 'deleteCalendarModal', 'title' => 'Hapus Calendar Event?']); ?> <?php echo $__env->renderComponent(); ?>
    </div>
</div>

<script>
function openCreateModal() {
    document.getElementById('createCalendarModal').classList.remove('hidden');
}

function closeModal(id) {
    document.getElementById(id).classList.add('hidden');
}

function editCalendarEvent(id) {
    const modal = document.getElementById('editCalendarModal');
    const form = document.getElementById('editCalendarForm');
    
    fetch(`/admin/calendar/${id}/edit`, {
        headers: {
            'Accept': 'application/json',
        }
    })
    .then(response => response.json())
    .then(data => {
        document.getElementById('edit-title').value = data.title || '';
        document.getElementById('edit-description').value = data.description || '';
        document.getElementById('edit-start_at').value = data.start_at || '';
        document.getElementById('edit-end_at').value = data.end_at || '';
        document.getElementById('edit-location').value = data.location || '';
        document.getElementById('edit-capacity').value = data.capacity || '';
        document.getElementById('edit-participants').value = data.participants || '';
        document.getElementById('edit-is_active').checked = data.is_active || false;
        form.action = `/admin/calendar/${id}`;
        modal.classList.remove('hidden');
    })
    .catch(error => console.error('Error:', error));
}



// Close modals when clicking outside
document.getElementById('createCalendarModal')?.addEventListener('click', function(e) {
    if (e.target === this) closeModal('createCalendarModal');
});

document.getElementById('editCalendarModal')?.addEventListener('click', function(e) {
    if (e.target === this) closeModal('editCalendarModal');
});

// Setup Click-Outside Handler for Delete Modal
setupDeleteModalClickOutside('deleteCalendarModal');
</script>

<script>
    setupDeleteModalClickOutside('deleteCalendarModal');
</script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Pemustaka\Desktop\Infobase_uppjpds\resources\views/admin/calendar/index.blade.php ENDPATH**/ ?>