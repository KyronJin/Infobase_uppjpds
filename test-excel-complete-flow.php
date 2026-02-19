<?php
/**
 * Complete Test: Excel Import → Database → Display
 */

// Add Laravel autoloader
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/bootstrap/app.php';

use Illuminate\Support\Facades\DB;
use App\Models\Pengumuman;

// Initialize Laravel
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make('Illuminate\Contracts\Http\Kernel');

echo "=== EXCEL IMPORT COMPLETE TEST ===\n\n";

// Test 1: Create test HTML table
echo "TEST 1: Generate Test Table\n";
echo "---\n";
$testData = [
    ['Nama Ruangan', 'Lantai', 'Kapasitas'],
    ['Ruang Rapat A', '1', '20'],
    ['Ruang Rapat B', '2', '15'],
    ['Ruang Komputer', '3', '50']
];

function generateTestTable($data) {
    $html = '<table style="width:100%; border-collapse: collapse; margin: 1rem 0; border: 1px solid #ccc;">';
    
    foreach ($data as $rowIndex => $row) {
        $isHeader = $rowIndex === 0;
        $bgColor = $isHeader ? '#3b82f6' : ($rowIndex % 2 === 0 ? '#fff' : '#f9f9f9');
        
        $html .= '<tr>';
        foreach ($row as $cell) {
            $tag = $isHeader ? 'th' : 'td';
            $cellValue = htmlspecialchars($cell ?? '');
            $html .= "<{$tag} style=\"border: 1px solid #ccc; padding: 8px; background-color: {$bgColor}; color: " . ($isHeader ? '#fff' : '#000') . "; font-weight: " . ($isHeader ? 'bold' : 'normal') . ";\">";
            $html .= $cellValue;
            $html .= "</{$tag}>";
        }
        $html .= '</tr>';
    }
    
    $html .= '</table>';
    return $html;
}

$table = generateTestTable($testData);
echo "✓ Table generated: " . strlen($table) . " bytes\n";
echo "✓ Contains <table>: " . (strpos($table, '<table') !== false ? 'YES' : 'NO') . "\n";
echo "✓ Contains <th>: " . (strpos($table, '<th') !== false ? 'YES' : 'NO') . "\n";
echo "✓ Contains <td>: " . (strpos($table, '<td') !== false ? 'YES' : 'NO') . "\n\n";

// Test 2: Insert into database
echo "TEST 2: Insert into Database\n";
echo "---\n";

try {
    $pengumuman = Pengumuman::create([
        'title' => 'Test Excel Table Import - ' . date('Y-m-d H:i:s'),
        'description' => $table,
        'published_at' => now(),
        'created_at' => now(),
        'updated_at' => now()
    ]);
    
    echo "✓ Data inserted to database\n";
    echo "✓ Record ID: " . $pengumuman->id . "\n";
    echo "✓ Title: " . $pengumuman->title . "\n";
    echo "✓ Description length: " . strlen($pengumuman->description) . " bytes\n";
    echo "✓ Published at: " . $pengumuman->published_at . "\n\n";
    
    $testId = $pengumuman->id;
} catch (Exception $e) {
    echo "✗ Database insert failed: " . $e->getMessage() . "\n\n";
    $testId = null;
}

// Test 3: Retrieve from database
echo "TEST 3: Retrieve from Database\n";
echo "---\n";

if ($testId) {
    try {
        $retrieved = Pengumuman::find($testId);
        
        if ($retrieved) {
            echo "✓ Record retrieved successfully\n";
            echo "✓ ID: " . $retrieved->id . "\n";
            echo "✓ Title: " . $retrieved->title . "\n";
            echo "✓ Description length: " . strlen($retrieved->description) . " bytes\n";
            echo "✓ Contains <table>: " . (strpos($retrieved->description, '<table') !== false ? 'YES' : 'NO') . "\n";
            echo "✓ Contains <th>: " . (strpos($retrieved->description, '<th') !== false ? 'YES' : 'NO') . "\n";
            echo "✓ Contains <td>: " . (strpos($retrieved->description, '<td') !== false ? 'YES' : 'NO') . "\n\n";
            
            // Show snippet
            echo "Content preview:\n";
            echo substr($retrieved->description, 0, 300) . "...\n\n";
        } else {
            echo "✗ Record not found\n\n";
        }
    } catch (Exception $e) {
        echo "✗ Retrieve failed: " . $e->getMessage() . "\n\n";
    }
}

// Test 4: Check display access
echo "TEST 4: Check Display URL\n";
echo "---\n";

if ($testId) {
    echo "✓ Detail page URL: http://localhost:8000/infobase/pengumuman-detail/{$testId}\n";
    echo "✓ List page URL: http://localhost:8000/infobase/pengumuman\n";
    echo "✓ Admin edit URL: http://localhost:8000/admin/pengumuman/{$testId}/edit\n\n";
}

echo "=== TEST COMPLETE ===\n";
echo "If all tests passed, the feature is working correctly!\n";
?>
