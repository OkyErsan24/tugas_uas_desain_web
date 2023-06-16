<?php
include('koneksi.php');
include('library.php');
session_start();
$nik = input($_POST['nik']);
$nisn = input($_POST['nisn']);
$nama = input($_POST['nama']);
$jenis_kelamin = input($_POST['jenis_kelamin']);
$tempat_lahir = input($_POST['tempat_lahir']);
$tanggal_lahir = input($_POST['tanggal_lahir']);
$alamat = input($_POST['alamat']);
$nik_ayah = input($_POST['nik_ayah']);
$nama_ayah = input($_POST['nama_ayah']);
$nik_ibu = input($_POST['nik_ibu']);
$nama_ibu = input($_POST['nama_ibu']);
$oldgambar = $_POST['oldgambar'];
$oldnisn = $_POST['oldnisn'];
$oldnikAyah = $_POST['oldnikAyah'];
$oldnikIbu = $_POST['oldnikIbu'];
if ($_FILES['gambar_siswa']['name'] != null) {
    unlink("./assets/img/" . $oldgambar);
    $gambar = upload($nik . "_" . $nama);
} else {
    $gambar = $oldgambar;
}
$sqlAyah = "UPDATE orangtua SET NIK = '$nik_ayah' , nama = '$nama_ayah' WHERE NIK = '$oldnikAyah'";
$updateAyah = mysqli_query($koneksi, $sqlAyah);
$sqlIbu = "UPDATE orangtua SET NIK = '$nik_ibu' , nama = '$nama_ibu' WHERE NIK = '$oldnikIbu'";
$updateIbu = mysqli_query($koneksi, $sqlIbu);
$sqlSiswa = "UPDATE siswa SET NIK = '$nik' , NISN = '$nisn' , nama = '$nama' , tempat_lahir = '$tempat_lahir' , tanggal_lahir = '$tanggal_lahir', jenis_kelamin =  '$jenis_kelamin' , alamat = '$alamat', gambar = '$gambar' WHERE NISN = '$oldnisn'";
$updateSiswa = mysqli_query($koneksi, $sqlSiswa);
if ($updateAyah && $updateIbu && $updateSiswa) {
    $_SESSION["status"] = "success";
    $_SESSION["message"] = "Data Siswa Berhasil Diubah";
} else {
    $_SESSION["status"] = "error";
    $_SESSION["message"] = "Data Siswa Gagal Diubah";
}
header("Location: index.php");
