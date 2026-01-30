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
                <h1 class="text-5xl font-black text-slate-900 tracking-tight">
                    {{ $title ?? 'Pengumuman' }}
                </h1>
                <p class="text-slate-500 text-lg">Update informasi dan berita terbaru untuk Anda.</p>
            </div>
            
            <a href="{{ route('infobase.index') }}" class="inline-flex items-center px-5 py-2.5 rounded-xl bg-white border border-slate-200 text-slate-600 font-semibold text-sm hover:bg-slate-50 hover:border-slate-300 transition-all shadow-sm">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Kembali
            </a>
        </header>

        <div class="space-y-10">
            @if(isset($pengumumans) && $pengumumans->count())
                @foreach($pengumumans as $item)
                    <article class="group relative bg-white rounded-3xl p-8 md:p-10 border border-slate-100 shadow-sm hover:shadow-xl hover:shadow-indigo-500/5 transition-all duration-300">
                        <div class="flex flex-col md:flex-row gap-8">
                            
                            <div class="hidden md:block w-32 flex-shrink-0">
                                <div class="sticky top-0">
                                    <div class="text-indigo-600 font-bold text-sm uppercase tracking-widest mb-1">
                                        {{ $item->published_at?->format('M') ?? 'Jan' }}
                                    </div>
                                    <div class="text-3xl font-black text-slate-900">
                                        {{ $item->published_at?->format('d') ?? '00' }}
                                    </div>
                                    <div class="text-slate-400 text-sm font-medium">
                                        {{ $item->published_at?->format('Y') ?? '2024' }}
                                    </div>
                                </div>
                            </div>

                            <div class="flex-1">
                                <div class="md:hidden flex items-center text-indigo-600 font-bold text-xs uppercase tracking-widest mb-3">
                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20"><path d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"/></svg>
                                    {{ $item->published_at?->format('d M Y') ?? 'Baru' }}
                                </div>

                                @if($item->image_path)
                                    <img src="{{ asset('storage/' . $item->image_path) }}" alt="{{ $item->title }}" class="w-full h-48 object-cover rounded-lg mb-5">
                                @endif

                                <h2 class="text-2xl md:text-3xl font-bold text-slate-800 mb-5 leading-tight group-hover:text-indigo-600 transition-colors">
                                    {{ $item->title }}
                                </h2>

                                <div class="prose prose-slate max-w-none text-slate-600 leading-relaxed">
                                    {!! nl2br(e($item->description)) !!}
                                </div>

                                <div class="mt-8 pt-8 border-t border-slate-50 flex items-center justify-between">
                                    <div class="flex items-center space-x-2 text-slate-400 text-sm">
                                        <span class="w-2 h-2 rounded-full bg-green-400"></span>
                                        <span>Berlaku: {{ $item->valid_from?->format('d/m/Y') ?? '-' }} - {{ $item->valid_until?->format('d/m/Y') ?? '-' }}</span>
                                    </div>
                                    <a href="{{ route('pengumuman.show', $item->id) }}" class="text-indigo-600 font-bold text-sm hover:underline">Baca Selengkapnya →</a>
                                </div>
                            </div>
                        </div>
                    </article>
                @endforeach
            @else
                <div class="bg-white rounded-[2rem] p-16 text-center border border-slate-100 shadow-sm">
                    <div class="w-24 h-24 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-12 h-12 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-slate-800">Belum ada pengumuman</h3>
                    <p class="text-slate-500 mt-2 max-w-xs mx-auto">Kami akan segera mengabari Anda jika ada informasi terbaru tersedia.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection