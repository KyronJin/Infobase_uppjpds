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
        ]);

        // For now just flash a success message. In future we can send an email or persist to DB.
        session()->flash('success', 'Terima kasih — pesan Anda telah diterima. Kami akan menghubungi Anda jika diperlukan.');

        return redirect()->route('contact');
    }
}
