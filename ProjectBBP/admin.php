<?php
    require 'functions.php';
    $data = query("SELECT * FROM resiko");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="resources/adminstyle.css">
</head>
<body>
    <h1>Selamat Datang Admin</h1>
    <div class="link-container">
        <a href="tambah-a.php">Tambah</a>
        <a href="hapus.php">Hapus</a>
        <a href="edit.php">Update</a>
        <a href="index.php">Logout</a>
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
                    <td><?= $i; ?></td>
                    <td><?= $dat["resiko"]?></td>
                    <td><?= $dat["divisi"]?></td>
                    <td><?= $dat["tingkat"]?></td>
                    <td><?= $dat["penyebab"]?></td>
                    <td><?= $dat["sumber"]?></td>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>
</body>
</html>
