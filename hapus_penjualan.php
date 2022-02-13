<?php

session_start();
if (!isset($_SESSION["login"])) {
  header("Location: index.php");
  exit;
}

require 'functions.php';

$no = $_GET["no"];



  if( hapus_penjualan($no) > 0 ) {
    echo "

      <script>
        alert('Data penjualan berhasil dihapus');
        document.location.href = 'penjualan.php';
      </script>

    ";

  } else {

    echo "

      <script>
        alert('Data penjualan gagal dihapus');
        document.location.href = 'penjualan.php';
      </script>

    ";
  }

?>