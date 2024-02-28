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
            if (unlink(WRITEPATH . 'uploads/Input_Teks.txt')) {
                if ($file->move(WRITEPATH . 'uploads', $newName)) {
                    // Jika file berhasil diunggah, tampilkan pesan sukses
                    return redirect()->to('/VigenereCipher');
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

    public function doUploadExtendedVigenereCipher()
    {
        // // Ambil file yang diunggah
        // $file = $this->request->getFile('inputFile');

        // // Pastikan file berhasil diunggah sebelum melanjutkan
        // if ($file && $file->isValid()) {
        //     // Hapus file dengan awalan "Input_Teks."
        //     $folderPath = WRITEPATH . 'uploads/';
        //     $files = glob($folderPath . 'Input_Teks.*'); // Ambil semua file dengan awalan "Input_Teks."
        //     foreach ($files as $fileToDelete) {
        //         if (is_file($fileToDelete)) {
        //             unlink($fileToDelete); // Hapus file
        //         }
        //     }

        //     // Ubah nama file
        //     $newName = 'Input_Teks.' . $file->getClientExtension();

        //     // Pindahkan file ke folder yang ditentukan (misalnya, folder writable)
        //     if ($file->move(WRITEPATH . 'uploads', $newName)) {
        //         // Jika file berhasil diunggah, tampilkan pesan sukses
        //         return redirect()->to('/ExtendedVigenereCipher');
        //     } else {
        //         // Jika terjadi kesalahan saat memindahkan file, tampilkan pesan kesalahan
        //         echo 'Gagal memindahkan file.';
        //     }
        // } else {
        //     // Jika file gagal diunggah, tampilkan pesan kesalahan
        //     echo 'File gagal diunggah.';
        // }
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
            if ($_FILES['inputFile']['error'] === UPLOAD_ERR_OK) {
              $tmp = explode('.', $_FILES['inputFile']['name']);
              $ext = end($tmp);
              $key = $_POST['kunci'] ?? '';
              $plainText = file_get_contents($_FILES['inputFile']['tmp_name']);
              $cipherText = ExtendedVigenereCipher::encryptExtendedVigenereCipherfile($plainText, $key);
          
              $filename = 'encrypt-' . uniqid() . '.' . $ext;
              file_put_contents(__DIR__ . '/../uploads/' . $filename, $cipherText);
            }
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
            if (unlink(WRITEPATH . 'uploads/Input_Teks.txt')) {
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
            if (unlink(WRITEPATH . 'uploads/Input_Teks.txt')) {
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
