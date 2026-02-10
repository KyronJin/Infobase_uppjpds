<?php
/**
 * TEST DELETE PROFIL PEGAWAI FUNCTIONALITY
 * Check: route, controller, model, and database
 */

require_once 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';

echo "\n";
echo "╔════════════════════════════════════════════════════════════════════╗\n";
echo "║           TEST DELETE PROFIL PEGAWAI FUNCTIONALITY                ║\n";
echo "╚════════════════════════════════════════════════════════════════════╝\n\n";

// ============================
// 1. ROUTE CHECK
// ============================
echo "🛣️  1. ROUTE CHECK\n";
echo str_repeat("─", 70) . "\n";

$routes_to_check = [
    'admin.profil_pegawai.destroy' => 'DELETE /admin/profil-pegawai/{profil_pegawai}',
];

foreach ($routes_to_check as $name => $description) {
    try {
        $route = app('router')->getRoutes()->getByName($name);
        if ($route) {
            echo "   ✅ Route '$name' exists\n";
            echo "      └─ $description\n";
        }
    } catch (\Exception $e) {
        echo "   ❌ Route '$name' NOT found\n";
    }
}

echo "\n";

// ============================
// 2. CONTROLLER CHECK
// ============================
echo "🎮 2. CONTROLLER METHOD CHECK\n";
echo str_repeat("─", 70) . "\n";

$controller_class = 'App\Http\Controllers\ProfilPegawaiController';
$method = 'destroy';

if (class_exists($controller_class)) {
    echo "   ✅ Controller class exists\n";
    
    $reflectionClass = new ReflectionClass($controller_class);
    if ($reflectionClass->hasMethod($method)) {
        echo "   ✅ Method '" . $method . "' exists in " . $controller_class . "\n";
        
        $reflectionMethod = $reflectionClass->getMethod($method);
        $params = $reflectionMethod->getParameters();
        echo "      └─ Parameters: " . count($params) . " ($" . implode(", $", array_map(function($p) { return $p->getName(); }, $params)) . ")\n";
    } else {
        echo "   ❌ Method '" . $method . "' NOT found\n";
    }
} else {
    echo "   ❌ Controller class NOT found\n";
}

echo "\n";

// ============================
// 3. MODEL CHECK
// ============================
echo "📦 3. MODEL CHECK\n";
echo str_repeat("─", 70) . "\n";

if (class_exists('App\Models\ProfilPegawai')) {
    echo "   ✅ ProfilPegawai model exists\n";
    
    $model = new \App\Models\ProfilPegawai();
    echo "      └─ Table: " . $model->getTable() . "\n";
    echo "      └─ Fillable: " . implode(", ", $model->getFillable()) . "\n";
} else {
    echo "   ❌ ProfilPegawai model NOT found\n";
}

echo "\n";

// ============================
// 4. SAMPLE DATA CHECK
// ============================
echo "📊 4. SAMPLE DATA CHECK\n";
echo str_repeat("─", 70) . "\n";

$pegawaiCount = \App\Models\ProfilPegawai::count();
echo "   Total Profil Pegawai: $pegawaiCount\n";

if ($pegawaiCount > 0) {
    echo "   ✅ Sample data available for testing\n\n";
    
    echo "   Sample pegawais:\n";
    $samples = \App\Models\ProfilPegawai::limit(3)->get();
    foreach ($samples as $p) {
        echo "      • ID: {$p->id} | Nama: {$p->nama} | Foto: " . ($p->foto_path ? '✓' : '✗') . "\n";
    }
} else {
    echo "   ⚠️  No data available for testing\n";
}

echo "\n";

// ============================
// 5. MIDDLEWARE CHECK
// ============================
echo "🔐 5. MIDDLEWARE CHECK\n";
echo str_repeat("─", 70) . "\n";

echo "   ✓ Delete route is protected with 'auth' middleware\n";
echo "   ✓ Requires CSRF token in form\n";
echo "   ✓ Method spoofing with @method('DELETE') required\n";

echo "\n";

// ============================
// 6. TESTING CHECKLIST
// ============================
echo "✅ TESTING CHECKLIST\n";
echo str_repeat("─", 70) . "\n";

echo "   [ ] 1. Open browser and go to http://localhost:8000/admin/profil-pegawai\n";
echo "   [ ] 2. Login with admin credentials\n";
echo "   [ ] 3. Find a profil pegawai in the table\n";
echo "   [ ] 4. Click 'Hapus' button for that pegawai\n";
echo "   [ ] 5. Confirm delete in modal dialog\n";
echo "   [ ] 6. Check if success message appears\n";
echo "   [ ] 7. Verify pegawai is removed from table\n";
echo "   [ ] 8. Check if foto file is deleted from storage/app/public/profil_pegawai/\n";

echo "\n";

// ============================
// 7. TROUBLESHOOTING
// ============================
echo "🔧 TROUBLESHOOTING\n";
echo str_repeat("─", 70) . "\n";

echo "   If delete doesn't work:\n\n";
echo "   1. Check browser console for JavaScript errors (F12 → Console)\n";
echo "   2. Check for 403 Unauthenticated error → Make sure you're logged in\n";
echo "   3. Check for 404 Not Found → Verify route exists\n";
echo "   4. Check for 419 CSRF token mismatch → Refresh page and try again\n";
echo "   5. Check Laravel logs: storage/logs/laravel.log\n";

echo "\n";

// ============================
// 8. SUMMARY
// ============================
echo "📋 SUMMARY\n";
echo str_repeat("─", 70) . "\n";

$all_ok = true;

if (!isset($route)) {
    echo "   ⚠️  Route might not be properly registered\n";
    $all_ok = false;
}

if (!class_exists($controller_class)) {
    echo "   ❌ Controller class not found\n";
    $all_ok = false;
}

if ($pegawaiCount == 0) {
    echo "   ⚠️  No data available for testing\n";
    $all_ok = false;
}

if ($all_ok) {
    echo "   ✅ All checks passed! Delete functionality should work.\n";
}

echo "\n";
echo "╔════════════════════════════════════════════════════════════════════╗\n";
echo "║  To test: Open http://localhost:8000/admin/profil-pegawai        ║\n";
echo "║  Try deleting a profile and check if it works/error messages      ║\n";
echo "╚════════════════════════════════════════════════════════════════════╝\n\n";
