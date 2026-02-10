<?php
chdir(__DIR__);
require 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';

$kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// Get controller
$controller = new \App\Http\Controllers\InfobaseController();

// Create a mock request
$request = \Illuminate\Http\Request::create('/infobase/profil-pegawai', 'GET');

try {
    $view = $controller->profilPegawai($request);
    $data = $view->getData();
    
    echo "✓ Controller executed successfully\n";
    echo "Slides: " . count($data['slides']) . "\n";
    
    foreach($data['slides'] as $i => $slide) {
        echo "  Slide " . ($i + 1) . ": " . count($slide) . " profiles\n";
    }
    
    echo "All Pegawai: " . count($data['allPegawai']) . "\n";
    echo "Jabatans: " . count($data['jabatans']) . "\n";
    
} catch (\Exception $e) {
    echo "✗ Error: " . $e->getMessage() . "\n";
    echo "\n" . $e->getTraceAsString() . "\n";
}
?>
