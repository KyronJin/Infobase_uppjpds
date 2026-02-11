

<?php $__env->startSection('content'); ?>
<div class="container mx-auto px-4 py-8">
    <div class="mb-8 flex justify-between items-start">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Edit Foto Galeri</h1>
            <p class="text-gray-600 mt-2">Edit foto: <span class="font-semibold"><?php echo e($gallery->title); ?></span></p>
        </div>
        <a href="<?php echo e(route('admin.gallery.index')); ?>" class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-3 px-6 rounded-lg transition duration-300">
            <i class="fas fa-arrow-left mr-2"></i>Kembali
        </a>
    </div>

    <?php if($errors->any()): ?>
        <div class="mb-6 p-4 bg-red-100 text-red-800 rounded-lg border border-red-300">
            <h3 class="font-semibold mb-2">Ada kesalahan:</h3>
            <ul class="list-disc list-inside">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <div class="bg-white rounded-lg shadow-lg p-8">
        <form action="<?php echo e(route('admin.gallery.update', $gallery)); ?>" method="POST" enctype="multipart/form-data" class="space-y-6">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <!-- Kategori -->
            <div>
                <label for="category" class="block text-sm font-semibold text-gray-700 mb-2">Kategori <span class="text-red-600">*</span></label>
                <select 
                    name="category" 
                    id="category"
                    required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition duration-200"
                >
                    <option value="">-- Pilih Kategori --</option>
                    <option value="building" <?php echo e(old('category', $gallery->category) === 'building' ? 'selected' : ''); ?>>Gedung</option>
                    <option value="interior" <?php echo e(old('category', $gallery->category) === 'interior' ? 'selected' : ''); ?>>Interior</option>
                    <option value="collection" <?php echo e(old('category', $gallery->category) === 'collection' ? 'selected' : ''); ?>>Koleksi</option>
                    <option value="service" <?php echo e(old('category', $gallery->category) === 'service' ? 'selected' : ''); ?>>Layanan</option>
                    <option value="facility" <?php echo e(old('category', $gallery->category) === 'facility' ? 'selected' : ''); ?>>Fasilitas</option>
                    <option value="activity" <?php echo e(old('category', $gallery->category) === 'activity' ? 'selected' : ''); ?>>Aktivitas</option>
                </select>
            </div>

            <!-- Lokasi Tampilan -->
            <div>
                <label for="location" class="block text-sm font-semibold text-gray-700 mb-2">Lokasi Tampilan <span class="text-red-600">*</span></label>
                <select 
                    name="location" 
                    id="location"
                    required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition duration-200"
                    onchange="toggleFormFields(); updateResolutionInfo()"
                >
                    <option value="">-- Pilih Lokasi --</option>
                    <option value="home" <?php echo e(old('location', $gallery->location) === 'home' ? 'selected' : ''); ?>>Halaman Beranda</option>
                    <option value="about" <?php echo e(old('location', $gallery->location) === 'about' ? 'selected' : ''); ?>>Halaman Tentang</option>
                    <option value="hero" <?php echo e(old('location', $gallery->location) === 'hero' ? 'selected' : ''); ?>>Hero Banner Beranda</option>
                    <option value="both" <?php echo e(old('location', $gallery->location) === 'both' ? 'selected' : ''); ?>>Kedua Halaman</option>
                </select>
            </div>

            <!-- Rekomendasi Rasio Foto -->
            <div id="resolutionInfo" class="p-4 bg-blue-50 border border-blue-200 rounded-lg hidden">
                <div class="flex items-start gap-3">
                    <i class="fas fa-info-circle text-blue-600 mt-1 flex-shrink-0"></i>
                    <div>
                        <h4 class="font-semibold text-blue-900 mb-2">Rekomendasi Ukuran Foto</h4>
                        <p id="resolutionText" class="text-sm text-blue-800"></p>
                    </div>
                </div>
            </div>

            <!-- Text Fields (hidden for hero banner) -->
            <div id="textFields" style="display: <?php echo e(old('location', $gallery->location) === 'hero' ? 'none' : 'block'); ?>;">
                <!-- Judul -->
                <div>
                    <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">Judul Foto <span class="text-red-600">*</span></label>
                    <input 
                        type="text" 
                        name="title" 
                        id="title" 
                        value="<?php echo e(old('title', $gallery->title)); ?>"
                        <?php echo e(old('location', $gallery->location) === 'hero' ? '' : 'required'); ?>

                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition duration-200"
                        placeholder="Judul foto galeri"
                    >
                </div>

                <!-- Deskripsi -->
                <div class="mt-6">
                    <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi</label>
                    <textarea 
                        name="description" 
                        id="description" 
                        rows="4"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition duration-200"
                        placeholder="Deskripsi foto"
                    ><?php echo e(old('description', $gallery->description)); ?></textarea>
                </div>
            </div>

            <!-- Foto Saat Ini -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Foto Saat Ini</label>
                <div class="relative w-48 h-48 rounded-lg overflow-hidden bg-gray-100 border border-gray-300">
                    <img src="<?php echo e(asset($gallery->image_path)); ?>" alt="<?php echo e($gallery->title); ?>" class="w-full h-full object-cover">
                </div>
            </div>

            <!-- Upload Foto Baru -->
            <div>
                <label for="image" class="block text-sm font-semibold text-gray-700 mb-2">Ganti Foto (Opsional)</label>
                <div class="relative border-2 border-dashed border-gray-300 rounded-lg p-8 text-center hover:border-blue-500 hover:bg-blue-50 transition duration-200 cursor-pointer"
                    onclick="document.getElementById('image').click()">
                    <input 
                        type="file" 
                        name="image" 
                        id="image" 
                        accept="image/*"
                        class="hidden"
                        onchange="handleImageChange(event)"
                    >
                    <div id="imagePreview" class="hidden">
                        <img id="previewImg" src="" alt="Preview" class="max-h-64 mx-auto rounded-lg mb-4">
                        <p id="fileName" class="text-sm text-gray-600"></p>
                    </div>
                    <div id="placeholder">
                        <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-2 block"></i>
                        <p class="text-gray-500">Klik atau drag-drop foto baru di sini</p>
                        <p class="text-sm text-gray-400 mt-1">Format: JPG, PNG, GIF, WebP (Max 5MB)</p>
                    </div>
                </div>
            </div>

            <!-- Urutan -->
            <div>
                <label for="order" class="block text-sm font-semibold text-gray-700 mb-2">Urutan Tampilan</label>
                <input 
                    type="number" 
                    name="order" 
                    id="order" 
                    value="<?php echo e(old('order', $gallery->order)); ?>"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition duration-200"
                    placeholder="0"
                    min="0"
                    onchange="checkOrderExists()"
                    onkeyup="checkOrderExists()"
                >
                <!-- Warning jika urutan sudah ada -->
                <div id="orderWarning" class="mt-2 p-3 bg-yellow-50 border border-yellow-200 rounded-lg hidden">
                    <div class="flex items-start gap-2">
                        <i class="fas fa-exclamation-triangle text-yellow-600 mt-1"></i>
                        <p class="text-sm text-yellow-800"><strong>Perhatian!</strong> Ada foto lain pada urutan ini. Foto akan ditambahkan dan urutan lain akan bergeser otomatis.</p>
                    </div>
                </div>
            </div>

            <!-- Status Aktif -->
            <div>
                <label class="flex items-center cursor-pointer">
                    <input 
                        type="checkbox" 
                        name="is_active" 
                        <?php echo e(old('is_active', $gallery->is_active) ? 'checked' : ''); ?>

                        class="w-5 h-5 text-blue-600 rounded border-gray-300 focus:ring-2 focus:ring-blue-200"
                    >
                    <span class="ml-3 text-sm font-medium text-gray-700">Aktif</span>
                </label>
            </div>

            <!-- Button Text & Link (hidden for non-hero banner) -->
            <div id="buttonFields" style="display: <?php echo e(old('location', $gallery->location) === 'hero' ? 'block' : 'none'); ?>;">
                <div class="mb-4">
                    <label for="button_text" class="block text-sm font-semibold text-gray-700 mb-2">Teks Tombol</label>
                    <input 
                        type="text" 
                        name="button_text" 
                        id="button_text" 
                        value="<?php echo e(old('button_text', $gallery->button_text)); ?>"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition duration-200"
                        placeholder="Contoh: Jelajahi, Lihat Detail, dll"
                    >
                </div>
                <div>
                    <label for="button_link" class="block text-sm font-semibold text-gray-700 mb-2">Link Tombol</label>
                    <input 
                        type="text" 
                        name="button_link" 
                        id="button_link" 
                        value="<?php echo e(old('button_link', $gallery->button_link)); ?>"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition duration-200"
                        placeholder="Contoh: #announcements, /about, dll"
                    >
                </div>
            </div>

            <!-- Tombol -->
            <div class="flex gap-4 pt-6 border-t">
                <?php if (isset($component)) { $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['variant' => 'secondary','size' => 'lg','type' => 'link','href' => ''.e(route('admin.gallery.index')).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'secondary','size' => 'lg','type' => 'link','href' => ''.e(route('admin.gallery.index')).'']); ?>Batal <?php echo $__env->renderComponent(); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['variant' => 'primary','size' => 'lg','type' => 'submit','icon' => 'save']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'primary','size' => 'lg','type' => 'submit','icon' => 'save']); ?>Simpan Perubahan <?php echo $__env->renderComponent(); ?>
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
function handleImageChange(event) {
    const file = event.target.files[0];
    if (!file) return;

    const reader = new FileReader();
    reader.onload = function(e) {
        document.getElementById('previewImg').src = e.target.result;
        document.getElementById('fileName').textContent = file.name + ' (' + (file.size / 1024 / 1024).toFixed(2) + ' MB)';
        document.getElementById('placeholder').classList.add('hidden');
        document.getElementById('imagePreview').classList.remove('hidden');
    };
    reader.readAsDataURL(file);
}

// Show/hide fields based on location selection
function toggleFormFields() {
    const locationSelect = document.getElementById('location');
    const textFields = document.getElementById('textFields');
    const buttonFields = document.getElementById('buttonFields');
    const isHero = locationSelect.value === 'hero';
    
    // Sembunyikan text fields jika hero banner
    textFields.style.display = isHero ? 'none' : 'block';
    
    // Tampilkan button fields jika hero banner
    buttonFields.style.display = isHero ? 'block' : 'none';
    
    // Update required attribute pada title untuk hero banner
    const titleInput = document.getElementById('title');
    titleInput.required = !isHero;
}

// Event listener untuk location change
document.getElementById('location').addEventListener('change', toggleFormFields);

// Function untuk update rekomendasi rasio berdasarkan lokasi
function updateResolutionInfo() {
    const locationSelect = document.getElementById('location');
    const resolutionInfo = document.getElementById('resolutionInfo');
    const resolutionText = document.getElementById('resolutionText');
    const selectedLocation = locationSelect.value;

    const resolutionData = {
        'hero': {
            title: '🖼️ Hero Banner Beranda',
            recommendations: [
                '<strong>Rasio Ideal: 16:9 (landscape panjang)</strong>',
                'Ukuran: Minimum 1920x1080px (1920x1440px lebih baik)',
                'Foto akan full-screen dan background bisa diganti otomatis',
                'Teks tetap di tengah, jadi pastikan subjek foto tidak terlalu detail'
            ]
        },
        'home': {
            title: '🏠 Halaman Beranda (Gallery)',
            recommendations: [
                '<strong>Rasio Ideal: 3:2 atau 4:3</strong>',
                'Ukuran: Minimum 1200x800px',
                'Foto akan ditampilkan dalam grid card',
                'Pastikan ada focal point yang menarik di tengah'
            ]
        },
        'about': {
            title: 'ℹ️ Halaman Tentang (Gallery)',
            recommendations: [
                '<strong>Rasio Ideal: 3:2 atau 4:3</strong>',
                'Ukuran: Minimum 1200x800px',
                'Foto akan ditampilkan dalam grid card di halaman about',
                'Gunakan foto yang menunjukkan karakteristik perpustakaan'
            ]
        },
        'both': {
            title: '📸 Kedua Halaman',
            recommendations: [
                '<strong>Rasio Ideal: 16:9 atau 4:3 (square-ish lebih aman)</strong>',
                'Ukuran: Minimum 1920x1080px',
                'Akan tampil di halaman beranda maupun halaman tentang',
                'Pastikan foto bagus di berbagai ukuran layar'
            ]
        }
    };

    if (selectedLocation && resolutionData[selectedLocation]) {
        const data = resolutionData[selectedLocation];
        resolutionInfo.classList.remove('hidden');
        
        let html = '<strong class="text-blue-900">' + data.title + '</strong><br/>';
        data.recommendations.forEach(rec => {
            html += '• ' + rec + '<br/>';
        });
        
        resolutionText.innerHTML = html;
    } else {
        resolutionInfo.classList.add('hidden');
    }
}

// Check if order already exists for selected location
function checkOrderExists() {
    const location = document.getElementById('location').value;
    const order = document.getElementById('order').value;
    const orderWarning = document.getElementById('orderWarning');
    
    if (!location || !order) {
        orderWarning.classList.add('hidden');
        return;
    }
    
    // For now, show warning if order is filled
    // TODO: Add AJAX to check against database
    orderWarning.classList.remove('hidden');
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    toggleFormFields();
    updateResolutionInfo();
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Pemustaka\Desktop\Infobase_uppjpds\resources\views/admin/gallery/edit.blade.php ENDPATH**/ ?>