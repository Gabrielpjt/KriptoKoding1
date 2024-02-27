<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?= $judul ?> (Encrypt)</h1>

    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Form untuk pencarian -->
        <form action="<?= base_url('VigenereCipher/encryptvigenerecipher') ?>" method="post">
            <div class="form-group">
                <label for="tipeInput">Input Type</label>
                <select class="form-control" id="tipeInput" name="tipeInput">
                    <option value="text">Text</option>
                    <option value="image">Image</option>
                    <option value="plaintext">Plaintext</option>
                </select>
            </div>
            <div class="form-group" id="inputText" style="margin-bottom: 30px;">
                <label for="inputText">Input Teks:</label>
                <input type="text" class="form-control" id="inputText" name="inputText" style="height: 60px;">
            </div>
            <div class="form-group" id="inputFile" style="display: none;">
                <label for="inputFile">Input File:</label>
                <input type="file" class="form-control" id="inputFile" name="inputFile">
            </div>
            <div class="form-group">
                <label for="kunci">Kunci:</label>
                <input type="text" class="form-control" id="kunci" name="kunci">
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Encrypt</button>
        </form>
    </div>

    <!-- Output Section -->
    <div class="mt-4">
        <label>Hasil Encrypt:</label>
        <?php if (isset($cipherText)) : ?>
            <p>
                <strong><?= $cipherText ?></strong>
            </p>
            <?php 
                // Simpan cipherText ke dalam file txt
                $filename = 'encrypt.txt';
                file_put_contents(__DIR__ . '/uploads' . $filename, $cipherText);
            ?>
            <p>
                <a href="/uploads/<?= $filename ?>" download>Download encrypted text file</a>
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
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Form untuk pencarian -->
        <form action="<?= base_url('/VigenereCipher/decryptvigenerecipher') ?>" method="post">
            <div class="form-group">
                <label for="tipeInputDecrypt">Input Type</label>
                <select class="form-control" id="tipeInputDecrypt" name="tipeInputDecrypt">
                    <option value="text">Text</option>
                    <option value="image">Image</option>
                    <option value="plaintext">Plaintext</option>
                </select>
            </div>
            <div class="form-group" id="inputTextDecrypt" style="margin-bottom: 30px;">
                <label for="inputTextDecrypt">Input Teks:</label>
                <input type="text" class="form-control" id="inputTextDecrypt" name="inputTextDecrypt" style="height: 60px;">
            </div>
            <div class="form-group" id="inputFileDecrypt" style="display: none;">
                <label for="inputFileDecrypt">Input File:</label>
                <input type="file" class="form-control" id="inputFileDecrypt" name="inputFileDecrypt">
            </div>
            <div class="form-group">
                <label for="kunciDecrypt">Kunci:</label>
                <input type="text" class="form-control" id="kunciDecrypt" name="kunciDecrypt">
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Decrypt</button>
        </form>
    </div>

    <!-- Output Section -->
    <div class="mt-4">
        <label>Hasil Decrypt:</label>
        <!-- Tempat untuk menampilkan output -->
        <?php if (isset($plainText)) : ?>
            <p>
                <strong><?= $plainText ?></strong>
            </p>
            <?php 
                // Simpan cipherText ke dalam file txt
                $filename = 'decrypt.txt';
                file_put_contents(__DIR__ . '/uploads' . $filename, $plainText);
            ?>
            <p>
                <a href="/uploads/<?= $filename ?>" download>Download decrypted text file</a>
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
        } else {
            inputText.style.display = 'none';
            inputFile.style.display = 'block';
        }
    });

    document.getElementById('tipeInputDecrypt').addEventListener('change', function() {
        var selectedValue = this.value;
        var inputTextDecrypt = document.getElementById('inputTextDecrypt');
        var inputFileDecrypt = document.getElementById('inputFileDecrypt');

        if (selectedValue === 'text') {
            inputTextDecrypt.style.display = 'block';
            inputFileDecrypt.style.display = 'none';
        } else {
            inputTextDecrypt.style.display = 'none';
            inputFileDecrypt.style.display = 'block';
        }
    });
</script>