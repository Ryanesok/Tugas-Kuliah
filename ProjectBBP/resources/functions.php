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
        $resiko = $dataPost["resiko"];
        $divisi = $dataPost["divisi"];
        $tingkat_resiko = $dataPost["tingkat"];
        $penyebab = $dataPost["penyebab"];
        $sumber  = $dataPost["sumber"];
        $mitigasi = $dataPost["mitigasi"];
        $solusi = $dataPost["solusi"];

        $query = "INSERT INTO resiko
                VALUES
                ('', '$resiko', '$divisi', '$tingkat_resiko', '$penyebab', '$sumber', '$mitigasi', '$solusi')
                ";
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
        $query = "DELETE FROM resiko WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
?>