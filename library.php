<?php

function upload($gambar)
{
    $namaFile = strtolower(str_replace(" ", "", $gambar));
    $pathParts = pathinfo($_FILES['gambar_siswa']["name"]);
    $ektensionFile = $pathParts['extension'];
    $dataFile = $namaFile . "." . $ektensionFile;
    $folder = "assets/img/";

    move_uploaded_file($_FILES['gambar_siswa']['tmp_name'], $folder . $dataFile);
    return $dataFile;
}
function input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


function getGambar()
{
    include("koneksi.php");
    $nik = $_POST['nik'];
    $sqlgambar = "SELECT gambar FROM siswa WHERE nik = '$nik'";
    $data = mysqli_query($koneksi, $sqlgambar);
    $result = $data->fetch_assoc();
    $dataFile = $result['gambar'];
    return $dataFile;
}
