@extends('layouts.app')

@section('content')

<div class="py-24 bg-white pt-28">
  <div class="max-w-6xl mx-auto px-6">
    <h1 class="h2 mb-6">{{ $title ?? 'Profile Ruangan' }}</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
      @foreach($items as $item)
        <div class="admin-section">
          @if($item->photo_link)
            <img src="{{ $item->photo_link }}" alt="{{ $item->room_name }}" class="w-full h-44 object-cover rounded-md mb-4">
          @endif
          <h3 class="h3">{{ $item->room_name }}</h3>
          <p class="text-sm text-gray-600">Lantai: {{ $item->floor }} — Kapasitas: {{ $item->capacity }}</p>
          <p class="mt-3 text-gray-700 leading-relaxed">{!! nl2br(e($item->description)) !!}</p>
        </div>
      @endforeach
    </div>

    <a href="{{ route('infobase') }}" class="inline-block mt-6 admin-button">← Kembali</a>
  </div>
</div>

@endsection
