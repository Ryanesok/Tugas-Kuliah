<?php
    require 'functions.php';
    $data = query("SELECT * FROM resiko");
    if(isset($_POST["login"])) {
        //cek username dan password
        if($_POST["username"] == "admin" && $_POST["password"] == "123") {
            header("Location: admin.php");
            exit;
        } elseif ($_POST["username"] == "user" && $_POST["password"] == "456") {
            header("Location: user.php");
        } 
        else {
            echo "Username tidak ditemukan!";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Risiko Mitigasi</title>
    <link rel="stylesheet" href="resources/style.css">
</head>
<body>
    <h1>Aplikasi Manajemen Risiko</h1>
    <div class="form-container">
            <form action="" method="post">
            <div class="inputs">
                <label for="username">Username:</label>
                <input type="text" name="username" id="username" placeholder="Masukkan username">

                <label for="password">Password:</label>
                <input type="password" name="password" id="password" placeholder="Masukkan password">
            </div>

            <!-- Login Button -->
            <div class="login-button">
                <button type="submit" name="login">Login</button>
            </div>
            </form>
        </div>
        <h2>Tabel Manajemen Resiko</h2>
    <section>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Resiko</th>
                    <th>Divisi</th>
                    <th>Tingkat Resiko</th>
                    <th>Penyebab Resiko</th>
                    <th>Sumber Resiko</th>
                    <th>Mitigasi</th>
                    <th>Solusi</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1?>
                <?php foreach($data as $dat):?>
                    <tr>
                    <td><?= $i; ?></td>
                    <td><?= $dat["resiko"]?></td>
                    <td><?= $dat["divisi"]?></td>
                    <td><?= $dat["tingkat"]?></td>
                    <td><?= $dat["penyebab"]?></td>
                    <td><?= $dat["sumber"]?></td>
                    <?php $i++ ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>
</body>
</html>
