<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?= $judul ?> (Encrypt)</h1>

    <div class="container-fluid">
        <div class="form-group">
            <label for="tipeInput">Input Type</label>
            <select class="form-control" id="tipeInput" name="tipeInput">
                <option value="plaintext">File PlainText</option>
                <option value="text">Text</option>
            </select>
        </div>

        <form action="<?= base_url('AffineCipher/encryptAffineCipher') ?>" method="post" enctype="multipart/form-data" id="formText" style="display: none;">
            <div class="form-group" id="inputText" style="margin-bottom: 30px;">
                <label for="inputText">Input Teks:</label>
                <input type="text" class="form-control" id="inputText" name="inputText" style="height: 60px;">
            </div>
            <div class="form-group">
                <label for="slope">Slope:</label>
                <input type="text" class="form-control" id="slope" name="slope">
            </div>
            <div class="form-group">
                <label for="intercept">Intercept:</label>
                <input type="text" class="form-control" id="intercept" name="intercept">
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Encrypt</button>
        </form>

        <form action="<?= base_url('AffineCipher/encryptAffineCipherfile') ?>" method="post" enctype="multipart/form-data" id="formFile">
            <div class="form-group" id="inputFile" style="margin-bottom: 30px;">
                <label for="inputFile">Input File:</label>
                <input type="file" class="form-control-file" id="inputFile" name="inputFile">
            </div>
            <div class="form-group">
                <label for="slope">Slope:</label>
                <input type="text" class="form-control" id="slope" name="slope">
            </div>
            <div class="form-group">
                <label for="intercept">Intercept:</label>
                <input type="text" class="form-control" id="intercept" name="intercept">
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Encrypt</button>
        </form>
    </div>

    <!-- Output Section -->
    <div class="mt-4">
        <?php if (isset($cipherText)) : ?>
            <label>PlainText:</label>
            <p>
                <strong><?= $plainTextencrypt ?></strong>
            </p>

            <label>Slope:</label>
            <p>
                <strong><?= $slopeencrypt ?></strong>
            </p>
            <label>Intercept:</label>
            <p>
                <strong><?= $interceptencrypt ?></strong>
            </p>
            <label>Hasil Encrypt:</label>
            <p>
                <strong><?= $cipherText ?></strong>
            </p>
            <?php
            // Simpan cipherText ke dalam file txt
            $filename = 'encrypt.' . $tipeFile; // Menggunakan ekstensi yang sesuai dengan $tipeFile
            $filepath = WRITEPATH . 'uploads/' . $filename; // Ubah path sesuai dengan lokasi yang Anda inginkan
            file_put_contents($filepath, $cipherText);
            ?>
            <p>
                <a href="<?= base_url('download/file/' . $filename) ?>">Download File</a>
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
                <option value="plaintext">File PlainText</option>
                <option value="text">Text</option>
            </select>
        </div>

        <form action="<?= base_url('AffineCipher/decryptAffineCipher') ?>" method="post" enctype="multipart/form-data" id="formTextDecrypt" style="display: none;">
            <div class="form-group" id="inputTextDecrypt" style="margin-bottom: 30px;">
                <label for="inputTextDecrypt">Input Teks:</label>
                <input type="text" class="form-control" id="inputTextDecrypt" name="inputTextDecrypt" style="height: 60px;">
            </div>
            <<div class="form-group">
                <label for="slope">Slope:</label>
                <input type="text" class="form-control" id="slope" name="slope">
            </div>
            <div class="form-group">
                <label for="intercept">Intercept:</label>
                <input type="text" class="form-control" id="intercept" name="intercept">
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Decrypt</button>
        </form>


        <form action="<?= base_url('AffineCipher/decryptAffineCipherfile') ?>" method="post" enctype="multipart/form-data" id="formFileDecrypt">
            <div class="form-group" id="inputFileDecrypt" style="margin-bottom: 30px;">
                <label for="inputFileDecrypt">Input File:</label>
                <input type="file" class="form-control-file" id="inputFileDecrypt" name="inputFileDecrypt">
            </div>
            <div class="form-group">
                <label for="slope">Slope:</label>
                <input type="text" class="form-control" id="slope" name="slope">
            </div>
            <div class="form-group">
                <label for="intercept">Intercept:</label>
                <input type="text" class="form-control" id="intercept" name="intercept">
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Decrypt</button>
        </form>
    </div>

    <!-- Output Section -->
    <div class="mt-4">
        <!-- Tempat untuk menampilkan output -->
        <?php if (isset($plainText)) : ?>
            <label>Cipher Text:</label>
            <p>
                <strong><?= $cipherTextdecrypt ?></strong>
            </p>

            <label>Slope:</label>
            <p>
                <strong><?= $slopedecrypt ?></strong>
            </p>
            <label>Intercept:</label>
            <p>
                <strong><?= $interceptdecrypt ?></strong>
            </p>
            <label>Hasil Decrypt:</label>
            <p>
                <strong><?= $plainText ?></strong>
            </p>
            <?php
            // Simpan cipherText ke dalam file txt
            $filename = 'decrypt.' . $tipeFile; // Menggunakan ekstensi yang sesuai dengan $tipeFile
            $filepath = WRITEPATH . 'uploads/' . $filename; // Ubah path sesuai dengan lokasi yang Anda inginkan
            file_put_contents($filepath, $plainText);
            ?>
            <p>
                <a href="<?= base_url('download/file/' . $filename) ?>">Download File</a>
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