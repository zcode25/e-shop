<?php

session_start();
if (!isset($_SESSION["login"])) {
  header("Location: index.php");
  exit;
}

require 'functions.php';

$kode = $_GET["kode"];
$no = $_GET["no"];
$penjualan = query("SELECT * FROM faktur JOIN karyawan USING(id_karyawan) JOIN pembeli USING(id_pembeli) WHERE no_faktur = '$no' ")[0];
$pembayaran = query("SELECT * FROM pembayaran WHERE kode_pembayaran = '$kode' ")[0];
$transaksis = query("SELECT * FROM transaksi JOIN barang USING(kode_barang) JOIN kategori USING(kode_kategori) WHERE no_faktur = '$no' ");
$fakturs = query("SELECT * FROM faktur");
$bisnis = query("SELECT * FROM faktur JOIN bisnis USING(kode_bisnis) WHERE no_faktur = '$no'")[0];

if (isset($_POST["submit"])) {


  if (ubah_pembayaran($_POST) > 0) {
    echo "

      <script>
        alert('Data pembayaran berhasil dibayar');
        document.location.href = 'pembayaran.php';
      </script>

    ";
  } else {

    echo "

      <script>
        alert('Data pembayaran gagal dibayar');
        document.location.href = 'pembayaran.php';
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
        <h1><i class="fa fa fa-usd"></i> Pembayaran</h1>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="tile">
          <section class="invoice">
            <div class="row mb-4">
              <div class="col-md-6">
                <h2 class="page-header"><?= $bisnis["nama_bisnis"]; ?></h2>
              </div>
              <div class="col-md-6 mt-3">
                <h5 class="text-right">Tanggal : <?= $penjualan["tgl_pemesanan"]; ?></h5>
              </div>
            </div>
            <div class="row invoice-info">
              <div class="col-md-4">From
                <address><strong><?= $penjualan["nama_karyawan"]; ?></strong><br><?= $bisnis["alamat_bisnis"]; ?><br>Telp : <?= $bisnis["telp_bisnis"]; ?><br>Email : <?= $bisnis["email_bisnis"]; ?></address>
              </div>
              <div class="col-md-4">To
                <address><strong><?= $penjualan["nama_pembeli"]; ?></strong><br><?= $penjualan["alamat_pembeli"]; ?><br>Telp : <?= $penjualan["telp_pembeli"]; ?><br>Email : <?= $penjualan["email_pembeli"]; ?></address>
              </div>
              <div class="col-md-4"><b>No Faktur : <?= $penjualan["no_faktur"]; ?></b><br><b>Tanggal Jatoh Tempo : </b><br><?= $penjualan["tgl_jatohtempo"]; ?></div>
            </div>
            <div class="row mt-3">
              <div class="col-12 table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Nama Barang</th>
                      <th>Kategori</th>
                      <th>Kuantitas</th>
                      <th>Harga Satuan</th>
                      <th>Jumlah</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($transaksis as $transaksi) : ?>
                      <tr>
                        <td><?= $transaksi["nama_barang"]; ?></td>
                        <td><?= $transaksi["nama_kategori"]; ?></td>
                        <td><?= $transaksi["kuantitas"]; ?></td>
                        <td>Rp <?= $transaksi["harga_jual"]; ?></td>
                        <td>Rp <?= $transaksi["kuantitas"] * $transaksi["harga_jual"]; ?></td>
                      </tr>
                    <?php endforeach; ?>
                    <tr style="background-color: #009486; color: white;">
                      <th colspan="4">TOTAL</th>

                      <?php $total[] = 0; ?>
                      <?php foreach ($transaksis as $transaksi) : ?>
                        <?php $total[] = $transaksi["kuantitas"] * $transaksi["harga_jual"]; ?>
                      <?php endforeach; ?>

                      <th>Rp <?= array_sum($total); ?></th>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </section>
        </div>
      </div>
      <div class="col-md-12">
        <div class="tile">
          <h3 class="tile-title">Data Pembayaran</h3>
          <div class="tile-body">
            <form action="" method="post">
              <div class="form-group">
                <label class="control-label" for="kode_pembayaran">Kode Pembayaran</label>
                <input class="form-control" type="text" placeholder="Masukan kode pembayaran" id="kode_pembayaran" name="kode_pembayaran" value="<?= $pembayaran['kode_pembayaran']; ?>" required readonly>
              </div>
              <div class="form-group">
                <label for="faktur">Faktur</label>
                <input class="form-control" type="text" placeholder="Masukan no faktur" id="faktur" name="faktur" value="<?= $pembayaran['no_faktur']; ?>" required readonly>
              </div>
              <div class="form-group">
                <label class="control-label" for="tgl_pembayaran">Tanggal Pembayaran</label>
                <input class="form-control" type="date" placeholder="Masukan tanggal pembayaran" id="tgl_pembayaran" name="tgl_pembayaran" value="<?= $pembayaran['tgl_pembayaran']; ?>" required>
              </div>
              <div class="form-group">
                <label class="control-label" for="total_pembayaran">Total Pembayaran</label>
                <input class="form-control" type="number" placeholder="Masukan total pembayaran" id="total_pembayaran" name="total_pembayaran" value="<?= $pembayaran['total_pembayaran']; ?>" required>
              </div>
          </div>
          <div class="tile-footer">
            <button class="btn btn-primary" type="submit" name="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Bayar</button>&nbsp;&nbsp;&nbsp;
            <a class="btn btn-secondary" href="pembayaran.php"><i class="fa fa-fw fa-lg fa-times-circle"></i>Batal</a>
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