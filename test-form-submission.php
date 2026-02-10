<?php
require 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\ProfilPegawai;
use App\Models\Jabatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

echo "===== Test Full Form Submission =====\n\n";

// Get jabatan
$jabatan = Jabatan::first();
if (!$jabatan) {
    echo "ERROR: No jabatan found\n";
    exit(1);
}

echo "Using Jabatan: {$jabatan->name}\n\n";

// Test data as if submitted from form
$formData = [
    'nama' => 'Budi Santoso',
    'jabatan_id' => (string)$jabatan->id,  // Form submits as string
    'deskripsi' => '<h2>Kepala Perpustakaan</h2><p>Berpengalaman lebih dari 10 tahun di bidang pengelolaan perpustakaan.</p>',
    'foto' => null
];

echo "TEST 1: Simulate Form Validation\n";
echo "Data:\n";
foreach ($formData as $key => $val) {
    if (is_string($val) && strlen($val) > 50) {
        echo "  $key: " . substr($val, 0, 50) . "...\n";
    } else {
        echo "  $key: " . ($val ?? 'null') . "\n";
    }
}

// Create a request-like object
$requestData = $formData;

// Simulate validation
echo "\nTEST 2: Validate Data\n";

// Check nama
if (empty($requestData['nama'])) {
    echo "✗ Nama is required\n";
    exit(1);
}
if (strlen($requestData['nama']) > 255) {
    echo "✗ Nama exceeds max length\n";
    exit(1);
}
echo "✓ Nama valid\n";

// Check jabatan_id
if (empty($requestData['jabatan_id'])) {
    echo "✗ Jabatan ID is required\n";
    exit(1);
}
$jabatanCheck = Jabatan::find($requestData['jabatan_id']);
if (!$jabatanCheck) {
    echo "✗ Jabatan ID not found\n";
    exit(1);
}
echo "✓ Jabatan ID valid\n";

// Check deskripsi
if (empty($requestData['deskripsi'])) {
    echo "✗ Deskripsi is required\n";
    exit(1);
}
// Check if deskripsi has actual text content
$plainText = strip_tags($requestData['deskripsi']);
if (strlen(trim($plainText)) === 0) {
    echo "✗ Deskripsi is empty (only tags)\n";
    exit(1);
}
echo "✓ Deskripsi valid (" . strlen(trim($plainText)) . " chars)\n";

echo "\nTEST 3: Create Pegawai\n";
try {
    $pegawai = ProfilPegawai::create([
        'nama' => $requestData['nama'],
        'jabatan_id' => $requestData['jabatan_id'],
        'deskripsi' => $requestData['deskripsi'],
    ]);
    
    echo "✓ Pegawai created successfully\n";
    echo "  ID: {$pegawai->id}\n";
    echo "  Nama: {$pegawai->nama}\n";
    echo "  Jabatan: {$pegawai->jabatan->name}\n";
    echo "  Deskripsi preview: " . substr(strip_tags($pegawai->deskripsi), 0, 50) . "...\n";
    
} catch (\Exception $e) {
    echo "✗ ERROR: " . $e->getMessage() . "\n";
    exit(1);
}

echo "\nTEST 4: Verify in Database\n";
$all = ProfilPegawai::all();
echo "Total pegawai: {$all->count()}\n";
foreach ($all as $p) {
    echo "  - {$p->nama} ({$p->jabatan->name})\n";
}

echo "\n===== Test Complete - Form Submission Should Work =====\n";
