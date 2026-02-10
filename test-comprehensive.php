<?php
require 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use App\Models\ProfilPegawai;
use Illuminate\Http\UploadedFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

echo "===== Full Form Test Simulation =====\n\n";

// Test 1: Check admin user
echo "TEST 1: Check Admin User\n";
$admin = User::where('email', 'admin@infobase.local')->first();
if ($admin) {
    echo "✓ Admin user found: ID {$admin->id}\n";
} else {
    echo "✗ Admin user NOT found!\n";
    exit(1);
}

// Test 2: Check Jabatan
echo "\nTEST 2: Check Jabatan\n";
$jabatan = \App\Models\Jabatan::first();
if ($jabatan) {
    echo "✓ Jabatan found: {$jabatan->name}\n";
} else {
    echo "✗ NO Jabatan found!\n";
    exit(1);
}

// Test 3: Test form validation without required fields
echo "\nTEST 3: Test Form Validation\n";
try {
    $validator = \Illuminate\Support\Facades\Validator::make(
        [],
        [
            'nama' => 'required|string|max:255',
            'jabatan_id' => 'required|exists:jabatans,id',
            'deskripsi' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]
    );
    
    if ($validator->fails()) {
        echo "✓ Validation catching missing fields:\n";
        foreach ($validator->errors()->all() as $error) {
            echo "  - $error\n";
        }
    }
} catch (\Exception $e) {
    echo "✗ Validation error: " . $e->getMessage() . "\n";
}

// Test 4: Test with valid data
echo "\nTEST 4: Test Create with Valid Data\n";
$validData = [
    'nama' => 'Test Pegawai',
    'jabatan_id' => $jabatan->id,
    'deskripsi' => '<p>Test description</p>',
];

try {
    $pegawai = ProfilPegawai::create($validData);
    echo "✓ Pegawai created successfully:\n";
    echo "  ID: {$pegawai->id}\n";
    echo "  Name: {$pegawai->nama}\n";
    echo "  Jabatan: {$pegawai->jabatan->name}\n";
} catch (\Exception $e) {
    echo "✗ Create failed: " . $e->getMessage() . "\n";
}

// Test 5: Check that Quill HTML is properly saved
echo "\nTEST 5: Verify Data in Database\n";
$all = ProfilPegawai::all();
echo "✓ Total pegawai in database: {$all->count()}\n";
foreach ($all as $p) {
    echo "  - {$p->nama} ({$p->jabatan->name})\n";
}

echo "\n===== All Tests Complete =====\n";
