<?php

require_once __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';

$container = $app->make(Illuminate\Contracts\Container\Container::class);
$container->make(Illuminate\Contracts\Http\Kernel::class)->handle(
    $request = Illuminate\Http\Request::capture()
);

// Query database
$jabatans = \App\Models\Jabatan::count();
$pegawais = \App\Models\ProfilPegawai::count();

echo "=== DATA DATABASE ===\n";
echo "Total Jabatan: $jabatans\n";
echo "Total Profil Pegawai: $pegawais\n";

if ($jabatans > 0) {
    echo "\nDaftar Jabatan:\n";
    $jabatanList = \App\Models\Jabatan::orderBy('order')->get();
    foreach ($jabatanList as $j) {
        echo "  - {$j->name} (order: {$j->order})\n";
    }
}

if ($pegawais > 0) {
    echo "\nDaftar Profil Pegawai:\n";
    $pegawaiList = \App\Models\ProfilPegawai::with('jabatan')->get();
    foreach ($pegawaiList as $p) {
        echo "  - {$p->nama} ({$p->jabatan?->name}) - File: {$p->foto_path}\n";
    }
}
