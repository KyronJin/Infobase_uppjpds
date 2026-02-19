<?php
// Load Laravel
require_once __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

// Get latest pengumuman
$pengumuman = \App\Models\Pengumuman::latest()->first();

if (!$pengumuman) {
    echo "❌ NO PENGUMUMAN FOUND\n";
    exit;
}

echo "✓ LATEST PENGUMUMAN FOUND\n";
echo "ID: " . $pengumuman->id . "\n";
echo "Title: " . $pengumuman->title . "\n";
echo "Description length: " . strlen($pengumuman->description) . " bytes\n";
echo "Has <table>: " . (strpos($pengumuman->description, '<table') !== false ? '✓ YES' : '✗ NO') . "\n";
echo "Has <th>: " . (strpos($pengumuman->description, '<th') !== false ? '✓ YES' : '✗ NO') . "\n";
echo "Has <td>: " . (strpos($pengumuman->description, '<td') !== false ? '✓ YES' : '✗ NO') . "\n";

echo "\n--- FIRST 1000 CHARS OF DESCRIPTION ---\n";
echo substr($pengumuman->description, 0, 1000) . "\n";
if (strlen($pengumuman->description) > 1000) {
    echo "\n... (" . (strlen($pengumuman->description) - 1000) . " more bytes)\n";
}

echo "\n--- LAST 5 PENGUMUMAN ---\n";
$all = \App\Models\Pengumuman::latest()->limit(5)->get();
foreach ($all as $p) {
    $hasTable = strpos($p->description, '<table') !== false;
    $tableStatus = $hasTable ? '✓ HAS TABLE' : '✗ NO TABLE';
    echo "[" . $p->id . "] " . substr($p->title, 0, 50) . " (" . strlen($p->description) . " bytes) - " . $tableStatus . "\n";
}
