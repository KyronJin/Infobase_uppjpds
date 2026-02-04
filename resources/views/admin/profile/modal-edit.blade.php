<!-- Edit Modal -->
<div id="editModal" class="fixed inset-0 backdrop-blur-sm bg-white/30 hidden z-50 flex items-center justify-center overflow-y-auto">
    <div class="bg-white rounded-lg shadow-lg w-full max-h-[90vh] overflow-y-auto my-8" style="max-width: 600px; margin-left: auto; margin-right: auto;">
        <div class="flex items-center justify-between px-6 py-4 border-b sticky top-0 bg-white">
            <h2 class="text-xl font-bold">Edit Profile Ruangan</h2>
            <button type="button" onclick="closeEditModal()" class="text-gray-500 hover:text-gray-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <div id="editModalErrors" class="hidden mx-6 mt-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded"></div>

        <form id="editForm" method="POST" onsubmit="submitEditForm(event)" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="px-6 py-4 space-y-4">
                <div class="form-group">
                    <label class="form-label">Room Name <span class="text-red-500">*</span></label>
                    <input type="text" id="room_name" name="room_name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Floor</label>
                    <input type="number" id="floor" name="floor" class="form-control" min="1" max="7">
                </div>
                <div class="form-group">
                    <label class="form-label">Capacity</label>
                    <input type="number" id="capacity" name="capacity" class="form-control">
                </div>
                <div class="form-group">
                    <label class="form-label">Deskripsi</label>
                    <textarea id="description" name="description" class="form-control" rows="4"></textarea>
                </div>
                <div class="form-group">
                    <label class="form-label">Photo Link</label>
                    <input type="text" id="photo_link" name="photo_link" class="form-control">
                </div>

                <!-- 3 Slot Gambar -->
                <div class="form-group">
                    <label class="form-label">Gambar Ruangan (Maksimal 3)</label>
                    <div class="grid grid-cols-3 gap-4 mt-4">
                        <!-- Slot 1 -->
                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center cursor-pointer hover:border-blue-400 transition" onclick="document.getElementById('slot-1-input').click()">
                            <div id="slot-1-preview" class="hidden">
                                <img id="slot-1-img" src="" alt="Slot 1" class="w-full h-32 object-cover rounded mb-2">
                                <button type="button" class="text-xs bg-blue-600 text-white px-2 py-1 rounded w-full">Ubah</button>
                            </div>
                            <div id="slot-1-empty" class="flex flex-col items-center justify-center h-32">
                                <svg class="w-8 h-8 text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                <p class="text-sm font-semibold text-gray-700">Gambar 1</p>
                            </div>
                            <input type="file" id="slot-1-input" name="slot_1_image" accept="image/*" class="hidden" onchange="previewSlotImage(1, this)">
                        </div>

                        <!-- Slot 2 -->
                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center cursor-pointer hover:border-blue-400 transition" onclick="document.getElementById('slot-2-input').click()">
                            <div id="slot-2-preview" class="hidden">
                                <img id="slot-2-img" src="" alt="Slot 2" class="w-full h-32 object-cover rounded mb-2">
                                <button type="button" class="text-xs bg-blue-600 text-white px-2 py-1 rounded w-full">Ubah</button>
                            </div>
                            <div id="slot-2-empty" class="flex flex-col items-center justify-center h-32">
                                <svg class="w-8 h-8 text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                <p class="text-sm font-semibold text-gray-700">Gambar 2</p>
                            </div>
                            <input type="file" id="slot-2-input" name="slot_2_image" accept="image/*" class="hidden" onchange="previewSlotImage(2, this)">
                        </div>

                        <!-- Slot 3 -->
                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center cursor-pointer hover:border-blue-400 transition" onclick="document.getElementById('slot-3-input').click()">
                            <div id="slot-3-preview" class="hidden">
                                <img id="slot-3-img" src="" alt="Slot 3" class="w-full h-32 object-cover rounded mb-2">
                                <button type="button" class="text-xs bg-blue-600 text-white px-2 py-1 rounded w-full">Ubah</button>
                            </div>
                            <div id="slot-3-empty" class="flex flex-col items-center justify-center h-32">
                                <svg class="w-8 h-8 text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                <p class="text-sm font-semibold text-gray-700">Gambar 3</p>
                            </div>
                            <input type="file" id="slot-3-input" name="slot_3_image" accept="image/*" class="hidden" onchange="previewSlotImage(3, this)">
                        </div>
                    </div>
                    <small class="text-gray-500 block mt-3">Klik pada slot untuk menambah atau mengubah gambar. Maksimal 3 gambar.</small>
                </div>
                <div class="form-group">
                    <label class="form-label inline-flex items-center">
                        <input type="checkbox" id="is_active" name="is_active" value="1" class="mr-2">
                        Active
                    </label>
                </div>
            </div>
            <div class="flex items-center justify-between px-6 py-4 border-t bg-gray-50 sticky bottom-0">
                <button type="button" onclick="closeEditModal()" class="btn btn-secondary">Cancel</button>
                <button type="submit" class="btn btn-primary">Save</button>
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
        }
    })
        .then(response => response.json())
        .then(data => {
            document.getElementById('editForm').action = `/admin/profile-ruangan/${itemId}`;
            document.getElementById('room_name').value = data.room_name || '';
            document.getElementById('floor').value = data.floor || '';
            document.getElementById('capacity').value = data.capacity || '';
            document.getElementById('description').value = data.description || '';
            document.getElementById('photo_link').value = data.photo_link || '';
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
                        showSlotImage(slotNum, `/storage/${image.image_path}`);
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
    
    fetch(form.action, {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
        }
    })
    .then(response => {
        if (response.ok) {
            closeEditModal();
            location.reload();
        } else {
            return response.json().then(data => {
                if (data.errors) {
                    let errorHTML = '<ul>';
                    for (let field in data.errors) {
                        errorHTML += `<li>${data.errors[field].join(', ')}</li>`;
                    }
                    errorHTML += '</ul>';
                    document.getElementById('editModalErrors').innerHTML = errorHTML;
                    document.getElementById('editModalErrors').classList.remove('hidden');
                } else {
                    alert('Error saving data');
                }
            });
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error saving data');
    });
}

// Close modal when clicking outside
document.getElementById('editModal')?.addEventListener('click', function(e) {
    if (e.target === this) {
        closeEditModal();
    }
});
</script>
