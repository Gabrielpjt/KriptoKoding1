<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class ExtendedVigenereCipher extends BaseController
{
    public function index()
    {
        $cipherText = 'Silahkan masukkan input';
        $plainText = null;
        $plainTextencrypt = null;
        $cipherTextdecrypt = null;
        $keyencrypt = null;
        $keydecrypt = null;

        $data = [
            'judul' => 'Extended Vigenere Cipher',
            'cipherText' => session()->getFlashdata('cipherText') ?? $cipherText, // Mengambil nilai cipherText dari flashdata,
            'plainText' => session()->getFlashdata('plainText') ?? $plainText,
            'plainTextencrypt' => session()->getFlashdata('plainTextencrypt') ?? $plainTextencrypt,
            'cipherTextdecrypt' => session()->getFlashdata('cipherTextdecrypt') ?? $cipherTextdecrypt,
            'keyencrypt' => session()->getFlashdata('keyencrypt') ?? $keyencrypt,
            'keydecrypt' => session()->getFlashdata('keydecrypt') ?? $keydecrypt,
        ];

        return view('templates/v_header', $data) .
            view('templates/v_sidebar') .
            view('templates/v_topbar') .
            view('VigenereCipher/index', $data) . // Mengirimkan data ke view VigenereCipher/index
            view('templates/v_footer');
    }

    public function encryptExtendedVigenereCipherfile()
    {
        $filePath = WRITEPATH . 'uploads/Input_Teks.txt';
        $key = $this->request->getPost('kunci') ?? '';
        session()->setFlashdata('keyencrypt', $key);

        if (file_exists($filePath)) {
            $fileContent = file_get_contents($filePath);
        } else {
            echo 'File not found.';
            return;
        }

        $plainText = $fileContent;
        session()->setFlashdata('plainTextencrypt', $plainText);

        if (empty($plainText) || empty($key)) {
            return redirect()->back()->withInput()->with('error', 'Please provide both plaintext and key.');
        }

        while (strlen($plainText) > strlen($key)) {
            $key .= $key;
          }
          while (strlen($plainText) < strlen($key)) {
            $key = substr($key, 0, strlen($key) - 1);
          }
      
          $plainTextArr = str_split($plainText);
          $keyArr = str_split($key);
      
          $plainValues = [];
          $keyValues = [];
      
          foreach ($plainTextArr as $plain) {
            $plainValues[] = ord($plain);
          }
      
          foreach ($keyArr as $keyItem) {
            $keyValues[] = ord($keyItem);
          }
      
          $cipherValues = [];
      
          for ($i = 0; $i < count($plainValues); $i++) {
            $cipherValues[] = ($plainValues[$i] + $keyValues[$i]) % 256;
          }
      
      
          // convert cypher values to cypher text
          $cipherText = '';
          foreach ($cipherValues as $value) {
            $cipherText .= chr($value);
          }

            // Simpan hasil enkripsi ke dalam session flashdata
            session()->setFlashdata('cipherText', $cipherText);

            // Simpan hasil enkripsi ke dalam file
            //write_file(WRITEPATH . 'uploads/encrypt.txt', $cipherText);

        return redirect()->to('/VigenereCipher');
    }



    public function encryptextendedvigenerecipher()
    {
            $plainText = $this->request->getPost('inputText') ?? '';
            $key = $this->request->getPost('kunci') ?? '';

            while (strlen($plainText) > strlen($key)) {
                $key .= $key;
              }
              while (strlen($plainText) < strlen($key)) {
                $key = substr($key, 0, strlen($key) - 1);
              }
          
              $plainTextArr = str_split($plainText);
              $keyArr = str_split($key);
          
              $plainValues = [];
              $keyValues = [];
          
              foreach ($plainTextArr as $plain) {
                $plainValues[] = ord($plain);
              }
          
              foreach ($keyArr as $keyItem) {
                $keyValues[] = ord($keyItem);
              }
          
              $cipherValues = [];
          
              for ($i = 0; $i < count($plainValues); $i++) {
                $cipherValues[] = ($plainValues[$i] + $keyValues[$i]) % 256;
              }
          
          
              // convert cypher values to cypher text
              $cipherText = '';
              foreach ($cipherValues as $value) {
                $cipherText .= chr($value);
              }

            // Simpan hasil enkripsi ke dalam session flashdata
            session()->setFlashdata('cipherText', $cipherText);

            // Simpan hasil enkripsi ke dalam file
            //write_file(WRITEPATH . 'uploads/encrypt.txt', $cipherText);

        return redirect()->to('/VigenereCipher');
    }

    public function decryptExtendedVignereCipherfile()
    {
        $filePath = WRITEPATH . 'uploads/Input_Teks.txt';
        $key = $this->request->getPost('kunci') ?? '';
        session()->setFlashdata('keydecrypt', $key);

        if (file_exists($filePath)) {
            $fileContent = file_get_contents($filePath);
        } else {
            echo 'File not found.';
            return;
        }

        $cipherText = $fileContent;
        session()->setFlashdata('cipherTextdecrypt', $cipherText);

        if (empty($cipherText) || empty($key)) {
            return redirect()->back()->withInput()->with('error', 'Please provide both ciphertext and key.');
        }

        while (strlen($cipherText) > strlen($key)) {
            $key .= $key;
          }
          while (strlen($cipherText) < strlen($key)) {
            $key = substr($key, 0, strlen($key) - 1);
          }
      
          $cipherTextArr = str_split($cipherText);
          $keyArr = str_split($key);
      
          $cipherValues = [];
          $keyValues = [];
      
          foreach ($cipherTextArr as $cipher) {
            $cipherValues[] = ord($cipher);
          }
      
          foreach ($keyArr as $keyItem) {
            $keyValues[] = ord($keyItem);
          }
      
          $plainValues = [];
      
          for ($i = 0; $i < count($cipherValues); $i++) {
            $plainValue = ($cipherValues[$i] - $keyValues[$i]) % 256;
            $plainValues[] = $plainValue < 0 ? $plainValue += 256 : $plainValue;
          }
      
          // convert cypher values to cypher text
          $plainText = '';
          foreach ($plainValues as $value) {
            $plainText .= chr($value);
          }

        // Simpan hasil enkripsi ke dalam session flashdata
        session()->setFlashdata('plainText', $plainText);

        return redirect()->to('/VigenereCipher');

    }

    public function decryptextendedvigenerecipher() {

        $cipherText = $this->request->getPost('inputTextDecrypt') ?? '';
        $key = $this->request->getPost('kunciDecrypt') ?? '';

        while (strlen($cipherText) > strlen($key)) {
            $key .= $key;
          }
          while (strlen($cipherText) < strlen($key)) {
            $key = substr($key, 0, strlen($key) - 1);
          }
      
          $cipherTextArr = str_split($cipherText);
          $keyArr = str_split($key);
      
          $cipherValues = [];
          $keyValues = [];
      
          foreach ($cipherTextArr as $cipher) {
            $cipherValues[] = ord($cipher);
          }
      
          foreach ($keyArr as $keyItem) {
            $keyValues[] = ord($keyItem);
          }
      
          $plainValues = [];
      
          for ($i = 0; $i < count($cipherValues); $i++) {
            $plainValue = ($cipherValues[$i] - $keyValues[$i]) % 256;
            $plainValues[] = $plainValue < 0 ? $plainValue += 256 : $plainValue;
          }
      
          // convert cypher values to cypher text
          $plainText = '';
          foreach ($plainValues as $value) {
            $plainText .= chr($value);
          }

        // Simpan hasil enkripsi ke dalam session flashdata
        session()->setFlashdata('plainText', $plainText);

        return redirect()->to('/VigenereCipher');
    }

}
