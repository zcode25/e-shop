<?php

session_start();
if (!isset($_SESSION["login"])) {
  header("Location: index.php");
  exit;
}

require 'functions.php';

$id = $_GET["id"];


  if( hapus_pembeli($id) > 0 ) {
    echo "

      <script>
        alert('Data pembeli berhasil dihapus');
        document.location.href = 'pembeli.php';
      </script>

    ";

  } else {

    echo "

      <script>
        alert('Data pembeli gagal dihapus');
        document.location.href = 'pembeli.php';
      </script>

    ";
  }

?>