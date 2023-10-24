<?php
require 'function.php';

$id_dos = $_GET["id_dosen"];

if (deleteDosen($id_dos) > 0) {
  echo "
    <script>
      document.location.href = '../dosen/data';
    </script>";
} else {
  echo "
    <script>
      alert('Data Gagal Dihapus, Coba Lagi!!');
      document.location.href = '../dosen/data';
    </script>";
}
