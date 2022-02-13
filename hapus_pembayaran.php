<?php

session_start();
if (!isset($_SESSION["login"])) {
  header("Location: index.php");
  exit;
}

require 'functions.php';

$no = $_GET["no"];
$kode = $_GET["kode"];


  if( hapus_pembayaran($no, $kode) > 0 ) {
    echo "

      <script>
        alert('Data pembayaran berhasil dihapus');
        document.location.href = 'pembayaran.php';
      </script>

    ";

  } else {

    echo "

      <script>
        alert('Data pembayaran gagal dihapus');
        document.location.href = 'pembayaran.php';
      </script>

    ";
  }

?>