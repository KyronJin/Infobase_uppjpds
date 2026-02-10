<?php

namespace App\Http\Middleware;

use App\Models\Pengumuman;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UpdateExpiredPengumumanStatus
{
    public function handle(Request $request, Closure $next): Response
    {
        // Update status pengumuman yang sudah expired sebelum request diproses
        Pengumuman::updateExpiredStatus();

        return $next($request);
    }
}
