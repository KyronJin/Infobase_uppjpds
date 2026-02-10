<?php
require 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Jabatan;
use App\Models\ProfilPegawai;

echo "===== Database Check =====\n\n";

// Check Jabatan
echo "Jabatan Records:\n";
$jabatans = Jabatan::all();
echo "Total: " . $jabatans->count() . "\n";
foreach ($jabatans as $j) {
    echo "- ID: {$j->id}, Name: {$j->name}, Order: {$j->order}\n";
}

echo "\nProfilPegawai Records:\n";
$profiles = ProfilPegawai::all();
echo "Total: " . $profiles->count() . "\n";

echo "\n===== Setup Complete =====\n";
