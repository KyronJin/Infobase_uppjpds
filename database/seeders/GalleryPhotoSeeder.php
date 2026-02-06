<?php

namespace Database\Seeders;

use App\Models\GalleryPhoto;
use Illuminate\Database\Seeder;

class GalleryPhotoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $photos = [
            [
                'title' => 'Gedung Perpustakaan Jakarta',
                'description' => 'Bangunan modern perpustakaan dengan arsitektur yang menarik dan fasad yang memukau',
                'image_path' => 'images/gallery/building.jpg',
                'category' => 'building',
                'is_active' => true,
                'order' => 1,
            ],
            [
                'title' => 'Area Baca Utama',
                'description' => 'Ruang baca modern dengan pencahayaan natural dan desain interior yang nyaman',
                'image_path' => 'images/gallery/reading-area-1.jpg',
                'category' => 'interior',
                'is_active' => true,
                'order' => 2,
            ],
            [
                'title' => 'Koleksi Buku',
                'description' => 'Rak-rak buku terorganisir dengan ribuan judul dari berbagai genre',
                'image_path' => 'images/gallery/books-collection.jpg',
                'category' => 'collection',
                'is_active' => true,
                'order' => 3,
            ],
            [
                'title' => 'Ruang Kolaborasi',
                'description' => 'Ruang modern untuk pembelajaran dan kolaborasi bersama dengan fasilitas lengkap',
                'image_path' => 'images/gallery/reading-area-2.jpg',
                'category' => 'interior',
                'is_active' => true,
                'order' => 4,
            ],
            [
                'title' => 'Area Layanan',
                'description' => 'Layanan administrasi dan bantuan terpadu untuk pengunjung perpustakaan',
                'image_path' => 'images/gallery/service-desk.jpg',
                'category' => 'service',
                'is_active' => true,
                'order' => 5,
            ],
            [
                'title' => 'Ruang Belajar Kelompok',
                'description' => 'Fasilitas lengkap dengan meja, kursi ergonomis untuk sesi belajar kelompok',
                'image_path' => 'images/gallery/study-room.jpg',
                'category' => 'facility',
                'is_active' => true,
                'order' => 6,
            ],
        ];

        foreach ($photos as $photo) {
            GalleryPhoto::firstOrCreate(
                ['title' => $photo['title']],
                $photo
            );
        }
    }
}
