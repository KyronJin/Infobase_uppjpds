<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisTataTertib extends Model
{
    protected $table = 'jenis_tata_tertibs';

    protected $fillable = ['name'];

    public function tataTertibs()
    {
        return $this->hasMany(TataTertib::class);
    }
}