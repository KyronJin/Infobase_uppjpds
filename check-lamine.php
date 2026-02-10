<?php
chdir(__DIR__);
require 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$pegawai = \App\Models\ProfilPegawai::where('nama', 'like', '%lamine%')->first();

if($pegawai) {
    echo "Nama: " . $pegawai->nama . PHP_EOL;
    echo "Foto Path: " . $pegawai->foto_path . PHP_EOL;
    
    $filepath = 'storage/app/' . $pegawai->foto_path;
    echo "Full path: " . __DIR__ . '/' . $filepath . PHP_EOL;
    echo "File exists: " . (file_exists($filepath) ? 'YES' : 'NO') . PHP_EOL;
    
    if(file_exists($filepath)) {
        $size = getimagesize($filepath);
        echo "Image dimensions: " . $size[0] . 'x' . $size[1] . PHP_EOL;
        echo "File size: " . filesize($filepath) . " bytes" . PHP_EOL;
    }
} else {
    echo "Pegawai tidak ditemukan" . PHP_EOL;
    echo "All pegawai:" . PHP_EOL;
    $all = \App\Models\ProfilPegawai::all();
    foreach($all as $p) {
        echo "- " . $p->nama . " (" . $p->foto_path . ")" . PHP_EOL;
    }
}
?>
