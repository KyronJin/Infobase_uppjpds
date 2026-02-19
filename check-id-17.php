<?php
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$p = \App\Models\Pengumuman::find(17);
echo "ID 17 - Table should display on user page:\n";
echo "Title: " . $p->title . "\n";
echo "First 1000 chars:\n";
echo substr($p->description, 0, 1000) . "\n";
