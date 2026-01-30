@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#f8fafc] pt-32 pb-24">
    <div class="max-w-4xl mx-auto px-6">
        <header class="flex flex-col md:flex-row md:items-end justify-between mb-16 gap-6">
            <div class="space-y-2">
                <nav class="flex items-center space-x-2 text-sm text-indigo-600 font-medium mb-4">
                    <a href="{{ route('home') }}" class="hover:underline">Home</a>
                    <span class="text-gray-400">/</span>
                    <span class="text-gray-500">Informasi</span>
                </nav>
                <h1 class="text-5xl font-black text-slate-900 tracking-tight">{{ $title ?? 'Tata Tertib' }}</h1>
                <p class="text-slate-500 text-lg">{{ $content ?? 'Berisi Tata Tertib dan Peraturan di Perpustakaan' }}</p>
            </div>
        </header>

        <div class="space-y-6">
            @forelse($jenis as $j)
                <div class="bg-white rounded-3xl p-8 border border-slate-100 shadow-sm">
                    <button class="w-full text-left flex items-center justify-between" onclick="toggleAccordion('accordion-{{ $j->id }}')">
                        <h2 class="text-2xl font-bold text-slate-800">{{ $j->name }}</h2>
                        <svg id="icon-{{ $j->id }}" class="w-6 h-6 text-slate-400 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div id="accordion-{{ $j->id }}" class="mt-6 space-y-4 hidden">
                        @foreach($j->tataTertibs as $t)
                            <div class="flex items-start space-x-3">
                                <span class="flex-shrink-0 w-2 h-2 bg-indigo-500 rounded-full mt-2"></span>
                                <p class="text-slate-600">{{ $t->content }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            @empty
                <div class="bg-white rounded-[2rem] p-16 text-center border border-slate-100 shadow-sm">
                    <h3 class="text-2xl font-bold text-slate-800">Belum ada tata tertib</h3>
                    <p class="text-slate-500 mt-2">Kami akan segera mengabari Anda jika ada informasi terbaru tersedia.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

<script>
    function toggleAccordion(id) {
        const content = document.getElementById(id);
        const icon = document.getElementById('icon-' + id.split('-')[1]);
        content.classList.toggle('hidden');
        icon.classList.toggle('rotate-180');
    }
</script>
@endsection