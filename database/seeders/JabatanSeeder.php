<?php

namespace Database\Seeders;

use App\Models\Jabatan;
use Illuminate\Database\Seeder;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jabatans = [
            'Kepala Perpustakaan',
            'Wakil Kepala Perpustakaan',
            'Pustakawan',
            'Staf Layanan Sirkulasi',
            'Staf Layanan Referensi',
            'Staf Teknologi Informasi',
            'Staf Administrasi',
            'Security',
            'Cleaning Service'
        ];

        foreach ($jabatans as $index => $name) {
            Jabatan::create([
                'name' => $name,
                'order' => $index + 1
            ]);
        }
    }
}
