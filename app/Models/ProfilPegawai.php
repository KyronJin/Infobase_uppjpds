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

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class);
    }
}