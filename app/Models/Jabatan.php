<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    protected $table = 'jabatans';

    protected $fillable = ['name', 'order'];

    public function profilPegawais()
    {
        return $this->hasMany(ProfilPegawai::class);
    }

    // Scope untuk order berdasarkan urutan
    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc');
    }
}