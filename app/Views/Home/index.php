 <!-- Begin Page Content -->
 <div class="container-fluid">

   <!-- Page Heading -->
   <h1 class="h3 mb-4 text-gray-800"><?= $judul; ?></h1>

   <div class="container">
        <h2>Cipher Descriptions</h2>
        <p><strong>Vigenere Cipher standard (26 huruf alfabet):</strong> Vigenere Cipher adalah teknik enkripsi sederhana yang menggunakan tabel Vigenere untuk mengenkripsi teks. Pesan dienkripsi dengan menggunakan kunci alfabetik, di mana setiap huruf kunci digunakan secara berulang untuk mengenkripsi teks.</p>
        <p><strong>Extended Vigenere Cipher (256 karakter ASCII):</strong> Extended Vigenere Cipher adalah versi yang diperluas dari Vigenere Cipher, yang mampu mengenkripsi karakter ASCII dengan menggunakan tabel Vigenere yang diperbesar. Ini memungkinkan untuk mengenkripsi teks yang mengandung karakter selain huruf alfabet.</p>
        <p><strong>Playfair Cipher (26 huruf alfabet):</strong> Playfair Cipher adalah teknik enkripsi yang menggunakan matriks 5x5 dari alfabet untuk mengenkripsi teks. Setiap pasangan huruf dalam teks digantikan oleh pasangan lainnya berdasarkan aturan tertentu.</p>
        <p><strong>Product cipher:</strong> Product cipher adalah kombinasi dari Vigenere Cipher dan cipher transposisi berbasis kolom. Vigenere Cipher digunakan untuk mengenkripsi teks, kemudian hasilnya diubah dengan mengaplikasikan cipher transposisi berbasis kolom.</p>
        <p><strong>Bonus:</strong> Affine Cipher dan Autokey Vigenere Cipher adalah teknik enkripsi tambahan yang dapat digunakan untuk mengamankan pesan. Affine Cipher menggunakan fungsi matematika linier, sedangkan Autokey Vigenere Cipher menggunakan kunci yang diambil dari teks pesan itu sendiri.</p>
    </div>



 </div>
 <!-- /.container-fluid -->

 </div>
 <!-- End of Main Content -->