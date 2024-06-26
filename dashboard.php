<?php

session_start();
if (!isset($_SESSION["login"])) {
  header("Location: index.php");
  exit;
}


require 'functions.php';
$kode = $_SESSION["bisnis"];
$suppliers = query("SELECT * FROM supplier WHERE kode_bisnis = '$kode'");
$fakturs = query("SELECT * FROM faktur WHERE kode_bisnis = '$kode'");
$pembelis = query("SELECT * FROM pembeli WHERE kode_bisnis = '$kode'");
$barangs = query("SELECT * FROM barang WHERE kode_bisnis = '$kode'");

// $bisnis = query("SELECT * FROM bisnis WHERE kode_bisnis = '$kode'")[0];

// $penjualans = query("SELECT no_faktur, tgl_pemesanan, tgl_jatohtempo, nama_karyawan FROM faktur JOIN pembeli USING (id_pembeli) JOIN karyawan USING (id_karyawan) WHERE kode_bisnis = '$kode' ORDER BY no_faktur DESC LIMIT 5");
$penjualans = query("SELECT * FROM faktur WHERE kode_bisnis = '$kode' ORDER BY no_faktur DESC LIMIT 5");
$tops = query("SELECT kode_barang, nama_barang, SUM(kuantitas) AS jumlah FROM transaksi JOIN barang USING (kode_barang) WHERE kode_bisnis = '$kode' GROUP BY (kode_barang) ORDER BY (jumlah) DESC LIMIT 10");

// var_dump($penjualans);
// exit();
$tanggal = date('Y-m-d');

$result = mysqli_query($conn, "SELECT * FROM pembayaran WHERE tgl_pembayaran = '$tanggal' AND kode_bisnis = '$kode'");

if (mysqli_num_rows($result) >= 1) {

  $pendapatan = query("SELECT tgl_pembayaran, SUM(total_pembayaran) AS pendapatan from pembayaran WHERE tgl_pembayaran = '$tanggal' GROUP BY (tgl_pembayaran)")[0];
} else {
  $pendapatan["pendapatan"] = 0;
}

$result2 = mysqli_query($conn, "SELECT * FROM pembayaran WHERE kode_bisnis = '$kode'");

if (mysqli_num_rows($result2) >= 1) {
  $pendapatans = query("SELECT SUM(total_pembayaran) AS pendapatan from pembayaran")[0];
} else {
  $pendapatans["pendapatan"] = 0;
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
        <p class="app-sidebar__user-name ml-2"></i><?= $_SESSION["nama"]; ?></p>
        <!-- <hr style="width: 50%;"> -->
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
        <h1><i class="fa fa-dashboard"></i> Dashboard</h1>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="widget-small primary "><i class="icon fa fa-usd fa-3x"></i>
          <div class="info">
            <h4>Pendapatan Hari Ini</h4>
            <p><b>Rp <?= $pendapatan["pendapatan"]; ?></b></p>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="widget-small info"><i class="icon fa fa-money fa-3x"></i>
          <div class="info">
            <h4>Pendapatan Selama Ini</h4>
            <p><b>Rp <?= $pendapatans["pendapatan"]; ?></b></p>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-3">
        <div class="widget-small warning  coloured-icon"><i class="icon fa fa-shopping-cart fa-3x"></i>
          <div class="info">
            <h4>Penjualan</h4>
            <p><b><?= count($fakturs) ?></b></p>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="widget-small info  coloured-icon"><i class="icon fa fa-archive fa-3x"></i>
          <div class="info">
            <h4>Barang</h4>
            <p><b><?= count($barangs) ?></b></p>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="widget-small primary coloured-icon"><i class="icon fa fa-users fa-3x"></i>
          <div class="info">
            <h4>Pembeli</h4>
            <p><b><?= count($pembelis) ?></b></p>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="widget-small danger  coloured-icon"><i class="icon fa fa-truck fa-3x"></i>
          <div class="info">
            <h4>Supplier</h4>
            <p><b><?= count($suppliers) ?></b></p>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="tile">
          <h3 class="tile-title">Top 10 Barang</h3>
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Kode Barang</th>
                  <th>Nama Barang</th>
                  <th>Jumlah</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 1; ?>
                <?php foreach ($tops as $top) : ?>
                  <?php if ($i == 1) : ?>
                    <tr class="table-primary">
                      <td><?= $i; ?></td>
                      <td><?= $top["kode_barang"]; ?></td>
                      <td><?= $top["nama_barang"]; ?></td>
                      <td><?= $top["jumlah"]; ?></td>
                    </tr>
                  <?php elseif ($i == 2) : ?>
                    <tr class="table-success">
                      <td><?= $i; ?></td>
                      <td><?= $top["kode_barang"]; ?></td>
                      <td><?= $top["nama_barang"]; ?></td>
                      <td><?= $top["jumlah"]; ?></td>
                    </tr>
                  <?php elseif ($i == 3) : ?>
                    <tr class="table-danger">
                      <td><?= $i; ?></td>
                      <td><?= $top["kode_barang"]; ?></td>
                      <td><?= $top["nama_barang"]; ?></td>
                      <td><?= $top["jumlah"]; ?></td>
                    </tr>
                  <?php else : ?>
                    <tr>
                      <td><?= $i; ?></td>
                      <td><?= $top["kode_barang"]; ?></td>
                      <td><?= $top["nama_barang"]; ?></td>
                      <td><?= $top["jumlah"]; ?></td>
                    </tr>
                  <?php endif; ?>
                  <?php $i++; ?>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="tile">
          <h3 class="tile-title">Data Penjualan Terbaru</h3>
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th>No Faktur</th>
                  <th>Tanggal Pemesanan</th>
                  <th>Tanggal Jatoh Tempo</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($penjualans as $penjualan) : ?>
                  <tr>
                    <td><?= $penjualan["no_faktur"]; ?></td>
                    <td><?= $penjualan["tgl_pemesanan"]; ?></td>
                    <td><?= $penjualan["tgl_jatohtempo"]; ?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
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