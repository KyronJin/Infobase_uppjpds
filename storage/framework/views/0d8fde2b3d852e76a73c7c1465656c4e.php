

<div id="<?php echo e($id ?? 'deleteModal'); ?>" class="fixed inset-0 backdrop-blur-sm bg-black/40 hidden z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md p-8 transform transition-all">
        <!-- Icon -->
        <div class="flex justify-center mb-6">
            <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center">
                <i class="fas fa-exclamation-triangle text-red-600 text-3xl"></i>
            </div>
        </div>
        
        <!-- Title -->
        <h3 class="text-2xl font-bold text-center text-gray-900 mb-2"><?php echo e($title ?? 'Hapus Item?'); ?></h3>
        
        <!-- Content -->
        <div class="bg-red-50 border-l-4 border-red-500 rounded-lg p-4 mb-6">
            <p class="text-gray-700 text-center">
                Yakin ingin menghapus <br>
                <strong id="deleteItemName" class="text-red-600 text-lg">item</strong>?
            </p>
            <p class="text-sm text-gray-500 text-center mt-2">
                <i class="fas fa-info-circle mr-1"></i>
                Tindakan ini tidak dapat dibatalkan
            </p>
        </div>
        
        <!-- Buttons -->
        <div class="flex gap-2 justify-center pt-2">
            <?php if (isset($component)) { $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['variant' => 'secondary','onclick' => 'closeDeleteModal()']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'secondary','onclick' => 'closeDeleteModal()']); ?>Batal <?php echo $__env->renderComponent(); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['variant' => 'danger','id' => 'confirmDeleteBtn-'.e($id ?? 'deleteModal').'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'danger','id' => 'confirmDeleteBtn-'.e($id ?? 'deleteModal').'']); ?><span id="deleteBtnText-<?php echo e($id ?? 'deleteModal'); ?>">Hapus</span> <?php echo $__env->renderComponent(); ?>
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

<script>
    // Initialize global deleteData if not exists
    if (typeof window.deleteData === 'undefined') {
        window.deleteData = {
            modalId: '<?php echo e($id ?? "deleteModal"); ?>',
            url: '',
            itemName: '',
            callback: null
        };
    }

    function openDeleteModal(modalId, itemName, deleteUrl, callback = null) {
        const modal = document.getElementById(modalId);
        if (!modal) {
            console.error(`Modal dengan id "${modalId}" tidak ditemukan`);
            return;
        }

        window.deleteData.modalId = modalId;
        window.deleteData.url = deleteUrl;
        window.deleteData.itemName = itemName;
        window.deleteData.callback = callback;

        const itemNameEl = document.getElementById('deleteItemName');
        if (itemNameEl) itemNameEl.textContent = itemName;
        
        const btnText = document.getElementById('deleteBtnText-' + modalId);
        if (btnText) btnText.textContent = 'Hapus';
        
        const confirmBtn = document.getElementById('confirmDeleteBtn-' + modalId);
        if (confirmBtn) confirmBtn.disabled = false;
        
        modal.classList.remove('hidden');
    }

    function closeDeleteModal() {
        const modal = document.getElementById(window.deleteData.modalId);
        if (modal) {
            modal.classList.add('hidden');
        }
    }

    // Close modal when clicking outside
    function setupDeleteModalClickOutside(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.addEventListener('click', function(e) {
                if (e.target === this) {
                    window.deleteData.modalId = modalId;
                    closeDeleteModal();
                }
            });
        }
    }

    // Wait for DOM to fully load
    function initDeleteConfirmButton() {
        const modalId = '<?php echo e($id ?? "deleteModal"); ?>';
        const confirmBtn = document.getElementById('confirmDeleteBtn-' + modalId);
        if (!confirmBtn) return;

        confirmBtn.addEventListener('click', async function() {
            if (!window.deleteData.url) {
                alert('URL delete tidak dikonfigurasi');
                return;
            }

            const btn = this;
            const originalText = btn.innerHTML;
            btn.disabled = true;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> <span>Menghapus...</span>';

            try {
                const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
                const modalId = '<?php echo e($id ?? "deleteModal"); ?>';
                
                const response = await fetch(window.deleteData.url, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    }
                });

                const data = await response.json();

                if (response.ok && data.success) {
                    // Ensure global toast functions are available
                    if (typeof window.showSuccessToast === 'function') {
                        window.showSuccessToast(`✓ ${window.deleteData.itemName} berhasil dihapus!`);
                    } else {
                        console.log('Toast function not ready, using alert:', window.deleteData.itemName);
                        alert(`${window.deleteData.itemName} berhasil dihapus!`);
                    }
                    
                    closeDeleteModal();
                    
                    // Call callback if provided
                    if (typeof window.deleteData.callback === 'function') {
                        window.deleteData.callback();
                    } else {
                        // Default: reload page after 1.5 seconds
                        setTimeout(() => window.location.reload(), 1500);
                    }
                } else {
                    const errorMsg = data.message || 'Kesalahan tidak diketahui';
                    if (typeof window.showErrorToast === 'function') {
                        window.showErrorToast(`✗ Gagal menghapus: ${errorMsg}`);
                    } else {
                        alert(`Gagal menghapus: ${errorMsg}`);
                    }
                    btn.innerHTML = originalText;
                    btn.disabled = false;
                }
            } catch (error) {
                console.error('Delete error:', error);
                if (typeof window.showErrorToast === 'function') {
                    window.showErrorToast('✗ Terjadi kesalahan saat menghapus data');
                } else {
                    alert('Terjadi kesalahan saat menghapus data');
                }
                btn.innerHTML = originalText;
                btn.disabled = false;
            }
        });
    }

    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initDeleteConfirmButton);
    } else {
        initDeleteConfirmButton();
    }

    // Setup click outside for modal
    try {
        setupDeleteModalClickOutside('<?php echo e($id ?? "deleteModal"); ?>');
    } catch(e) {
        console.warn('Could not setup click outside:', e);
    }
</script>
<?php /**PATH C:\Users\Pemustaka\Desktop\Infobase_uppjpds\resources\views/components/delete-modal.blade.php ENDPATH**/ ?>