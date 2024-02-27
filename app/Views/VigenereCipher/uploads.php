<?php
// Menentukan nama file
$filename = 'encrypt.txt';

// Menentukan direktori target
$directory = __DIR__ . '/../uploads/';

// Membuat direktori jika belum ada
if (!is_dir($directory)) {
    mkdir($directory, 0755, true);
}

// Menyimpan cipherText ke dalam file
$file_path = $directory . $filename;
file_put_contents($file_path, $cipherText);

// Membuat tautan unduh
if (file_exists($file_path)) {
    echo '<a href="/uploads/' . $filename . '" download>Download encrypted text file</a>';
} else {
    echo 'Failed to create file.';
}
?>
