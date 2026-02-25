<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "=== Testing About Create Functionality ===\n\n";

// Simulate form request
$_POST = [
    'key' => 'test_create_' . time(),
    'title' => 'Test Create Content',
    'content' => '<p>This is test content from create form</p>',
];

echo "1. Testing with data:\n";
echo "   Key: " . $_POST['key'] . "\n";
echo "   Title: " . $_POST['title'] . "\n";
echo "   Content: " . substr($_POST['content'], 0, 50) . "...\n\n";

// Test create
echo "2. Creating about via model:\n";
try {
    $about = \App\Models\About::create([
        'key' => $_POST['key'],
        'title' => $_POST['title'],
        'content' => $_POST['content'],
        'active' => true,
    ]);
    echo "   ✓ SUCCESS! Created ID: {$about->id}\n";
    echo "   Key: {$about->key}\n";
    echo "   Title: {$about->title}\n";
    echo "   Content length: " . strlen($about->content) . " characters\n\n";
    
    // Test fetch
    echo "3. Fetching created about:\n";
    $fetched = \App\Models\About::find($about->id);
    if($fetched) {
        echo "   ✓ Fetched successfully\n";
        echo "   Key: {$fetched->key}\n";
        echo "   Title: {$fetched->title}\n";
    }
    
    // Test delete
    echo "\n4. Deleting test record:\n";
    $about->delete();
    echo "   ✓ Deleted\n";
    
} catch (\Exception $e) {
    echo "   ✗ ERROR: " . $e->getMessage() . "\n";
    echo "   Trace: " . $e->getTraceAsString() . "\n";
}

echo "\n=== Test Complete ===\n";
