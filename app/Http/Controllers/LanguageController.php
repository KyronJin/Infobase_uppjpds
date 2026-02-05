<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function switchLanguage($locale)
    {
        // Check if locale is supported
        if (in_array($locale, ['id', 'en'])) {
            // Set the application locale
            App::setLocale($locale);
            
            // Store the locale in session
            Session::put('locale', $locale);
        }
        
        // Redirect back to previous page
        return redirect()->back();
    }
}