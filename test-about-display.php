<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "=== Testing About Display in Public Page ===\n\n";

// 1. Check existing data
echo "1. Checking existing About data:\n";
$abouts = \App\Models\About::where('active', true)->get();
echo "   Total active records: " . count($abouts) . "\n";
foreach($abouts as $about) {
    echo "   - {$about->key}: {$about->title}\n";
}

// 2. Create test content
echo "\n2. Creating test content:\n";
$testKey = 'test_display_' . time();
$testAbout = \App\Models\About::create([
    'key' => $testKey,
    'title' => 'Test Display Section',
    'content' => '<h3>This is a test section</h3><p>This content should appear on the about page</p>',
    'active' => true,
]);
echo "   ✓ Created: {$testAbout->key}\n";

// 3. Verify route logic
echo "\n3. Simulating route logic:\n";

// Get all active about content from database
$allAbouts = \App\Models\About::where('active', true)->get();

// Get specific content for sections
$aboutContent = $allAbouts->firstWhere('key', 'profil_institusi');
$visiMisiContent = $allAbouts->firstWhere('key', 'visi_misi');

echo "   ✓ About Content (Profil Institusi):\n";
if($aboutContent) {
    echo "     - Title: {$aboutContent->title}\n";
    echo "     - Content preview: " . substr(strip_tags($aboutContent->content), 0, 60) . "...\n";
}

echo "   ✓ Visi Misi Content:\n";
if($visiMisiContent) {
    echo "     - Title: {$visiMisiContent->title}\n";
    echo "     - Content preview: " . substr(strip_tags($visiMisiContent->content), 0, 60) . "...\n";
}

echo "   ✓ Custom content (for display in custom section):\n";
$customAbouts = $allAbouts->filter(function($about) {
    return !in_array($about->key, ['profil_institusi', 'visi_misi']);
});
echo "     Count: " . count($customAbouts) . "\n";
foreach($customAbouts as $custom) {
    echo "     - {$custom->key}: {$custom->title}\n";
}

// 4. Cleanup
echo "\n4. Cleaning up test data:\n";
$testAbout->delete();
echo "   ✓ Test record deleted\n";

echo "\n=== Test Complete ===\n";
echo "\nNow test on browser:\n";
echo "1. Go to http://127.0.0.1:8000/about\n";
echo "2. Check if data appears in the sections\n";
echo "3. Profil Institusi section should show the #profil_institusi content\n";
echo "4. Vision section should show #visi_misi content\n";
echo "5. Any other content should appear in 'Additional Sections' area\n";
