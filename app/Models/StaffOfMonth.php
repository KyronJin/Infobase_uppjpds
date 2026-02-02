<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffOfMonth extends Model
{
    use HasFactory;

    protected $table = 'staff_of_months';

    protected $fillable = ['name', 'position', 'month', 'year', 'bio', 'photo_path', 'photo_link', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
