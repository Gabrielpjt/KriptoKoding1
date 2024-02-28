<?php

namespace App\Controllers;

use CodeIgniter\Controller;


class AffineCipher extends BaseController
{
  public function index()
  {
    $cipherText = null;
    $plainText = null;
    $plainTextencrypt = null;
    $cipherTextdecrypt = null;
    $slopeencrypt = null;
    $slopedecrypt = null;
    $interceptencrypt = null;
    $interceptdecrypt = null;
    $tipeFile = null;

    $data = [
      'judul' => 'Affine Cipher',
      'cipherText' => session()->getFlashdata('cipherText') ?? $cipherText, // Mengambil nilai cipherText dari flashdata,
      'plainText' => session()->getFlashdata('plainText') ?? $plainText,
      'plainTextencrypt' => session()->getFlashdata('plainTextencrypt') ?? $plainTextencrypt,
      'cipherTextdecrypt' => session()->getFlashdata('cipherTextdecrypt') ?? $cipherTextdecrypt,
      'slopeencrypt' => session()->getFlashdata('slopeencrypt') ?? $slopeencrypt,
      'slopedecrypt' => session()->getFlashdata('slopedecrypt') ?? $slopedecrypt,
      'interceptencrypt' => session()->getFlashdata('interceptencrypt') ?? $interceptencrypt,
      'interceptdecrypt' => session()->getFlashdata('interceptdecrypt') ?? $interceptdecrypt,
      'tipeFile' => session()->getFlashdata('tipeFile') ?? $tipeFile,
    ];

    return view('templates/v_header', $data) .
      view('templates/v_sidebar') .
      view('templates/v_topbar') .
      view('AffineCipher/index', $data) . // Mengirimkan data ke view VigenereCipher/index
      view('templates/v_footer');
  }

  public static $slopeOption = [1, 3, 5, 7, 9, 11, 15, 17, 19, 21];

  public static function checkRelativePrime($slope)
  {
    for ($i = 1; $i <= $slope; $i++) {
      if ($i !== 1) {
        if ($slope % $i === 0 && 26 % $i === 0) {
          return false;
        }
      }
    }
    return true;
  }

  private static function findInverseSlope($slope)
  {
    $i = 1;
    while (($slope * $i) % 26 !== 1) {
      $i++;
    }
    return $i;
  }


  public function encryptAffineCipherfile()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
        if ($_FILES['inputFile']['error'] === UPLOAD_ERR_OK) {
        $tmp = explode('.', $_FILES['inputFile']['name']);
        $ext = end($tmp);
        $slope = $_POST['slope'] ?? '';
        $intercept = $_POST['intercept'] ?? '';
        session()->setFlashdata('slopeencrypt', $slope);
        session()->setFlashdata('interceptencrypt', $intercept);
        $plainText = file_get_contents($_FILES['inputFile']['tmp_name']);
        session()->setFlashdata('plainTextencrypt', $plainText);

        // Get MIME type of the uploaded file
        $fileName = $_FILES['inputFile']['name'];
        $pecah = explode(".", $fileName);
        $tipeFile = $pecah[1];
        session()->setFlashdata('tipeFile', $tipeFile);
        }
    }

        $alphabets = range('a', 'z');

        $plainTextArr = str_split(strtolower($plainText));

        $plainValues = [];

        foreach ($plainTextArr as $plain) {
            foreach ($alphabets as $index => $alphabet) {
            if ($alphabet === $plain) {
                $plainValues[] = $index;
            }
            }
        }

        $cipherValues = [];

        foreach ($plainValues as $plainValue) {
            $cipherValues[] = ($slope * $plainValue + $intercept) % 26;
        }

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

    return redirect()->to('/AffineCipher');
  }



  public function encryptaffinecipher()
  {
    // Menetapkan header HTTP
    $response = service('response');
    $response->setHeader('Content-Type', 'text/html; charset=ISO-8859-1');
    $plainText = $this->request->getPost('inputText') ?? '';
    $slope = $this->request->getPost('slope') ?? '';
    $intercept = $this->request->getPost('intercept') ?? '';

    session()->setFlashdata('plainTextencrypt', $plainText);
    session()->setFlashdata('slopeencrypt', $slope);
    session()->setFlashdata('interceptencrypt', $intercept);

    $tipeFile = 'txt';
    session()->setFlashdata('tipeFile', $tipeFile);

        $alphabets = range('a', 'z');

        $plainTextArr = str_split(strtolower($plainText));

        $plainValues = [];

        foreach ($plainTextArr as $plain) {
            foreach ($alphabets as $index => $alphabet) {
            if ($alphabet === $plain) {
                $plainValues[] = $index;
            }
            }
        }

        $cipherValues = [];

        foreach ($plainValues as $plainValue) {
            $cipherValues[] = ($slope * $plainValue + $intercept) % 26;
        }

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

    return redirect()->to('/AffineCipher');
  }

  public function decryptAffineCipherfile()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
        if ($_FILES['inputFile']['error'] === UPLOAD_ERR_OK) {
        $tmp = explode('.', $_FILES['inputFile']['name']);
        $ext = end($tmp);
        $slope = $_POST['slope'] ?? '';
        $intercept = $_POST['intercept'] ?? '';
        session()->setFlashdata('slopedecrypt', $slope);
        session()->setFlashdata('interceptdecrypt', $intercept);
        $cipherText = file_get_contents($_FILES['inputFileDecrypt']['tmp_name']);
        session()->setFlashdata('cipherTextdecrypt', $cipherText);

        // Get MIME type of the uploaded file
        $fileName = $_FILES['inputFile']['name'];
        $pecah = explode(".", $fileName);
        $tipeFile = $pecah[1];
        session()->setFlashdata('tipeFile', $tipeFile);
        }
    }

    $alphabets = range('a', 'z');

    $cipherTextArr = str_split(strtolower($cipherText));

    $cipherValues = [];

    foreach ($cipherTextArr as $cipher) {
      foreach ($alphabets as $index => $alphabet) {
        if ($alphabet === $cipher) {
          $cipherValues[] = $index;
        }
      }
    }

    $plainValues = [];
    $inverseSlope = Affine::findInverseSlope($slope);
    foreach ($cipherValues as $cipherValue) {
      $plainValue = ($inverseSlope * ($cipherValue - $intercept)) % 26;
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

    return redirect()->to('/AffineCipher');
  }

  public function decryptaffinecipher()
  {

    // Menetapkan header HTTP
    $response = service('response');
    $response->setHeader('Content-Type', 'text/html; charset=ISO-8859-1');
    $cipherText = $this->request->getPost('inputTextDecrypt') ?? '';
    $slope = $this->request->getPost('slope') ?? '';
    $intercept = $this->request->getPost('intercept') ?? '';

    session()->setFlashdata('cipherTextdecrypt', $cipherText);
    session()->setFlashdata('slopedecrypt', $slope);
    session()->setFlashdata('interceptdecrypt', $intercept);

    $tipeFile = 'txt';
    session()->setFlashdata('tipeFile', $tipeFile);

    $alphabets = range('a', 'z');

    $cipherTextArr = str_split(strtolower($cipherText));

    $cipherValues = [];

    foreach ($cipherTextArr as $cipher) {
      foreach ($alphabets as $index => $alphabet) {
        if ($alphabet === $cipher) {
          $cipherValues[] = $index;
        }
      }
    }

    $plainValues = [];
    $inverseSlope = $this->findInverseSlope($slope);
    foreach ($cipherValues as $cipherValue) {
      $plainValue = ($inverseSlope * ($cipherValue - $intercept)) % 26;
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

    return redirect()->to('/AffineCipher');
  }
}
