<?php
    require '../resources/functions.php';
    $data = query("SELECT * FROM resiko");
    if(isset($_POST['tambah-m'])){
        if(tambahmitigasi($_POST)){
            echo "
                <script>
                    alert('data berhasil ditambahkan!');
                    document.location.href = 'tambah-m-a.php';
                </script>
            ";
        }else{
            echo "
                <script>
                    alert('data gagal ditambahkan!');
                    document.location.href = 'tambah-m-a.php';
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
    <title>Tambah Mitigasi</title>
</head>
<body>
    <h1>Tambah Mitigasi</h1>
    <a href="tambah-a.php">Kembali</a>
    <section>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Risiko</th>
                    <th>Tingkat</th>
                    <th>Mitigasi</th>
                    <th>Solusi</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1?>
                <?php foreach($data as $dat): ?>
                    <tr>
                        <td><?= $i;?></td>
                        <td><?= $dat['resiko'];?></td>
                        <td><?= $dat['tingkat'];?></td>
                        <td>
                            <ul>
                                <?php
                                    $mitigasiData = query("SELECT * FROM mitigasi WHERE resiko_id = ". $dat['id']);
                                    foreach($mitigasiData as $mit):
                                ?>
                                <li><?= $mit['mitigasi'] ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </td>
                        <td>
                            <?php foreach($mitigasiData as $mit): ?>
                                <li><?= $mit['solusi']?></li>
                            <?php endforeach; ?>
                        </td>
                        <td>
                            <form action="" method="post">
                                <input type="hidden" name="id" value="<?= $dat['id'];?>">
                                <label for="mitigasi"></label>
                                <input type="text" id="mitigasi" name="mitigasi" placeholder="tambahkan mitigasi..." required>
                                <label for="solusi"></label>
                                <input type="text" id="solusi" name="solusi" placeholder="tambahkan solusi..." required>
                                <button type="submit" name="tambah-m">Tambah</button>
                            </form>
                        </td>
                    </tr>
                    
                <?php $i++; endforeach; ?>
            </tbody>
        </table>
    </section>
</body>
</html>