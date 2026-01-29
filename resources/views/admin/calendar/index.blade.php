@extends('layouts.app')

@section('content')
<div class="py-24 bg-white pt-28">
  <div class="max-w-6xl mx-auto px-6">
    <div class="admin-section">
        <div class="flex items-center justify-between mb-6">
            <h1 class="h2">Daftar Calendar Events</h1>
            <a href="{{ route('admin.calendar.create') }}" class="admin-button">Buat Event</a>
        </div>

        @if(session('success'))
            <div class="content-box mb-4">{{ session('success') }}</div>
        @endif

        <div class="grid gap-4">
            @foreach($items as $item)
                    <div class="p-4 bg-white rounded-lg shadow-sm">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="h3">{{ $item->title }}</h3>
                            <p class="text-sm text-gray-600">{{ $item->start_at?->format('d M Y H:i') ?? '-' }} @if($item->location) • {{ $item->location }} @endif</p>
                        </div>
                        <div class="flex gap-2">
                            <a href="{{ route('admin.calendar.edit', $item) }}" class="inline-block px-3 py-1 border rounded">Edit</a>
                            <form action="{{ route('admin.calendar.destroy', $item) }}" method="POST" onsubmit="return confirm('Hapus event?');">
                                @csrf
                                @method('DELETE')
                                <button class="inline-block px-3 py-1 bg-red-600 text-white rounded">Hapus</button>
                            </form>
                        </div>
                    </div>
                    <div class="mt-3 text-gray-700">{!! nl2br(e($item->description)) !!}</div>
                </div>
            @endforeach
        </div>

        <div class="mt-6">{{ $items->links() }}</div>
    </div>
</div>
@endsection
