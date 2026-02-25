

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
                <strong id="deleteItemName-<?php echo e($id ?? 'deleteModal'); ?>" class="text-red-600 text-lg">item</strong>?
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['variant' => 'secondary','onclick' => 'closeDeleteModal(\''.e($id ?? 'deleteModal').'\')']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'secondary','onclick' => 'closeDeleteModal(\''.e($id ?? 'deleteModal').'\')']); ?>Batal <?php echo $__env->renderComponent(); ?>
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
    // Global delete data store for handling multiple modals
    if (typeof window.deleteDataStore === 'undefined') {
        window.deleteDataStore = {};
    }

    /**
     * Open delete modal dengan konfirmasi
     * @param {string} modalId - ID dari modal element
     * @param {string} itemName - Nama item yang akan dihapus (untuk ditampilkan di modal)
     * @param {string} deleteUrl - URL untuk DELETE request
     * @param {Function} callback - Callback function setelah delete berhasil (optional)
     * @param {Object} formData - Additional form data (optional)
     * @param {string} method - HTTP method, default 'DELETE' (optional)
     */
    function openDeleteModal(modalId, itemName, deleteUrl, callback = null, formData = null, method = 'DELETE') {
        const modal = document.getElementById(modalId);
        if (!modal) {
            console.error(`Modal dengan id "${modalId}" tidak ditemukan`);
            return;
        }

        // Store data for this specific modal
        window.deleteDataStore[modalId] = {
            modalId: modalId,
            url: deleteUrl,
            itemName: itemName,
            callback: callback,
            formData: formData,
            method: method
        };

        // Update modal UI
        const itemNameEl = document.getElementById('deleteItemName-' + modalId);
        if (itemNameEl) {
            itemNameEl.textContent = itemName;
        }
        
        const btnText = document.getElementById('deleteBtnText-' + modalId);
        if (btnText) btnText.textContent = 'Hapus';
        
        const confirmBtn = document.getElementById('confirmDeleteBtn-' + modalId);
        if (confirmBtn) confirmBtn.disabled = false;
        
        modal.classList.remove('hidden');
    }

    /**
     * Close delete modal
     * @param {string} modalId - ID dari modal element yang akan ditutup
     */
    function closeDeleteModal(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.classList.add('hidden');
        }
        // Clean up data
        if (window.deleteDataStore[modalId]) {
            delete window.deleteDataStore[modalId];
        }
    }

    /**
     * Confirm delete action
     * @param {string} modalId - ID dari modal yang melakukan delete
     */
    async function confirmDeleteAction(modalId) {
        const data = window.deleteDataStore[modalId];
        
        if (!data) {
            console.error(`Delete data untuk modal "${modalId}" tidak ditemukan`);
            return;
        }

        if (!data.url) {
            if (typeof window.showErrorToast === 'function') {
                window.showErrorToast('✗ URL delete tidak dikonfigurasi');
            } else {
                alert('URL delete tidak dikonfigurasi');
            }
            return;
        }

        const confirmBtn = document.getElementById('confirmDeleteBtn-' + modalId);
        const btn = confirmBtn;
        const originalText = btn.innerHTML;
        btn.disabled = true;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> <span>Menghapus...</span>';

        try {
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
            
            const requestOptions = {
                method: data.method || 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            };

            // Add body if POST or if formData exists
            if ((data.method === 'POST' || data.method === 'PUT') && data.formData) {
                requestOptions.body = JSON.stringify(data.formData);
            }

            const response = await fetch(data.url, requestOptions);
            const responseData = await response.json();

            if (response.ok && responseData.success) {
                // Show success toast
                if (typeof window.showSuccessToast === 'function') {
                    window.showSuccessToast(`✓ ${data.itemName} berhasil dihapus!`);
                } else {
                    alert(`${data.itemName} berhasil dihapus!`);
                }
                
                // Close modal
                closeDeleteModal(modalId);
                
                // Execute callback or reload
                if (typeof data.callback === 'function') {
                    data.callback();
                } else {
                    // Default: reload page after 1.5 seconds
                    setTimeout(() => window.location.reload(), 1500);
                }
            } else {
                const errorMsg = responseData.message || 'Kesalahan tidak diketahui';
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
                alert('Terjadi kesalahan saat menghapus data: ' + error.message);
            }
            btn.innerHTML = originalText;
            btn.disabled = false;
        }
    }

    // Setup event listeners
    function initDeleteConfirmButton() {
        const modalId = '<?php echo e($id ?? "deleteModal"); ?>';
        const confirmBtn = document.getElementById('confirmDeleteBtn-' + modalId);
        if (!confirmBtn) return;

        // Attach click handler
        confirmBtn.addEventListener('click', function() {
            confirmDeleteAction(modalId);
        });

        // Setup click outside to close modal
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.addEventListener('click', function(e) {
                if (e.target === this) {
                    closeDeleteModal(modalId);
                }
            });
        }
    }

    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initDeleteConfirmButton);
    } else {
        initDeleteConfirmButton();
    }
</script>
<?php /**PATH C:\Users\Pemustaka\Desktop\Infobase_uppjpds\resources\views/components/delete-modal.blade.php ENDPATH**/ ?>