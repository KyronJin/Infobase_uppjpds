@extends('layouts.app')

@section('content')
<div class="bg-[#f8fafc] min-h-screen py-6 sm:py-8 font-cairo">
    <div class="max-w-4xl mx-auto px-4 sm:px-6">
        <div class="mb-6 sm:mb-8 flex items-center justify-between gap-3">
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.agenda.login') }}" class="inline-flex items-center justify-center w-10 h-10 bg-white border border-slate-200 text-[#063A76] rounded-xl hover:bg-slate-50 transition-colors" title="Kembali">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <div>
                    <h1 class="text-2xl sm:text-3xl font-bold text-[#063A76]">Pilih Kalender Publik</h1>
                    <p class="text-sm text-slate-500">Event pada halaman kalender aktifitas hanya diambil dari kalender yang dipilih.</p>
                </div>
            </div>
            <x-button variant="secondary" size="md" type="link" href="{{ route('admin.agenda.login') }}" icon="rotate-right">Login Ulang</x-button>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-5 sm:p-8">
            @if(session('ok'))
                <div class="mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl text-sm">{{ session('ok') }}</div>
            @endif

            @if(session('error'))
                <div class="mb-4 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl text-sm">{{ session('error') }}</div>
            @endif

            @if(empty($calendars))
                <div class="text-center py-8 text-slate-500">
                    <i class="fas fa-calendar-xmark text-3xl mb-2"></i>
                    <p>Belum ada kalender yang bisa dipilih. Coba login ulang.</p>
                </div>
            @else
                <form action="{{ route('admin.agenda.calendars.save') }}" method="POST" class="space-y-6">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                        @foreach($calendars as $calendar)
                            @php
                                $name = is_array($calendar) ? ($calendar['name'] ?? $calendar['calendarName'] ?? '') : $calendar;
                                $label = $name !== '' ? $name : 'Kalender';
                                $isChecked = in_array($label, $selected ?? [], true);
                            @endphp
                            <label class="flex items-center gap-3 rounded-xl border border-slate-200 px-4 py-3 hover:bg-slate-50 cursor-pointer">
                                <input type="checkbox" name="selected_calendars[]" value="{{ $label }}" {{ $isChecked ? 'checked' : '' }} class="w-4 h-4 text-[#063A76] rounded">
                                <span class="text-sm font-medium text-slate-700">{{ $label }}</span>
                            </label>
                        @endforeach
                    </div>

                    <div class="flex items-center justify-between pt-4 border-t border-slate-200">
                        <x-button variant="secondary" size="md" type="link" href="{{ route('admin.calendar.index') }}">Kembali</x-button>
                        <x-button variant="primary" size="md" type="submit" icon="check">Simpan Pilihan Kalender</x-button>
                    </div>
                </form>
            @endif
        </div>
    </div>
</div>
@endsection
