<?php

namespace Database\Seeders;

use App\Models\Jabatan;
use App\Models\ProfilPegawai;
use Illuminate\Database\Seeder;

class ProfilPegawaiSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat Jabatan sesuai struktur org chart
        $jabatans = [
            ['name' => 'Kepala Perpustakaan', 'order' => 1],
            ['name' => 'Direktur Utama', 'order' => 2],
            ['name' => 'Wakil Direktur', 'order' => 3],
            ['name' => 'Kepala Bagian', 'order' => 4],
            ['name' => 'Staff', 'order' => 5],
        ];

        $createdJabatans = [];
        foreach ($jabatans as $jabatanData) {
            $createdJabatans[$jabatanData['name']] = Jabatan::firstOrCreate(
                ['name' => $jabatanData['name']],
                ['order' => $jabatanData['order']]
            );
        }

        // 2. Buat Profil Pegawai sesuai struktur org chart (dari diagram)
        $profilesData = [
            // Level 1: Kepala Perpustakaan
            [
                'nama' => 'Prof. Ahmad Syaiful',
                'jabatan_id' => $createdJabatans['Kepala Perpustakaan']->id,
                'deskripsi' => 'Kepala Perpustakaan dengan pengalaman lebih dari 20 tahun di institusi pendidikan.'
            ],
            
            // Level 2: Direktur Utama & Komisi
            [
                'nama' => 'Dewan Komisaris',
                'jabatan_id' => $createdJabatans['Direktur Utama']->id,
                'deskripsi' => 'Board dewan komisaris yang mengawasi operasional perpustakaan.'
            ],
            [
                'nama' => 'Komite Nominasi & Remunerasi',
                'jabatan_id' => $createdJabatans['Direktur Utama']->id,
                'deskripsi' => 'Tim yang menangani nominasi dan remunerasi staf.'
            ],
            [
                'nama' => 'Komite Audit',
                'jabatan_id' => $createdJabatans['Direktur Utama']->id,
                'deskripsi' => 'Tim audit internal untuk menjamin kualitas layanan.'
            ],

            // Level 3: Direktur Utama & Wakil
            [
                'nama' => 'Noersing Handoko',
                'jabatan_id' => $createdJabatans['Wakil Direktur']->id,
                'deskripsi' => 'Direktur Utama yang memimpin operasional harian perpustakaan.'
            ],
            [
                'nama' => 'Kanil Mirdlani Imansyah',
                'jabatan_id' => $createdJabatans['Wakil Direktur']->id,
                'deskripsi' => 'Wakil Direktur Utama untuk operasional administrasi.'
            ],

            // Level 4: Middle Management
            [
                'nama' => 'Ahmad Alfariz',
                'jabatan_id' => $createdJabatans['Kepala Bagian']->id,
                'deskripsi' => 'Sekretaris Perusahaan yang mengelola administrasi kantor pusat.'
            ],
            [
                'nama' => 'Luthان Fadel Putra',
                'jabatan_id' => $createdJabatans['Kepala Bagian']->id,
                'deskripsi' => 'Manajer Hubungan Investor yang menangani investor relations.'
            ],
            [
                'nama' => 'Christophorus Taufik',
                'jabatan_id' => $createdJabatans['Kepala Bagian']->id,
                'deskripsi' => 'Legal Perusahaan yang menangani aspek hukum.'
            ],
            [
                'nama' => 'Roy Shandy Darmin',
                'jabatan_id' => $createdJabatans['Kepala Bagian']->id,
                'deskripsi' => 'Kepala Audit Internal untuk pengawasan kualitas.'
            ],

            // Level 5: Direktur & Staff
            [
                'nama' => 'Helmi Balfas',
                'jabatan_id' => $createdJabatans['Staff']->id,
                'deskripsi' => 'Direktur Perpustakaan dengan fokus pada pengembangan koleksi.'
            ],
            [
                'nama' => 'Lina P. Tanaya',
                'jabatan_id' => $createdJabatans['Staff']->id,
                'deskripsi' => 'Direktur Layanan yang bertanggung jawab atas pengalaman pengguna.'
            ],
            [
                'nama' => 'Valencia H. Tandosoedjno',
                'jabatan_id' => $createdJabatans['Staff']->id,
                'deskripsi' => 'Direktur Teknologi Informasi untuk sistem dan infrastruktur.'
            ],
            [
                'nama' => 'Dewi Tembaga',
                'jabatan_id' => $createdJabatans['Staff']->id,
                'deskripsi' => 'Direktur Keuangan yang mengelola budget dan laporan keuangan.'
            ],
            [
                'nama' => 'Titan Hermawan',
                'jabatan_id' => $createdJabatans['Staff']->id,
                'deskripsi' => 'Direktur Pengembangan yang mengurus program pengembangan staf.'
            ],
            [
                'nama' => 'Tantan Sumartana',
                'jabatan_id' => $createdJabatans['Staff']->id,
                'deskripsi' => 'Direktur Operasional yang mengkoordinasikan seluruh operasi.'
            ],
        ];

        // 3. Simpan semua profil pegawai
        foreach ($profilesData as $profileData) {
            ProfilPegawai::firstOrCreate(
                ['nama' => $profileData['nama']],
                $profileData
            );
        }

        $this->command->info('✅ ProfilPegawai seeder berhasil dijalankan!');
        $this->command->info('   - ' . count($createdJabatans) . ' Jabatan dibuat');
        $this->command->info('   - ' . count($profilesData) . ' Profil Pegawai dibuat');
    }
}
