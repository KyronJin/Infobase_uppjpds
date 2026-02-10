<?php
require 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\ProfilPegawai;
use App\Models\Jabatan;
use App\Models\User;

echo "===== Test Tambah Profil Pegawai =====\n\n";

// Get first jabatan
$jabatan = Jabatan::first();
if (!$jabatan) {
    echo "ERROR: Tidak ada data jabatan!\n";
    exit(1);
}

echo "Using Jabatan: {$jabatan->name} (ID: {$jabatan->id})\n\n";

// Simulate form submission
$data = [
    'nama' => 'John Doe',
    'jabatan_id' => $jabatan->id,
    'deskripsi' => 'Seorang pustakawan berpengalaman dengan fokus pada pengembangan koleksi.',
    'foto_path' => null
];

echo "Data to insert:\n";
foreach ($data as $key => $value) {
    echo "  $key: " . ($value ?? 'NULL') . "\n";
}

try {
    $pegawai = ProfilPegawai::create($data);
    echo "\n✓ SUCCESS! Profil pegawai berhasil ditambahkan.\n";
    echo "  ID: {$pegawai->id}\n";
    echo "  Nama: {$pegawai->nama}\n";
    echo "  Jabatan ID: {$pegawai->jabatan_id}\n";
} catch (\Exception $e) {
    echo "\n✗ ERROR: " . $e->getMessage() . "\n";
    echo "Code: " . $e->getCode() . "\n";
}
