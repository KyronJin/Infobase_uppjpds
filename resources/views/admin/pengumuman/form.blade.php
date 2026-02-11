<form method="POST" action="{{ route('admin.pengumuman.store') }}" enctype="multipart/form-data">
    @csrf

    <div class="mb-4">
        <label class="block text-gray-700 mb-1">Judul</label>
        <input type="text" name="title" required class="w-full border rounded px-3 py-2" value="{{ old('title') }}">
        @error('title')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
    </div>

    <div class="mb-4">
        <label class="block text-gray-700 mb-1">Isi Pengumuman</label>
        <textarea name="description" rows="8" required class="w-full border rounded px-3 py-2">{{ old('description') }}</textarea>
        @error('description')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
    </div>

    <div class="mb-4">
        <label class="block text-gray-700 mb-1">🖼️ Gambar Pengumuman (Opsional)</label>
        <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center cursor-pointer hover:bg-gray-50 hover:border-teal-400 transition-colors" id="dropzone">
            <input type="file" name="image" id="imageInput" class="hidden" accept="image/*" onchange="previewImageWithCropper(event, 'imagePreview', 'cropButton')">
            <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-2 block"></i>
            <p class="text-gray-600 mb-1">Klik atau drag gambar ke sini</p>
            <p class="text-gray-400 text-sm">Maksimal 10 MB (JPEG, PNG) • Bisa di-crop dan edit</p>
            <div id="imagePreview" class="mt-3"></div>
            <div class="mt-4 text-center" style="position: relative; z-index: 10;">
                <button type="button" id="cropButton" onclick="openImageCropper(document.getElementById('imageInput'), document.getElementById('imagePreview'))" class="crop-button-standard" style="display: none;">
                    ✂️ Edit & Crop Gambar
                </button>
            </div>
        </div>
        @error('image')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
    </div>

    <div class="mb-4">
        <label class="block text-gray-700 mb-1">Tanggal Publish</label>
        <input type="datetime-local" name="published_at" class="w-full border rounded px-3 py-2" value="{{ old('published_at') }}">
        @error('published_at')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
    </div>

    <div class="flex justify-end space-x-3">
        <x-button variant="secondary" size="md" type="button" id="cancel-btn">Batal</x-button>
        <x-button variant="primary" size="md" icon="check" type="submit">Buat Pengumuman</x-button>
    </div>
</form>

<script>
// Drag and drop functionality for image input
const dropzone = document.getElementById('dropzone');
const imageInput = document.getElementById('imageInput');
const imagePreview = document.getElementById('imagePreview');
const cropButton = document.getElementById('cropButton');

console.log('Form elements found:', {
    dropzone: !!dropzone,
    imageInput: !!imageInput,
    imagePreview: !!imagePreview,
    cropButton: !!cropButton
});

// Click to upload
dropzone.addEventListener('click', () => imageInput.click());

// File input change event
imageInput.addEventListener('change', function(e) {
    console.log('File input changed:', e.target.files);
    const file = e.target.files[0];
    
    if (file) {
        console.log('File selected:', file.name);
        
        // Show preview
        const reader = new FileReader();
        reader.onload = function(e) {
            const fileSize = (file.size / 1024).toFixed(1);
            
            imagePreview.innerHTML = `
                <div class="bg-green-50 border-2 border-green-200 rounded-lg p-4 mt-3">
                    <img src="${e.target.result}" 
                         alt="Preview gambar" 
                         class="h-32 w-auto rounded-lg border border-green-300 object-cover mx-auto mb-3 shadow-md">
                    <div class="text-sm text-center">
                        <p class="font-bold text-green-800">✓ ${file.name}</p>
                        <p class="text-green-600">📏 ${fileSize} KB • ✅ Siap untuk diedit!</p>
                        <p class="text-xs text-blue-600 mt-1 font-semibold">➡️ Klik tombol "Edit & Crop" di bawah</p>
                    </div>
                </div>
            `;
            
            // Show crop button
            if (cropButton) {
                cropButton.style.display = 'inline-block';
                cropButton.classList.add('animate-bounce');
                setTimeout(() => {
                    cropButton.classList.remove('animate-bounce');
                    cropButton.classList.add('animate-pulse');
                }, 2000);
                console.log('Crop button shown');
            }
        };
        reader.readAsDataURL(file);
    } else {
        imagePreview.innerHTML = '';
        if (cropButton) cropButton.style.display = 'none';
    }
});

// Drag and drop
dropzone.addEventListener('dragover', (e) => {
    e.preventDefault();
    dropzone.style.backgroundColor = '#f3f4f6';
});

dropzone.addEventListener('dragleave', () => {
    dropzone.style.backgroundColor = 'transparent';
});

dropzone.addEventListener('drop', (e) => {
    e.preventDefault();
    dropzone.style.backgroundColor = 'transparent';
    
    const files = e.dataTransfer.files;
    if (files.length > 0) {
        imageInput.files = files;
        // Trigger the cropper preview
        const event = new Event('change', { bubbles: true });
        imageInput.dispatchEvent(event);
    }
});

// Remove image function
function removeImage() {
    imageInput.value = '';
    imagePreview.innerHTML = '';
    imagePreview.style.display = 'none';
    if (cropButton) cropButton.style.display = 'none';
}

// Cancel button
document.getElementById('cancel-btn').addEventListener('click', function() {
    document.getElementById('create-announcement-modal').classList.add('hidden');
});
</script>