<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryPhoto extends Model
{
    protected $table = 'gallery_photos';

    protected $fillable = [
        'title',
        'description',
        'image_path',
        'category',
        'location',
        'is_active',
        'order',
        'button_text',
        'button_link',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    public function scopeByLocation($query, $location)
    {
        return $query->where('location', $location);
    }

    /**
     * Scope untuk mendapatkan foto hero banner
     * Menampilkan foto dengan location 'hero' atau 'both'
     */
    public function scopeHero($query)
    {
        return $query->whereIn('location', ['hero', 'both'])->active();
    }

    /**
     * Scope untuk mendapatkan foto halaman beranda/home
     * Menampilkan foto dengan location 'home' atau 'both'
     */
    public function scopeHome($query)
    {
        return $query->whereIn('location', ['home', 'both'])->active();
    }

    /**
     * Scope untuk mendapatkan foto halaman about
     * Menampilkan foto dengan location 'about' atau 'both'
     */
    public function scopeAbout($query)
    {
        return $query->whereIn('location', ['about', 'both'])->active();
    }
}
