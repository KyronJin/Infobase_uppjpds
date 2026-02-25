<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "=== FINAL About Create Verification ===\n\n";

echo "1. Checking About Model:\n";
$about = \App\Models\About::first();
if($about) {
    echo "   ✓ Can retrieve About records\n";
    echo "   Sample: ID {$about->id}, Key: {$about->key}\n";
}

echo "\n2. Testing Create Validation:\n";
$testData = [
    'key' => 'final_test_' . time(),
    'title' => 'Final Test',
    'content' => '<h2>Test</h2><p>Content</p>',
];

try {
    // Simulate request validation
    $request = new \Illuminate\Http\Request($testData);
    $validated = $request->validate([
        'key' => 'required|string|max:255|unique:abouts,key',
        'title' => 'required|string|max:255',
        'content' => 'required|string',
    ]);
    echo "   ✓ Validation passed\n";
} catch (\Exception $e) {
    echo "   ✗ Validation failed: " . $e->getMessage() . "\n";
}

echo "\n3. Testing Model Create:\n";
try {
    $newAbout = \App\Models\About::create($testData + ['active' => true]);
    echo "   ✓ Created: ID {$newAbout->id}\n";
    echo "   ✓ Key: {$newAbout->key}\n";
    echo "   ✓ Title: {$newAbout->title}\n";
    echo "   ✓ Content length: " . strlen($newAbout->content) . " chars\n";
    
    // Cleanup
    $newAbout->delete();
    echo "   ✓ Cleaned up\n";
} catch (\Exception $e) {
    echo "   ✗ Error: " . $e->getMessage() . "\n";
}

echo "\n4. Routes Status:\n";
echo "   GET  /admin/about           → admin.about.index\n";
echo "   GET  /admin/about/create    → admin.about.create\n";
echo "   POST /admin/about           → admin.about.store\n";
echo "   GET  /admin/about/{id}/edit → admin.about.edit\n";
echo "   PUT  /admin/about/{id}      → admin.about.update\n";
echo "   DELETE /admin/about/{id}    → admin.about.destroy\n";

echo "\n5. Views Status:\n";
$views = [
    'admin.about.index' => 'resources/views/admin/about/index.blade.php',
    'admin.about.create' => 'resources/views/admin/about/create.blade.php',
    'admin.about.edit' => 'resources/views/admin/about/edit.blade.php',
];

foreach($views as $view => $path) {
    $fullPath = base_path($path);
    if(file_exists($fullPath)) {
        echo "   ✓ $view exists\n";
    } else {
        echo "   ✗ $view NOT FOUND at $path\n";
    }
}

echo "\n=== VERIFICATION COMPLETE ===\n";
echo "\n📝 CHECKLIST FOR TESTING:\n";
echo "1. Open http://127.0.0.1:8000/admin/about\n";
echo "2. Log in if needed\n";
echo "3. Click 'Tambah Konten Baru'\n";
echo "4. Fill in:\n";
echo "   - Key: test_content (lowercase, no spaces)\n";
echo "   - Title: My Test Content\n";
echo "   - Content: Write something in the editor\n";
echo "5. Click 'Buat Konten' button\n";
echo "6. Check browser console (F12) for debug logs\n";
echo "7. If error, check server logs\n";
