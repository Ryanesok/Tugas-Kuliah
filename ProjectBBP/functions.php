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

        $query = "INSERT INTO resiko
                VALUES
                ('', '$resiko', '$divisi', '$tingkat_resiko', '$penyebab', '$sumber')
                ";
        mysqli_query($conn, $query);
        return mysqli_affected_rows($conn);
    }
?>