

<?php $__env->startSection('content'); ?>
<div class="bg-gray-50 min-h-screen py-12 pt-28">
    <div class="max-w-7xl mx-auto px-6">
        <div class="mb-8 flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Pengumuman</h1>
                <p class="text-gray-600 mt-1">Kelola semua pengumuman organisasi Anda</p>
            </div>
            <a href="<?php echo e(route('admin.pengumuman.create')); ?>" class="inline-flex items-center gap-2 px-6 py-3 text-white font-medium rounded-lg" style="background-color: #F85E38;" onmouseover="this.style.backgroundColor='#E64D28'" onmouseout="this.style.backgroundColor='#F85E38'">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Buat Pengumuman Baru
            </a>
        </div>

        <?php if(session('success')): ?>
            <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-6 py-4 rounded-lg">
                <p class="font-semibold"><?php echo e(session('success')); ?></p>
            </div>
        <?php endif; ?>

        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-8">
            <form action="<?php echo e(route('admin.pengumuman.index')); ?>" method="GET" class="flex flex-wrap gap-4 items-center">
                <div class="flex-1 min-w-64">
                    <input type="text" name="search" value="<?php echo e(request('search', '')); ?>" placeholder="Cari berdasarkan judul atau isi..."
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <select name="status" class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
                    <option value="">Semua Status</option>
                    <option value="active" <?php echo e(request('status') === 'active' ? 'selected' : ''); ?>>✓ Aktif</option>
                    <option value="inactive" <?php echo e(request('status') === 'inactive' ? 'selected' : ''); ?>>✗ Tidak Aktif</option>
                </select>
                <button type="submit" class="px-6 py-2 text-white rounded-lg font-medium" style="background-color: #063A76;" onmouseover="this.style.backgroundColor='#052A57'" onmouseout="this.style.backgroundColor='#063A76'">
                    Cari
                </button>
                <?php if(request('search') || request('status')): ?>
                    <a href="<?php echo e(route('admin.pengumuman.index')); ?>" class="px-4 py-2 text-gray-700 rounded-lg" style="background-color: #ECFDF1;" onmouseover="this.style.backgroundColor='#D1F8E6'" onmouseout="this.style.backgroundColor='#ECFDF1'">
                        Reset
                    </a>
                <?php endif; ?>
            </form>
        </div>

        <?php if($pengumumans->count() > 0): ?>
            <div class="space-y-4">
                <?php $__currentLoopData = $pengumumans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 hover:shadow-md transition-shadow">
                        <div class="flex items-start gap-6 p-6">
                            <div class="flex-shrink-0 pt-1">
                                <?php if($item->status === 'active'): ?>
                                    <span class="inline-flex items-center justify-center w-10 h-10 bg-green-100 text-green-700 rounded-full text-lg">✓</span>
                                <?php else: ?>
                                    <span class="inline-flex items-center justify-center w-10 h-10 bg-gray-200 text-gray-600 rounded-full text-lg">✗</span>
                                <?php endif; ?>
                            </div>

                            <div class="flex-1 min-w-0">
                                <div class="flex items-baseline gap-3 mb-2">
                                    <h3 class="text-lg font-semibold text-gray-900"><?php echo e($item->title); ?></h3>
                                    <?php if($item->status === 'active'): ?>
                                        <span class="text-xs font-medium px-2.5 py-0.5 bg-green-100 text-green-800 rounded-full">AKTIF</span>
                                    <?php else: ?>
                                        <span class="text-xs font-medium px-2.5 py-0.5 bg-gray-100 text-gray-800 rounded-full">NONAKTIF</span>
                                    <?php endif; ?>
                                </div>
                                <p class="text-sm text-gray-600 mb-2 line-clamp-2"><?php echo e(strip_tags($item->description)); ?></p>
                                <?php if($item->published_at): ?>
                                    <p class="text-xs text-gray-500">Publikasi: <?php echo e($item->published_at->timezone('Asia/Jakarta')->format('d M Y H:i')); ?></p>
                                <?php endif; ?>
                            </div>

                            <div class="flex items-center gap-2 flex-shrink-0">
                                <a href="<?php echo e(route('admin.pengumuman.edit', $item)); ?>" class="w-9 h-9 flex items-center justify-center text-white rounded" style="background-color: #F85E38;" onmouseover="this.style.backgroundColor='#E64D28'" onmouseout="this.style.backgroundColor='#F85E38'" title="Edit">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path></svg>
                                </a>
                                <button type="button" class="w-9 h-9 flex items-center justify-center text-white rounded" style="background-color: #E83B2B;" onmouseover="this.style.backgroundColor='#D62B1C'" onmouseout="this.style.backgroundColor='#E83B2B'" title="Hapus"
                                    onclick="showDeleteModal('<?php echo e(addslashes($item->title)); ?>', '/admin/pengumuman/<?php echo e($item->id); ?>')">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                                </button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <?php if($pengumumans->hasPages()): ?>
                <div class="mt-8">
                    <?php echo e($pengumumans->appends(request()->query())->links()); ?>

                </div>
            <?php endif; ?>
        <?php else: ?>
            <div class="bg-white rounded-lg border border-gray-200 border-dashed p-12 text-center">
                <p class="text-gray-600 text-lg font-medium mb-4">Belum ada pengumuman</p>
                <a href="<?php echo e(route('admin.pengumuman.create')); ?>" class="inline-flex items-center gap-2 px-6 py-3 text-white rounded-lg" style="background-color: #F85E38;" onmouseover="this.style.backgroundColor='#E64D28'" onmouseout="this.style.backgroundColor='#F85E38'">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Buat Pengumuman Baru
                </a>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- DELETE MODAL - INLINE -->
<div id="deletePengumumanModal" class="fixed inset-0 bg-black/40 backdrop-blur-sm hidden z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md p-8">
        <div class="flex justify-center mb-6">
            <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center">
                <i class="fas fa-exclamation-triangle text-red-600 text-3xl"></i>
            </div>
        </div>
        
        <h3 class="text-2xl font-bold text-center text-gray-900 mb-2">Hapus Pengumuman?</h3>
        
        <div class="bg-red-50 border-l-4 border-red-500 rounded-lg p-4 mb-6">
            <p class="text-gray-700 text-center">Yakin ingin menghapus <br><strong id="deleteItemName" class="text-red-600 text-lg">item</strong>?</p>
            <p class="text-sm text-gray-500 text-center mt-2"><i class="fas fa-info-circle mr-1"></i>Tindakan ini tidak dapat dibatalkan</p>
        </div>
        
        <div class="flex gap-3">
            <button type="button" onclick="document.getElementById('deletePengumumanModal').classList.add('hidden')" class="flex-1 px-6 py-2.5 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 font-semibold">
                Batal
            </button>
            <button type="button" id="confirmDeleteBtn" class="flex-1 px-6 py-2.5 bg-red-600 text-white rounded-lg hover:bg-red-700 font-semibold flex items-center justify-center gap-2">
                <i class="fas fa-trash-alt"></i> <span id="deleteBtnText">Hapus</span>
            </button>
        </div>
    </div>
</div>

<script>
let deleteUrl = '';
let deleteName = '';

function showDeleteModal(name, url) {
    deleteUrl = url;
    deleteName = name;
    document.getElementById('deleteItemName').textContent = name;
    document.getElementById('deleteBtnText').textContent = 'Hapus';
    document.getElementById('deletePengumumanModal').classList.remove('hidden');
}

document.getElementById('confirmDeleteBtn').addEventListener('click', async function() {
    if (!deleteUrl) return;
    
    const btn = this;
    btn.disabled = true;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> <span>Menghapus...</span>';
    
    try {
        const response = await fetch(deleteUrl, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        });
        
        const data = await response.json();
        
        if (response.ok && data.success) {
            if (typeof showSuccessToast === 'function') {
                showSuccessToast('✓ ' + deleteName + ' berhasil dihapus!');
            }
            document.getElementById('deletePengumumanModal').classList.add('hidden');
            setTimeout(() => location.reload(), 1500);
        } else {
            if (typeof showErrorToast === 'function') {
                showErrorToast('✗ Gagal menghapus: ' + (data.message || 'Error'));
            } else {
                alert('Gagal: ' + (data.message || 'Error'));
            }
            btn.innerHTML = '<i class="fas fa-trash-alt"></i> <span>Hapus</span>';
            btn.disabled = false;
        }
    } catch (error) {
        if (typeof showErrorToast === 'function') {
            showErrorToast('✗ Terjadi kesalahan');
        } else {
            alert('Terjadi kesalahan');
        }
        btn.innerHTML = '<i class="fas fa-trash-alt"></i> <span>Hapus</span>';
        btn.disabled = false;
    }
});

// Close on backdrop click
document.getElementById('deletePengumumanModal').addEventListener('click', function(e) {
    if (e.target === this) {
        this.classList.add('hidden');
    }
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Pemustaka\Desktop\Infobase_uppjpds\resources\views/admin/pengumuman/index.blade.php ENDPATH**/ ?>