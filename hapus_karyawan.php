<?php

session_start();
if (!isset($_SESSION["login"])) {
  header("Location: index.php");
  exit;
}

require 'functions.php';

$id = $_GET["id"];


  if( hapus_karyawan($id) > 0 ) {
    echo "

      <script>
        alert('Data karyawan berhasil dihapus');
        document.location.href = 'logout.php';
      </script>

    ";

  } else {

    echo "

      <script>
        alert('Data karyawan gagal dihapus');
        document.location.href = 'karyawan.php';
      </script>

    ";
  }

?>