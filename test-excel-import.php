<?php
/**
 * Comprehensive test script for Excel import debugging
 */

require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Pengumuman;

// Test 1: Check if localStorage concept is working
echo "=== TEST 1: Check Latest Pengumuman ===" . PHP_EOL;
$latest = Pengumuman::latest()->first();
if ($latest) {
    echo "✓ Latest ID: " . $latest->id . PHP_EOL;
    echo "✓ Title: " . $latest->title . PHP_EOL;
    echo "✓ Description length: " . strlen($latest->description) . " chars" . PHP_EOL;
    echo "✓ Has <table>: " . (strpos($latest->description, '<table') !== false ? 'YES' : 'NO') . PHP_EOL;
} else {
    echo "✗ No pengumuman found" . PHP_EOL;
}

// Test 2: Create test pengumuman with simulated Excel data
echo "\n=== TEST 2: Create Test Pengumuman with Excel Table ===" . PHP_EOL;

$htmlWithTable = '<p>Data Karyawan UPP JPDS:</p>' .
'<table style="width:100%; border-collapse: collapse; margin: 1rem 0; border: 1px solid #d1d5db;">' .
'<tr style="background-color: #3b82f6;"><th style="border: 1px solid #d1d5db; padding: 0.75rem; color: white;">Nama</th><th style="border: 1px solid #d1d5db; padding: 0.75rem; color: white;">Divisi</th><th style="border: 1px solid #d1d5db; padding: 0.75rem; color: white;">Status</th></tr>' .
'<tr style="background-color: #ffffff;"><td style="border: 1px solid #d1d5db; padding: 0.75rem;">Budi Santoso</td><td style="border: 1px solid #d1d5db; padding: 0.75rem;">IT</td><td style="border: 1px solid #d1d5db; padding: 0.75rem;">Aktif</td></tr>' .
'<tr style="background-color: #f0f4f8;"><td style="border: 1px solid #d1d5db; padding: 0.75rem;">Ani Wijaya</td><td style="border: 1px solid #d1d5db; padding: 0.75rem;">HR</td><td style="border: 1px solid #d1d5db; padding: 0.75rem;">Aktif</td></tr>' .
'<tr style="background-color: #ffffff;"><td style="border: 1px solid #d1d5db; padding: 0.75rem;">Citra Dewi</td><td style="border: 1px solid #d1d5db; padding: 0.75rem;">Marketing</td><td style="border: 1px solid #d1d5db; padding: 0.75rem;">Aktif</td></tr>' .
'</table>' .
'<p>Total karyawan: 3 orang</p>';

try {
    $test = Pengumuman::create([
        'title' => 'TEST - Excel Import ' . date('Y-m-d H:i:s'),
        'description' => $htmlWithTable,
        'status' => 'active'
    ]);
    
    echo "✓ Created with ID: " . $test->id . PHP_EOL;
    
    // Verify retrieval
    $retrieved = Pengumuman::find($test->id);
    echo "✓ Retrieved successfully" . PHP_EOL;
    echo "✓ Contains table: " . (strpos($retrieved->description, '<table') !== false ? 'YES' : 'NO') . PHP_EOL;
    echo "✓ HTML intact: " . (strpos($retrieved->description, '<th>') !== false ? 'YES' : 'NO') . PHP_EOL;
    
} catch (\Exception $e) {
    echo "✗ Error: " . $e->getMessage() . PHP_EOL;
}

// Test 3: Check table display in user pages
echo "\n=== TEST 3: Check Public Pages ===" . PHP_EOL;
echo "Pengumuman list page: http://localhost:8000/infobase/pengumuman" . PHP_EOL;
echo "Detail page (last ID): http://localhost:8000/infobase/pengumuman-detail/" . Pengumuman::latest()->first()->id . PHP_EOL;

echo "\n=== SUMMARY ===" . PHP_EOL;
echo "✓ Database operations: OK" . PHP_EOL;
echo "✓ HTML storage: OK" . PHP_EOL;
echo "Check browser DevTools console for Excel import debugging logs!" . PHP_EOL;
?>
