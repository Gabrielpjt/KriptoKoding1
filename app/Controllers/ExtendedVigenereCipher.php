<?php

namespace App\Controllers;

use CodeIgniter\Controller;

//require '../vendor/autoload.php';

use Smalot\PdfParser\Parser; // Import namespace untuk Parser dari Smalot\PdfParser

// Memuat kelas FPDF
//require_once APPPATH . '../vendor/fpdf/fpdf.php';

class ExtendedVigenereCipher extends BaseController
{
  public function index()
  {
    $cipherText = null;
    $plainText = null;
    $plainTextencrypt = null;
    $cipherTextdecrypt = null;
    $keyencrypt = null;
    $keydecrypt = null;
    $tipeFile = null;

    $data = [
      'judul' => 'Extended Vigenere Cipher',
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
      view('ExtendedVigenereCipher/index', $data) . // Mengirimkan data ke view VigenereCipher/index
      view('templates/v_footer');
  }

  public function encryptExtendedVigenereCipherfile()
  {
  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    if ($_FILES['inputFile']['error'] === UPLOAD_ERR_OK) {
      $tmp = explode('.', $_FILES['inputFile']['name']);
      $ext = end($tmp);
      $key = $_POST['kunci'] ?? '';
      $plainText = file_get_contents($_FILES['inputFile']['tmp_name']);
      session()->setFlashdata('plainTextencrypt', $plainText);
      session()->setFlashdata('keyencrypt', $key);

      // Get MIME type of the uploaded file
      $fileName = $_FILES['inputFile']['name'];
      $pecah = explode(".", $fileName);
      $tipeFile = $pecah[1];
      session()->setFlashdata('tipeFile', $tipeFile);
    }
  }

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

    return redirect()->to('/ExtendedVigenereCipher');
  }



  public function encryptextendedvigenerecipher()
  {
    // Menetapkan header HTTP
    $response = service('response');
    $response->setHeader('Content-Type', 'text/html; charset=ISO-8859-1');
    $plainText = $this->request->getPost('inputText') ?? '';
    $key = $this->request->getPost('kunci') ?? '';

    session()->setFlashdata('plainTextencrypt', $plainText);
    session()->setFlashdata('keyencrypt', $key);


    $tipeFile = 'txt';
    session()->setFlashdata('tipeFile', $tipeFile);

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

    return redirect()->to('/ExtendedVigenereCipher');
  }

  public function decryptExtendedVigenereCipherfile()
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

    return redirect()->to('/ExtendedVigenereCipher');
  }

  public function decryptextendedvigenerecipher()
  {

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

    return redirect()->to('/ExtendedVigenereCipher');
  }
}
