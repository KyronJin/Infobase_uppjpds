<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function index()
    {
        // Pastikan nama file blade kamu benar (misal: resources/views/infobase.blade.php)
        // Jika nama filenya infobase.blade.php, maka tulis 'infobase'
        
        $todayOfficer = [
            'name' => 'Nama Petugas',
            'position' => 'Pustakawan Ahli',
            'image' => 'https://via.placeholder.com/150'
        ];

        $infobaseData = [
            [
                'title' => 'Layanan Sirkulasi',
                'description' => 'Informasi mengenai peminjaman dan pengembalian buku.',
                'image' => 'https://via.placeholder.com/400x225'
            ],
            // Tambahkan data lainnya di sini
        ];

        return view('nama_file_blade_kamu', compact('todayOfficer', 'infobaseData'));
    }

    public function showLogin()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ], [
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Password harus diisi.',
        ]);

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('admin.pengumuman.index'));
        }

        return back()->withErrors(['email' => '✗ Email atau password yang Anda masukkan tidak sesuai dengan data kami.'])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }
}