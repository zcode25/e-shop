<?php
require 'functions.php';

$bisnis = query("SELECT max(kode_bisnis) as kode_terbesar FROM bisnis")[0];
$kode_bisnis = $bisnis["kode_terbesar"];
$urutan = (int) substr($kode_bisnis, 4, 4);

$urutan++;
$huruf = "B";
$kode_bisnis = $huruf . sprintf("%04s", $urutan);


if (isset($_POST["submit"])) {

    if (tambah_bisnis($_POST) > 0) {
        echo "
        
        <script>
        alert('Data bisnis berhasil ditambahkan');
        </script>
        ";

        // $kodebisnis = $_POST["kode_bisnis"];
        header("Location: pendaftaran_penjual.php?kode=$kode_bisnis");
        die();
    } else {

        echo "

      <script>
        alert('Data bisnis gagal ditambahkan');
        document.location.href = 'pendaftaran.php';
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
                            <h3 class="card-title">Pendaftaran Bisnis</h3>
                            <form action="" method="post">
                                <!-- <div class="form-group"> -->
                                <!-- <label class="control-label" for="kode_bisnis">Kode Bisnis</label> -->
                                <input class="form-control" type="hidden" id="kode_bisnis" name="kode_bisnis" value="<?= $kode_bisnis ?>" required>
                                <!-- </div> -->
                                <div class="form-group">
                                    <label class="control-label" for="nama_bisnis">Nama Bisnis</label>
                                    <input class="form-control" type="text" id="nama_bisnis" name="nama_bisnis" required>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="telp_bisnis">Telp Bisnis</label>
                                    <input class="form-control" type="telp" id="telp_bisnis" name="telp_bisnis" required>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="email_bisnis">Email Bisnis</label>
                                    <input class="form-control" type="email" id="email_bisnis" name="email_bisnis" required>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="alamat_bisnis">Alamat Bisnis</label>
                                    <input class="form-control" type="text" id="alamat_bisnis" name="alamat_bisnis" required>
                                </div>

                                <button class="btn btn-success tombol" type="submit" name="submit">Daftar</button>&nbsp;&nbsp;&nbsp;
                                <a class="btn btn-secondary" href="karyawan.php"><i class="fa fa-fw fa-lg fa-times-circle"></i>Batal</a>
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