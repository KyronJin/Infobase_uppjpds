@extends('layouts.app')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
<style>
    .font-cairo { font-family: 'Cairo', sans-serif; }
    .quill-editor { min-height: 400px; }
</style>
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
@endpush

@section('content')
<div class="bg-gray-50 min-h-screen py-12 pt-28 font-cairo">
    <div class="max-w-4xl mx-auto px-6">
        
        <!-- Standardized Header -->
        <div class="flex flex-col md:flex-row items-center justify-between mb-8 bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
            <div class="flex items-center gap-4">
                <a href="{{ route('admin.tata_tertib.index') }}" class="w-10 h-10 flex items-center justify-center rounded-full bg-gray-50 text-gray-400 hover:bg-gray-100 transition-colors">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <div>
                    <h1 class="h2 text-gray-800">Edit Tata Tertib</h1>
                    <p class="text-sm text-gray-500">Sesuaikan aturan dan kebijakan operasional.</p>
                </div>
            </div>
        </div>

        @if ($errors->any())
        <div class="mb-6 bg-red-50 border-l-4 border-red-400 p-4 rounded-r-xl">
            <div class="flex">
                <div class="ml-3">
                    <h3 class="text-sm font-bold text-red-800 font-cairo">Validasi Gagal</h3>
                    <ul class="mt-1 text-sm text-red-700 list-disc list-inside font-cairo">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        @endif

        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-10">
                <form action="{{ route('admin.tata_tertib.update', $tata_tert_id ?? $tata_tertib) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Jenis Tata Tertib</label>
                            <select name="jenis_tata_tertib_id" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition-all outline-none" required>
                                <option value="">Pilih Jenis</option>
                                @foreach ($jenis as $item)
                                    <option value="{{ $item->id }}" {{ old('jenis_tata_tertib_id', $tata_tertib->jenis_tata_tertib_id) == $item->id ? 'selected' : '' }}>
                                        {{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Status</label>
                            <select name="is_active" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition-all outline-none" required>
                                <option value="1" {{ old('is_active', $tata_tertib->is_active) == 1 ? 'selected' : '' }}>✓ Aktif</option>
                                <option value="0" {{ old('is_active', $tata_tertib->is_active) == 0 ? 'selected' : '' }}>✗ Tidak Aktif</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-10">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Konten Tata Tertib</label>
                        <div id="editor-container" class="quill-editor bg-gray-50 border-gray-200 rounded-xl overflow-hidden">
                            {!! old('content', $tata_tertib->content) !!}
                        </div>
                        <input type="hidden" name="content" id="content-input">
                    </div>

                    <div class="flex items-center gap-4 pt-8 border-t border-gray-100">
                        <x-button variant="primary" size="lg" icon="save" type="submit" class="flex-1">Simpan Perubahan</x-button>
                        <x-button variant="secondary" size="lg" type="link" href="{{ route('admin.tata_tertib.index') }}">Batal</x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const quill = new Quill('#editor-container', {
            theme: 'snow',
            modules: {
                toolbar: [
                    [{ 'header': [1, 2, 3, false] }],
                    ['bold', 'italic', 'underline', 'strike'],
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                    ['clean']
                ]
            }
        });

        const form = document.querySelector('form');
        form.onsubmit = function() {
            const contentInput = document.querySelector('#content-input');
            contentInput.value = quill.root.innerHTML;
        };
    });
</script>
@endpush
