<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    protected $table = 'pengumumans';

    protected $fillable = [
        'title',
        'description',
        'image_path',
        'published_at',
        'unpublished_at',
        'valid_from',
        'valid_until',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'unpublished_at' => 'datetime',
        'valid_from' => 'datetime',
        'valid_until' => 'datetime',
    ];

    // Scope untuk cek aktif berdasarkan tanggal
    public function scopeActive($query)
    {
        $now = now();
        return $query->where(function ($q) use ($now) {
            $q->whereNull('published_at')->orWhere('published_at', '<=', $now);
        })->where(function ($q) use ($now) {
            $q->whereNull('unpublished_at')->orWhere('unpublished_at', '>=', $now);
        })->where(function ($q) use ($now) {
            $q->whereNull('valid_from')->orWhere('valid_from', '<=', $now);
        })->where(function ($q) use ($now) {
            $q->whereNull('valid_until')->orWhere('valid_until', '>=', $now);
        });
    }
}