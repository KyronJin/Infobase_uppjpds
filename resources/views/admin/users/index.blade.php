@extends('layouts.app')

@section('content')
<div class="bg-[#f8fafc] min-h-screen py-6 sm:py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="mb-6 sm:mb-8 bg-white border border-slate-200 rounded-2xl p-5 sm:p-6">
            <h1 class="text-2xl sm:text-3xl font-bold text-[#063A76]">Akun Admin</h1>
            <p class="text-slate-600 mt-1">Buat akun admin baru untuk mengakses Admin Panel.</p>
        </div>

        @if(session('success'))
            <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-6 py-4 rounded-xl">
                <p class="font-semibold">{{ session('success') }}</p>
            </div>
        @endif

        @if($errors->any())
            <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-6 py-4 rounded-xl">
                <ul class="list-disc list-inside space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6 sm:gap-8">
            <div class="xl:col-span-1">
                <div class="bg-white border border-slate-200 rounded-2xl p-5 sm:p-6 shadow-sm">
                    <h2 class="text-lg font-bold text-[#063A76] mb-4">Tambah Admin Baru</h2>

                    <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-4">
                        @csrf

                        <div>
                            <label for="name" class="block text-sm font-semibold text-slate-700 mb-1.5">Nama</label>
                            <input
                                id="name"
                                name="name"
                                type="text"
                                value="{{ old('name') }}"
                                required
                                class="w-full px-4 py-2.5 border border-slate-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#063A76] focus:border-[#063A76]"
                                placeholder="Nama admin"
                            >
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-semibold text-slate-700 mb-1.5">Email</label>
                            <input
                                id="email"
                                name="email"
                                type="email"
                                value="{{ old('email') }}"
                                required
                                class="w-full px-4 py-2.5 border border-slate-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#063A76] focus:border-[#063A76]"
                                placeholder="admin@contoh.com"
                            >
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-semibold text-slate-700 mb-1.5">Password</label>
                            <input
                                id="password"
                                name="password"
                                type="password"
                                required
                                class="w-full px-4 py-2.5 border border-slate-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#063A76] focus:border-[#063A76]"
                                placeholder="Minimal 8 karakter"
                            >
                        </div>

                        <div>
                            <label for="password_confirmation" class="block text-sm font-semibold text-slate-700 mb-1.5">Konfirmasi Password</label>
                            <input
                                id="password_confirmation"
                                name="password_confirmation"
                                type="password"
                                required
                                class="w-full px-4 py-2.5 border border-slate-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#063A76] focus:border-[#063A76]"
                                placeholder="Ulangi password"
                            >
                        </div>

                        <button type="submit" class="w-full inline-flex items-center justify-center gap-2 px-5 py-3 text-white font-semibold rounded-xl bg-[#063A76] hover:bg-[#052A57] transition-colors">
                            <i class="fas fa-user-plus"></i>
                            Simpan Akun Admin
                        </button>
                    </form>
                </div>
            </div>

            <div class="xl:col-span-2">
                <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
                    <div class="px-5 sm:px-6 py-4 border-b border-slate-200">
                        <h2 class="text-lg font-bold text-[#063A76]">Daftar Akun Admin</h2>
                        <p class="text-sm text-slate-500 mt-1">Total: {{ $users->count() }} akun</p>
                    </div>

                    @if($users->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm">
                                <thead class="bg-slate-50">
                                    <tr>
                                        <th class="text-left px-5 sm:px-6 py-3 font-semibold text-slate-700">Nama</th>
                                        <th class="text-left px-5 sm:px-6 py-3 font-semibold text-slate-700">Email</th>
                                        <th class="text-left px-5 sm:px-6 py-3 font-semibold text-slate-700">Dibuat</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                        <tr class="border-t border-slate-100">
                                            <td class="px-5 sm:px-6 py-3.5 text-slate-800 font-medium">{{ $user->name }}</td>
                                            <td class="px-5 sm:px-6 py-3.5 text-slate-700">{{ $user->email }}</td>
                                            <td class="px-5 sm:px-6 py-3.5 text-slate-500">{{ optional($user->created_at)->timezone('Asia/Jakarta')->format('d M Y H:i') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="px-5 sm:px-6 py-12 text-center text-slate-500">
                            Belum ada akun admin.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
