<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfileRuangan extends Model
{
    protected $table = 'profile_ruangans';
    
    protected $fillable = [
        'room_name', 'floor', 'capacity', 'description', 'is_active'
    ];

    public function images()
    {
        return $this->hasMany(ProfileRuanganImage::class);
    }
}