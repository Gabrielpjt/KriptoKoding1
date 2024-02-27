<?php

namespace App\Controllers;

class Upload extends BaseController
{
    public function index()
    {
        return view('upload_form');
    }

    public function doUpload()
    {
        // Ambil file yang diunggah
        $file = $this->request->getFile('inputFile');

        // Pastikan file berhasil diunggah sebelum melanjutkan
        if ($file && $file->isValid()) {
            // Ubah nama file
            $newName = 'Input_Teks.txt';
            
            // Pindahkan file ke folder yang ditentukan (misalnya, folder writable)
            if ($file->move(WRITEPATH . 'uploads', $newName)) {
                // Jika file berhasil diunggah, tampilkan pesan sukses
                return redirect()->to('/PlayfairCipher');
            } else {
                // Jika terjadi kesalahan saat memindahkan file, tampilkan pesan kesalahan
                echo 'Gagal memindahkan file.';
            }
        } else {
            // Jika file gagal diunggah, tampilkan pesan kesalahan
            echo 'File gagal diunggah.';
        }
    }
}
