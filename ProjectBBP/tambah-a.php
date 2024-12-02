<?php
    require 'functions.php';
    $enum_div = enum("SHOW COLUMNS FROM resiko LIKE 'divisi'");
    $enum_tgkt = enum("SHOW COLUMNS FROM resiko LIKE 'tingkat'");
    $enum_smbr = enum("SHOW COLUMNS FROM resiko LIKE 'sumber'");
    if(isset($_POST["submit"])){
        if(tambah($_POST)> 0){
            echo "
                <script>
                    alert('data berhasil ditambahkan!');
                    document.location.href = 'tambah-a.php';
                </script>
            ";
        }else{
            echo "
                <script>
                    alert('data gagal ditambahkan!');
                    document.location.href = 'tambah-a.php';
                </script>
            ";
        }
        
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=\, initial-scale=1.0">
    <title>Form Risk Register</title>
    <link rel="stylesheet" href="">
</head>
<body>
    <div class="header">
        <h1>Form Risk Register</h1>
        <a href="admin.php">Kembali</a> 
    </div>
    <div class="form-container">
    <form action="" method="post">
        <div class="input-container">
            <!-- label Resiko -->
            <label for="resiko">Resiko: </label>
            <input type="text" name="resiko" id="resiko" placeholder="Masukkan resiko" required>
            
            <!-- label divisi -->
            <label for="divisi">Divisi: </label>
            <select name="divisi" id="divisi" required>
                <option value="">Pilih Divisi</option>
                <?php foreach($enum_div as $divisi) :?>
                    <option value="<?= $divisi;?>"><?= $divisi?></option>
                <?php endforeach; ?>
            </select>
            
            <!-- label tingkat resiko -->
            <label for="tingkat">Tingkat Resiko: </label>
            <select name="tingkat" id="tingkat" required>
                <option value="">Pilih Tingkat Resiko</option>
                <?php foreach($enum_tgkt as $tingkat):?>
                    <option value="<?= $tingkat; ?>"><?= $tingkat?></option>
                <?php endforeach;?>
            </select>
            
            <!-- label penyebab -->
            <label for="penyebab">Penyebab: </label>
            <input type="text" name="penyebab" id="penyebab" placeholder="Masukkan penyebab" required>
            
            <!-- label sumber resiko -->
            <label for="sumber">Sumber Resiko</label>
            <select name="sumber" id="sumber" required>
                <option value="">Pilih Sumber Resiko</option>
                <?php foreach($enum_smbr as $sumber):?>
                    <option value="<?= $sumber; ?>"><?= $sumber?></option>
                <?php endforeach;?>
            </select>
        </div>
        <div class="submit-container">
            <button type="submit" name="submit">Input Resiko</button>
        </div>
    </form>
    </div>
</body>
</html>