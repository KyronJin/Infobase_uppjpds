<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$abouts = \App\Models\About::all();
echo "Total records: " . count($abouts) . "\n";
foreach($abouts as $about) {
    echo "- ID: {$about->id}, Key: {$about->key}, Title: {$about->title}, Active: " . ($about->active ? 'Yes' : 'No') . "\n";
}
