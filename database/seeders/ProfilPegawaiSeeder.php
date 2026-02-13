<?php

namespace Database\Seeders;

use App\Models\Jabatan;
use App\Models\ProfilPegawai;
use Illuminate\Database\Seeder;

class ProfilPegawaiSeeder extends Seeder
{
    public function run(): void
    {
        // Buat profil pegawai sesuai struktur organisasi
        // Struktur: Kepala -> Wakil -> Direktur -> Kepala Bagian -> Staff

        $profilesData = [
            // Level 1: Kepala Perpustakaan (1 orang)
            [
                'nama' => 'Dr. Muhammad Syaiful, M.Si.',
                'jabatan' => 'Kepala Perpustakaan',
                'deskripsi' => 'Kepala Perpustakaan dengan pengalaman lebih dari 20 tahun dalam pengembangan koleksi dan manajemen perpustakaan digital.'
            ],
            
            // Level 2: Wakil Kepala Perpustakaan (1 orang)
            [
                'nama' => 'Siti Nurhaliza, S.Sos.',
                'jabatan' => 'Wakil Kepala Perpustakaan',
                'deskripsi' => 'Wakil Kepala Perpustakaan yang bertanggung jawab atas operasional harian dan layanan pengguna.'
            ],

            // Level 3: Direktur Utama (1 orang)
            [
                'nama' => 'Budi Santoso, M.A.',
                'jabatan' => 'Direktur Utama',
                'deskripsi' => 'Direktur Utama yang memimpin divisi pengembangan koleksi dan strategi jangka panjang perpustakaan.'
            ],

            // Level 4: Pustakawan (2 orang)
            [
                'nama' => 'Ema Widiyastuti, S.Sos., M.Lis.',
                'jabatan' => 'Pustakawan',
                'deskripsi' => 'Pustakawan senior dengan expertise dalam katalogisasi dan pengorganisasian metadata koleksi digital.'
            ],
            [
                'nama' => 'Rinto Harahap, S.I.Kom.',
                'jabatan' => 'Pustakawan',
                'deskripsi' => 'Pustakawan yang fokus pada pelestarian dokumen bersejarah dan digitalisasi arsip.'
            ],

            // Level 5: Wakil Direktur (1 orang)
            [
                'nama' => 'Yanita Putri, M.Ed.',
                'jabatan' => 'Wakil Direktur',
                'deskripsi' => 'Wakil Direktur yang mengelola program pelatihan dan pengembangan sumber daya manusia.'
            ],

            // Level 6: Kepala Bagian (1 orang)
            [
                'nama' => 'Hendra Wijaya, S.T.',
                'jabatan' => 'Kepala Bagian',
                'deskripsi' => 'Kepala Bagian Teknis yang mengawasi infrastruktur IT dan sistem informasi perpustakaan.'
            ],

            // Level 7: Staff Layanan Sirkulasi (2 orang)
            [
                'nama' => 'Ani Wijaya, S.Sos.',
                'jabatan' => 'Staff Layanan Sirkulasi',
                'deskripsi' => 'Staff Sirkulasi yang menangani peminjaman, pengembalian, dan administrasi koleksi fisik.'
            ],
            [
                'nama' => 'Cahyo Pratama, S.T.',
                'jabatan' => 'Staff Layanan Sirkulasi',
                'deskripsi' => 'Staff Sirkulasi yang bertanggung jawab pada manajemen inventori dan audit koleksi berkala.'
            ],

            // Level 8: Staff Layanan Referensi (2 orang)
            [
                'nama' => 'Dewi Lestari, S.I.Kom., M.Lis.',
                'jabatan' => 'Staff Layanan Referensi',
                'deskripsi' => 'Staff Referensi yang memberikan konsultasi dan bantuan pencarian informasi kepada pengguna.'
            ],
            [
                'nama' => 'Triadi Heriyanto, S.Sos.',
                'jabatan' => 'Staff Layanan Referensi',
                'deskripsi' => 'Staff Referensi yang mengembangkan panduan penelitian dan literasi informasi untuk pengguna.'
            ],

            // Level 9: Staff Umum (3 orang)
            [
                'nama' => 'Slamet Riyadi, S.T.',
                'jabatan' => 'Staff',
                'deskripsi' => 'Staff Support yang mengelola sistem database dan troubleshooting teknis perpustakaan.'
            ],
            [
                'nama' => 'Ratna Dwi Cahyani, S.I.Kom.',
                'jabatan' => 'Staff',
                'deskripsi' => 'Staff Administrasi yang menangani dokumentasi dan koordinasi program perpustakaan.'
            ],
            [
                'nama' => 'Bambang Sutrisno, A.Md.',
                'jabatan' => 'Staff',
                'deskripsi' => 'Staff Operasional yang membantu pemeliharaan fasilitas dan kebersihan ruang perpustakaan.'
            ],

            // Level 10: Staff Teknologi Informasi (1 orang)
            [
                'nama' => 'Adi Pratama, S.Kom., M.Kom.',
                'jabatan' => 'Staff Teknologi Informasi',
                'deskripsi' => 'Specialist TI yang mengembangkan dan memelihara sistem informasi perpustakaan terintegrasi.'
            ],

            // Level 11: Staff Administrasi (1 orang)
            [
                'nama' => 'Susi Handayani, A.Md.',
                'jabatan' => 'Staff Administrasi',
                'deskripsi' => 'Staff Administrasi yang menangani surat-menyurat, pengurusan izin, dan administrasi keuangan.'
            ],

            // Level 12: Security (1 orang)
            [
                'nama' => 'Pak Harno',
                'jabatan' => 'Security',
                'deskripsi' => 'Petugas keamanan yang menjaga keamanan perpustakaan dan memantau akses pengguna.'
            ],

            // Level 13: Cleaning Service (2 orang)
            [
                'nama' => 'Ibu Marni',
                'jabatan' => 'Cleaning Service',
                'deskripsi' => 'Peserta Cleaning Service yang menjaga kebersihan dan kerapian area perpustakaan.'
            ],
            [
                'nama' => 'Pak Wayan',
                'jabatan' => 'Cleaning Service',
                'deskripsi' => 'Peserta Cleaning Service yang menangani pemeliharaan halaman dan area umum perpustakaan.'
            ],
        ];

        // Simpan semua profil pegawai
        $count = 0;
        foreach ($profilesData as $data) {
            $jabatan = Jabatan::where('name', $data['jabatan'])->first();
            
            if (!$jabatan) {
                $this->command->warn("⚠️ Jabatan '{$data['jabatan']}' tidak ditemukan!");
                continue;
            }

            ProfilPegawai::firstOrCreate(
                ['nama' => $data['nama']],
                [
                    'jabatan_id' => $jabatan->id,
                    'deskripsi' => $data['deskripsi'],
                ]
            );
            $count++;
        }

        $this->command->info('✅ ProfilPegawai seeder berhasil dijalankan!');
        $this->command->info("   - {$count} Profil Pegawai dibuat/diperbarui");
    }
}
