<?php

session_start();
if (!isset($_SESSION["login"])) {
  header("Location: index.php");
  exit;
}

require 'functions.php';

$kode = $_GET["kode"];


  if( hapus_kategori($kode) > 0 ) {
    echo "

      <script>
        alert('Data Kategori berhasil dihapus');
        document.location.href = 'barang.php';
      </script>

    ";

  } else {

    echo "

      <script>
        alert('Data Kategori gagal dihapus');
        document.location.href = 'barang.php';
      </script>

    ";
  }
