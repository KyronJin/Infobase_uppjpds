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
            'Direktur Utama',
            'Pustakawan',
            'Wakil Direktur',
            'Kepala Bagian',
            'Staff Layanan Sirkulasi',
            'Staff Layanan Referensi',
            'Staff',
            'Staff Teknologi Informasi',
            'Staff Administrasi',
            'Security',
            'Cleaning Service'
        ];

        foreach ($jabatans as $index => $name) {
            Jabatan::firstOrCreate(
                ['name' => $name],
                ['order' => $index + 1]
            );
        }
    }
}
