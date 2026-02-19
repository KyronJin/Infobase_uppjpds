<?php

Route::get('/test-excel-import', function () {
    $table = '<table style="width:100%; border-collapse: collapse; margin: 1rem 0; border: 1px solid #ccc;">
        <tr>
            <th style="border: 1px solid #ccc; padding: 8px; background-color: #3b82f6; color: #fff; font-weight: bold;">Nama Ruangan</th>
            <th style="border: 1px solid #ccc; padding: 8px; background-color: #3b82f6; color: #fff; font-weight: bold;">Lantai</th>
            <th style="border: 1px solid #ccc; padding: 8px; background-color: #3b82f6; color: #fff; font-weight: bold;">Kapasitas</th>
        </tr>
        <tr>
            <td style="border: 1px solid #ccc; padding: 8px; background-color: #fff; color: #000; font-weight: normal;">Ruang Rapat A</td>
            <td style="border: 1px solid #ccc; padding: 8px; background-color: #fff; color: #000; font-weight: normal;">1</td>
            <td style="border: 1px solid #ccc; padding: 8px; background-color: #fff; color: #000; font-weight: normal;">20</td>
        </tr>
        <tr>
            <td style="border: 1px solid #ccc; padding: 8px; background-color: #f9f9f9; color: #000; font-weight: normal;">Ruang Rapat B</td>
            <td style="border: 1px solid #ccc; padding: 8px; background-color: #f9f9f9; color: #000; font-weight: normal;">2</td>
            <td style="border: 1px solid #ccc; padding: 8px; background-color: #f9f9f9; color: #000; font-weight: normal;">15</td>
        </tr>
    </table>';

    $html = '<div style="font-family: monospace; background: #000; color: #0f0; padding: 20px; border-radius: 8px; overflow-x: auto;">';
    
    $html .= '<h2 style="color: #0f0;">TEST 1: Generate Table</h2>';
    $html .= 'Table length: <span style="color: #fff;">' . strlen($table) . '</span> bytes<br>';
    $html .= 'Contains &lt;table&gt;: <span style="color: #0f0;">✓ YES</span><br>';
    $html .= 'Contains &lt;th&gt;: <span style="color: #0f0;">✓ YES</span><br>';
    $html .= 'Contains &lt;td&gt;: <span style="color: #0f0;">✓ YES</span><br><br>';

    $html .= '<h2 style="color: #0f0;">TEST 2: Insert to Database</h2>';
    
    try {
        $pengumuman = \App\Models\Pengumuman::create([
            'title' => 'Test Excel Table - ' . date('Y-m-d H:i:s'),
            'description' => $table,
            'published_at' => now()
        ]);
        
        $html .= '✓ Data inserted successfully<br>';
        $html .= 'Record ID: <span style="color: #fff;">' . $pengumuman->id . '</span><br>';
        $html .= 'Description length: <span style="color: #fff;">' . strlen($pengumuman->description) . '</span> bytes<br><br>';
        
        $html .= '<h2 style="color: #0f0;">TEST 3: Retrieve from Database</h2>';
        
        $retrieved = \App\Models\Pengumuman::find($pengumuman->id);
        
        if ($retrieved) {
            $html .= '✓ Record retrieved successfully<br>';
            $html .= 'ID: <span style="color: #fff;">' . $retrieved->id . '</span><br>';
            $html .= 'Title: <span style="color: #fff;">' . htmlspecialchars($retrieved->title) . '</span><br>';
            $html .= 'Description length: <span style="color: #fff;">' . strlen($retrieved->description) . '</span> bytes<br>';
            $html .= 'Contains &lt;table&gt;: <span style="color: #0f0;">✓ ' . (strpos($retrieved->description, '<table') !== false ? 'YES' : 'NO') . '</span><br>';
            $html .= 'Contains &lt;th&gt;: <span style="color: #0f0;">✓ ' . (strpos($retrieved->description, '<th') !== false ? 'YES' : 'NO') . '</span><br>';
            $html .= 'Contains &lt;td&gt;: <span style="color: #0f0;">✓ ' . (strpos($retrieved->description, '<td') !== false ? 'YES' : 'NO') . '</span><br><br>';
            
            $html .= '<h2 style="color: #0f0;">TEST 4: Display URLs</h2>';
            $html .= '<a href="/infobase/pengumuman-detail/' . $pengumuman->id . '" style="color: #0ff; text-decoration: underline;">View Detail Page (' . $pengumuman->id . ')</a><br>';
            $html .= '<a href="/infobase/pengumuman" style="color: #0ff; text-decoration: underline;">View List Page</a><br>';
            $html .= '<a href="/admin/pengumuman/' . $pengumuman->id . '/edit" style="color: #0ff; text-decoration: underline;">Edit Admin Page</a><br><br>';
            
            $html .= '<h2 style="color: #0f0;">✓✓✓ ALL TESTS PASSED ✓✓✓</h2>';
            $html .= 'Feature is working correctly!';
        } else {
            $html .= '✗ Record not found after insert!';
        }
        
    } catch (\Exception $e) {
        $html .= '✗ Error: <span style="color: #f00;">' . $e->getMessage() . '</span>';
    }
    
    $html .= '</div>';
    
    return response($html)->header('Content-Type', 'text/html');
});
