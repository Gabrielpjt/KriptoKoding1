<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class AutokeyVigenereCipher extends BaseController
{
    public function index()
    {
        // Deklarasi variabel dengan nilai default null
        $cipherText = null;
        $plainText = null;
        $plainTextencrypt = null;
        $cipherTextdecrypt = null;
        $keyencrypt = null;
        $keydecrypt = null;
        $tipeFile = null;

        // Mengambil nilai dari session flashdata jika ada, jika tidak menggunakan nilai default
        $data = [
            'judul' => 'Autokey Vigenere Cipher',
            'cipherText' => session()->getFlashdata('cipherText') ?? $cipherText,
            'plainText' => session()->getFlashdata('plainText') ?? $plainText,
            'plainTextencrypt' => session()->getFlashdata('plainTextencrypt') ?? $plainTextencrypt,
            'cipherTextdecrypt' => session()->getFlashdata('cipherTextdecrypt') ?? $cipherTextdecrypt,
            'keyencrypt' => session()->getFlashdata('keyencrypt') ?? $keyencrypt,
            'keydecrypt' => session()->getFlashdata('keydecrypt') ?? $keydecrypt,
            'tipeFile' => session()->getFlashdata('tipeFile') ?? $tipeFile,
        ];

        // Mengembalikan tampilan dengan data yang diberikan
        return view('templates/v_header', $data) .
            view('templates/v_sidebar') .
            view('templates/v_topbar') .
            view('AutokeyVigenereCipher/index', $data) .
            view('templates/v_footer');
    }

    // Fungsi untuk enkripsi teks dengan file
    public function encryptAutokeyVigenereCipherfile()
    {
        // Cek apakah metode request adalah POST dan tombol submit telah ditekan
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
            // Cek apakah tidak ada error pada file yang diunggah
            if ($_FILES['inputFile']['error'] === UPLOAD_ERR_OK) {
                // Mendapatkan ekstensi file
                $tmp = explode('.', $_FILES['inputFile']['name']);
                $ext = end($tmp);
                $key = $_POST['kunci'] ?? '';
                $plainText = file_get_contents($_FILES['inputFile']['tmp_name']);
                session()->setFlashdata('plainTextencrypt', $plainText);

                // Mendapatkan tipe file
                $fileName = $_FILES['inputFile']['name'];
                $pecah = explode(".", $fileName);
                $tipeFile = $pecah[1];
                session()->setFlashdata('tipeFile', $tipeFile);
            }
        }

        // Cek apakah plaintext dan key kosong
        if (empty($plainText) || empty($key)) {
            return redirect()->back()->withInput()->with('error', 'Please provide both plaintext and key.');
        }

        // Membuat array alfabet
        $alphabets = range('a', 'z');

        // Memanipulasi teks plaintext dan key
        $plainText = implode(explode(' ', $plainText));
        $key = implode(explode(' ', $key));

        // Menyamakan panjang key dengan plaintext
        while (strlen($plainText) > strlen($key)) {
            $key .= $plainText;
        }
        while (strlen($plainText) < strlen($key)) {
            $key = substr($key, 0, strlen($key) - 1);
        }

        // Mengubah plaintext dan key menjadi array karakter kecil
        $plainTextArr = str_split(strtolower($plainText));
        $keyArr = str_split(strtolower($key));

        // Mendapatkan nilai alfabet untuk plaintext dan key
        $plainValues = [];
        $keyValues = [];

        foreach ($plainTextArr as $plain) {
            $plainValues[] = array_search($plain, $alphabets);
        }

        foreach ($keyArr as $keyItem) {
            $keyValues[] = array_search($keyItem, $alphabets);
        }

        // Melakukan enkripsi menggunakan algoritma Autokey Vigenere Cipher
        $cipherValues = [];
        for ($i = 0; $i < count($plainValues); $i++) {
            $cipherValues[] = ($plainValues[$i] + $keyValues[$i]) % 26;
        }

        // Mengonversi nilai enkripsi ke teks cipher
        $cipherText = '';
        foreach ($cipherValues as $value) {
            $cipherText .= $alphabets[$value];
        }

        // Menyimpan hasil enkripsi ke dalam session flashdata
        session()->setFlashdata('cipherText', $cipherText);

        // Kembali ke halaman Autokey Vigenere Cipher
        return redirect()->to('/AutokeyVigenereCipher');
    }

    // Fungsi untuk enkripsi teks dengan metode extended Vigenere Cipher
    public function encryptautokeyvigenerecipher()
    {
        // Menetapkan header HTTP
        $response = service('response');
        $response->setHeader('Content-Type', 'text/html; charset=ISO-8859-1');
        $plainText = $this->request->getPost('inputText') ?? '';
        $key = $this->request->getPost('kunci') ?? '';

        session()->setFlashdata('plainTextencrypt', $plainText);
        session()->setFlashdata('keyencrypt', $key);

        // Menetapkan tipe file
        $tipeFile = 'txt';
        session()->setFlashdata('tipeFile', $tipeFile);

        // Membuat array alfabet
        $alphabets = range('a', 'z');

        // Memanipulasi teks plaintext dan key
        $plainText = implode(explode(' ', $plainText));
        $key = implode(explode(' ', $key));

        // Menyamakan panjang key dengan plaintext
        while (strlen($plainText) > strlen($key)) {
            $key .= $plainText;
        }
        while (strlen($plainText) < strlen($key)) {
            $key = substr($key, 0, strlen($key) - 1);
        }

        // Mengubah plaintext dan key menjadi array karakter kecil
        $plainTextArr = str_split(strtolower($plainText));
        $keyArr = str_split(strtolower($key));

        // Mendapatkan nilai alfabet untuk plaintext dan key
        $plainValues = [];
        $keyValues = [];

        foreach ($plainTextArr as $plain) {
            $plainValues[] = array_search($plain, $alphabets);
        }

        foreach ($keyArr as $keyItem) {
            $keyValues[] = array_search($keyItem, $alphabets);
        }

        // Melakukan enkripsi menggunakan algoritma extended Vigenere Cipher
        $cipherValues = [];
        for ($i = 0; $i < count($plainValues); $i++) {
            $cipherValues[] = ($plainValues[$i] + $keyValues[$i]) % 26;
        }

        // Mengonversi nilai enkripsi ke teks cipher
        $cipherText = '';
        foreach ($cipherValues as $value) {
            $cipherText .= $alphabets[$value];
        }

        // Menyimpan hasil enkripsi ke dalam session flashdata
        session()->setFlashdata('cipherText', $cipherText);

        // Kembali ke halaman Autokey Vigenere Cipher
        return redirect()->to('/AutokeyVigenereCipher');
    }

    public function decryptAutokeyVigenereCipherfile()
    {
      if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
        if ($_FILES['inputFileDecrypt']['error'] === UPLOAD_ERR_OK) {
          $tmp = explode('.', $_FILES['inputFileDecrypt']['name']);
          $ext = end($tmp);
          $key = $_POST['kunci'] ?? '';
          $cipherText = file_get_contents($_FILES['inputFileDecrypt']['tmp_name']);
          session()->setFlashdata('cipherTextdecrypt', $cipherText);
    
          // Get MIME type of the uploaded file
          $fileName = $_FILES['inputFileDecrypt']['name'];
          $pecah = explode(".", $fileName);
          $tipeFile = $pecah[1];
          session()->setFlashdata('tipeFile', $tipeFile);
        }
      }
  
      if (empty($cipherText) || empty($key)) {
        return redirect()->back()->withInput()->with('error', 'Please provide both ciphertext and key.');
      }

      // Membuat array alfabet
      $alphabets = range('a', 'z');

      // Memanipulasi teks cipher dan kunci
      $cipherText = implode(explode(' ', $cipherText));
      $key = implode(explode(' ', $key));

      // Jika panjang teks cipher lebih besar dari panjang kunci, lakukan dekripsi
      if (strlen($cipherText) > strlen($key)) {
          $plainText = '';
          $cipherTextArr = str_split(strtolower($cipherText));
          $keyArr = str_split(strtolower($key));

          $cipherValues = [];
          $keyValues = [];

          // Mendapatkan nilai alfabet untuk teks cipher dan kunci
          foreach ($cipherTextArr as $cipher) {
              $cipherValues[] = array_search($cipher, $alphabets);
          }

          foreach ($keyArr as $keyItem) {
              $keyValues[] = array_search($keyItem, $alphabets);
          }

          $plainValues = [];

          // Melakukan dekripsi menggunakan algoritma Autokey Vigenere Cipher
          for ($i = 0; $i < count($keyValues); $i++) {
              $plainValue = ($cipherValues[$i] - $keyValues[$i]) % 26;
              $plainValues[] = $plainValue < 0 ? $plainValue += 26 : $plainValue;
          }

          $j = 0;
          for ($i = count($keyValues); $i < count($cipherValues); $i++) {
              $plainValue = ($cipherValues[$i] - $plainValues[$j]) % 26;
              $j++;
              $plainValues[] = $plainValue < 0 ? $plainValue += 26 : $plainValue;
          }

          // Mengonversi nilai dekripsi ke teks plainteks
          foreach ($plainValues as $value) {
              $plainText .= $alphabets[$value];
          }

      } else {
          // Jika panjang teks cipher lebih kecil dari panjang kunci, lakukan dekripsi
          while (strlen($cipherText) < strlen($key)) {
              $key = substr($key, 0, strlen($key) - 1);
          }

          $cipherTextArr = str_split(strtolower($cipherText));
          $keyArr = str_split(strtolower($key));

          $cipherValues = [];
          $keyValues = [];

          // Mendapatkan nilai alfabet untuk teks cipher dan kunci
          foreach ($cipherTextArr as $cipher) {
              $cipherValues[] = array_search($cipher, $alphabets);
          }

          foreach ($keyArr as $keyItem) {
              $keyValues[] = array_search($keyItem, $alphabets);
          }

          $plainValues = [];

          // Melakukan dekripsi menggunakan algoritma Autokey Vigenere Cipher
          for ($i = 0; $i < count($cipherValues); $i++) {
              $plainValue = ($cipherValues[$i] - $keyValues[$i]) % 26;
              $plainValues[] = $plainValue < 0 ? $plainValue += 26 : $plainValue;
          }

          // Mengonversi nilai dekripsi ke teks plainteks
          $plainText = '';
          foreach ($plainValues as $value) {
              $plainText .= $alphabets[$value];
          }
      }

      // Menyimpan hasil dekripsi ke dalam session flashdata
      session()->setFlashdata('plainText', $plainText);

      // Kembali ke halaman Autokey Vigenere Cipher
      return redirect()->to('/AutokeyVigenereCipher');
  }

    // Fungsi untuk dekripsi teks dengan file menggunakan metode Autokey Vigenere Cipher
    public function decryptAutokeyVigenereCipher()
    {
        // Mengambil teks cipher dan kunci dari form
        $cipherText = $this->request->getPost('inputTextDecrypt') ?? '';
        $key = $this->request->getPost('kunciDecrypt') ?? '';
        session()->setFlashdata('cipherTextdecrypt', $cipherText);
        session()->setFlashdata('keydecrypt', $key);

        // Menetapkan tipe file
        $tipeFile = 'txt';
        session()->setFlashdata('tipeFile', $tipeFile);

        // Membuat array alfabet
        $alphabets = range('a', 'z');

        // Memanipulasi teks cipher dan kunci
        $cipherText = implode(explode(' ', $cipherText));
        $key = implode(explode(' ', $key));

        // Jika panjang teks cipher lebih besar dari panjang kunci, lakukan dekripsi
        if (strlen($cipherText) > strlen($key)) {
            $plainText = '';
            $cipherTextArr = str_split(strtolower($cipherText));
            $keyArr = str_split(strtolower($key));

            $cipherValues = [];
            $keyValues = [];

            // Mendapatkan nilai alfabet untuk teks cipher dan kunci
            foreach ($cipherTextArr as $cipher) {
                $cipherValues[] = array_search($cipher, $alphabets);
            }

            foreach ($keyArr as $keyItem) {
                $keyValues[] = array_search($keyItem, $alphabets);
            }

            $plainValues = [];

            // Melakukan dekripsi menggunakan algoritma Autokey Vigenere Cipher
            for ($i = 0; $i < count($keyValues); $i++) {
                $plainValue = ($cipherValues[$i] - $keyValues[$i]) % 26;
                $plainValues[] = $plainValue < 0 ? $plainValue += 26 : $plainValue;
            }

            $j = 0;
            for ($i = count($keyValues); $i < count($cipherValues); $i++) {
                $plainValue = ($cipherValues[$i] - $plainValues[$j]) % 26;
                $j++;
                $plainValues[] = $plainValue < 0 ? $plainValue += 26 : $plainValue;
            }

            // Mengonversi nilai dekripsi ke teks plainteks
            foreach ($plainValues as $value) {
                $plainText .= $alphabets[$value];
            }

        } else {
            // Jika panjang teks cipher lebih kecil dari panjang kunci, lakukan dekripsi
            while (strlen($cipherText) < strlen($key)) {
                $key = substr($key, 0, strlen($key) - 1);
            }

            $cipherTextArr = str_split(strtolower($cipherText));
            $keyArr = str_split(strtolower($key));

            $cipherValues = [];
            $keyValues = [];

            // Mendapatkan nilai alfabet untuk teks cipher dan kunci
            foreach ($cipherTextArr as $cipher) {
                $cipherValues[] = array_search($cipher, $alphabets);
            }

            foreach ($keyArr as $keyItem) {
                $keyValues[] = array_search($keyItem, $alphabets);
            }

            $plainValues = [];

            // Melakukan dekripsi menggunakan algoritma Autokey Vigenere Cipher
            for ($i = 0; $i < count($cipherValues); $i++) {
                $plainValue = ($cipherValues[$i] - $keyValues[$i]) % 26;
                $plainValues[] = $plainValue < 0 ? $plainValue += 26 : $plainValue;
            }

            // Mengonversi nilai dekripsi ke teks plainteks
            $plainText = '';
            foreach ($plainValues as $value) {
                $plainText .= $alphabets[$value];
            }
        }

        // Menyimpan hasil dekripsi ke dalam session flashdata
        session()->setFlashdata('plainText', $plainText);

        // Kembali ke halaman Autokey Vigenere Cipher
        return redirect()->to('/AutokeyVigenereCipher');
    }
}
