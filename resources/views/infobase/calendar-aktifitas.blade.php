@extends('layouts.app')

@push('styles')
<!-- Local accents for calendar layout (keeps Cairo for badges) -->
<style>
    .glass-card { background: rgba(255,255,255,0.06); backdrop-filter: blur(10px); }
    .calendar-badge { background: white; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.08); }
</style>
@endpush

@section('content')

<div class="bg-gradient-to-br from-teal-800 via-teal-700 to-emerald-800 min-h-screen py-24 pt-28">
    <div class="max-w-4xl mx-auto px-6">
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-12 gap-4">
            <div>
                <h1 class="h2 text-white">{{ $title ?? 'Calendar Aktifitas' }}</h1>
                <div class="h-1.5 w-24 bg-teal-400 mt-3 rounded-full"></div>
            </div>

            <a href="{{ route('infobase') }}" class="group inline-flex items-center text-teal-100 hover:text-white transition-all font-semibold">
                <svg class="w-5 h-5 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Kembali ke Infobase
            </a>
        </div>

        @if(isset($events) && $events->count())
            <div class="space-y-8 relative before:absolute before:inset-0 before:ml-12 before:-translate-x-px md:before:mx-auto md:before:translate-x-0 before:h-full before:w-0.5 before:bg-gradient-to-b before:from-transparent before:via-teal-400/30 before:to-transparent">
                @foreach($events as $ev)
                <article class="relative flex items-center justify-between md:justify-normal md:odd:flex-row-reverse group">
                    <div class="flex items-center justify-center w-10 h-10 rounded-full border-4 border-teal-800 bg-teal-400 absolute left-7 md:left-1/2 -translate-x-1/2 shadow-xl z-10 group-hover:scale-105 transition-transform"></div>

                    <div class="w-[calc(100%-4rem)] md:w-[45%] glass-card p-6 rounded-3xl transition-all duration-300 hover:bg-white/10 hover:shadow-2xl">
                        <div class="flex items-start gap-4">
                            <div class="calendar-badge flex-shrink-0 flex flex-col items-center justify-center rounded-2xl p-3 min-w-[70px] h-fit">
                                <span class="text-2xl font-black text-teal-700 leading-none">{{ $ev->start_at?->format('d') }}</span>
                                <span class="text-[10px] font-bold text-teal-600 uppercase tracking-tighter">{{ $ev->start_at?->format('M Y') }}</span>
                            </div>

                            <div class="flex-1">
                                <div class="flex items-center text-teal-200 text-xs mb-2 font-semibold">
                                    <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    {{ $ev->start_at?->format('H:i') }} WIB
                                    @if($ev->location)
                                        <span class="mx-2 opacity-40">|</span>
                                        <span class="truncate">{{ $ev->location }}</span>
                                    @endif
                                </div>
                                <h3 class="h3 text-white mb-2">{{ $ev->title }}</h3>
                                <div class="text-teal-50/70 text-sm leading-relaxed line-clamp-3">
                                    {!! nl2br(e($ev->description)) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
                @endforeach

            </div>
        @else
            <div class="glass-card rounded-3xl p-16 text-center">
                <div class="w-24 h-24 bg-white/10 rounded-full flex items-center justify-center mx-auto mb-6 shadow-inner">
                    <svg class="w-12 h-12 text-teal-200 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <h3 class="h3 text-white mb-2">Belum ada event terjadwal</h3>
                <p class="text-teal-100/60 max-w-xs mx-auto">Kalender saat ini masih kosong. Silakan kembali lagi nanti untuk pembaruan aktifitas.</p>
            </div>
        @endif

    </div>
</div>
@endsection