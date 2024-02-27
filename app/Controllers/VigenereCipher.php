<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class VigenereCipher extends BaseController
{
    public function index()
    {
        $cipherText = 'Silahkan masukkan input';
        $plainText = null;

        $data = [
            'judul' => 'Vigenere Cipher',
            'cipherText' => session()->getFlashdata('cipherText') ?? $cipherText, // Mengambil nilai cipherText dari flashdata,
            'plainText' => session()->getFlashdata('plainText') ?? $plainText,
        ];

        return view('templates/v_header', $data) .
            view('templates/v_sidebar') .
            view('templates/v_topbar') .
            view('VigenereCipher/index', $data) . // Mengirimkan data ke view VigenereCipher/index
            view('templates/v_footer');
    }

    public function encryptvigenerecipher()
    {
            $plainText = $this->request->getPost('inputText') ?? '';
            $key = $this->request->getPost('kunci') ?? '';

            $alphabets = range('a', 'z');

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

    public function decryptvigenerecipher() {

        $cipherText = $this->request->getPost('inputTextDecrypt') ?? '';
        $key = $this->request->getPost('kunciDecrypt') ?? '';

        $alphabets = range('a', 'z');

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
