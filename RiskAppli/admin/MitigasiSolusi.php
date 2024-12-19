<?php
    session_start();
    require '../resources/functions.php';
    $db = new Database();
    $db->checkLogin();

    $data = $db->query("SELECT * FROM resiko");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Mitigasi Solusi</title>
</head>
<body>
    <h1>Risk Management System</h1>
    <p>Admin dapat menambahkan Mitigasi dan Solusi untuk masalah yang ada</p>
    <a href="admin.php">Kembali</a>
    <h3>Table Management Resiko</h3>
    <table>
        <thead>
            <th>No</th>
            <th>Masalah</th>
            <th>Divisi</th>
            <th>Tingkat</th>
            <th>Penyebab</th>
            <th>Sumber</th>
            <th>Mitigasi</th>
            <th>Solusi</th>
        </thead>
        <tbody>
            <?php $i = 1;?>
            <?php 
                if(empty($data)){
                    echo "<tr><td colspan='8'>-- kosong --</td></tr>";
                } else {
                    $data_approved = array_filter($data, function($row) {
                        return $row['status'] == 'approved';
                    });

                    if(empty($data_approved)){
                        echo "<tr><td colspan='8'>-- kosong --</td></tr>";
                    } else {
                        foreach($data_approved as $row) {
                ?>
                    <form method="post" action="">
                        <tr>
                            <td><?= $i; ?></td>
                            <td><?= $row["resiko"]; ?></td>
                            <td><?= $row["divisi"]; ?></td>
                            <td><?= $row["tingkat"]; ?></td>
                            <td><?= $row["penyebab"]; ?></td>
                            <td><?= $row["sumber"]; ?></td>
                            <td>
                                <?php if (!empty($row["mitigasi"])): ?>
                                    <?= $row["mitigasi"]; ?>
                                <?php else: ?>
                                    <input type="text" name="mitigasi" placeholder="Masukkan Mitigasi" 
                                        value="<?= htmlspecialchars($_POST['mitigasi'] ?? ''); ?>">
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if (!empty($row["solusi"])): ?>
                                    <?= $row["solusi"]; ?>
                                <?php else: ?>
                                    <input type="text" name="solusi" placeholder="Masukkan Solusi" 
                                        value="<?= htmlspecialchars($_POST['solusi'] ?? ''); ?>">
                                <?php endif; ?>
                            </td>   
                            <td>
                                <input type="hidden" name="id" value="<?= $row["id"]; ?>">
                            </td>
                            <?php if(empty($row['mitigasi']) || empty($row['solusi'])):?>
                                <td><button type="submit" name="submit">Submit</button></td>
                            <?php endif;?>
                        </tr>
                    </form>
                <?php 
                            $i++;
                        }
                    }
                }
            ?>
</body>
</html>
<?php
if (isset($_POST["submit"])) {
    $id = $_POST["id"];
    $mitigasi = $_POST["mitigasi"];
    $solusi = $_POST["solusi"];

    // Simpan ke database jika kedua nilai diisi
    if (!empty($mitigasi) && !empty($solusi)) {
        if ($db->tambahMitigasiSolusi($id, $mitigasi, $solusi)) {
            echo "<script>alert('Mitigasi dan Solusi berhasil ditambahkan!'); document.location.href = 'MitigasiSolusi.php';</script>";
        } else {
            echo "<script>alert('Gagal menambahkan mitigasi dan solusi!');</script>";
        }
    } else {
        // Tampilkan alert jika input tidak lengkap
        echo "<script>alert('Mohon isi kedua kolom Mitigasi dan Solusi sebelum menyimpan.');</script>";
    }
}
?>