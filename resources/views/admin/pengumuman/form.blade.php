<form method="POST" action="{{ route('admin.pengumuman.store') }}" class="bg-white p-6 rounded-lg shadow">
    @csrf

    <div class="mb-4">
        <label class="block text-gray-700 mb-1">Judul</label>
        <input type="text" name="title" required class="w-full border rounded px-3 py-2">
    </div>

    <div class="mb-4">
        <label class="block text-gray-700 mb-1">Isi Pengumuman</label>
        <textarea name="body" rows="8" required class="w-full border rounded px-3 py-2"></textarea>
    </div>

    <div class="mb-4">
        <label class="block text-gray-700 mb-1">Tanggal Publish (opsional)</label>
        <input type="datetime-local" name="published_at" class="w-full border rounded px-3 py-2">
    </div>

    <button type="submit" class="bg-teal-600 text-white px-6 py-2 rounded hover:bg-teal-700">
        Buat Pengumuman
    </button>
</form>