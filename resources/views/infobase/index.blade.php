@extends('layouts.app')

@push('styles')
{{-- Memastikan font Cairo tersedia --}}
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700;800&display=swap" rel="stylesheet">
<style>
    body { font-family: 'Cairo', sans-serif; }
    
    /* Efek Kaca (Glassmorphism) */
    .glass-card {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    /* Animasi halus untuk gambar */
    .img-hover {
        transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    }
</style>
@endpush

@section('content')
<x-navbar />

<div class="bg-gradient-to-br from-teal-800 via-teal-700 to-emerald-800 min-h-screen">
    <div class="max-w-7xl mx-auto px-6 py-16 lg:py-20">
        
        <div class="text-center mb-20">
            <h1 class="text-6xl lg:text-7xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-white to-teal-200 tracking-tighter mb-4">
                INFOBASE
            </h1>
            <div class="h-1.5 w-24 bg-teal-400 mx-auto rounded-full mb-6"></div>
            <p class="text-xl text-teal-50 font-light tracking-wide uppercase">Pusat Informasi Perpustakaan UPPJPDS</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
            
            <div class="lg:col-span-4 space-y-8">
                <div class="flex items-center space-x-3 mb-2">
                    <span class="flex h-3 w-3 rounded-full bg-teal-400 animate-ping"></span>
                    <h2 class="text-2xl font-bold text-white tracking-tight">Today's Officer</h2>
                </div>
                
                <div class="glass-card rounded-3xl p-8 transition-transform duration-500 hover:scale-[1.02]">
                    <div class="flex flex-col items-center">
                        <div class="relative group">
                            <div class="absolute -inset-1 bg-gradient-to-r from-teal-400 to-emerald-400 rounded-full blur opacity-25 group-hover:opacity-50 transition duration-1000"></div>
                            <div class="relative w-44 h-44 rounded-full overflow-hidden border-4 border-white shadow-2xl mb-6">
                                <img src="{{ $todayOfficer['image'] }}" alt="{{ $todayOfficer['name'] }}" class="w-full h-full object-cover img-hover group-hover:scale-110">
                            </div>
                        </div>
                        <h3 class="text-2xl font-bold text-white text-center">{{ $todayOfficer['name'] }}</h3>
                        <p class="px-4 py-1 mt-3 bg-teal-500/30 text-teal-50 rounded-full text-sm font-medium border border-teal-400/30">
                            {{ $todayOfficer['position'] }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-8">
                <div class="flex items-center justify-between mb-8">
                    <h2 class="text-2xl font-bold text-white tracking-tight">Informasi Terbaru</h2>
                    <div class="h-px flex-1 bg-white/10 ml-6"></div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach($infobaseData as $item)
                    <div class="glass-card rounded-2xl overflow-hidden group hover:bg-white/20 transition-all duration-300">
                        <div class="relative aspect-video overflow-hidden">
                            <img src="{{ $item['image'] }}" alt="{{ $item['title'] }}" class="w-full h-full object-cover img-hover group-hover:scale-105">
                            <div class="absolute inset-0 bg-gradient-to-t from-teal-900/60 to-transparent opacity-60"></div>
                        </div>
                        
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-white mb-2 group-hover:text-teal-200 transition-colors">{{ $item['title'] }}</h3>
                            <p class="text-teal-100/80 text-sm leading-relaxed mb-6 line-clamp-2">
                                {{ $item['description'] }}
                            </p>
                            
                            <a href="#" class="flex items-center justify-center w-full py-3 bg-white text-teal-800 font-bold rounded-xl hover:bg-teal-50 hover:shadow-lg transition-all active:scale-95">
                                Lihat Detail
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="mt-24">
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-2xl font-bold text-white tracking-tight">Hubungi Kami</h2>
                <div class="h-px flex-1 bg-white/10 ml-6"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="glass-card p-8 rounded-3xl flex flex-col items-center text-center group hover:bg-teal-500/20 transition-all duration-300">
                    <div class="w-14 h-14 bg-white/10 rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7 text-teal-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    </div>
                    <h4 class="text-lg font-bold text-white mb-2">Lokasi</h4>
                    <p class="text-teal-100 text-sm leading-relaxed">
                        Jl. Contoh No. 123, Gedung Perpustakaan UPPJPDS, Jakarta.
                    </p>
                </div>

                <div class="glass-card p-8 rounded-3xl flex flex-col items-center text-center group hover:bg-teal-500/20 transition-all duration-300">
                    <div class="w-14 h-14 bg-white/10 rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7 text-teal-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    </div>
                    <h4 class="text-lg font-bold text-white mb-2">Email</h4>
                    <p class="text-teal-100 text-sm italic">info@uppjpds.library.sch.id</p>
                </div>

                <div class="glass-card p-8 rounded-3xl flex flex-col items-center text-center group hover:bg-teal-500/20 transition-all duration-300">
                    <div class="w-14 h-14 bg-white/10 rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7 text-teal-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                    </div>
                    <h4 class="text-lg font-bold text-white mb-2">Kontak</h4>
                    <p class="text-teal-100 text-sm">+62 812 3456 7890</p>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection