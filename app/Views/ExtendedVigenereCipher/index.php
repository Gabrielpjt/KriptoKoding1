<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?= $judul ?> (Encrypt)</h1>

    <div class="container-fluid">
        <div class="form-group">
            <label for="tipeInput">Input Type</label>
            <select class="form-control" id="tipeInput" name="tipeInput">
                <option value="plaintext">File Plaintext</option>
                <option value="text">Text</option>
            </select>
        </div>

        <form action="<?= base_url('ExtendedVigenereCipher/encryptExtendedVigenereCipher') ?>" method="post" enctype="multipart/form-data" id="formText" style="display: none;">
            <div class="form-group" id="inputText" style="margin-bottom: 30px;">
                <label for="inputText">Input Teks:</label>
                <input type="text" class="form-control" id="inputText" name="inputText" style="height: 60px;">
            </div>
            <div class="form-group">
                <label for="kunci">Kunci:</label>
                <input type="text" class="form-control" id="kunci" name="kunci">
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Encrypt</button>
        </form>

        <form action="<?= base_url('upload/doUploadExtendedVigenereCipher') ?>" method="post" enctype="multipart/form-data" id="formFile">
            <div class="form-group" id="inputFile" style="margin-bottom: 30px;">
                <label for="inputFile">Input File:</label>
                <input type="file" class="form-control" id="inputFile" name="inputFile">
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Simpan File</button>
        </form>

        <form action="<?= base_url('ExtendedVigenereCipher/encryptExtendedVigenereCipherfile') ?>" method="post" enctype="multipart/form-data" id="formFile1">
            <div class="form-group">
                <label for="kunci">Kunci:</label>
                <input type="text" class="form-control" id="kunci" name="kunci">
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Encrypt</button>
        </form>
    </div>

    <!-- Output Section -->
    <div class="mt-4">
        <label>PlainText:</label>
        <p>
            <strong><?= $plainTextencrypt ?></strong>
        </p>

        <label>Kunci:</label>
        <p>
            <strong><?= $keyencrypt ?></strong>
        </p>
        <label>Hasil Encrypt:</label>
        <?php if (isset($cipherText)) : ?>
            <p>
                <strong><?= $cipherText ?></strong>
            </p>
            <?php
            // Simpan cipherText ke dalam file txt
            $filename = 'encrypt.txt';
            $filepath = WRITEPATH . 'uploads/' . $filename; // Ubah path sesuai dengan lokasi yang Anda inginkan
            file_put_contents($filepath, $cipherText);
            ?>
            <p>
            <a href="<?= base_url('download/file/encrypt.txt') ?>">Download File</a>
            </p>
        <?php else : ?> 
            <p>
                <strong>Please input some text</strong>
            </p>
        <?php endif ?>


    </div>
</div>

<div class="container-fluid mt-5">
    <h1 class="h3 mb-4 text-gray-800"><?= $judul ?> (Decrypt)</h1>
    
    <div class="container-fluid">
        <div class="form-group">
            <label for="tipeInputDecrypt">Input Type</label>
            <select class="form-control" id="tipeInputDecrypt" name="tipeInputDecrypt">
                <option value="plaintext">File Plaintext</option>
                <option value="text">Text</option>
            </select>
        </div>

        <form action="<?= base_url('ExtendedVigenereCipher/decryptExtendedVigenereCipher') ?>" method="post" enctype="multipart/form-data" id="formTextDecrypt" style="display: none;">
            <div class="form-group" id="inputTextDecrypt" style="margin-bottom: 30px;">
                <label for="inputTextDecrypt">Input Teks:</label>
                <input type="text" class="form-control" id="inputTextDecrypt" name="inputTextDecrypt" style="height: 60px;">
            </div>
            <div class="form-group">
                <label for="kunciDecrypt">Kunci:</label>
                <input type="text" class="form-control" id="kunciDecrypt" name="kunciDecrypt">
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Decrypt</button>
        </form>

        <form action="<?= base_url('upload/doUploadExtendedVigenereCipher') ?>" method="post" enctype="multipart/form-data" id="formFileDecrypt">
            <div class="form-group" id="inputFile" style="margin-bottom: 30px;">
                <label for="inputFile">Input File:</label>
                <input type="file" class="form-control" id="inputFileDecrypt" name="inputFile">
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Simpan File</button>
        </form>

        <form action="<?= base_url('ExtendedVigenereCipher/decryptExtendedVigenereCipherfile') ?>" method="post" enctype="multipart/form-data" id="formFile1Decrypt">
            <div class="form-group">
                <label for="kunci">Kunci:</label>
                <input type="text" class="form-control" id="kunciDecrypt" name="kunci">
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Decrypt</button>
        </form>
    </div>

    <!-- Output Section -->
    <div class="mt-4">
        <label>Cipher Text:</label>
        <p>
            <strong><?= $cipherTextdecrypt ?></strong>
        </p>

        <label>Kunci:</label>
        <p>
            <strong><?= $keydecrypt ?></strong>
        </p>
        <label>Hasil Decrypt:</label>
        <!-- Tempat untuk menampilkan output -->
        <?php if (isset($plainText)) : ?>
            <p>
                <strong><?= $plainText ?></strong>
            </p>
            <?php
            // Simpan cipherText ke dalam file txt
            $filename = 'decrypt.txt';
            $filepath = WRITEPATH . 'uploads/' . $filename; // Ubah path sesuai dengan lokasi yang Anda inginkan
            file_put_contents($filepath, $plainText);
            ?>
            <p>
            <a href="<?= base_url('download/file/decrypt.txt') ?>">Download File</a>
            </p>
        <?php else : ?> 
            <p>
                <strong>Please input some text</strong>
            </p>
        <?php endif ?>


    </div>
    </div>
</div>

<script>
    document.getElementById('tipeInput').addEventListener('change', function() {
        var selectedValue = this.value;
        var inputText = document.getElementById('inputText');
        var inputFile = document.getElementById('inputFile');

        if (selectedValue === 'text') {
            inputText.style.display = 'block';
            inputFile.style.display = 'none';
            document.getElementById('formText').style.display = 'block';
            document.getElementById('formFile').style.display = 'none';
            document.getElementById('formFile1').style.display = 'none';

        } else {
            inputText.style.display = 'none';
            inputFile.style.display = 'block';
            document.getElementById('formText').style.display = 'none';
            document.getElementById('formFile').style.display = 'block';
            document.getElementById('formFile1').style.display = 'block';

        }
    });

    document.getElementById('tipeInputDecrypt').addEventListener('change', function() {
        var selectedValue = this.value;
        var inputTextDecrypt = document.getElementById('inputTextDecrypt');
        var inputFileDecrypt = document.getElementById('inputFileDecrypt');

        if (selectedValue === 'text') {
            inputTextDecrypt.style.display = 'block';
            inputFileDecrypt.style.display = 'none';
            document.getElementById('formTextDecrypt').style.display = 'block';
            document.getElementById('formFileDecrypt').style.display = 'none';
            document.getElementById('formFile1Decrypt').style.display = 'none';
        } else {
            inputTextDecrypt.style.display = 'none';
            inputFileDecrypt.style.display = 'block';
            document.getElementById('formTextDecrypt').style.display = 'none';
            document.getElementById('formFileDecrypt').style.display = 'block';
            document.getElementById('formFile1Decrypt').style.display = 'block';
        }
    });
</script>