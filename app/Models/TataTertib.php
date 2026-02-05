<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TataTertib extends Model
{
    protected $table = 'tata_tertibs';

    protected $fillable = [
        'jenis_tata_tertib_id',
        'content',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Scope untuk search
    public function scopeSearch($query, $keyword)
    {
        return $query->where('content', 'like', "%{$keyword}%")
                    ->orWhereHas('jenisTataTertib', function ($q) use ($keyword) {
                        $q->where('name', 'like', "%{$keyword}%");
                    });
    }

    public function jenisTataTertib()
    {
        return $this->belongsTo(JenisTataTertib::class, 'jenis_tata_tertib_id', 'id');
    }
}