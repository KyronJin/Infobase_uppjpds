<!-- Edit Modal -->
<div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center overflow-y-auto">
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
                    <label class="form-label">Description</label>
                    <textarea id="description" name="description" class="form-control" rows="4"></textarea>
                </div>
                <div class="form-group">
                    <label class="form-label">Photo Link</label>
                    <input type="text" id="photo_link" name="photo_link" class="form-control">
                </div>
                <div class="form-group">
                    <label class="form-label">Images</label>
                    <input type="file" id="images" name="images[]" class="form-control" accept="image/*" multiple>
                    <small class="text-gray-500">Opsional: Upload multiple image files</small>
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
function openEditModal(itemId) {
    fetch(`/admin/profile/${itemId}/edit-modal`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('editForm').action = `/admin/profile/${itemId}`;
            document.getElementById('room_name').value = data.room_name || '';
            document.getElementById('floor').value = data.floor || '';
            document.getElementById('capacity').value = data.capacity || '';
            document.getElementById('description').value = data.description || '';
            document.getElementById('photo_link').value = data.photo_link || '';
            document.getElementById('is_active').checked = data.is_active;
            document.getElementById('editModalErrors').classList.add('hidden');
            
            document.getElementById('editModal').classList.remove('hidden');
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error loading data');
        });
}

function closeEditModal() {
    document.getElementById('editModal').classList.add('hidden');
    document.getElementById('editForm').reset();
}

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
