<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Download extends Controller
{
    public function file($filename)
    {
        // Path ke direktori file
        $file = WRITEPATH . 'uploads/' . $filename;

        // Periksa apakah file ada
        if (file_exists($file)) {
            // Set header untuk memastikan file diunduh
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . $filename . '"');
            header('Content-Length: ' . filesize($file));

            // Baca dan kirimkan isi file ke output
            readfile($file);
            exit;
        } else {
            // Tampilkan pesan jika file tidak ditemukan
            die('File tidak ditemukan.');
        }
    }
}
