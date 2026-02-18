<?php
// Create a simple test Excel file
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Add test data
$sheet->setCellValue('A1', 'Nama');
$sheet->setCellValue('B1', 'Usia');
$sheet->setCellValue('C1', 'Kota');

$sheet->setCellValue('A2', 'Budi');
$sheet->setCellValue('B2', 25);
$sheet->setCellValue('C2', 'Jakarta');

$sheet->setCellValue('A3', 'Ani');
$sheet->setCellValue('B3', 23);
$sheet->setCellValue('C3', 'Bandung');

$sheet->setCellValue('A4', 'Citra');
$sheet->setCellValue('B4', 28);
$sheet->setCellValue('C4', 'Surabaya');

// Auto-size columns
foreach (range('A', 'C') as $col) {
    $sheet->getColumnDimension($col)->setAutoSize(true);
}

// Save file
$writer = new Xlsx($spreadsheet);
$filename = 'test_data_' . date('Ymd_His') . '.xlsx';
$filepath = 'public/' . $filename;

try {
    $writer->save($filepath);
    echo "✓ Test Excel file created: " . $filename . "\n";
    echo "Location: " . $filepath . "\n";
    echo "Size: " . filesize($filepath) . " bytes\n";
} catch (\Exception $e) {
    echo "✗ Error: " . $e->getMessage() . "\n";
}
?>
