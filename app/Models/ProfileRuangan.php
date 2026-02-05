<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfileRuangan extends Model
{
    protected $table = 'profile_ruangans';
    
    protected $fillable = [
        'room_name', 'floor', 'capacity', 'description', 'is_active'
    ];

    // Scope untuk search
    public function scopeSearch($query, $keyword)
    {
        return $query->where('room_name', 'like', "%{$keyword}%")
                    ->orWhere('description', 'like', "%{$keyword}%")
                    ->orWhere('floor', 'like', "%{$keyword}%");
    }

    public function images()
    {
        return $this->hasMany(ProfileRuanganImage::class);
    }
}