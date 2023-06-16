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
    <title>Edit Data Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand mx-auto text-lg text-white" href="#">Edit Data Siswa</a>
        </div>
    </nav>
    <!-- End Navbar -->
    <!-- Data Table -->
    <div class="container mb-5">
        <h3 class="my-3">Edit Data Siswa</h3>
        <form action="aksi_update.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="oldnisn" value="<?= $siswa['NISN'] ?>">
            <input type="hidden" name="oldgambar" value="<?= $siswa['gambar'] ?>">
            <input type="hidden" name="oldnikAyah" value="<?= $siswa['ayah'] ?>">
            <input type="hidden" name="oldnikIbu" value="<?= $siswa['ibu'] ?>">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <i class="fa-solid fa-person"></i>&emsp; DATA DIRI SISWA
                </div>
                <div class="row">
                    <div class="col-5">
                        <div class="mx-3 my-3">
                            <div class="mb-3">
                                <label for="nik" class="form-label">NIK<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" required id="nik" name="nik" placeholder="Masukkan NIK" value="<?= $siswa['NIK'] ?>">
                            </div>
                            <div class="mb-3">
                                <label for="nisn" class="form-label">NISN<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" required id="nisn" name="nisn" placeholder="Masukkan NISN" value="<?= $siswa['NISN'] ?>">
                            </div>
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" required id="nama" name="nama" placeholder="Masukkan Nama" value="<?= $siswa['nama'] ?>">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Jenis Kelamin<span class="text-danger">*</span></label>
                                <div class="mt-1"></div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="laki" value="Laki-Laki" required <?= ($siswa['jenis_kelamin'] == 'Laki-Laki') ? "checked" : "" ?>>
                                    <label class="form-check-label" for="laki">Laki-Laki</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="perempuan" value="Perempuan" <?= ($siswa['jenis_kelamin'] == 'Perempuan') ? "checked" : "" ?>>
                                    <label class="form-check-label" for="perempuan">Perempuan</label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="tempat_lahir" class="form-label">Tempat Lahir<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" required id="tempat_lahir" name="tempat_lahir" placeholder="Masukkan Tempat Lahir" value="<?= $siswa['tempat_lahir'] ?>">
                            </div>
                            <div class="mb-3">
                                <label for="tanggal_lahir" class="form-label">Tanggal Lahir<span class="text-danger">*</span></label>
                                <input type="date" class="form-control" required id="tanggal_lahir" name="tanggal_lahir" placeholder="Masukkan Tanggal Lahir" value="<?= $siswa['tanggal_lahir'] ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-2"></div>
                    <div class="col-5">
                        <div class="mx-3 my-3">

                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat<span class="text-danger">*</span></label>
                                <textarea class="form-control" name="alamat" id="alamat" rows="3"><?= $siswa['alamat'] ?></textarea>
                            </div>
                            <div class="mb-3">
                                <div class="form-group">
                                    <label for="gambar_siswa" class="form-label">Gambar Siswa</label>
                                    <div class="preview mb-3">
                                        <img id="preview-selected-image" src="./assets/img/<?= $siswa['gambar'] ?>" width="225px" height="225px" />
                                    </div>
                                    <input type="file" class="form-control form-control-file" id="gambar_siswa" name="gambar_siswa" onchange="previewImage(event);">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mt-5">
                <div class="card-header bg-primary text-white">
                    <i class="fa-solid fa-user-group"></i>&emsp; DATA ORANG TUA SISWA
                </div>

                <div class="row">
                    <div class="col-5">
                        <div class="mx-3 my-3">
                            <h5 class="mb-3">Data Ayah</h5>
                            <div class="mb-3">
                                <input type="hidden" name="action" value="add">
                                <label for="nik_ayah" class="form-label">NIK<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" required id="nik_ayah" name="nik_ayah" placeholder="Masukkan NIK" value="<?= $nikAyah ?>">
                            </div>
                            <div class=" mb-3">
                                <label for="nama_ayah" class="form-label">Nama<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" required id="nama_ayah" name="nama_ayah" placeholder="Masukkan Nama" value="<?= $namaAyah ?>">
                            </div>
                        </div>
                    </div>
                    <div class=" col-2">
                    </div>
                    <div class="col-5">
                        <div class="mx-3 my-3">
                            <h5 class="mb-3">Data Ibu</h5>
                            <div class="mb-3">
                                <input type="hidden" name="action" value="add">
                                <label for="nik_ibu" class="form-label">NIK<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" required id="nik_ibu" name="nik_ibu" placeholder="Masukkan NIK" value="<?= $nikIbu ?>">
                            </div>
                            <div class=" mb-3">
                                <label for="nama_ibu" class="form-label">Nama<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" required id="nama_ibu" name="nama_ibu" placeholder="Masukkan Nama" value="<?= $namaibu ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" name="submit" class="btn btn-primary float-end my-3">Ubah</button>
        </form>
    </div>

    <!-- End Data Table -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        const previewImage = (event) => {
            const imageFiles = event.target.files;
            const imageFilesLength = imageFiles.length;
            if (imageFilesLength > 0) {
                const imageSrc = URL.createObjectURL(imageFiles[0]);
                console.log(imageSrc);
                const imagePreviewElement = document.querySelector("#preview-selected-image");
                imagePreviewElement.src = imageSrc;
            }
        };
    </script>
</body>

</html>