@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#f8fafc] pt-32 pb-24"> 
    <div class="max-w-4xl mx-auto px-6">
        
        <header class="flex flex-col md:flex-row md:items-end justify-between mb-16 gap-6">
            <div class="space-y-2">
                <nav class="flex items-center space-x-2 text-sm text-indigo-600 font-medium mb-4">
                    <a href="{{ route('infobase.pengumuman') }}" class="hover:underline">Pengumuman</a>
                    <span class="text-gray-400">/</span>
                    <span class="text-gray-500">Detail</span>
                </nav>
                <h1 class="text-5xl font-black text-slate-900 tracking-tight">
                    {{ $pengumuman->title }}
                </h1>
            </div>
            
            <a href="{{ route('infobase.pengumuman') }}" class="inline-flex items-center px-5 py-2.5 rounded-xl bg-white border border-slate-200 text-slate-600 font-semibold text-sm hover:bg-slate-50 hover:border-slate-300 transition-all shadow-sm">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Kembali
            </a>
        </header>

        <article class="bg-white rounded-3xl p-8 md:p-10 border border-slate-100 shadow-sm">
            <div class="flex flex-col md:flex-row gap-12">
                
                <div class="hidden md:block w-32 flex-shrink-0">
                    <div class="sticky top-0">
                        <div class="text-indigo-600 font-bold text-sm uppercase tracking-widest mb-1">
                            {{ $pengumuman->published_at?->format('M') ?? 'Jan' }}
                        </div>
                        <div class="text-3xl font-black text-slate-900">
                            {{ $pengumuman->published_at?->format('d') ?? '00' }}
                        </div>
                        <div class="text-slate-400 text-sm font-medium">
                            {{ $pengumuman->published_at?->format('Y') ?? '2024' }}
                        </div>
                    </div>
                </div>

                <div class="flex-1">
                    <div class="md:hidden flex items-center text-indigo-600 font-bold text-xs uppercase tracking-widest mb-3">
                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20"><path d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"/></svg>
                        {{ $pengumuman->published_at?->format('d M Y') ?? 'Baru' }}
                    </div>

                    <div class="prose prose-slate max-w-none text-slate-700 text-lg leading-relaxed">
                        {!! nl2br(e($pengumuman->body)) !!}
                    </div>

                    <div class="mt-12 pt-8 border-t border-slate-50">
                        <div class="flex items-center space-x-2 text-slate-400 text-sm">
                            <span class="w-2 h-2 rounded-full bg-green-400"></span>
                            <span>Dipublikasikan pada {{ $pengumuman->published_at?->format('d F Y') ?? 'Sekarang' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </article>
    </div>
</div>
@endsection
