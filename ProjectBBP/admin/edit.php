<?php
    require '../resources/functions.php';
    $data = query("SELECT * FROM resiko");
    $enum_div = enum("SHOW COLUMNS FROM resiko LIKE 'divisi'");
    $enum_tgkt = enum("SHOW COLUMNS FROM resiko LIKE 'tingkat'");
    $enum_smbr = enum("SHOW COLUMNS FROM resiko LIKE 'sumber'");
    if(isset($_POST['update'])){
        if(update($_POST)){
            echo "
                <script>
                    alert('data berhasil diupdate!');
                    document.location.href = 'edit.php';
                </script>
            ";
        }else{
            echo "
                <script>
                    alert('data gagal diupdate!');
                    document.location.href = 'edit.php';
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
    <title>Update Data Resiko</title>
</head>
<body>
    <h2>Tabel Manajemen Resiko</h2>
    <a href="admin.php">Kembali</a>
    <form action="" method="post">
    <button type="submit" name="update">Update</button>
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
                        <td><input type="text" name="resiko" value="<?= $dat["resiko"]?>"></td>
                        <td>
                            <select name="divisi">
                            <option value="">Pilih Divisi</option>
                            <?php foreach($enum_div as $divisi) :?>
                                <option value="<?= $divisi;?>" <?= $divisi == $dat['divisi']? 'selected': '';?>>
                                    <?= $divisi?>
                                </option>
                            <?php endforeach; ?>
                            </select>
                        </td>
                        <td>
                            <select name="tingkat">
                            <option value="">Pilih Tingkat Resiko</option>
                            <?php foreach($enum_tgkt as $tingkat):?>
                                <option value="<?= $tingkat; ?>" <?= $tingkat == $dat['tingkat'] ? 'selected' : ''?>>
                                    <?= $tingkat?>
                                </option>
                            <?php endforeach;?>
                            </select>
                        </td>
                        <td><input type="text" name="penyebab" value="<?= $dat["penyebab"];?>"></td>
                        <td>
                            <select name="sumber" id="sumber">
                                <option value="">Pilih sumber Resiko</option>
                                <?php foreach($enum_smbr as $sumber):?>
                                    <option value="<?= $sumber; ?>" <?= $sumber == $dat['sumber'] ? 'selected' : '';?>>
                                        <?= $sumber?>
                                    </option>
                                <?php endforeach;?>
                            </select>
                        </td>
                            <ul>
                            <?php
                                $mitigasiData = query("SELECT * FROM mitigasi WHERE resiko_id = ". $dat['id']);
                                foreach($mitigasiData as $mit):
                            ?>
                                <td>
                                    <li>
                                        <input type="text" name="mitigasi" value="<?= $mit["mitigasi"];?>">
                                    </li>
                                </td>
                            <?php endforeach; ?>
                            </ul>
                            <ul>
                            <?php foreach($mitigasiData as $mit):?>
                                <td>
                                    <li>    
                                        <input type="text" name="solusi" value="<?= $mit["solusi"];?>">
                                    </li>
                                </td>
                            <?php endforeach; ?>
                            </ul>
                        <input type="hidden" name="id" value="<?= $dat['id'];?>">  
                        <?php $i++;?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>
    </form>  
</body>
</html>
