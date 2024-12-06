<?php
    require "../resources/functions.php";
    $data = query("SELECT * FROM resiko");
    if(isset($_POST["hapus"])){
        if(hapus($_POST['id'])){
            echo "
                <script>
                    alert('data berhasil dihapus!');
                    document.location.href = 'hapus.php';
                </script>
            ";
        }else{
            echo "
            <script>
                alert('data gagal dihapus!');
                document.location.href = 'hapus.php';
            </script>
        ";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hapus data</title>
</head>
<body>
    <h1>Hapus data resiko</h1>
    <a href="admin.php">Kembali</a>
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
                        <td><?= $dat["mitigasi"]?></td>
                        <td><?= $dat["solusi"]?></td>
                        <td>
                            <form action="" method="post">
                                <input type="hidden" name="id" value="<?= $dat['id'];?>">
                                <button type="submit" name="hapus">Hapus</button></td>
                            </form>  
                        <?php $i++;?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>
</body>
</html>
