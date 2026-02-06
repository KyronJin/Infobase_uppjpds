@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-8">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Kelola Galeri Foto</h1>
                <p class="text-gray-600 mt-2">Manage foto-foto perpustakaan</p>
            </div>
            <a href="{{ route('admin.gallery.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg transition duration-300">
                <i class="fas fa-plus mr-2"></i>Tambah Foto
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-100 text-green-800 rounded-lg border border-green-300">
            <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-100 border-b-2 border-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Foto</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Judul</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Kategori</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Status</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Urutan</th>
                        <th class="px-6 py-3 text-center text-sm font-semibold text-gray-700">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($photos as $photo)
                        <tr class="border-b hover:bg-gray-50 transition duration-200">
                            <td class="px-6 py-4">
                                <div class="w-16 h-16 rounded overflow-hidden bg-gray-100">
                                    <img src="{{ asset($photo->image_path) }}" alt="{{ $photo->title }}" class="w-full h-full object-cover">
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <p class="font-medium text-gray-900">{{ $photo->title }}</p>
                                <p class="text-sm text-gray-600 line-clamp-1">{{ $photo->description }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-block px-3 py-1 bg-gray-100 text-gray-800 text-sm font-medium rounded-full">
                                    {{ $photo->category }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                @if($photo->is_active)
                                    <span class="inline-block px-3 py-1 bg-green-100 text-green-800 text-sm font-medium rounded-full">
                                        <i class="fas fa-check-circle mr-1"></i>Aktif
                                    </span>
                                @else
                                    <span class="inline-block px-3 py-1 bg-gray-100 text-gray-800 text-sm font-medium rounded-full">
                                        <i class="fas fa-times-circle mr-1"></i>Nonaktif
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="font-semibold text-gray-700">{{ $photo->order }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex justify-center gap-2">
                                    <a href="{{ route('admin.gallery.edit', $photo) }}" class="inline-flex items-center px-3 py-2 bg-yellow-500 hover:bg-yellow-600 text-white rounded transition duration-200">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.gallery.destroy', $photo) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center px-3 py-2 bg-red-600 hover:bg-red-700 text-white rounded transition duration-200">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8">
                                <div class="text-center">
                                    <i class="fas fa-image text-4xl text-gray-300 mb-4"></i>
                                    <p class="text-gray-500 text-lg mb-4">Belum ada foto galeri</p>
                                    <a href="{{ route('admin.gallery.create') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded transition duration-300">
                                        Tambah Foto Pertama
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($photos->hasPages())
            <div class="bg-gray-50 px-6 py-4">
                {{ $photos->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
