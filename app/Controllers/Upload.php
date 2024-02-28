<?php

namespace App\Controllers;

class Upload extends BaseController
{
    public function index()
    {
        return view('upload_form');
    }

    public function doUploadVigenereCipher()
    {
        // Ambil file yang diunggah
        $file = $this->request->getFile('inputFile');

        // Pastikan file berhasil diunggah sebelum melanjutkan
        if ($file && $file->isValid()) {
            // Ubah nama file
            $newName = 'Input_Teks.txt';
            
            // Pindahkan file ke folder yang ditentukan (misalnya, folder writable)
            if (unlink(WRITEPATH . 'uploads/Input_Teks.txt')){
                if ($file->move(WRITEPATH . 'uploads', $newName)) {
                    // Jika file berhasil diunggah, tampilkan pesan sukses
                    return redirect()->to('/ProductCipher');
                } else {
                    // Jika terjadi kesalahan saat memindahkan file, tampilkan pesan kesalahan
                    echo 'Gagal memindahkan file.';
                }
            }
        } else {
            // Jika file gagal diunggah, tampilkan pesan kesalahan
            echo 'File gagal diunggah.';
        }
    }

    public function doUploadExtendedCipher()
    {
        // Ambil file yang diunggah
        $file = $this->request->getFile('inputFile');

        // Pastikan file berhasil diunggah sebelum melanjutkan
        if ($file && $file->isValid()) {
            // Ubah nama file
            $newName = 'Input_Teks.txt';
            
            // Pindahkan file ke folder yang ditentukan (misalnya, folder writable)
            if (unlink(WRITEPATH . 'uploads/Input_Teks.txt')){
                if ($file->move(WRITEPATH . 'uploads', $newName)) {
                    // Jika file berhasil diunggah, tampilkan pesan sukses
                    return redirect()->to('/ProductCipher');
                } else {
                    // Jika terjadi kesalahan saat memindahkan file, tampilkan pesan kesalahan
                    echo 'Gagal memindahkan file.';
                }
            }
        } else {
            // Jika file gagal diunggah, tampilkan pesan kesalahan
            echo 'File gagal diunggah.';
        }
    }

    public function doUploadPlayfairCipher()
    {
        // Ambil file yang diunggah
        $file = $this->request->getFile('inputFile');

        // Pastikan file berhasil diunggah sebelum melanjutkan
        if ($file && $file->isValid()) {
            // Ubah nama file
            $newName = 'Input_Teks.txt';
            
            // Pindahkan file ke folder yang ditentukan (misalnya, folder writable)
            if (unlink(WRITEPATH . 'uploads/Input_Teks.txt')){
                if ($file->move(WRITEPATH . 'uploads', $newName)) {
                    // Jika file berhasil diunggah, tampilkan pesan sukses
                    return redirect()->to('/PlayfairCipher');
                } else {
                    // Jika terjadi kesalahan saat memindahkan file, tampilkan pesan kesalahan
                    echo 'Gagal memindahkan file.';
                }
            }
        } else {
            // Jika file gagal diunggah, tampilkan pesan kesalahan
            echo 'File gagal diunggah.';
        }
    }

    public function doUploadProductCipher()
    {
        // Ambil file yang diunggah
        $file = $this->request->getFile('inputFile');

        // Pastikan file berhasil diunggah sebelum melanjutkan
        if ($file && $file->isValid()) {
            // Ubah nama file
            $newName = 'Input_Teks.txt';
            
            // Pindahkan file ke folder yang ditentukan (misalnya, folder writable)
            if (unlink(WRITEPATH . 'uploads/Input_Teks.txt')){
                if ($file->move(WRITEPATH . 'uploads', $newName)) {
                    // Jika file berhasil diunggah, tampilkan pesan sukses
                    return redirect()->to('/ProductCipher');
                } else {
                    // Jika terjadi kesalahan saat memindahkan file, tampilkan pesan kesalahan
                    echo 'Gagal memindahkan file.';
                }
            }
        } else {
            // Jika file gagal diunggah, tampilkan pesan kesalahan
            echo 'File gagal diunggah.';
        }
    }

}
