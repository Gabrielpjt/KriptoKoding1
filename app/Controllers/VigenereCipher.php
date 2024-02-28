<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class VigenereCipher extends BaseController
{
    public function index()
    {
        $cipherText = null;
        $plainText = null;
        $plainTextencrypt = null;
        $cipherTextdecrypt = null;
        $tipeFile = null;
        $keyencrypt = null;
        $keydecrypt = null;

        $data = [
            'judul' => 'Vigenere Cipher',
            'cipherText' => session()->getFlashdata('cipherText') ?? $cipherText, // Mengambil nilai cipherText dari flashdata,
            'plainText' => session()->getFlashdata('plainText') ?? $plainText,
            'plainTextencrypt' => session()->getFlashdata('plainTextencrypt') ?? $plainTextencrypt,
            'cipherTextdecrypt' => session()->getFlashdata('cipherTextdecrypt') ?? $cipherTextdecrypt,
            'keyencrypt' => session()->getFlashdata('keyencrypt') ?? $keyencrypt,
            'keydecrypt' => session()->getFlashdata('keydecrypt') ?? $keydecrypt,
            'tipeFile' => session()->getFlashdata('tipeFile') ?? $tipeFile,
        ];

        return view('templates/v_header', $data) .
            view('templates/v_sidebar') .
            view('templates/v_topbar') .
            view('VigenereCipher/index', $data) . // Mengirimkan data ke view VigenereCipher/index
            view('templates/v_footer');
    }

    public function encryptVigenereCipherfile()
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

        $alphabets = range('a', 'z');

        $plainText = implode(explode(' ', $plainText));
        $key = implode(explode(' ', $key));

        while (strlen($plainText) > strlen($key)) {
            $key .= $key;
        }
        while (strlen($plainText) < strlen($key)) {
            $key = substr($key, 0, strlen($key) - 1);
        }

        $plainTextArr = str_split(strtolower($plainText));
        $keyArr = str_split(strtolower($key));

        $plainValues = [];
        $keyValues = [];

        foreach ($plainTextArr as $plain) {
            foreach ($alphabets as $index => $alphabet) {
                if ($alphabet === $plain) {
                    $plainValues[] = $index;
                }
            }
        }

        foreach ($keyArr as $keyItem) {
            foreach ($alphabets as $index => $alphabet) {
                if ($alphabet === $keyItem) {
                    $keyValues[] = $index;
                }
            }
        }

        $cipherValues = [];

        for ($i = 0; $i < count($plainValues); $i++) {
            $cipherValues[] = ($plainValues[$i] + $keyValues[$i]) % 26;
        }

        // convert cipher values to cipher text
        $cipherText = '';
        foreach ($cipherValues as $value) {
            foreach ($alphabets as $index => $alphabet) {
                if ($value === $index) {
                    $cipherText .= $alphabet;
                }
            }
        }

        // Simpan hasil enkripsi ke dalam session flashdata
        session()->setFlashdata('cipherText', $cipherText);

        // Simpan hasil enkripsi ke dalam file
        //write_file(WRITEPATH . 'uploads/encrypt.txt', $cipherText);

        return redirect()->to('/VigenereCipher');
    }



    public function encryptvigenerecipher()
    {
        $plainText = $this->request->getPost('inputText') ?? '';
        $key = $this->request->getPost('kunci') ?? '';

        session()->setFlashdata('plainTextencrypt', $plainText);
        session()->setFlashdata('keyencrypt', $key);
        session()->setFlashdata('tipeFile', 'txt');

        $alphabets = range('a', 'z');

        $plainText = implode(explode(' ', $plainText));
        $key = implode(explode(' ', $key));

        while (strlen($plainText) > strlen($key)) {
            $key .= $key;
        }
        while (strlen($plainText) < strlen($key)) {
            $key = substr($key, 0, strlen($key) - 1);
        }

        $plainTextArr = str_split(strtolower($plainText));
        $keyArr = str_split(strtolower($key));

        $plainValues = [];
        $keyValues = [];

        foreach ($plainTextArr as $plain) {
            foreach ($alphabets as $index => $alphabet) {
                if ($alphabet === $plain) {
                    $plainValues[] = $index;
                }
            }
        }

        foreach ($keyArr as $keyItem) {
            foreach ($alphabets as $index => $alphabet) {
                if ($alphabet === $keyItem) {
                    $keyValues[] = $index;
                }
            }
        }

        $cipherValues = [];

        for ($i = 0; $i < count($plainValues); $i++) {
            $cipherValues[] = ($plainValues[$i] + $keyValues[$i]) % 26;
        }

        // convert cipher values to cipher text
        $cipherText = '';
        foreach ($cipherValues as $value) {
            foreach ($alphabets as $index => $alphabet) {
                if ($value === $index) {
                    $cipherText .= $alphabet;
                }
            }
        }

        // Simpan hasil enkripsi ke dalam session flashdata
        session()->setFlashdata('cipherText', $cipherText);

        // Simpan hasil enkripsi ke dalam file
        //write_file(WRITEPATH . 'uploads/encrypt.txt', $cipherText);

        return redirect()->to('/VigenereCipher');
    }

    public function decryptVigenereCipherfile()
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

        $alphabets = range('a', 'z');

        $cipherText = implode(explode(' ', $cipherText));
        $key = implode(explode(' ', $key));

        while (strlen($cipherText) > strlen($key)) {
            $key .= $key;
        }
        while (strlen($cipherText) < strlen($key)) {
            $key = substr($key, 0, strlen($key) - 1);
        }


        $cipherTextArr = str_split(strtolower($cipherText));
        $keyArr = str_split(strtolower($key));

        $cipherValues = [];
        $keyValues = [];

        foreach ($cipherTextArr as $cipher) {
            foreach ($alphabets as $index => $alphabet) {
                if ($alphabet === $cipher) {
                    $cipherValues[] = $index;
                }
            }
        }

        foreach ($keyArr as $keyItem) {
            foreach ($alphabets as $index => $alphabet) {
                if ($alphabet === $keyItem) {
                    $keyValues[] = $index;
                }
            }
        }

        $plainValues = [];

        for ($i = 0; $i < count($cipherValues); $i++) {
            $plainValue = ($cipherValues[$i] - $keyValues[$i]) % 26;
            $plainValues[] = $plainValue < 0 ? $plainValue += 26 : $plainValue;
        }

        // convert cypher values to cypher text
        $plainText = '';
        foreach ($plainValues as $value) {
            foreach ($alphabets as $index => $alphabet) {
                if ($value === $index) {
                    $plainText .= $alphabet;
                }
            }
        }

        // Simpan hasil enkripsi ke dalam session flashdata
        session()->setFlashdata('plainText', $plainText);

        return redirect()->to('/VigenereCipher');
    }

    public function decryptvigenerecipher()
    {

        $cipherText = $this->request->getPost('inputTextDecrypt') ?? '';
        $key = $this->request->getPost('kunciDecrypt') ?? '';
        session()->setFlashdata('cipherTextdecrypt', $cipherText);
        session()->setFlashdata('keydecrypt', $key);
        session()->setFlashdata('tipeFile', 'txt');

        $alphabets = range('a', 'z');

        $cipherText = implode(explode(' ', $cipherText));
        $key = implode(explode(' ', $key));

        while (strlen($cipherText) > strlen($key)) {
            $key .= $key;
        }
        while (strlen($cipherText) < strlen($key)) {
            $key = substr($key, 0, strlen($key) - 1);
        }


        $cipherTextArr = str_split(strtolower($cipherText));
        $keyArr = str_split(strtolower($key));

        $cipherValues = [];
        $keyValues = [];

        foreach ($cipherTextArr as $cipher) {
            foreach ($alphabets as $index => $alphabet) {
                if ($alphabet === $cipher) {
                    $cipherValues[] = $index;
                }
            }
        }

        foreach ($keyArr as $keyItem) {
            foreach ($alphabets as $index => $alphabet) {
                if ($alphabet === $keyItem) {
                    $keyValues[] = $index;
                }
            }
        }

        $plainValues = [];

        for ($i = 0; $i < count($cipherValues); $i++) {
            $plainValue = ($cipherValues[$i] - $keyValues[$i]) % 26;
            $plainValues[] = $plainValue < 0 ? $plainValue += 26 : $plainValue;
        }

        // convert cypher values to cypher text
        $plainText = '';
        foreach ($plainValues as $value) {
            foreach ($alphabets as $index => $alphabet) {
                if ($value === $index) {
                    $plainText .= $alphabet;
                }
            }
        }

        // Simpan hasil enkripsi ke dalam session flashdata
        session()->setFlashdata('plainText', $plainText);

        return redirect()->to('/VigenereCipher');
    }
}
