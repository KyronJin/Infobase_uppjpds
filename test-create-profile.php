<?php
// Simple test to check if ProfileRuangan save works

require 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$request = Illuminate\Http\Request::create('/test', 'GET');
$response = $kernel->handle($request);

// Get a database connection
$db = $app['db'];

// Check if table exists and schema
try {
    $columns = $db->getSchemaBuilder()->getColumnListing('profile_ruangan_images');
    echo "profile_ruangan_images columns:\n";
    print_r($columns);
    echo "\n\nTable exists: YES\n";
    
    // Try to create test record
    $app['db']->table('profile_ruangan_images')->insert([
        'profile_ruangan_id' => 1,
        'slot' => 1,
        'image_path' => 'test/image.jpg',
        'created_at' => now(),
        'updated_at' => now(),
    ]);
    echo "Test insert: SUCCESS\n";
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . "\n";
    echo "Line: " . $e->getLine() . "\n";
}
?>
