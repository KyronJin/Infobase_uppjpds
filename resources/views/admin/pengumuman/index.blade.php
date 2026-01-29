@extends('layouts.app')

@section('content')
<div class="py-24 bg-white pt-28">
    <div class="max-w-6xl mx-auto px-6">
        <h1 class="h2 mb-6">Pengumuman</h1>

        <div class="grid md:grid-cols-2 gap-8">
            <!-- Kiri: Inbox / Daftar Pengumuman -->
            <div class="space-y-6">
                <h2 class="h3 text-teal-700">Inbox</h2>

                <pre>{{ var_dump($pengumumans->toArray()) }}</pre>
                 <!-- atau lebih simpel -->
                 <div>Jumlah pengumuman: {{ $pengumumans->count() }}</div> 

                @if($pengumumans->isEmpty())
                    <div class="bg-gray-50 p-6 rounded-lg text-center text-gray-600">
                        Belum ada pengumuman saat ini
                    </div>
                @else
                    @foreach($pengumumans as $item)
                    <div class="border-l-4 border-teal-500 pl-4 bg-gray-50 p-4 rounded">
                        <h3 class="h3">{{ $item->title }}</h3>
                        <p class="text-sm text-gray-500 mb-2">
                            {{ $item->published_at?->format('d F Y') ?? '—' }}
                        </p>
                        <div class="text-gray-700 prose prose-sm">
                            {!! nl2br(e($item->body)) !!}
                        </div>
                    </div>
                    @endforeach
                @endif
            </div>

            <!-- Kanan: Hanya muncul kalau admin (atau kosong kalau bukan admin) -->
            @can('manage', App\Models\Pengumuman::class)
            <div>
                <h2 class="text-2xl font-semibold text-teal-700 mb-4">Buat / Edit Pengumuman</h2>
                <!-- Form create di sini + list kecil untuk edit -->
                @include('admin.pengumuman.form')
            </div>
            @endcan
        </div>

        <a href="{{ route('infobase') }}" class="inline-block mt-8 text-teal-600 hover:underline">
            ← Kembali
        </a>
    </div>
</div>
@endsection