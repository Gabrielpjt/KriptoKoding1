<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class ProductCipher extends BaseController
{
    public function index()
    {
        $cipherText = null;
        $plainText = null;

        $data = [
            'judul' => 'Product Cipher',
            'cipherText' => session()->getFlashdata('cipherText') ?? $cipherText,
            'plainText' => session()->getFlashdata('plainText') ?? $plainText,
        ];

        return view('templates/v_header', $data) .
            view('templates/v_sidebar') .
            view('templates/v_topbar') .
            view('ProductCipher/index', $data) .
            view('templates/v_footer');
    }

    public function encryptProductCipher()
    {
        $plainText = $this->request->getPost('inputText') ?? '';
        $key = $this->request->getPost('kunci') ?? '';

        // Validate input
        if (empty($plainText) || empty($key)) {
            return redirect()->back()->withInput()->with('error', 'Please provide both plaintext and key.');
        }

        // Encrypt plaintext
        $cipherText = $this->encrypt($plainText, $key);

        // Store encrypted text in flashdata
        session()->setFlashdata('cipherText', $cipherText);

        return redirect()->to('/ProductCipher');
    }

    public function decryptProductCipher()
    {
        $cipherText = $this->request->getPost('inputTextDecrypt') ?? '';
        $key = $this->request->getPost('kunciDecrypt') ?? '';

        // Validate input
        if (empty($cipherText) || empty($key)) {
            return redirect()->back()->withInput()->with('error', 'Please provide both ciphertext and key.');
        }

        // Decrypt ciphertext
        $plainText = $this->decrypt($cipherText, $key);

        // Store decrypted text in flashdata
        session()->setFlashdata('plainText', $plainText);

        return redirect()->to('/ProductCipher');
    }

    private function encrypt($plaintext, $key)
    {
        $ciphertext = '';

        // Apply transposition
        $transposed = $this->transpose($plaintext, $key);

        // Apply substitution
        foreach (str_split($transposed) as $char) {
            if (ctype_alpha($char)) {
                $shift = ord($char) - ord('a');
                $shiftedChar = chr(($shift + strlen($key)) % 26 + ord('a'));
                $ciphertext .= $shiftedChar;
            } else {
                $ciphertext .= $char;
            }
        }

        return $ciphertext;
    }

    private function decrypt($ciphertext, $key)
    {
        $plaintext = '';
    
        // Apply reverse substitution
        $substituted = '';
        foreach (str_split($ciphertext) as $char) {
            if (ctype_alpha($char)) {
                $shift = ord($char) - ord('a');
                // Perhitungan pergeseran yang diperbaiki
                $shiftedChar = chr((($shift - strlen($key)) + 26) % 26 + ord('a'));
                $substituted .= $shiftedChar;
            } else {
                $substituted .= $char;
            }
        }
    
        // Apply reverse transposition
        $transposed = $this->transpose($substituted, $key);
    
        return $transposed;
    }    
    
    private function transpose($text, $key)
    {
        $keyLength = strlen($key);
        $textLength = strlen($text);
        $transposed = '';

        for ($i = 0; $i < $textLength; $i++) {
            $transposed .= $text[$i % $keyLength];
        }

        return $transposed;
    }
}
