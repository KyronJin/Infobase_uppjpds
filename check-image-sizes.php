<?php
$filepath = __DIR__ . '/public/storage/profil_pegawai/mbfiJTbWQCV7vMHfzjgy4heDleZhms86X3BH6PZ3.jpg';

if(file_exists($filepath)) {
    $size = @getimagesize($filepath);
    if($size) {
        echo "Image dimensions: " . $size[0] . ' x ' . $size[1] . " pixels" . PHP_EOL;
        echo "File size: " . filesize($filepath) . " bytes" . PHP_EOL;
        echo "MIME type: " . $size['mime'] . PHP_EOL;
    } else {
        echo "Failed to read image info" . PHP_EOL;
    }
} else {
    echo "File not found" . PHP_EOL;
}

// Also check other files
echo "\n--- All profil_pegawai images ---\n";
$dir = __DIR__ . '/public/storage/profil_pegawai';
$files = glob($dir . '/*');
foreach($files as $file) {
    $size = @getimagesize($file);
    if($size) {
        echo basename($file) . ": " . $size[0] . ' x ' . $size[1] . " px" . PHP_EOL;
    }
}
?>
