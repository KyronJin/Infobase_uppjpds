<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfilPegawai extends Model
{
    protected $table = 'profil_pegawais';

    protected $fillable = [
        'nama',
        'jabatan_id',
        'deskripsi',
        'foto_path',
    ];

    // Scope untuk search
    public function scopeSearch($query, $keyword)
    {
        return $query->where('nama', 'like', "%{$keyword}%")
                    ->orWhere('deskripsi', 'like', "%{$keyword}%")
                    ->orWhereHas('jabatan', function ($q) use ($keyword) {
                        $q->where('name', 'like', "%{$keyword}%");
                    });
    }

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class);
    }
}