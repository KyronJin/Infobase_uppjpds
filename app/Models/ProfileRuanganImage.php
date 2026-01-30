<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfileRuanganImage extends Model
{
    protected $table = 'profile_ruangan_images';
    
    protected $fillable = ['profile_ruangan_id', 'image_path'];

    public function profileRuangan()
    {
        return $this->belongsTo(ProfileRuangan::class);
    }
}