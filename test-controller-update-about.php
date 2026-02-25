<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AboutController;

echo "=== Testing Edit Through Controller ===\n\n";

// Get test record
$about = \App\Models\About::where('key', 'sejarah_pepustakaan_jakarta')->first();
if(!$about) {
    echo "✗ Test record not found\n";
    exit;
}

echo "1. Original State:\n";
echo "   ID: {$about->id}\n";
echo "   Key: {$about->key}\n";
echo "   Content: " . substr(strip_tags($about->content), 0, 60) . "...\n";

// Create mock request
$updateData = [
    'title' => 'SEJARAH EDITED - ' . time(),
    'content' => '<h2>Sejarah EDITED</h2><p>This is edited content</p>',
];

echo "\n2. Update Data:\n";
echo "   New Title: {$updateData['title']}\n";
echo "   New Content: " . substr($updateData['content'], 0, 50) . "...\n";

// Create request
$request = new Request($updateData);

echo "\n3. Calling Controller Update:\n";

try {
    // Validate
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required|string',
    ]);
    echo "   ✓ Validation passed\n";
    
    // Update
    $about->update($validated);
    echo "   ✓ Updated in database\n";
    
    // Verify
    $check = \App\Models\About::find($about->id);
    echo "   ✓ Title changed: " . ($check->title === $updateData['title'] ? 'YES' : 'NO') . "\n";
    echo "   ✓ Content changed: " . (strpos($check->content, 'EDITED') !== false ? 'YES' : 'NO') . "\n";
    
    echo "\n4. Route Query Test:\n";
    $routeAbouts = \App\Models\About::where('active', true)->get();
    $found = $routeAbouts->firstWhere('key', 'sejarah_pepustakaan_jakarta');
    echo "   ✓ Found in query: " . ($found ? 'YES' : 'NO') . "\n";
    echo "   Updated in query: " . (strpos($found->content, 'EDITED') !== false ? 'YES' : 'NO') . "\n";
    
} catch (\Exception $e) {
    echo "   ✗ Error: " . $e->getMessage() . "\n";
}

echo "\n=== Controller Test Complete ===\n";
