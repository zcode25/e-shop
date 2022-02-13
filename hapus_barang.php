<?php

session_start();
if (!isset($_SESSION["login"])) {
  header("Location: index.php");
  exit;
}

require 'functions.php';

$kode = $_GET["kode"];


  if( hapus_barang($kode) > 0 ) {
    echo "

      <script>
        alert('Data barang berhasil dihapus');
        document.location.href = 'barang.php';
      </script>

    ";

  } else {

    echo "

      <script>
        alert('Data barang gagal dihapus');
        document.location.href = 'barang.php';
      </script>

    ";
  }

?>