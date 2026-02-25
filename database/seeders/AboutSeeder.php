<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\About;

class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        About::firstOrCreate(
            ['key' => 'profil_institusi'],
            [
                'title' => 'Profil Institusi',
                'content' => 'Perpustakaan Jakarta (UPPJPDS) adalah institusi publik yang berkomitmen untuk menyediakan akses informasi berkualitas tinggi kepada seluruh masyarakat Jakarta. Kami berfungsi sebagai pusat pembelajaran, dokumentasi, dan pemeliharaan memori kolektif masyarakat.<br><br>Dengan koleksi lengkap, fasilitas modern, dan staf yang profesional, kami menawarkan lebih dari sekadar tempat meminjam buku. Kami adalah ruang untuk belajar, berkolaborasi, berinovasi, dan terhubung dengan komunitas pengetahuan.',
                'active' => true
            ]
        );

        About::firstOrCreate(
            ['key' => 'visi_misi'],
            [
                'title' => 'Visi & Misi',
                'content' => '<h3>Visi Kami</h3><p>Menjadi pusat pengetahuan yang inklusif, inovatif, dan relevan untuk mendukung literasi dan kreativitas seluruh warga Jakarta.</p><h3>Misi Kami</h3><ul><li>Menyediakan akses informasi yang luas dan berkualitas</li><li>Mendukung pembelajaran seumur hidup</li><li>Mempromosikan literasi digital dan tradisional</li><li>Menjadi pusat komunitas untuk kolaborasi dan inovasi</li></ul>',
                'active' => true
            ]
        );
    }
}
