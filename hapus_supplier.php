<?php

session_start();
if (!isset($_SESSION["login"])) {
  header("Location: index.php");
  exit;
}

require 'functions.php';

$kode = $_GET["kode"];


  if( hapus_supplier($kode) > 0 ) {
    echo "

      <script>
        alert('Data supplier berhasil dihapus');
        document.location.href = 'supplier.php';
      </script>

    ";

  } else {

    echo "

      <script>
        alert('Data supplier gagal dihapus');
        document.location.href = 'supplier.php';
      </script>

    ";
  }

?>