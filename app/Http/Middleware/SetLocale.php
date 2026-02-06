<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if locale is set in session
        if (Session::has('locale')) {
            $locale = Session::get('locale');
            if (in_array($locale, ['id', 'en'])) {
                App::setLocale($locale);
            } else {
                // Set default if invalid locale
                App::setLocale('id');
                Session::put('locale', 'id');
            }
        } else {
            // Set default locale to Indonesian
            App::setLocale('id');
            Session::put('locale', 'id');
        }

        return $next($request);
    }
}
