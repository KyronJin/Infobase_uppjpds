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
}
