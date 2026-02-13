<div id="editModal" class="fixed inset-0 backdrop-blur-sm bg-white/30 hidden z-50 flex items-center justify-center">
    <div class="bg-white rounded-lg max-w-lg w-full max-h-[90vh] overflow-y-auto shadow-lg">
        <div class="flex items-center justify-between px-6 py-4 border-b sticky top-0 bg-white">
            <h2 class="text-xl font-bold text-gray-900">Edit Profile Ruangan</h2>
            <button type="button" onclick="closeEditModal()" class="text-gray-500 hover:text-gray-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <div id="editModalErrors" class="hidden mx-6 mt-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded"></div>

        <form id="editForm" method="POST" onsubmit="submitEditForm(event)" enctype="multipart/form-data" class="px-6 py-4 space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-gray-700 font-semibold mb-2">Nama Ruangan <span class="text-red-500">*</span></label>
                <input type="text" id="room_name" name="room_name" required class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500">
            </div>
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Lantai</label>
                <input type="number" id="floor" name="floor" min="1" max="7" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500">
            </div>
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Kapasitas</label>
                <input type="number" id="capacity" name="capacity" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500">
            </div>
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Deskripsi</label>
                <textarea id="description" name="description" rows="4" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500"></textarea>
            </div>
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Gambar Ruangan (Maksimal 3)</label>
                <div class="grid grid-cols-3 gap-4 mt-2">
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center cursor-pointer hover:border-teal-400 transition" onclick="document.getElementById('slot-1-input').click()">
                        <div id="slot-1-preview" class="hidden">
                            <img id="slot-1-img" src="" alt="Slot 1" class="w-full h-32 object-cover rounded mb-2">
                            <button type="button" class="text-xs bg-orange-600 text-white px-3 py-1 rounded w-full hover:bg-orange-700 transition">Ubah</button>
                        </div>
                        <div id="slot-1-empty" class="flex flex-col items-center justify-center h-32">
                            <svg class="w-8 h-8 text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            <p class="text-sm font-semibold text-gray-700">Gambar 1</p>
                        </div>
                        <input type="file" id="slot-1-input" name="slot_1_image" accept="image/*" class="hidden" onchange="previewSlotImage(1, this)">
                    </div>

                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center cursor-pointer hover:border-teal-400 transition" onclick="document.getElementById('slot-2-input').click()">
                        <div id="slot-2-preview" class="hidden">
                            <img id="slot-2-img" src="" alt="Slot 2" class="w-full h-32 object-cover rounded mb-2">
                            <button type="button" class="text-xs bg-orange-600 text-white px-3 py-1 rounded w-full hover:bg-orange-700 transition">Ubah</button>
                        </div>
                        <div id="slot-2-empty" class="flex flex-col items-center justify-center h-32">
                            <svg class="w-8 h-8 text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            <p class="text-sm font-semibold text-gray-700">Gambar 2</p>
                        </div>
                        <input type="file" id="slot-2-input" name="slot_2_image" accept="image/*" class="hidden" onchange="previewSlotImage(2, this)">
                    </div>

                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center cursor-pointer hover:border-teal-400 transition" onclick="document.getElementById('slot-3-input').click()">
                        <div id="slot-3-preview" class="hidden">
                            <img id="slot-3-img" src="" alt="Slot 3" class="w-full h-32 object-cover rounded mb-2">
                            <button type="button" class="text-xs bg-orange-600 text-white px-3 py-1 rounded w-full hover:bg-orange-700 transition">Ubah</button>
                        </div>
                        <div id="slot-3-empty" class="flex flex-col items-center justify-center h-32">
                            <svg class="w-8 h-8 text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            <p class="text-sm font-semibold text-gray-700">Gambar 3</p>
                        </div>
                        <input type="file" id="slot-3-input" name="slot_3_image" accept="image/*" class="hidden" onchange="previewSlotImage(3, this)">
                    </div>
                </div>
                <p class="text-xs text-gray-500 mt-2">Klik slot untuk menambah atau mengubah gambar. Maksimal 3 gambar.</p>
            </div>

            <div class="flex items-center">
                <input type="checkbox" id="is_active" name="is_active" value="1" class="w-4 h-4 text-teal-600 rounded focus:ring-2 focus:ring-teal-500">
                <label class="ml-2 text-gray-700 font-semibold">Aktif</label>
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t border-gray-200">
                <x-button variant="secondary" size="md" type="button" onclick="closeEditModal()">Batal</x-button>
                <x-button variant="primary" size="md" icon="check" type="submit">Simpan</x-button>
            </div>
        </form>
    </div>
</div>

<script>
let modalCurrentImageIndex = 0;
let modalExistingImages = [];
const existingSlots = {};

function openEditModal(itemId) {
    fetch(`/admin/profile-ruangan/${itemId}/edit`, {
        headers: {
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
        }
    })
        .then(response => response.json())
        .then(data => {
            document.getElementById('editForm').action = `/admin/profile-ruangan/${itemId}`;
            document.getElementById('room_name').value = data.room_name || '';
            document.getElementById('floor').value = data.floor || '';
            document.getElementById('capacity').value = data.capacity || '';
            document.getElementById('description').value = data.description || '';
            document.getElementById('is_active').checked = data.is_active;
            document.getElementById('editModalErrors').classList.add('hidden');
            
            // Reset semua slot
            resetAllSlots();
            
            // Load existing images ke slot
            if (data.images && data.images.length > 0) {
                data.images.forEach((image, index) => {
                    if (index < 3) {
                        const slotNum = index + 1;
                        existingSlots[slotNum] = image;
                        // Get filename from image_path
                        const filename = image.image_path.split('/').pop();
                        const imageUrl = `{{ route('profile-ruangan.image', ['filename' => '']) }}` + filename;
                        showSlotImage(slotNum, imageUrl);
                    }
                });
            }
            
            document.getElementById('editModal').classList.remove('hidden');
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error loading data');
        });
}

function resetAllSlots() {
    for (let i = 1; i <= 3; i++) {
        document.getElementById(`slot-${i}-input`).value = '';
        document.getElementById(`slot-${i}-empty`).classList.remove('hidden');
        document.getElementById(`slot-${i}-preview`).classList.add('hidden');
        existingSlots[i] = null;
    }
}

function showSlotImage(slotNum, imagePath) {
    const preview = document.getElementById(`slot-${slotNum}-preview`);
    const empty = document.getElementById(`slot-${slotNum}-empty`);
    const img = document.getElementById(`slot-${slotNum}-img`);
    
    img.src = imagePath;
    preview.classList.remove('hidden');
    empty.classList.add('hidden');
}

function previewSlotImage(slotNum, input) {
    const file = input.files[0];
    
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            showSlotImage(slotNum, e.target.result);
            existingSlots[slotNum] = null; // Clear existing image if user uploads new one
        };
        reader.readAsDataURL(file);
    }
}

function closeEditModal() {
    document.getElementById('editModal').classList.add('hidden');
    document.getElementById('editForm').reset();
    resetAllSlots();
}

// Handle file input change for new images
document.addEventListener('DOMContentLoaded', function() {
    // No additional handlers needed for slots, handled by onchange
});

function submitEditForm(event) {
    event.preventDefault();
    const form = document.getElementById('editForm');
    const formData = new FormData(form);
    const errorDiv = document.getElementById('editModalErrors');
    const submitBtn = form.querySelector('[type="submit"]');
    const originalText = submitBtn.innerText;
    
    submitBtn.disabled = true;
    submitBtn.innerText = 'Menyimpan...';
    errorDiv.classList.add('hidden');
    
    // Log FormData content
    console.log('Modal edit form submission:');
    console.log('Form action:', form.action);
    let fileCount = 0;
    for (let [key, value] of formData.entries()) {
        if (value instanceof File) {
            fileCount++;
            console.log(`  ${key}: File(${value.name}, ${value.size} bytes)`);
        } else if (value !== '') {
            console.log(`  ${key}: ${value}`);
        }
    }
    console.log(`Total files in FormData: ${fileCount}`);
    
    fetch(form.action, {
        method: 'POST', // Laravel requires POST with _method override
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json',
        }
    })
    .then(response => {
        console.log('Modal response status:', response.status);
        console.log('Modal response headers:', response.headers);
        
        if (response.status === 422) {
            // Validation error
            return response.json().then(data => {
                console.log('Modal validation errors:', data);
                if (data.errors) {
                    let errorHTML = '<strong>Perbaiki kesalahan berikut:</strong><ul style="margin-top: 8px;">';
                    for (let field in data.errors) {
                        errorHTML += `<li>• ${data.errors[field].join(', ')}</li>`;
                    }
                    errorHTML += '</ul>';
                    errorDiv.innerHTML = errorHTML;
                    errorDiv.classList.remove('hidden');
                }
                throw new Error('Validation error');
            });
        } else if (response.ok) {
            // Success - expect JSON response
            return response.json().then(data => {
                console.log('Modal update success:', data);
                closeEditModal();
                setTimeout(() => {
                    location.reload();
                }, 300);
            });
        } else {
            // Error response
            return response.json().then(data => {
                console.log('Modal error response:', data);
                let errorMsg = data.error || `HTTP Error ${response.status}`;
                if (data.debug) {
                    errorMsg += ` (${data.debug.file}:${data.debug.line})`;
                }
                throw new Error(errorMsg);
            }).catch(() => {
                throw new Error(`HTTP Error ${response.status}`);
            });
        }
    })
    .catch(error => {
        console.error('Modal error:', error);
        if (error.message !== 'Validation error') {
            errorDiv.innerHTML = `<strong>Error:</strong> ${error.message || 'Terjadi kesalahan saat menyimpan data'}`;
            errorDiv.classList.remove('hidden');
        }
        submitBtn.disabled = false;
        submitBtn.innerText = originalText;
    });
}

// Close modal when clicking outside
document.getElementById('editModal')?.addEventListener('click', function(e) {
    if (e.target === this) {
        closeEditModal();
    }
});
</script>
