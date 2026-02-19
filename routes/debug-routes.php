<?php

Route::get('/test-database-pengumuman', function () {
    // Get latest pengumuman
    $pengumuman = \App\Models\Pengumuman::latest()->first();
    
    $html = '<div style="font-family: monospace; background: #000; color: #0f0; padding: 20px; border-radius: 8px; line-height: 1.6;">';
    
    if (!$pengumuman) {
        $html .= '<p style="color: #f00;">❌ No pengumuman found in database</p>';
    } else {
        $html .= '<h2 style="color: #0f0; margin-bottom: 15px;">✓ Latest Pengumuman Found</h2>';
        $html .= '<p>ID: <span style="color: #fff;">' . $pengumuman->id . '</span></p>';
        $html .= '<p>Title: <span style="color: #fff;">' . htmlspecialchars($pengumuman->title) . '</span></p>';
        $html .= '<p>Description length: <span style="color: #fff;">' . strlen($pengumuman->description) . '</span> bytes</p>';
        $html .= '<p>Contains &lt;table&gt;: <span style="color: #' . (strpos($pengumuman->description, '<table') !== false ? '0f0' : 'f00') . ';">' . 
                (strpos($pengumuman->description, '<table') !== false ? '✓ YES' : '✗ NO') . '</span></p>';
        $html .= '<p>Contains &lt;th&gt;: <span style="color: #' . (strpos($pengumuman->description, '<th') !== false ? '0f0' : 'f00') . ';">' . 
                (strpos($pengumuman->description, '<th') !== false ? '✓ YES' : '✗ NO') . '</span></p>';
        $html .= '<p>Contains &lt;td&gt;: <span style="color: #' . (strpos($pengumuman->description, '<td') !== false ? '0f0' : 'f00') . ';">' . 
                (strpos($pengumuman->description, '<td') !== false ? '✓ YES' : '✗ NO') . '</span></p>';
        
        $html .= '<hr style="border: 1px solid #333; margin: 20px 0;">';
        $html .= '<h3 style="color: #0f0;">Raw Description (First 2000 chars):</h3>';
        $html .= '<pre style="background: #111; padding: 10px; overflow-x: auto; font-size: 11px; max-height: 500px; border: 1px solid #333;">' . 
                htmlspecialchars(substr($pengumuman->description, 0, 2000)) . (strlen($pengumuman->description) > 2000 ? '\n\n... (' . (strlen($pengumuman->description) - 2000) . ' more bytes)' : '') . 
                '</pre>';
        
        $html .= '<hr style="border: 1px solid #333; margin: 20px 0;">';
        $html .= '<h3 style="color: #0f0;">Rendered in Browser:</h3>';
        $html .= '<div style="background: #1a1a1a; border: 1px solid #333; padding: 15px; margin: 10px 0; border-radius: 4px; max-height: 400px; overflow: auto;">' . 
                $pengumuman->description . 
                '</div>';
        
        $html .= '<hr style="border: 1px solid #333; margin: 20px 0;">';
        $html .= '<h3 style="color: #0f0;">Links:</h3>';
        $html .= '<p><a href="/infobase/pengumuman-detail/' . $pengumuman->id . '" style="color: #0ff; text-decoration: underline; font-size: 14px;">→ View Detail Page</a></p>';
        $html .= '<p><a href="/admin/pengumuman/' . $pengumuman->id . '/edit" style="color: #0ff; text-decoration: underline; font-size: 14px;">→ Edit in Admin</a></p>';
        $html .= '<p><a href="/infobase/pengumuman" style="color: #0ff; text-decoration: underline; font-size: 14px;">→ View List Page</a></p>';
    }
    
    // Also show all pengumuman count + last 5
    $count = \App\Models\Pengumuman::count();
    $html .= '<hr style="border: 1px solid #333; margin: 20px 0;">';
    $html .= '<p>Total pengumuman in database: <span style="color: #fff;">' . $count . '</span></p>';
    
    $html .= '<h3 style="color: #0f0; margin-top: 20px;">Last 5 Pengumuman:</h3>';
    $all = \App\Models\Pengumuman::latest()->limit(5)->get();
    foreach ($all as $p) {
        $hasTable = strpos($p->description, '<table') !== false;
        $tableStatus = $hasTable ? '<span style="color: #0f0;">✓ HAS TABLE</span>' : '<span style="color: #f00;">✗ NO TABLE</span>';
        $html .= '<p style="margin: 5px 0; padding: 8px; background: #111; border-left: 2px solid #' . ($hasTable ? '0f0' : 'f00') . ';">';
        $html .= '[ID: ' . $p->id . '] ' . htmlspecialchars(substr($p->title, 0, 50)) . ' (' . strlen($p->description) . ' bytes) ' . $tableStatus;
        $html .= '</p>';
    }
    
    $html .= '</div>';
    return response($html)->header('Content-Type', 'text/html');
});
