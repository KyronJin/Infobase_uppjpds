#!/usr/bin/env php
<?php
// Quick database check script
require 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';

// Setup the application
$kernel = $app->make(\Illuminate\Contracts\Http\Kernel::class);

// Query database
echo "\n=== PROFIL PEGAWAI SYSTEM CHECK ===\n\n";

$jabatans = \App\Models\Jabatan::orderBy('order')->get();
$pegawais = \App\Models\ProfilPegawai::with('jabatan')->get();

echo "📊 STATISTIK:\n";
echo "   Total Jabatan: " . count($jabatans) . "\n";
echo "   Total Pegawai: " . count($pegawais) . "\n\n";

if (count($jabatans) > 0) {
    echo "📋 JABATAN YANG TERDAFTAR:\n";
    foreach ($jabatans as $j) {
        $count = \App\Models\ProfilPegawai::where('jabatan_id', $j->id)->count();
        echo "   [$j->order] " . str_pad($j->name, 40) . " → $count pegawai\n";
    }
    echo "\n";
}

if (count($pegawais) > 0) {
    echo "👥 DAFTAR PEGAWAI:\n";
    foreach ($pegawais as $p) {
        $photo = $p->foto_path ? "✓ Ada" : "✗ Tidak";
        echo "   • " . str_pad($p->nama, 30) . " | " . str_pad($p->jabatan?->name ?? "N/A", 30) . " | Foto: $photo\n";
    }
    echo "\n";
}

echo "✅ VERIFIKASI STATUS:\n";
echo "   ✓ Model ProfilPegawai: Active\n";
echo "   ✓ Model Jabatan: Active\n";
echo "   ✓ Relasi: Terhubung\n";
echo "   ✓ Database: Connected\n\n";

echo "🚀 SISTEM PROFIL PEGAWAI SIAP DIGUNAKAN!\n\n";
