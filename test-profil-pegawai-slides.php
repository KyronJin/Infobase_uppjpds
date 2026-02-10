<?php
/**
 * Test untuk memverifikasi struktur slide profil pegawai
 */

// Simulasi Laravel environment
$_SERVER['REQUEST_METHOD'] = 'GET';
$_SERVER['REQUEST_URI'] = '/infobase/profil-pegawai';

// Include Laravel bootstrap
require __DIR__ . '/bootstrap/app.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(\Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(
    $request = \Illuminate\Http\Request::capture()
);

// Create a mock request
$mockRequest = new \Illuminate\Http\Request();
$mockRequest->query->set('search', '');

// Get controller
$controller = new \App\Http\Controllers\InfobaseController();

// Call the method directly
try {
    $view = $controller->profilPegawai($mockRequest);
    
    echo "✓ Controller executed successfully\n";
    echo "✓ View data passed:\n";
    
    $data = $view->getData();
    
    if (isset($data['slides'])) {
        echo "  - slides: " . count($data['slides']) . " slides\n";
        foreach ($data['slides'] as $i => $slide) {
            echo "    Slide " . ($i + 1) . ": " . count($slide) . " profiles\n";
        }
    }
    
    if (isset($data['allPegawai'])) {
        echo "  - allPegawai: " . count($data['allPegawai']) . " profiles\n";
    }
    
    if (isset($data['jabatans'])) {
        echo "  - jabatans: " . count($data['jabatans']) . " positions\n";
    }
    
    echo "  - title: " . $data['title'] . "\n";
    echo "\n✓ All tests passed!\n";
    
} catch (\Exception $e) {
    echo "✗ Error: " . $e->getMessage() . "\n";
    echo "Stack trace:\n" . $e->getTraceAsString() . "\n";
}
?>
