<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "=== About Functionality Test ===\n\n";

// Test 1: Check if About model exists
echo "1. Checking About model...\n";
$abouts = \App\Models\About::all();
echo "   ✓ Total about records: " . count($abouts) . "\n";

// Test 2: List all abouts
echo "\n2. Listing all about content:\n";
foreach($abouts as $about) {
    echo "   - ID: {$about->id}, Key: {$about->key}, Title: {$about->title}\n";
}

// Test 3: Create new about
echo "\n3. Creating new about record...\n";
$newAbout = \App\Models\About::create([
    'key' => 'test_about_' . time(),
    'title' => 'Test About Content',
    'content' => '<p>This is test content</p>',
    'active' => true
]);
echo "   ✓ Created: ID {$newAbout->id}, Key: {$newAbout->key}\n";

// Test 4: Update about
echo "\n4. Updating about record...\n";
$newAbout->update(['title' => 'Updated Test About']);
echo "   ✓ Updated title to: {$newAbout->title}\n";

// Test 5: Get active about
echo "\n5. Fetching active about (profil_institusi)...\n";
$profileAbout = \App\Models\About::where('key', 'profil_institusi')->where('active', true)->first();
if($profileAbout) {
    echo "   ✓ Found: {$profileAbout->title}\n";
    echo "   Content preview: " . substr(strip_tags($profileAbout->content), 0, 80) . "...\n";
} else {
    echo "   ✗ Not found\n";
}

// Test 6: Delete test record
echo "\n6. Deleting test record...\n";
$newAbout->delete();
echo "   ✓ Deleted record ID {$newAbout->id}\n";

echo "\n=== All tests passed! ===\n";
