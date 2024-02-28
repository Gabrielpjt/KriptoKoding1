<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class ProductCipher extends BaseController
{
    public function index()
    {
        $cipherText = null;
        $plainText = null;
        $plainTextencrypt = null;
        $cipherTextdecrypt = null;
        $keyencrypt = null;
        $keydecrypt = null;

        $data = [
            'judul' => 'Product Cipher',
            'cipherText' => session()->getFlashdata('cipherText') ?? $cipherText,
            'plainText' => session()->getFlashdata('plainText') ?? $plainText,
            'plainTextencrypt' => session()->getFlashdata('plainTextencrypt') ?? $plainTextencrypt,
            'cipherTextdecrypt' => session()->getFlashdata('cipherTextdecrypt') ?? $cipherTextdecrypt,
            'keyencrypt' => session()->getFlashdata('keyencrypt') ?? $keyencrypt,
            'keydecrypt' => session()->getFlashdata('keydecrypt') ?? $keydecrypt,
        ];

        return view('templates/v_header', $data) .
            view('templates/v_sidebar') .
            view('templates/v_topbar') .
            view('ProductCipher/index', $data) .
            view('templates/v_footer');
    }

    public function encryptProductCipherfile()
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

        $cipherText = $this->encrypt($plainText, $key);
        $cipherText = $this->transposeencrypt($cipherText, $key);

        session()->setFlashdata('cipherText', $cipherText);

        return redirect()->to('/ProductCipher');
    }

    public function encryptProductCipher()
    {
        $plainText = $this->request->getPost('inputText') ?? '';
        session()->setFlashdata('plainTextencrypt', $plainText);
        $key = $this->request->getPost('kunci') ?? '';
        session()->setFlashdata('keyencrypt', $key);

        if (empty($plainText) || empty($key)) {
            return redirect()->back()->withInput()->with('error', 'Please provide both plaintext and key.');
        }

        $cipherText = $this->encrypt($plainText, $key);
        $cipherText = $this->transposeencrypt($cipherText, $key);

        session()->setFlashdata('cipherText', $cipherText);

        return redirect()->to('/ProductCipher');
    }

    public function decryptProductCipherfile()
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

        $plainText = $this->transposedecrypt($cipherText, $key);
        $plainText = $this->decrypt($plainText, $key);

        session()->setFlashdata('plainText', $plainText);

        return redirect()->to('/ProductCipher');
    }

    public function decryptProductCipher()
    {
        $cipherText = $this->request->getPost('inputTextDecrypt') ?? '';
        $key = $this->request->getPost('kunciDecrypt') ?? '';
        session()->setFlashdata('keydecrypt', $key);
        session()->setFlashdata('cipherTextdecrypt', $cipherText);

        if (empty($cipherText) || empty($key)) {
            return redirect()->back()->withInput()->with('error', 'Please provide both ciphertext and key.');
        }

        $plainText = $this->transposedecrypt($cipherText, $key);
        $plainText = $this->decrypt($plainText, $key);

        session()->setFlashdata('plainText', $plainText);

        return redirect()->to('/ProductCipher');
    }

    private function encrypt($plainText, $key)
    {
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

        return $cipherText;

    }
    
    private function decrypt($cipherText, $key)
    {
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

        return $plainText;
    }

    private function compare($first, $second) {
        return strcmp($first->Value, $second->Value);
    }

    private function GetShiftIndexes($key)
    {
        $keyLength = strlen($key);
        $indexes = array();
        $sortedKey = array();
        $i;

        for ($i = 0; $i < $keyLength; ++$i) {
            $pair = new KeyValuePair();
            $pair->Key = $i;
            $pair->Value = $key[$i];
            $sortedKey[] = $pair;
        }

        usort($sortedKey, array($this, 'compare'));
        $i = 0;

        for ($i = 0; $i < $keyLength; ++$i)
            $indexes[$sortedKey[$i]->Key] = $i;

        return $indexes;
    }

    private function Encipher($input, $key, $padChar)
    {
        $output = "";
        $totalChars = strlen($input);
        $keyLength = strlen($key);
        $input = ($totalChars % $keyLength == 0) ? $input : str_pad($input, $totalChars - ($totalChars % $keyLength) + $keyLength, $padChar, STR_PAD_RIGHT);
        $totalChars = strlen($input);
        $totalColumns = $keyLength;
        $totalRows = ceil($totalChars / $totalColumns);
        $rowChars = array(array());
        $colChars = array(array());
        $sortedColChars = array(array());
        $currentRow = 0; $currentColumn = 0; $i = 0; $j = 0;
        $shiftIndexes = $this->GetShiftIndexes($key);

        for ($i = 0; $i < $totalChars; ++$i)
        {
            $currentRow = $i / $totalColumns;
            $currentColumn = $i % $totalColumns;
            $rowChars[$currentRow][$currentColumn] = $input[$i];
        }

        for ($i = 0; $i < $totalRows; ++$i)
            for ($j = 0; $j < $totalColumns; ++$j)
                $colChars[$j][$i] = $rowChars[$i][$j];

        for ($i = 0; $i < $totalColumns; ++$i)
            for ($j = 0; $j < $totalRows; ++$j)
                $sortedColChars[$shiftIndexes[$i]][$j] = $colChars[$i][$j];

        for ($i = 0; $i < $totalChars; ++$i)
        {
            $currentRow = $i / $totalRows;
            $currentColumn = $i % $totalRows;
            $output .= $sortedColChars[$currentRow][$currentColumn];
        }

        return $output;
    }

    private function Decipher($input, $key)
    {
        $output = "";
        $keyLength = strlen($key);
        $totalChars = strlen($input);
        $totalColumns = ceil($totalChars / $keyLength);
        $totalRows = $keyLength;
        $rowChars = array();
        $colChars = array();
        $unsortedColChars = array();
        $currentRow = 0;
        $currentColumn = 0;
        $i = 0;
        $j = 0;
        $shiftIndexes = $this->GetShiftIndexes($key);
    
        for ($i = 0; $i < $totalChars; ++$i) {
            $currentRow = $i / $totalColumns;
            $currentColumn = $i % $totalColumns;
            $rowChars[$currentRow][$currentColumn] = $input[$i];
        }
    
        for ($i = 0; $i < $totalRows; ++$i) {
            for ($j = 0; $j < $totalColumns; ++$j) {
                // Perbaikan inisialisasi array untuk menghindari "Undefined array key"
                $colChars[$j][$i] = $rowChars[$i][$j] ?? '';
            }
        }
    
        for ($i = 0; $i < $totalColumns; ++$i) {
            for ($j = 0; $j < $totalRows; ++$j) {
                $unsortedColChars[$i][$j] = $colChars[$i][$shiftIndexes[$j]] ?? '';
            }
        }
    
        for ($i = 0; $i < $totalChars; ++$i) {
            $currentRow = $i / $totalRows;
            $currentColumn = $i % $totalRows;
            $output .= $unsortedColChars[$currentRow][$currentColumn];
        }
    
        return $output;
    }


    private function transposeencrypt($text, $key)
    {
        // Memanggil fungsi Encipher dengan teks dan kunci yang diberikan
        return $this->Encipher($text, $key, ' ');
    }

    private function transposedecrypt($text, $key)
    {
        // Memanggil fungsi Encipher dengan teks dan kunci yang diberikan
        return $this->Decipher($text, $key);
    }
    
}

class KeyValuePair
{
    public $Key;
    public $Value;
}
