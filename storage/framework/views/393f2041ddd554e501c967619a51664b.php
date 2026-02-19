
<div style="max-width: 1400px; margin: 0 auto; padding: 2rem 1.5rem 1rem 1.5rem;">
    <form method="GET" action="<?php echo e($action); ?>" class="flex gap-3 mb-6 flex-wrap">
        <div style="flex: 1; min-width: 200px;">
            <input 
                type="text" 
                name="search" 
                placeholder="<?php echo e($placeholder ?? 'Cari...'); ?>" 
                value="<?php echo e($search ?? ''); ?>"
                class="w-full px-4 py-2 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-[#00425A] transition duration-300"
            >
        </div>
        
        
        <?php if(isset($showStatusFilter) && $showStatusFilter): ?>
            <select 
                name="status"
                class="px-4 py-2 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-[#00425A] transition duration-300 bg-white"
            >
                <option value="active" <?php echo e(isset($status) && ($status === 'active' || $status === '') ? 'selected' : ''); ?>>Aktif</option>
                <option value="inactive" <?php echo e(isset($status) && $status === 'inactive' ? 'selected' : ''); ?>>Tidak Aktif</option>
            </select>
        <?php endif; ?>
        
        <button 
            type="submit" 
            class="px-6 py-2 bg-[#00425A] text-white font-semibold rounded-lg hover:bg-[#003144] transition duration-300 flex items-center gap-2"
        >
            <i class="fas fa-search"></i>
            Cari
        </button>
        <?php if(!empty($search) || (isset($status) && !empty($status))): ?>
            <a 
                href="<?php echo e($action); ?>" 
                class="px-4 py-2 bg-gray-300 text-gray-700 font-semibold rounded-lg hover:bg-gray-400 transition duration-300"
            >
                <i class="fas fa-times"></i>
            </a>
        <?php endif; ?>
    </form>

    <?php if(!empty($search) || (isset($status) && !empty($status))): ?>
        <div style="margin-bottom: 1.5rem; padding: 1rem; background: #e3f2fd; border-left: 4px solid #00425A; border-radius: 0.5rem;">
            <p style="color: #00425A; font-size: 0.95rem; margin: 0;">
                <i class="fas fa-info-circle mr-2"></i>
                <?php if(!empty($search) && isset($status) && !empty($status)): ?>
                    Hasil pencarian untuk: <strong><?php echo e($search); ?></strong> dengan status <strong><?php echo e($status === 'active' ? 'Aktif' : 'Tidak Aktif'); ?></strong>
                <?php elseif(!empty($search)): ?>
                    Hasil pencarian untuk: <strong><?php echo e($search); ?></strong>
                <?php else: ?>
                    Menampilkan pengumuman dengan status <strong><?php echo e($status === 'active' ? 'Aktif' : 'Tidak Aktif'); ?></strong>
                <?php endif; ?>
                <?php if(isset($resultCount)): ?>
                    (<?php echo e($resultCount); ?> hasil ditemukan)
                <?php endif; ?>
            </p>
        </div>
    <?php endif; ?>
</div><?php /**PATH C:\Users\Pemustaka\Desktop\Infobase_uppjpds\resources\views/partials/search-form.blade.php ENDPATH**/ ?>