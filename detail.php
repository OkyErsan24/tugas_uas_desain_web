<?php
include("koneksi.php");
$nisn = $_GET['nisn'];
$sqlSiswa = "SELECT * FROM siswa WHERE NISN = $nisn";
$querySiswa = mysqli_query($koneksi, $sqlSiswa);
$siswa = mysqli_fetch_assoc($querySiswa);
$nikAyah = $siswa['ayah'];
$nikIbu = $siswa['ibu'];
$sqlAyah = "SELECT * FROM orangtua WHERE NIK = $nikAyah";
$queryAyah = mysqli_query($koneksi, $sqlAyah);
$ayah = mysqli_fetch_assoc($queryAyah);
$namaAyah = $ayah['nama'];
$sqlIbu = "SELECT * FROM orangtua WHERE NIK = $nikIbu";
$queryIbu = mysqli_query($koneksi, $sqlIbu);
$ibu = mysqli_fetch_assoc($queryIbu);
$namaibu = $ibu['nama'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Data Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand mx-auto text-lg text-white" href="#">Detail Data Siswa</a>
        </div>
    </nav>
    <!-- End Navbar -->
    <!-- Data Table -->
    <div class="container mb-5">
        <h3 class="my-3">Detail Data Siswa</h3>
        <div class="card">
            <div class="card-header bg-primary text-white">
                <i class="fa-solid fa-person"></i>&emsp; Detail Data Siswa
            </div>
            <div class="card-body">
                <img class="mx-auto d-block" src="./assets/img/<?= $siswa['gambar'] ?>" alt="<?= $siswa['gambar'] ?>" height="250px" width="250px">
                <div class="row justify-content-center">
                    <div class="col-auto">
                        <table class="table table-responsive table-borderless">
                            <tr>
                                <td>NIK</td>
                                <td>:</td>
                                <td><?= $siswa['NIK'] ?></td>
                            </tr>
                            <tr>
                                <td>NISN</td>
                                <td>:</td>
                                <td><?= $siswa['NISN'] ?></td>
                            </tr>
                            <tr>
                                <td>Nama Siswa</td>
                                <td>:</td>
                                <td><?= $siswa['nama'] ?></td>
                            </tr>
                            <tr>
                                <td>Tempat Tanggal Lahir</td>
                                <td>:</td>
                                <?php $date = date_create($siswa['tanggal_lahir']); ?>
                                <td><?= $siswa['tempat_lahir'] ?>, <?= date_format($date, "d-m-Y"); ?></td>
                            </tr>
                            <tr>
                                <td>Jenis Kelamin</td>
                                <td>:</td>
                                <td><?= $siswa['jenis_kelamin'] ?></td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td>:</td>
                                <td><?= $siswa['alamat'] ?></td>
                            </tr>
                            <tr>
                                <td>Nama Ayah</td>
                                <td>:</td>
                                <td><?= $namaAyah ?></td>
                            </tr>
                            <tr>
                                <td>Nama Ibu</td>
                                <td>:</td>
                                <td><?= $namaibu ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- End Data Table -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>