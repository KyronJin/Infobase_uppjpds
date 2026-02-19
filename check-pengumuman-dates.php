<?php
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "=== CHECKING ALL PENGUMUMAN DATES ===\n\n";

$all = \App\Models\Pengumuman::latest()->limit(10)->get();

$now = now();
echo "Current time: " . $now->format('Y-m-d H:i:s') . "\n\n";

foreach ($all as $p) {
    echo "ID: {$p->id}\n";
    echo "Title: " . substr($p->title, 0, 50) . "\n";
    echo "Published: " . ($p->published_at ? $p->published_at->format('Y-m-d H:i:s') : 'NULL') . "\n";
    echo "Valid From: " . ($p->valid_from ? $p->valid_from->format('Y-m-d H:i:s') : 'NULL') . "\n";
    echo "Valid Until: " . ($p->valid_until ? $p->valid_until->format('Y-m-d H:i:s') : 'NULL') . "\n";
    
    // Check if it passes validByDate scope
    $passValidFrom = is_null($p->valid_from) || $p->valid_from <= $now;
    $passValidUntil = is_null($p->valid_until) || $p->valid_until >= $now;
    $passes = $passValidFrom && $passValidUntil;
    
    echo "Passes validByDate scope: " . ($passes ? "✓ YES" : "✗ NO") . "\n";
    if (!$passes) {
        if (!$passValidFrom) echo "  → Reason: valid_from is in the future\n";
        if (!$passValidUntil) echo "  → Reason: valid_until is in the past\n";
    }
    
    echo "\n";
}

echo "\n=== SUMMARY ===\n";
$visible = \App\Models\Pengumuman::validByDate()->count();
$total = \App\Models\Pengumuman::count();
echo "Visible pengumuman: $visible\n";
echo "Total pengumuman: $total\n";
echo "Hidden pengumuman: " . ($total - $visible) . "\n";
