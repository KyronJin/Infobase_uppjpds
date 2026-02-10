<?php
require 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Http\Request;
use App\Http\Controllers\ProfilPegawaiController;
use App\Models\Jabatan;

echo "===== Test Form Submission with Controller =====\n\n";

// Get first jabatan
$jabatan = Jabatan::first();
if (!$jabatan) {
    echo "ERROR: No jabatan found\n";
    exit(1);
}

echo "Using Jabatan: {$jabatan->name} (ID: {$jabatan->id})\n\n";

// Create a mock request
$requestData = [
    'nama' => 'Rina Wijaya',
    'jabatan_id' => (string)$jabatan->id,
    'deskripsi' => '<p><strong>Seorang pustakawan</strong> profesional dengan pengalaman lebih dari 5 tahun.</p>',
];

echo "TEST: Simulating Form Request\n";
echo "Data to submit:\n";
foreach ($requestData as $key => $val) {
    if (is_string($val) && strlen($val) > 80) {
        echo "  $key: " . substr($val, 0, 80) . "...\n";
    } else {
        echo "  $key: " . $val . "\n";
    }
}

try {
    // Create a request object
    $request = Request::create('/admin/profil-pegawai', 'POST', $requestData);
    
    // Create controller instance
    $controller = new ProfilPegawaiController();
    
    // Call store method
    echo "\nCalling store() method...\n";
    $response = $controller->store($request);
    
    echo "✓ Store method executed\n";
    echo "Response type: " . get_class($response) . "\n";
    
    if (method_exists($response, 'getStatusCode')) {
        echo "Response status: " . $response->getStatusCode() . "\n";
    }
    
    if (method_exists($response, 'getTargetUrl')) {
        echo "Redirect URL: " . $response->getTargetUrl() . "\n";
    }
    
} catch (\Illuminate\Validation\ValidationException $e) {
    echo "\n✗ VALIDATION ERROR:\n";
    foreach ($e->errors() as $field => $errors) {
        foreach ($errors as $error) {
            echo "  - $field: $error\n";
        }
    }
} catch (\Exception $e) {
    echo "\n✗ ERROR: " . $e->getMessage() . "\n";
    echo "Type: " . get_class($e) . "\n";
    echo "File: " . $e->getFile() . " (Line " . $e->getLine() . ")\n";
    echo "\nStack trace:\n";
    echo $e->getTraceAsString() . "\n";
}

// Verify in database
echo "\n\nVERIFY: Check database\n";
$all = \App\Models\ProfilPegawai::all();
echo "Total pegawai in database: {$all->count()}\n";
foreach ($all as $p) {
    echo "  - {$p->nama} ({$p->jabatan->name})\n";
}
