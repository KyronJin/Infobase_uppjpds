<form method="POST" action="{{ route('admin.pengumuman.store') }}">
    @csrf

    <div class="mb-4">
        <label class="block text-gray-700 mb-1">Judul</label>
        <input type="text" name="title" required class="w-full border rounded px-3 py-2">
    </div>

    <div class="mb-4">
        <label class="block text-gray-700 mb-1">Isi Pengumuman</label>
        <textarea name="description" rows="8" required class="w-full border rounded px-3 py-2"></textarea>
    </div>

    <div class="mb-4">
        <label class="block text-gray-700 mb-1">Tanggal Publish</label>
        <input type="datetime-local" name="published_at" class="w-full border rounded px-3 py-2">
    </div>

    <div class="mb-4">
        <label class="block text-gray-700 mb-1">Tanggal Mulai Berlaku</label>
        <input type="date" name="valid_from" class="w-full border rounded px-3 py-2">
    </div>

    <div class="mb-4">
        <label class="block text-gray-700 mb-1">Tanggal Akhir Berlaku</label>
        <input type="date" name="valid_until" class="w-full border rounded px-3 py-2">
    </div>

    <div class="flex justify-end space-x-3">
        <button type="button" id="cancel-btn" class="px-4 py-2 border border-gray-300 rounded text-gray-700 hover:bg-gray-50">
            Batal
        </button>
        <button type="submit" class="bg-teal-600 text-white px-6 py-2 rounded hover:bg-teal-700">
            Buat Pengumuman
        </button>
    </div>
</form>

<script>
document.getElementById('cancel-btn').addEventListener('click', function() {
    document.getElementById('create-announcement-modal').classList.add('hidden');
});
</script>