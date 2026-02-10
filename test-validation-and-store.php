<?php
require 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Validator;
use App\Models\Jabatan;
use App\Models\ProfilPegawai;

echo "===== Test Form Validation & Store =====\n\n";

// Get first jabatan
$jabatan = Jabatan::first();
if (!$jabatan) {
    echo "ERROR: No jabatan found\n";
    exit(1);
}

echo "Using Jabatan: {$jabatan->name} (ID: {$jabatan->id})\n\n";

// Test data
$formData = [
    'nama' => 'Siti Nurhaliza',
    'jabatan_id' => (string)$jabatan->id,
    'deskripsi' => '<p>Kepala Perpustakaan dengan pengalaman lebih dari 15 tahun.</p>',
];

echo "TEST 1: Validation\n";
echo "Data:\n";
foreach ($formData as $key => $val) {
    if (is_string($val) && strlen($val) > 60) {
        echo "  $key: " . substr($val, 0, 60) . "...\n";
    } else {
        echo "  $key: " . $val . "\n";
    }
}

// Validate
$validator = Validator::make($formData, [
    'nama' => 'required|string|max:255',
    'jabatan_id' => 'required|exists:jabatans,id',
    'deskripsi' => 'required|string',
    'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
], [
    'nama.required' => 'Nama pegawai harus diisi.',
    'nama.string' => 'Nama pegawai harus berupa teks.',
    'nama.max' => 'Nama pegawai maksimal 255 karakter.',
    'jabatan_id.required' => 'Jabatan harus dipilih.',
    'jabatan_id.exists' => 'Jabatan yang dipilih tidak valid.',
    'deskripsi.required' => 'Deskripsi pegawai harus diisi.',
    'deskripsi.string' => 'Deskripsi pegawai harus berupa teks.',
    'foto.image' => 'File harus berupa gambar.',
    'foto.mimes' => 'Format gambar harus JPEG, PNG, JPG, atau GIF.',
    'foto.max' => 'Ukuran gambar maksimal 2MB.',
]);

if ($validator->fails()) {
    echo "\n✗ Validation FAILED:\n";
    foreach ($validator->errors()->all() as $error) {
        echo "  - $error\n";
    }
    exit(1);
} else {
    echo "\n✓ Validation PASSED\n";
}

echo "\nTEST 2: Create Record\n";
try {
    // Get validated data
    $validated = $validator->validated();
    
    // Create the record
    $pegawai = ProfilPegawai::create($validated);
    
    echo "✓ Record created successfully\n";
    echo "  ID: {$pegawai->id}\n";
    echo "  Nama: {$pegawai->nama}\n";
    echo "  Jabatan ID: {$pegawai->jabatan_id}\n";
    echo "  Jabatan Name: {$pegawai->jabatan->name}\n";
    
} catch (\Exception $e) {
    echo "✗ Create FAILED: " . $e->getMessage() . "\n";
    exit(1);
}

echo "\nTEST 3: Verify Database\n";
$all = ProfilPegawai::all();
echo "Total pegawai: {$all->count()}\n";
foreach ($all as $p) {
    echo "  - {$p->nama} ({$p->jabatan->name})\n";
}

echo "\n✓ ALL TESTS PASSED\n";
echo "Form submission should work correctly now!\n";
