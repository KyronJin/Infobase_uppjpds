<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Pengumuman;

// Create test pengumuman with HTML table
$htmlTable = '<p>Data Karyawan:</p>' .
'<table style="width:100%; border-collapse: collapse; margin: 1rem 0; border: 1px solid #ccc;">' .
'<tr>' .
'<th style="border: 1px solid #ccc; padding: 8px; background-color: #3b82f6; color: #fff; font-weight: bold;">Nama</th>' .
'<th style="border: 1px solid #ccc; padding: 8px; background-color: #3b82f6; color: #fff; font-weight: bold;">Umur</th>' .
'<th style="border: 1px solid #ccc; padding: 8px; background-color: #3b82f6; color: #fff; font-weight: bold;">Divisi</th>' .
'</tr>' .
'<tr>' .
'<td style="border: 1px solid #ccc; padding: 8px; background-color: #fff;">Budi Santoso</td>' .
'<td style="border: 1px solid #ccc; padding: 8px; background-color: #fff;">25</td>' .
'<td style="border: 1px solid #ccc; padding: 8px; background-color: #fff;">IT</td>' .
'</tr>' .
'<tr>' .
'<td style="border: 1px solid #ccc; padding: 8px; background-color: #f9f9f9;">Ani Wijaya</td>' .
'<td style="border: 1px solid #ccc; padding: 8px; background-color: #f9f9f9;">23</td>' .
'<td style="border: 1px solid #ccc; padding: 8px; background-color: #f9f9f9;">HR</td>' .
'</tr>' .
'<tr>' .
'<td style="border: 1px solid #ccc; padding: 8px; background-color: #fff;">Citra Dewi</td>' .
'<td style="border: 1px solid #ccc; padding: 8px; background-color: #fff;">28</td>' .
'<td style="border: 1px solid #ccc; padding: 8px; background-color: #fff;">Marketing</td>' .
'</tr>' .
'</table>' .
'<p>Total: 3 karyawan</p>';

try {
    $pengumuman = Pengumuman::create([
        'title' => 'TEST EXCEL TABLE - ' . date('Y-m-d H:i:s'),
        'description' => $htmlTable,
        'status' => 'active'
    ]);
    
    echo "✓ Pengumuman created successfully with ID: " . $pengumuman->id . "\n";
    echo "Description length: " . strlen($pengumuman->description) . " characters\n";
    echo "Contains <table>: " . (strpos($pengumuman->description, '<table') !== false ? 'YES ✓' : 'NO ✗') . "\n";
    
    // Verify retrieval
    $retrieved = Pengumuman::find($pengumuman->id);
    echo "\nVerifying retrieval:\n";
    echo "Retrieved successfully: " . ($retrieved ? 'YES ✓' : 'NO ✗') . "\n";
    echo "Data intact: " . (strlen($retrieved->description) > 100 ? 'YES ✓' : 'NO ✗') . "\n";
    echo "Has table headers: " . (strpos($retrieved->description, '<th') !== false ? 'YES ✓' : 'NO ✗') . "\n";
    echo "Has table cells: " . (strpos($retrieved->description, '<td') !== false ? 'YES ✓' : 'NO ✗') . "\n";
    echo "\nTest pengumuman detail: http://localhost:8000/infobase/pengumuman-detail/" . $pengumuman->id . "\n";
    
} catch (\Exception $e) {
    echo "✗ Error: " . $e->getMessage() . "\n";
}
?>
