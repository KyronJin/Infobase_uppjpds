<?php
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

// Simulate request to pengumuman page
$request = new \Illuminate\Http\Request();
$controller = new \App\Http\Controllers\InfobaseController();

$view = $controller->pengumuman($request);

echo "=== PAGE RENDER TEST ===\n\n";
echo "View name: " . get_class($view) . "\n";

// Get the data passed to view
$data = $view->getData();
echo "\nData passed to view:\n";
echo "- pengumumans: " . (isset($data['pengumumans']) ? 'EXISTS' : 'MISSING') . "\n";
if (isset($data['pengumumans'])) {
    echo "  - Count: " . $data['pengumumans']->count() . "\n";
    echo "  - Total: " . $data['pengumumans']->total() . "\n";
    echo "  - Items:\n";
    foreach ($data['pengumumans'] as $p) {
        echo "    - ID {$p->id}: {$p->title} (published: " . ($p->published_at ? $p->published_at->format('Y-m-d') : 'NULL') . ")\n";
    }
}
echo "- search: " . (isset($data['search']) ? "'{$data['search']}'" : "(empty)") . "\n";

echo "\n=== VIEW RENDERING ===\n";

// Try to render the view
try {
    $html = $view->render();
    echo "View rendered successfully (" . strlen($html) . " bytes)\n\n";
    
    // Check for pengumuman cards
    if (strpos($html, 'pengumuman-card') !== false) {
        preg_match_all('/pengumuman-card/', $html, $matches);
        echo "Found pengumuman-card elements: " . count($matches[0]) . "\n";
    } else {
        echo "No pengumuman-card elements found\n";
    }
    
    // Check for empty state
    if (strpos($html, 'Belum ada pengumuman') !== false) {
        echo "Page shows: 'Belum ada pengumuman' message\n";
    }
    
    if (strpos($html, 'empty-state') !== false) {
        echo "Empty state div found\n";
    }
    
    // Show first 500 chars of content-wrapper section
    $start = strpos($html, 'content-wrapper');
    if ($start !== false) {
        echo "\nContent section preview:\n";
        echo substr($html, $start, 500) . "...\n";
    }
    
} catch (\Exception $e) {
    echo "ERROR rendering view:\n";
    echo "Message: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . "\n";
    echo "Line: " . $e->getLine() . "\n";
    echo "Stack: " . substr($e->getTraceAsString(), 0, 500) . "\n";
}
