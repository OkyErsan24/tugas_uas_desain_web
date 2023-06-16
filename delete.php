<?php
include("koneksi.php");
$nisn = $_POST['nisn'];
$output = array();
$sqlgambar = "SELECT ayah,ibu,gambar FROM siswa WHERE NISN = '$nisn';";
$data = mysqli_query($koneksi, $sqlgambar);
$result = $data->fetch_assoc();
$nikAyah = $result['ayah'];
$nikIbu = $result['ibu'];
unlink("assets/img/" . $result['gambar']);
$sqlSiswa = "DELETE FROM siswa WHERE NISN = '$nisn'";
$deleteSiswa = mysqli_query($koneksi, $sqlSiswa);
$sqlAyah = "DELETE FROM orangtua WHERE NIK = '$nikAyah'";
$deleteAyah = mysqli_query($koneksi, $sqlAyah);
$sqlIbu = "DELETE FROM orangtua WHERE NIK = '$nikIbu'";
$deleteIbu = mysqli_query($koneksi, $sqlIbu);
if ($deleteAyah && $deleteIbu && $deleteSiswa) {
    $output['status'] = 'success';
    $output['message'] = 'Data Siswa Berhasil Didelete';
} else {
    $output['status'] = 'error';
    $output['message'] = 'Data Siswa Gagal Dihapus';
}
echo json_encode($output);
