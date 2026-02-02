<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Show the contact form.
     */
    public function show()
    {
        return view('contact');
    }

    /**
     * Handle contact form submission.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ], [
            'name.required' => 'Nama harus diisi.',
            'name.string' => 'Nama harus berupa teks.',
            'name.max' => 'Nama maksimal 255 karakter.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.max' => 'Email maksimal 255 karakter.',
            'message.required' => 'Pesan harus diisi.',
            'message.string' => 'Pesan harus berupa teks.',
        ]);

        // For now just flash a success message. In future we can send an email or persist to DB.
        session()->flash('success', '✓ Terima kasih! Pesan Anda telah berhasil diterima. Kami akan menghubungi Anda jika diperlukan.');

        return redirect()->route('contact');
    }
}
