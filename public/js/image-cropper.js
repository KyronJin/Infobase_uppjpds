/**
 * 🖼️ Advanced Image Cropper
 * Features: Crop, Rotate, Flip, Zoom, Quality Control, Multiple Format Export
 * Dependencies: Cropper.js
 */

class ImageCropper {
    constructor() {
        this.cropper = null;
        this.originalFile = null;
        this.targetInput = null;
        this.targetPreview = null;
        this.quality = 0.8;
        this.scaleX = 1;
        this.scaleY = 1;
        this.init();
    }

    init() {
        this.loadCropperCSS();
        this.loadCropperJS(() => {
            this.bindEvents();
        });
    }

    loadCropperCSS() {
        if (!document.querySelector('#cropper-css')) {
            const link = document.createElement('link');
            link.id = 'cropper-css';
            link.rel = 'stylesheet';
            link.href = 'https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css';
            document.head.appendChild(link);
        }
    }

    loadCropperJS(callback) {
        if (window.Cropper) {
            callback();
            return;
        }

        const script = document.createElement('script');
        script.src = 'https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js';
        script.onload = callback;
        document.head.appendChild(script);
    }

    bindEvents() {
        // Modal controls
        document.getElementById('close-cropper-btn').addEventListener('click', () => this.closeCropper());
        document.getElementById('cancel-crop-btn').addEventListener('click', () => this.closeCropper());
        document.getElementById('apply-crop-btn').addEventListener('click', () => this.applyCrop());

        // Aspect ratio buttons
        document.querySelectorAll('.aspect-ratio-btn').forEach(btn => {
            btn.addEventListener('click', (e) => this.setAspectRatio(e.target.dataset.ratio));
        });

        // Transform controls
        document.getElementById('rotate-left').addEventListener('click', () => this.cropper?.rotate(-90));
        document.getElementById('rotate-right').addEventListener('click', () => this.cropper?.rotate(90));
        document.getElementById('flip-horizontal').addEventListener('click', () => this.flipHorizontal());
        document.getElementById('flip-vertical').addEventListener('click', () => this.flipVertical());
        document.getElementById('zoom-in').addEventListener('click', () => this.cropper?.zoom(0.1));
        document.getElementById('zoom-out').addEventListener('click', () => this.cropper?.zoom(-0.1));
        document.getElementById('reset-crop').addEventListener('click', () => this.resetCrop());

        // Quality slider
        const qualitySlider = document.getElementById('quality-slider');
        qualitySlider.addEventListener('input', (e) => {
            this.quality = parseFloat(e.target.value);
            // Update display
            const label = document.getElementById('quality-label');
            if (label) label.textContent = `⚡ Quality (${this.quality})`;
        });

        // Close modal on outside click
        document.getElementById('image-cropper-modal').addEventListener('click', (e) => {
            if (e.target.id === 'image-cropper-modal') {
                this.closeCropper();
            }
        });

        // ESC key to close
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && !document.getElementById('image-cropper-modal').classList.contains('hidden')) {
                this.closeCropper();
            }
        });
    }

    openCropper(file, targetInput, targetPreview = null) {
        this.originalFile = file;
        this.targetInput = targetInput;
        this.targetPreview = targetPreview;

        const reader = new FileReader();
        reader.onload = (e) => {
            const imageElement = document.getElementById('cropper-image');
            imageElement.src = e.target.result;

            // Show modal
            document.getElementById('image-cropper-modal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';

            // Show welcome message
            this.showNotification('Gambar berhasil dimuat! Silakan edit sesuai kebutuhan', 'info', 4000);

            // Initialize cropper after modal is shown
            setTimeout(() => {
                if (this.cropper) {
                    this.cropper.destroy();
                }

                this.cropper = new Cropper(imageElement, {
                    aspectRatio: NaN, // Free aspect ratio by default
                    viewMode: 1,
                    dragMode: 'move',
                    autoCropArea: 0.8,
                    restore: false,
                    guides: true,
                    center: true,
                    highlight: true,
                    cropBoxMovable: true,
                    cropBoxResizable: true,
                    toggleDragModeOnDblclick: true,
                    responsive: true,
                    background: false,
                    modal: true,
                });

                // Reset transform values
                this.scaleX = 1;
                this.scaleY = 1;
                
                // Show tutorial after cropper is ready
                setTimeout(() => {
                    this.showTutorial();
                }, 1000);
            }, 100);
        };

        reader.readAsDataURL(file);
    }

    setAspectRatio(ratio) {
        // Update button states
        document.querySelectorAll('.aspect-ratio-btn').forEach(btn => {
            btn.classList.remove('bg-teal-100', 'text-teal-700', 'border-teal-300');
            btn.classList.add('border-gray-300');
        });

        const activeBtn = document.querySelector(`[data-ratio="${ratio}"]`);
        if (activeBtn) {
            activeBtn.classList.remove('border-gray-300');
            activeBtn.classList.add('bg-teal-100', 'text-teal-700', 'border-teal-300');
        }

        if (!this.cropper) return;

        if (ratio === 'free') {
            this.cropper.setAspectRatio(NaN);
        } else {
            const [width, height] = ratio.split('/').map(Number);
            this.cropper.setAspectRatio(width / height);
        }
    }

    flipHorizontal() {
        this.scaleX = -this.scaleX;
        this.cropper?.scaleX(this.scaleX);
    }

    flipVertical() {
        this.scaleY = -this.scaleY;
        this.cropper?.scaleY(this.scaleY);
    }

    resetCrop() {
        if (!this.cropper) return;
        
        this.cropper.reset();
        this.scaleX = 1;
        this.scaleY = 1;
        
        // Reset aspect ratio to free
        this.setAspectRatio('free');
        
        // Reset quality
        this.quality = 0.8;
        document.getElementById('quality-slider').value = 0.8;
        const label = document.getElementById('quality-label');
        if (label) label.textContent = `⚡ Quality (${this.quality})`;
    }

    showTutorial() {
        const steps = [
            { message: 'Drag sudut kotak untuk crop area yang diinginkan', delay: 0 },
            { message: 'Pilih aspect ratio di bawah jika diperlukan', delay: 2000 },
            { message: 'Gunakan tombol rotate dan flip untuk edit lanjutan', delay: 4000 },
            { message: 'Klik "Terapkan Edit" jika sudah sesuai', delay: 6000 }
        ];

        steps.forEach(step => {
            setTimeout(() => {
                this.showNotification(step.message, 'info', 2000);
            }, step.delay);
        });
    }

    applyCrop() {
        if (!this.cropper) return;

        const canvas = this.cropper.getCroppedCanvas({
            maxWidth: 2048,
            maxHeight: 2048,
            imageSmoothingEnabled: true,
            imageSmoothingQuality: 'high',
        });

        const format = document.getElementById('output-format').value;

        canvas.toBlob((blob) => {
            // Show processing notification
            this.showNotification('Memproses gambar...', 'info', 1000);
            
            // Create new file
            const fileName = this.originalFile.name.replace(/\.[^/.]+$/, '') + 
                           (format === 'image/png' ? '.png' : '.jpg');
            const croppedFile = new File([blob], fileName, { type: format });

            // Update target input
            const dt = new DataTransfer();
            dt.items.add(croppedFile);
            this.targetInput.files = dt.files;

            // Trigger change event
            const event = new Event('change', { bubbles: true });
            this.targetInput.dispatchEvent(event);

            // Update preview if provided
            if (this.targetPreview) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    if (this.targetPreview.tagName === 'IMG') {
                        this.targetPreview.src = e.target.result;
                        this.targetPreview.style.display = 'block';
                    } else {
                        this.targetPreview.innerHTML = `
                            <div class="text-center">
                                <img src="${e.target.result}" 
                                     alt="Hasil edit gambar" 
                                     class="h-32 w-auto rounded-lg border-2 border-green-300 object-cover mx-auto shadow-lg">
                                <p class="text-xs text-green-600 font-semibold mt-2">✅ Gambar berhasil diedit!</p>
                            </div>
                        `;
                        this.targetPreview.style.display = 'block';
                    }
                };
                reader.readAsDataURL(croppedFile);
            }

            // Show success message with file info
            const fileSize = (croppedFile.size / 1024).toFixed(1);
            this.showNotification(`Gambar berhasil diedit! (${fileSize}KB)`, 'success', 4000);

            this.closeCropper();
        }, format, this.quality);
    }

    closeCropper() {
        if (this.cropper) {
            this.cropper.destroy();
            this.cropper = null;
        }

        document.getElementById('image-cropper-modal').classList.add('hidden');
        document.body.style.overflow = '';
        
        // Reset form
        this.resetCrop();
    }

    showNotification(message, type = 'info', duration = 3000) {
        // Create notification
        const notification = document.createElement('div');
        notification.className = `fixed top-4 right-4 z-[10000] px-6 py-4 rounded-lg shadow-xl text-white font-semibold transform transition-all duration-500 translate-x-full max-w-sm ${
            type === 'success' ? 'bg-gradient-to-r from-green-500 to-green-600' : 
            type === 'error' ? 'bg-gradient-to-r from-red-500 to-red-600' : 
            type === 'info' ? 'bg-gradient-to-r from-blue-500 to-blue-600' :
            'bg-gradient-to-r from-purple-500 to-purple-600'
        }`;
        
        // Add icon based on type
        const icon = type === 'success' ? '✅' : 
                    type === 'error' ? '❌' : 
                    type === 'info' ? '📝' : '💬';
        
        notification.innerHTML = `
            <div class="flex items-center">
                <span class="text-lg mr-2">${icon}</span>
                <div>
                    <div class="font-bold text-sm">${type.charAt(0).toUpperCase() + type.slice(1)}</div>
                    <div class="text-xs opacity-90">${message}</div>
                </div>
            </div>
        `;

        document.body.appendChild(notification);

        // Animate in
        setTimeout(() => notification.classList.remove('translate-x-full'), 100);

        // Remove after duration
        setTimeout(() => {
            notification.classList.add('translate-x-full');
            setTimeout(() => notification.remove(), 500);
        }, duration);
    }
}

// Initialize global cropper instance
window.imageCropper = new ImageCropper();

// Helper function to open cropper
window.openImageCropper = function(inputElement, previewElement = null) {
    if (!inputElement.files || !inputElement.files[0]) {
        window.imageCropper.showNotification('Pilih gambar terlebih dahulu!', 'error', 3000);
        return;
    }

    const file = inputElement.files[0];
    
    // Validate file type
    if (!file.type.startsWith('image/')) {
        window.imageCropper.showNotification('File harus berupa gambar! (JPEG, PNG, GIF)', 'error', 4000);
        return;
    }

    // Validate file size (max 10MB)
    if (file.size > 10 * 1024 * 1024) {
        const fileSize = (file.size / 1024 / 1024).toFixed(1);
        window.imageCropper.showNotification(`File terlalu besar (${fileSize}MB)! Maksimal 10MB`, 'error', 4000);
        return;
    }

    // Show loading
    window.imageCropper.showNotification('Memuat editor gambar...', 'info', 2000);
    
    setTimeout(() => {
        window.imageCropper.openCropper(file, inputElement, previewElement);
    }, 500);
};

// Enhanced preview function with crop button
window.previewImageWithCropper = function(event, previewId, cropButtonId = null) {
    const file = event.target.files[0];
    const preview = document.getElementById(previewId);
    const cropButton = cropButtonId ? document.getElementById(cropButtonId) : null;

    console.log('Preview function called:', { file: !!file, preview: !!preview, cropButton: !!cropButton });

    if (file) {
        // Validate file
        if (!file.type.startsWith('image/')) {
            alert('File harus berupa gambar!');
            return;
        }

        // Show loading state
        if (preview) {
            preview.innerHTML = `
                <div class="text-center py-4">
                    <div class="inline-block animate-spin rounded-full h-8 w-8 border-b-2 border-teal-600 mb-2"></div>
                    <p class="text-sm text-gray-600">Memuat preview...</p>
                </div>
            `;
            preview.style.display = 'block';
        }

        const reader = new FileReader();
        reader.onload = function(e) {
            const fileSize = (file.size / 1024).toFixed(1);
            const fileName = file.name;
            
            if (preview.tagName === 'IMG') {
                preview.src = e.target.result;
                preview.style.display = 'block';
            } else {
                preview.innerHTML = `
                    <div class="text-center bg-green-50 border border-green-200 rounded-lg p-4">
                        <img src="${e.target.result}" 
                             alt="Preview gambar" 
                             class="h-24 w-auto rounded border border-green-300 object-cover mx-auto mb-2">
                        <div class="text-xs text-green-700">
                            <p class="font-semibold">${fileName}</p>
                            <p>📏 ${fileSize} KB • ✅ Siap untuk diedit</p>
                            <p class="text-blue-600 font-bold mt-1">➡️ Klik tombol biru di bawah untuk edit!</p>
                        </div>
                    </div>
                `;
                preview.style.display = 'block';
            }

            // Show crop button with enhanced visibility
            if (cropButton) {
                cropButton.style.display = 'inline-flex';
                cropButton.style.pointerEvents = 'auto';
                cropButton.style.position = 'relative';
                cropButton.style.zIndex = '100';
                
                // Remove any existing animations and add show class
                cropButton.classList.remove('animate-pulse');
                cropButton.classList.add('show');
                
                // Make button more visible
                setTimeout(() => {
                    cropButton.classList.remove('show');
                    cropButton.classList.add('animate-pulse');
                }, 1000);
                
                console.log('Crop button activated successfully');
                
                // Show instruction notification
                if (window.imageCropper && typeof window.imageCropper.showNotification === 'function') {
                    window.imageCropper.showNotification('📸 Gambar siap! Klik tombol BIRU untuk mulai editing', 'info', 5000);
                }
            } else {
                console.error('Crop button not found:', cropButtonId);
            }
        };
        
        reader.onerror = function() {
            alert('Gagal membaca file gambar!');
        };
        
        reader.readAsDataURL(file);
    } else {
        if (preview) preview.style.display = 'none';
        if (cropButton) {
            cropButton.style.display = 'none';
            cropButton.classList.remove('animate-pulse', 'show');
        }
    }
};
};

console.log('🖼️ Advanced Image Cropper loaded successfully!');