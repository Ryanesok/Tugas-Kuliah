<?php
    $host = "localhost";
    $username = "root";
    $pass = "";
    $dbname = "aplikasi";

    $conn = mysqli_connect($host, $username, $pass, $dbname);

    function query($query){
        global $conn;
        $result = mysqli_query($conn, $query);
        $rows =[];
        while($row = mysqli_fetch_assoc($result)){
            $rows[] = $row;
        }

        return $rows;
    }

    function enum($query){
        global $conn;
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);

        $enum_values = $row['Type'];

        preg_match_all("/'([^']+)'/", $enum_values, $matches);
        $enum_values = $matches[1];

        return $enum_values;
    }

    function tambah($dataPost){
        global $conn;
        $resiko = htmlspecialchars($dataPost["resiko"]);
        $divisi = htmlspecialchars($dataPost["divisi"]);
        $tingkat_resiko = htmlspecialchars($dataPost["tingkat"]);
        $penyebab = htmlspecialchars($dataPost["penyebab"]);
        $sumber  = htmlspecialchars($dataPost["sumber"]);
        $mitigasi = htmlspecialchars($dataPost["mitigasi"]);
        $solusi = htmlspecialchars($dataPost["solusi"]);

        $query = "INSERT INTO resiko
                VALUES
                ('', '$resiko', '$divisi', '$tingkat_resiko', '$penyebab', '$sumber', '$mitigasi', '$solusi')
                ";
        mysqli_query($conn, $query);
        return mysqli_affected_rows($conn);
    }

    function tambahmitigasi($dataPost){
        global $conn;
        $resiko_id = htmlspecialchars($dataPost['id']);
        $mitigasi = htmlspecialchars($dataPost['mitigasi']);
        $solusi = htmlspecialchars($dataPost['solusi']);

        $query = "INSERT INTO mitigasi (resiko_id, mitigasi, solusi)
                VALUES 
                ('$resiko_id', '$mitigasi', '$solusi')";
        
        mysqli_query($conn, $query);
        return mysqli_affected_rows($conn);
    } 

    function handleLogin(){
        if(isset($_POST["login"])) {
            // Check username and password
            if($_POST["username"] == "admin") {
                if($_POST["password"] == "123"){
                    header("Location: admin/admin.php");
                    exit;
                }else{
                    echo "
                    <script>
                        alert('Password salah!');
                        document.location.href = 'index.php';
                    </script>
                    ";
                }
            } elseif ($_POST["username"] == "user") {
                if($_POST["password"] == "456"){
                    header("Location: user/user.php");
                }else{
                    echo "
                    <script>
                        alert('Password salah!');
                        document.location.href = 'index.php';
                    </script>
                    ";
                }
            } 
            else {
                echo "
                <script>
                    alert('Username tidak ditemukan!');
                    document.location.href = 'index.php';
                </script>
                ";
            }
        }
    }

    function hapus($id){
        global $conn;
        // Hapus data dari tabel mitigasi
        $queryMitigasi = "DELETE FROM mitigasi WHERE resiko_id = ?";
        $stmtMitigasi = $conn->prepare($queryMitigasi);
        $stmtMitigasi->bind_param("i", $id);
        $stmtMitigasi->execute();
        
        // Hapus data dari tabel resiko
        $queryResiko = "DELETE FROM resiko WHERE id = ?";
        $stmtResiko = $conn->prepare($queryResiko);
        $stmtResiko->bind_param("i", $id);
        return $stmtResiko->execute();
    }

    function update($datapost){
        global $conn;
        $id = htmlspecialchars($datapost['id']); 
        $resiko = htmlspecialchars($datapost["resiko"]);
        $divisi = htmlspecialchars($datapost["divisi"]);
        $tingkat_resiko = htmlspecialchars($datapost["tingkat"]);
        $penyebab = htmlspecialchars($datapost["penyebab"]);
        $sumber  = htmlspecialchars($datapost["sumber"]);
        $mitigasi = htmlspecialchars($datapost["mitigasi"]);
        $solusi = htmlspecialchars($datapost["solusi"]);

        // Mulai transaksi
    mysqli_begin_transaction($conn);
    try {
        // Update tabel resiko
        $queryResiko = "UPDATE resiko SET
                resiko = '$resiko',
                divisi = '$divisi',
                tingkat = '$tingkat_resiko',
                penyebab = '$penyebab',
                sumber = '$sumber'
                WHERE id = '$id'";

        if (!mysqli_query($conn, $queryResiko)) {
            throw new Exception("Error Update Resiko: " . mysqli_error($conn));
        }

        // Update tabel mitigasi
        $mitigasiArray = isset($datapost["mitigasi"]) ? $datapost["mitigasi"] : [];
        $solusiArray = isset($datapost["solusi"]) ? $datapost["solusi"] : [];

        foreach ($mitigasiArray as $index => $mitigasi) {
            $solusi = isset($solusiArray[$index]) ? $solusiArray[$index] : '';
            $queryMitigasi = "UPDATE mitigasi SET
                            mitigasi = '$mitigasi',
                            solusi = '$solusi'
                            WHERE resiko_id = '$id' AND id = '$index'";
            if (!mysqli_query($conn, $queryMitigasi)) {
                throw new Exception("Error Update Mitigasi: " . mysqli_error($conn));
            }
        }

        // Commit transaksi
        mysqli_commit($conn);
        return true;
    } catch (Exception $e) {
        // Rollback jika ada kesalahan
        mysqli_rollback($conn);
        echo $e->getMessage();
        return false;
    }
}
?>
