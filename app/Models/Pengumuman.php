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
        'status',
    ];

    // Scope untuk search
    public function scopeSearch($query, $keyword)
    {
        return $query->where('title', 'like', "%{$keyword}%")
                    ->orWhere('description', 'like', "%{$keyword}%");
    }

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
        })->where('status', 'active');
    }

    // Scope untuk pengumuman yang valid berdasarkan tanggal berlaku
    public function scopeValidByDate($query)
    {
        $now = now();
        return $query->where(function ($q) use ($now) {
            $q->whereNull('valid_from')->orWhere('valid_from', '<=', $now);
        })->where(function ($q) use ($now) {
            $q->whereNull('valid_until')->orWhere('valid_until', '>=', $now);
        });
    }

    // Method untuk cek apakah pengumuman sudah expired
    public function isExpired(): bool
    {
        if ($this->valid_until === null) {
            return false;
        }
        return now() > $this->valid_until;
    }

    // Method untuk cek apakah pengumuman sudah mulai berlaku
    public function isValidStarted(): bool
    {
        if ($this->valid_from === null) {
            return true;
        }
        return now() >= $this->valid_from;
    }

    // Method untuk mendapatkan status efektif
    public function getEffectiveStatus(): string
    {
        if ($this->isExpired()) {
            return 'inactive';
        }
        return $this->status ?? 'active';
    }

    // Static method untuk update status pengumuman yang sudah expired
    public static function updateExpiredStatus()
    {
        $now = now();
        
        // Update semua pengumuman aktif yang sudah melewati valid_until menjadi inactive
        return static::where('status', 'active')
            ->where('valid_until', '<', $now)
            ->whereNotNull('valid_until')
            ->update(['status' => 'inactive']);
    }
}