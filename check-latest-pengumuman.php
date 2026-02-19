<?php
require __DIR__ . '/vendor/autoload.php';

$app = require __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$latest = \App\Models\Pengumuman::latest('id')->first();
echo "=== LATEST PENGUMUMAN ===\n";
echo "ID: " . $latest->id . "\n";
echo "Title: " . $latest->title . "\n";
echo "Created: " . $latest->created_at . "\n";
echo "Content length: " . strlen($latest->description) . " bytes\n";
echo "Has <table>: " . (strpos($latest->description, '<table') !== false ? "YES ✓" : "NO ✗") . "\n";
echo "Has <tr>: " . (strpos($latest->description, '<tr') !== false ? "YES ✓" : "NO ✗") . "\n";
echo "Has <td>: " . (strpos($latest->description, '<td') !== false ? "YES ✓" : "NO ✗") . "\n";
echo "\nFirst 300 chars:\n";
echo substr($latest->description, 0, 300) . "\n";
echo "\nLast 300 chars:\n";
echo substr($latest->description, -300) . "\n";
