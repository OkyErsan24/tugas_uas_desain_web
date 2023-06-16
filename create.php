<?php
include("koneksi.php");
include("library.php");
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
    $gambar = upload($nik . "_" . $nama);
    $sqlAyah = "INSERT INTO orangtua(NIK , nama)
        VALUES('$nik_ayah' , '$nama_ayah')";
    $insertAyah = mysqli_query($koneksi, $sqlAyah);
    $sqlIbu = "INSERT INTO orangtua(NIK , nama)
        VALUES('$nik_ibu' , '$nama_ibu')";
    $insertIbu = mysqli_query($koneksi, $sqlIbu);
    $sqlSiswa = "INSERT INTO siswa(NIK , NISN , nama , jenis_kelamin , tempat_lahir , tanggal_lahir , alamat , gambar , ayah , ibu)
        VALUES('$nik' , '$nisn' , '$nama' ,'$jenis_kelamin' , '$tempat_lahir' ,'$tanggal_lahir' ,'$alamat' , '$gambar', '$nik_ayah', '$nik_ibu')";
    $insertSiswa = mysqli_query($koneksi, $sqlSiswa);
    if ($insertAyah && $insertIbu && $insertSiswa) {
        $_SESSION["status"] = "success";
        $_SESSION["message"] = "Data Siswa Berhasil Ditambahkan";
    } else {
        $_SESSION["status"] = "error";
        $_SESSION["message"] = "Data Siswa Gagal Ditambahkan";
    }
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand mx-auto text-lg text-white" href="#">Tambah Data Siswa</a>
        </div>
    </nav>
    <!-- End Navbar -->
    <!-- Data Table -->
    <div class="container mb-5">
        <h3 class="my-3">Tambah Data Siswa</h3>

        <form action="create.php" method="post" enctype="multipart/form-data">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <i class="fa-solid fa-person"></i>&emsp; DATA DIRI SISWA
                </div>

                <div class="row">
                    <div class="col-5">
                        <div class="mx-3 my-3">
                            <div class="mb-3">
                                <label for="nik" class="form-label">NIK<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" required id="nik" name="nik" placeholder="Masukkan NIK">
                            </div>
                            <div class="mb-3">
                                <label for="nisn" class="form-label">NISN<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" required id="nisn" name="nisn" placeholder="Masukkan NISN">
                            </div>
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" required id="nama" name="nama" placeholder="Masukkan Nama">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Jenis Kelamin<span class="text-danger">*</span></label>
                                <div class="mt-1"></div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="laki" value="Laki-Laki" required>
                                    <label class="form-check-label" for="laki">Laki-Laki</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="perempuan" value="Perempuan">
                                    <label class="form-check-label" for="perempuan">Perempuan</label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="tempat_lahir" class="form-label">Tempat Lahir<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" required id="tempat_lahir" name="tempat_lahir" placeholder="Masukkan Tempat Lahir">
                            </div>
                            <div class="mb-3">
                                <label for="tanggal_lahir" class="form-label">Tanggal Lahir<span class="text-danger">*</span></label>
                                <input type="date" class="form-control" required id="tanggal_lahir" name="tanggal_lahir" placeholder="Masukkan Tanggal Lahir">
                            </div>
                        </div>
                    </div>
                    <div class="col-2"></div>
                    <div class="col-5">
                        <div class="mx-3 my-3">

                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat<span class="text-danger">*</span></label>
                                <textarea class="form-control" name="alamat" id="alamat" rows="3"></textarea>
                            </div>
                            <div class="mb-3">
                                <div class="form-group">
                                    <label for="gambar_siswa" class="form-label">Gambar Siswa<span class="text-danger">*</span></label>
                                    <div class="preview mb-3">
                                        <img id="preview-selected-image" src="./assets/img/tidaktersedia.jpg" width="225px" height="225px" />
                                    </div>
                                    <input type="file" class="form-control form-control-file" id="gambar_siswa" name="gambar_siswa" onchange="previewImage(event);" required>
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
                                <input type="text" class="form-control" required id="nik_ayah" name="nik_ayah" placeholder="Masukkan NIK">
                            </div>
                            <div class="mb-3">
                                <label for="nama_ayah" class="form-label">Nama<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" required id="nama_ayah" name="nama_ayah" placeholder="Masukkan Nama">
                            </div>
                        </div>
                    </div>
                    <div class="col-2"></div>
                    <div class="col-5">
                        <div class="mx-3 my-3">
                            <h5 class="mb-3">Data Ibu</h5>
                            <div class="mb-3">
                                <input type="hidden" name="action" value="add">
                                <label for="nik_ibu" class="form-label">NIK<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" required id="nik_ibu" name="nik_ibu" placeholder="Masukkan NIK">
                            </div>
                            <div class="mb-3">
                                <label for="nama_ibu" class="form-label">Nama<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" required id="nama_ibu" name="nama_ibu" placeholder="Masukkan Nama">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" name="submit" class="btn btn-primary float-end my-3">Simpan</button>
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
                // imagePreviewElement.style.display = "block";
            }
        };
    </script>
</body>

</html>