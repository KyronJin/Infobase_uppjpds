@extends('layouts.app')

@section('content')

<div class="py-24 bg-white pt-28">
    <div class="max-w-6xl mx-auto px-6">
        <div class="mb-8 flex items-center gap-2 text-gray-600">
                <a href="{{ route('infobase') }}" class="text-teal-600 hover:text-teal-700 font-semibold">InfoBase</a>
                <span>/</span>
                <span class="text-gray-800">{{ $title ?? 'Tata Tertib' }}</span>
        </div>

        <h1 class="h2 mb-6">{{ $title ?? 'Tata Tertib' }}</h1>

        <div class="space-y-6">
            @foreach($items as $item)
                <article class="admin-section">
                    <h3 class="h3 mb-2">{{ $item->title }}</h3>
                    <div class="text-gray-700 leading-relaxed">{!! nl2br(e($item->content)) !!}</div>
                    @if($item->document_link)
                        <p class="mt-3"><a href="{{ $item->document_link }}" target="_blank" class="text-teal-600 font-semibold">Download</a></p>
                    @endif
                </article>
            @endforeach
        </div>

        <a href="{{ route('infobase') }}" class="inline-block mt-6 admin-button">← Kembali</a>
    </div>
</div>

@endsection
