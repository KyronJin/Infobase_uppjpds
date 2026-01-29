<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TataTertib extends Model
{
    protected $table = 'tata_tertibs';

    protected $fillable = [
        'title',
        'content',
        'document_link',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
