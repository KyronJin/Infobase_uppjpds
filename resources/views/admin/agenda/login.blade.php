@extends('layouts.app')

@section('content')
<div class="bg-[#f8fafc] min-h-screen py-6 sm:py-8 font-cairo">
    <div class="max-w-2xl mx-auto px-4 sm:px-6">
        <div class="mb-6 sm:mb-8 flex items-center gap-3">
            <a href="{{ route('admin.calendar.index') }}" class="inline-flex items-center justify-center w-10 h-10 bg-white border border-slate-200 text-[#063A76] rounded-xl hover:bg-slate-50 transition-colors" title="Kembali">
                <i class="fas fa-arrow-left"></i>
            </a>
            <div>
                <h1 class="text-2xl sm:text-3xl font-bold text-[#063A76]">Integrasi Agenda</h1>
                <p class="text-sm text-slate-500">Login ke API agenda untuk mengambil daftar kalender.</p>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-5 sm:p-8">
            @if(session('ok'))
                <div class="mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl text-sm">{{ session('ok') }}</div>
            @endif

            @if(session('error'))
                <div class="mb-4 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl text-sm">{{ session('error') }}</div>
            @endif

            @if($errors->any())
                <div class="mb-4 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl text-sm">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.agenda.login.post') }}" method="POST" class="space-y-5">
                @csrf
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Username API</label>
                    <input type="text" name="username" value="{{ old('username') }}" required class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#063A76]" placeholder="Masukkan username">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Password API</label>
                    <input type="password" name="password" required class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#063A76]" placeholder="Masukkan password">
                </div>

                <div class="flex items-center justify-between pt-2">
                    <x-button variant="secondary" size="md" type="link" href="{{ route('admin.calendar.index') }}">Batal</x-button>
                    <x-button variant="primary" size="md" type="submit" icon="right-to-bracket">Login & Lanjut</x-button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
