<?php

session_start();
if (!isset($_SESSION["login"])) {
  header("Location: index.php");
  exit;
}

require 'functions.php';
$kode = $_SESSION["bisnis"];
$no = $_GET["no"];
$penjualan = query("SELECT * FROM faktur JOIN karyawan USING(id_karyawan) JOIN pembeli USING(id_pembeli) WHERE no_faktur = '$no' ")[0];
$transaksis = query("SELECT * FROM transaksi JOIN barang USING(kode_barang) JOIN kategori USING(kode_kategori) WHERE no_faktur = '$no' ");

$barangs = query("SELECT * FROM barang WHERE kode_bisnis = '$kode'");
$karyawans = query("SELECT * FROM karyawan");
$pembelis = query("SELECT * FROM pembeli");

if (isset($_POST["submit"])) {

  $kode = $_POST["barang"];
  $kuantitas = $_POST["kuantitas"];
  $stok = query("SELECT * FROM barang WHERE kode_barang = '$kode'")[0];

  if ($stok["stok"] >= $kuantitas) {
    if (tambah_transaksi_penjualan($_POST, $stok) > 0) {
      echo "

        <script>
          window.location.href = window.location.href;
        </script>

      ";
      kurangi_stok($_POST, $stok);
    } else {

      echo "

        <script>
          alert('Data yang dimasukan sudah ada');
          window.location.href = window.location.href;
        </script>

      ";
    }
  } else {
    echo "

        <script>
          alert('Stok barang tidak cukup');
          window.location.href = window.location.href;
          
        </script>

      ";
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta name="description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
  <!-- Twitter meta-->
  <meta property="twitter:card" content="summary_large_image">
  <meta property="twitter:site" content="@pratikborsadiya">
  <meta property="twitter:creator" content="@pratikborsadiya">
  <!-- Open Graph Meta-->
  <meta property="og:type" content="website">
  <meta property="og:site_name" content="Vali Admin">
  <meta property="og:title" content="Vali - Free Bootstrap 4 admin theme">
  <meta property="og:url" content="http://pratikborsadiya.in/blog/vali-admin">
  <meta property="og:image" content="http://pratikborsadiya.in/blog/vali-admin/hero-social.png">
  <meta property="og:description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
  <title>Electronic Shop</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Main CSS-->
  <link rel="stylesheet" type="text/css" href="css/main.css">
  <!-- Font-icon css-->
  <link rel="shortcut icon" href="img/eshop.png">
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body class="app sidebar-mini rtl">
  <!-- Navbar-->
  <header class="app-header"><a class="app-header__logo" href="dashboard.php" style="font-family : arial; font-size: 20px"><?= $_SESSION["nama_bisnis"]; ?></a>
    <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
    <!-- Navbar Right Menu-->
    <ul class="app-nav">
      <!-- User Menu-->
      <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-user fa-lg"></i></a>
        <ul class="dropdown-menu settings-menu dropdown-menu-right">
          <li><a class="dropdown-item" href="ubah_karyawan.php?id=<?= $_SESSION["id"]; ?>"><i class="fa fa-user fa-lg"></i> Profil</a></li>
          <li><a class="dropdown-item" href="logout.php"><i class="fa fa-sign-out fa-lg"></i> Logout</a></li>
        </ul>
      </li>
    </ul>
  </header>
  <!-- Sidebar menu-->
  <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
  <aside class="app-sidebar">
    <div class="app-sidebar__user">
      <div>
        <p class="app-sidebar__user-name ml-2"><?= $_SESSION["nama"]; ?></p>
        <!-- <p class="app-sidebar__user-designation">Karyawan</p> -->
      </div>
    </div>
    <ul class="app-menu">
      <li><a class="app-menu__item" href="dashboard.php"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>
      <li><a class="app-menu__item" href="supplier.php"><i class="app-menu__icon fa fa-truck"></i><span class="app-menu__label">Supplier</span></a></li>
      <li><a class="app-menu__item" href="barang.php"><i class="app-menu__icon fa fa-archive"></i><span class="app-menu__label">Barang</span></a></li>
      <li><a class="app-menu__item" href="pembeli.php"><i class="app-menu__icon fa fa-users"></i><span class="app-menu__label">Pembeli</span></a></li>
      <li><a class="app-menu__item" href="karyawan.php"><i class="app-menu__icon fa fa-briefcase"></i><span class="app-menu__label">Karyawan</span></a></li>
      <li><a class="app-menu__item" href="penjualan.php"><i class="app-menu__icon fa fa-shopping-cart"></i><span class="app-menu__label">Penjualan</span></a></li>
      <li><a class="app-menu__item" href="pembayaran.php"><i class="app-menu__icon fa fa-usd"></i><span class="app-menu__label">Pembayaran</span></a></li>
      <li><a class="app-menu__item" href="laporan.php"><i class="app-menu__icon fa fa-file"></i><span class="app-menu__label">Laporan</span></a></li>
      <li><a class="app-menu__item" href="donasi.php"><i class="app-menu__icon fa fa-heart"></i><span class="app-menu__label">Donasi</span></a></li>
    </ul>
  </aside>
  <main class="app-content">
    <div class="app-title">
      <div>
        <h1><i class="fa fa-shopping-cart"></i> Penjualan</h1>
      </div>
    </div>
    <div class="row">

      <div class="col-md-9">
        <div class="tile">
          <h3 class="tile-title">Data Transaksi Penjualan</h3>
          <div class="tile-body">
            <form action="" method="post">
              <input class="form-control" type="hidden" id="no_faktur" name="no_faktur" value="<?= $penjualan['no_faktur']; ?>" required>
              <div class="form-group">
                <label for="barang">Barang</label>
                <select class="form-control" id="barang" name="barang">
                  <?php foreach ($barangs as $barang) : ?>
                    <option value="<?= $barang["kode_barang"]; ?>"><?= $barang["nama_barang"]; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="form-group">
                <label class="control-label" for="kuantitas">Kuantitas</label>
                <input class="form-control" type="number" placeholder="Masukan kuantitas" id="kuantitas" name="kuantitas" required>
              </div>
          </div>
          <div class="tile-footer">
            <div class="row">

              <div class="col mt-2">
                <button class="btn btn-primary" type="submit" name="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Tambah</button>&nbsp;&nbsp;&nbsp;
              </div>
              <div class="col mt-2">
                <a class="btn btn-secondary" href="penjualan.php"><i class="fa fa-fw fa-lg fa-chevron-circle-left"></i>Kembali</a>
              </div>
              <div class="col mt-2">
                <a class="btn btn-warning" href="cetak_penjualan.php?no=<?= $penjualan["no_faktur"] ?>" target="_blank"><i class="fa fa-fw fa-lg fa-print"></i>Print</a>&nbsp;&nbsp;&nbsp;
              </div>
            </div>
          </div>
          </form>
          <div class="table-responsive mt-5">
            <table class="table">
              <thead>
                <tr>
                  <!-- <th>Kode Barang</th> -->
                  <th>Nama Barang</th>
                  <th>Kategori</th>
                  <th>Kuantitas</th>
                  <th>Harga Satuan</th>
                  <th>Jumlah</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($transaksis as $transaksi) : ?>
                  <tr>
                    <!-- <td><?= $transaksi["kode_barang"]; ?></td> -->
                    <td><?= $transaksi["nama_barang"]; ?></td>
                    <td><?= $transaksi["nama_kategori"]; ?></td>
                    <td><?= $transaksi["kuantitas"]; ?></td>
                    <td>Rp <?= $transaksi["harga_jual"]; ?></td>
                    <td>Rp <?= $transaksi["kuantitas"] * $transaksi["harga_jual"]; ?></td>
                    <td>
                      <a href="hapus_transaksi_penjualan.php?no=<?= $transaksi["no_faktur"]; ?>&kode=<?= $transaksi["kode_barang"]; ?>&kty=<?= $transaksi["kuantitas"]; ?>" class="badge badge-danger" title="hapus" onclick=" return confirm ('yakin ?');"><i class="fa fa-trash-o"></i></a>
                    </td>
                  </tr>
                <?php endforeach; ?>
                <tr style="background-color: #009486; color: white;">
                  <th colspan=" 4" style="text-align: left">TOTAL</th>

                  <?php $total[] = 0; ?>
                  <?php foreach ($transaksis as $transaksi) : ?>
                    <?php $total[] = $transaksi["kuantitas"] * $transaksi["harga_jual"]; ?>
                  <?php endforeach; ?>

                  <th>Rp <?= array_sum($total); ?></th>
                  <th></th>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="tile">
          <h3 class="tile-title">Data Penjualan</h3>
          <div class="tile-body">
            <form action="" method="post">
              <div class="form-group">
                <label class="control-label" for="no_faktur">No Faktur</label>
                <input class="form-control" type="text" placeholder="Masukan no faktur" id="no_faktur" name="no_faktur" value="<?= $penjualan['no_faktur']; ?>" readonly required>
              </div>
              <div class="form-group">
                <label class="control-label" for="tgl_pemesanan">Tanggal Pemesanan</label>
                <input class="form-control" type="date" placeholder="Masukan tanggal pemesanan" id="tgl_pemesanan" name="tgl_pemesanan" value="<?= $penjualan['tgl_pemesanan']; ?>" readonly required>
              </div>
              <div class="form-group">
                <label class="control-label" for="tgl_jatohtempo">Tanggal Jatuh Tempo</label>
                <input class="form-control" type="date" placeholder="Masukan tanggal jatoh tempo" id="tgl_jatohtempo" name="tgl_jatohtempo" value="<?= $penjualan['tgl_jatohtempo']; ?>" readonly required>
              </div>
              <div class="form-group">
                <label for="pembeli">Pembeli</label>
                <select class="form-control" id="pembeli" name="pembeli" disabled>
                  <?php foreach ($pembelis as $pembeli) : ?>
                    <option value="<?= $pembeli["id_pembeli"]; ?>" <?php if ($pembeli["id_pembeli"] == $penjualan['id_pembeli']) {
                                                                      echo 'selected';
                                                                    } ?>><?= $pembeli["nama_pembeli"] ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="form-group">
                <label for="karyawan">karyawan</label>
                <select class="form-control" id="karyawan" name="karyawan" disabled>
                  <?php foreach ($karyawans as $karyawan) : ?>
                    <option value="<?= $karyawan["id_karyawan"]; ?>" <?php if ($karyawan["id_karyawan"] == $penjualan['id_karyawan']) {
                                                                        echo 'selected';
                                                                      } ?>><?= $karyawan["nama_karyawan"] ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
          </div>
          </form>
        </div>
      </div>
    </div>
  </main>
  <!-- Essential javascripts for application to work-->
  <script src="js/jquery-3.2.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>
  <!-- The javascript plugin to display page loading on top-->
  <script src="js/plugins/pace.min.js"></script>
  <!-- Page specific javascripts-->
  <!-- Google analytics script-->
  <script type="text/javascript">
    if (document.location.hostname == 'pratikborsadiya.in') {
      (function(i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function() {
          (i[r].q = i[r].q || []).push(arguments)
        }, i[r].l = 1 * new Date();
        a = s.createElement(o),
          m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)
      })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');
      ga('create', 'UA-72504830-1', 'auto');
      ga('send', 'pageview');
    }
  </script>
</body>

</html>