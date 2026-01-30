@extends('layouts.app')

@section('content')

<div class="py-24 bg-white pt-28">
  <div class="max-w-6xl mx-auto px-6">
    <h1 class="h2 mb-6">{{ $title ?? 'Staff of The Month' }}</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
      @forelse($items as $item)
        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
          @if($item->foto_path)
            <img src="{{ asset('storage/' . $item->foto_path) }}" alt="{{ $item->name }}" class="w-full h-48 object-cover">
          @else
            <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
              <i class="fas fa-user text-gray-400 text-4xl"></i>
            </div>
          @endif
          
          <div class="p-6">
            <h3 class="h3 text-gray-800 mb-2">{{ $item->name }}</h3>
            @if($item->position)
              <p class="text-sm text-gray-600 font-semibold mb-3">{{ $item->position }}</p>
            @endif
            @if($item->month && $item->year)
              <p class="text-xs text-gray-500 mb-4">Bulan {{ $item->month }} Tahun {{ $item->year }}</p>
            @endif
            @if($item->bio)
              <p class="text-gray-700 text-sm leading-relaxed">{!! nl2br(e($item->bio)) !!}</p>
            @endif
          </div>
        </div>
      @empty
        <div class="col-span-3 bg-gray-50 rounded-lg p-12 text-center">
          <i class="fas fa-star text-gray-300 text-5xl mb-4 block"></i>
          <p class="text-gray-500 text-lg">Belum ada Staff of The Month yang ditampilkan</p>
        </div>
      @endforelse
    </div>

    <a href="{{ route('infobase.index') }}" class="inline-block mt-6 admin-button">← Kembali</a>
  </div>
</div>

@endsection
