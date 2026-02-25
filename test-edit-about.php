<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "=== Testing EDIT Functionality ===\n\n";

// 1. Get existing record
echo "1. Getting existing record:\n";
$about = \App\Models\About::where('key', 'profil_institusi')->first();
if($about) {
    echo "   ✓ Found: ID {$about->id}\n";
    echo "   Current Title: {$about->title}\n";
    echo "   Current Content: " . substr(strip_tags($about->content), 0, 50) . "...\n";
} else {
    echo "   ✗ Not found\n";
    exit;
}

// 2. Simulate edit/update
echo "\n2. Testing Update:\n";
$oldContent = $about->content;
$newContent = '<p>✓ UPDATED CONTENT - ' . date('Y-m-d H:i:s') . '</p>';

$about->update([
    'content' => $newContent
]);
echo "   ✓ Update called\n";

// 3. Verify update in database
echo "\n3. Verifying in Database:\n";
$refreshed = \App\Models\About::find($about->id);
echo "   Updated at: " . $refreshed->updated_at . "\n";
echo "   Content matches: " . ($refreshed->content === $newContent ? '✓' : '✗') . "\n";
echo "   New content: " . substr($refreshed->content, 0, 80) . "...\n";

// 4. Test in route context
echo "\n4. Testing Route Query:\n";
$routeQuery = \App\Models\About::where('active', true)->get();
$found = $routeQuery->firstWhere('key', 'profil_institusi');
if($found) {
    echo "   ✓ Found in route query\n";
    echo "   Content in query: " . substr($found->content, 0, 80) . "...\n";
    echo "   Matches updated: " . ($found->content === $newContent ? '✓' : '✗') . "\n";
}

// 5. Restore original
echo "\n5. Restoring Original:\n";
$about->update(['content' => $oldContent]);
echo "   ✓ Restored\n";

echo "\n=== Test Complete ===\n";
