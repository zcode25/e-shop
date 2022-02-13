<?php
require 'functions.php';

$karyawan = query("SELECT max(id_karyawan) as kode_terbesar FROM karyawan")[0];
$id_karyawan = $karyawan["kode_terbesar"];
$urutan = (int) substr($id_karyawan, 4, 4);

$urutan++;
$huruf = "K";
$id_karyawan = $huruf . sprintf("%04s", $urutan);
$kode = $_GET["kode"];

if (isset($_POST["submit"])) {

    if (tambah_karyawan($_POST) > 0) {
        echo "

      <script>
        alert('Data bisnis berhasil ditambahkan');
        document.location.href = 'login.php';
      </script>

    ";
    } else {

        echo "

      <script>
        alert('Data bisnis gagal ditambahkan');
        document.location.href = 'pendaftaran_penjual.php';
      </script>

    ";
    }
}

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="shortcut icon" href="img/eshop.png">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <style>
        body {
            background-color: #009486;
        }

        .tombol {
            background-color: #009486;
            color: white;
            border: none;
        }

        .tombol:hover {
            background-color: #009486;
            color: white;
            border: none;
        }
    </style>

    <title>Electronic Shop</title>
</head>

<body>

    <div class="pendaftaran my-5">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">Pendaftaran Penjual</h3>
                            <form action="" method="post">
                                <!-- <div class="form-group"> -->
                                <!-- <label class="control-label" for="kode_bisnis">Kode Bisnis</label> -->
                                <input class="form-control" type="hidden" id="id_karyawan" name="id_karyawan" value="<?= $id_karyawan; ?>" required>
                                <input class="form-control" type="hidden" id="kode_bisnis" name="kode_bisnis" value="<?= $kode; ?>" required>
                                <!-- </div> -->
                                <div class="form-group">
                                    <label class="control-label" for="nama_karyawan">Nama Penjual</label>
                                    <input class="form-control" type="text" id="nama_karyawan" name="nama_karyawan" required>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="telp_karyawan">Telp Penjual</label>
                                    <input class="form-control" type="telp" id="telp_karyawan" name="telp_karyawan" required>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="email_karyawan">Email Penjual</label>
                                    <input class="form-control" type="email" id="email_karyawan" name="email_karyawan" required>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="alamat_karyawan">Alamat Penjual</label>
                                    <input class="form-control" type="text" id="alamat_karyawan" name="alamat_karyawan" required>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="password">Password</label>
                                    <input class="form-control" type="password" id="password" name="password" required>
                                </div>

                                <button class="btn btn-success tombol" type="submit" name="submit">Daftar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>