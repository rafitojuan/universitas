<?php
require 'function.php';

$id_ruangan = $_GET['id_ruangan'];

if (deleteRuangan($id_ruangan)) {
  echo "
    <script>
      document.location.href = '../dosen/daftar-ruangan.php';
  </script>";
} else {
  echo "
    <script>
      document.location.href = '../dosen/data.php';
    </script>";
}
