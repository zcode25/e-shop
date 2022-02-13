<?php

session_start();
if (!isset($_SESSION["login"])) {
  header("Location: index.php");
  exit;
}

require 'functions.php';

$no = $_GET["no"];
$kode = $_GET["kode"];
$kty = $_GET["kty"];
$stok = query("SELECT * FROM barang WHERE kode_barang = '$kode'")[0];


  if( hapus_transaksi_penjualan($no, $kode) > 0 ) {
    echo "

      <script>
        window.location.href = 'transaksi_penjualan.php?no=$no';
      </script>

    ";

    tambah_stok($kode, $kty, $stok);
  } else {

    echo "

      <script>
        window.location.href = 'transaksi_penjualan.php?no=$no';
      </script>

    ";
  }

?>