<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand mx-auto text-lg text-white" href="#">List Siswa</a>
        </div>
    </nav>
    <!-- End Navbar -->
    <!-- Data Table -->
    <?php include("koneksi.php");
    $getAllData = mysqli_query($koneksi, "SELECT * FROM siswa");
    session_start();
    ?>
    <div class="container">
        <h3 class="my-3">Siswa</h3>
        <a class="btn btn-primary mb-5 btn-lg" href="create.php">Tambah Data Siswa</a>
        <div class=" table-responsive mb-5">
            <table id="example" class="table mt-5" style="width:100%">
                <thead>
                    <tr>
                        <th>NIK</th>
                        <th>NISN</th>
                        <th>Nama</th>
                        <th>Jenis Kelamin</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($barangData = mysqli_fetch_array($getAllData)) { ?>
                        <tr>
                            <td><?= $barangData['NIK']; ?></td>
                            <td><?= $barangData['NISN']; ?></td>
                            <td><?= $barangData['nama']; ?></td>
                            <td><?= $barangData['jenis_kelamin']; ?></td>
                            <td>
                                <a class="btn btn-primary btn-sm" href="detail.php?nisn=<?= $barangData['NISN'] ?>"><i class="fa-solid fa-eye"></i></a>
                                <a class="btn btn-warning btn-sm text-white" href="edit.php?nisn=<?= $barangData['NISN'] ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                                <a class="btn btn-danger btn-sm" id="buttonHapus" data-id="<?= $barangData['NISN'] ?>"><i class="fa-solid fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- End Data Table -->


    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#example').DataTable({
                "language": {
                    "info": "Total Data : _TOTAL_ ",
                    "infoEmpty": "Tidak Ditemukan Data",
                    "lengthMenu": "Tampilkan _MENU_ Data",
                    "search": "Cari",
                    "zeroRecords": "Data Tidak Ditemukan"
                },
            });
            $(document).on('click', '#buttonHapus', function() {
                var nisn = $(this).data('id');
                swal.fire({
                    title: 'Apakah Anda yakin ?',
                    text: "Data yang sudah dihapus tidak bisa dikembalikan",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Hapus Data',
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url: 'delete.php',
                            type: 'POST',
                            data: {
                                nisn: nisn,
                            },
                        }).done(function(response) {
                            var data = JSON.parse(response);
                            console.log(response);
                            Swal.fire({
                                icon: data.status,
                                title: data.message,
                                showConfirmButton: false,
                                timer: 1500
                            })
                            setTimeout(function() {
                                window.location.reload();
                            }, 1500);
                        })
                    }
                })

            });
        });
    </script>
    <?php if (@$_SESSION['message']) { ?>
        <script>
            Swal.fire({
                icon: '<?= $_SESSION['status'] ?>',
                title: '<?= $_SESSION['status'] ?>',
                text: '<?= $_SESSION['message'] ?>',
                showConfirmButton: false,
                timer: 1500
            })
        </script>
        <!-- jangan lupa untuk menambahkan unset agar sweet alert tidak muncul lagi saat di refresh -->
    <?php unset($_SESSION['message']);
        unset($_SESSION["status"]);
    } ?>
</body>

</html>