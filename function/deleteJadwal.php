<?php
require 'function.php';

$id_jadwal = $_GET['j'];

if (deleteJadwal($id_jadwal) > 0) {
  echo "
    <script>
      document.location.href = '../dosen/data-jadwal';
    </script>";
} else {
  echo "
  <script>
    alert('Data Gagal Dihapus, Coba Lagi!!');
    document.location.href = '../dosen/data-jadwal';
  </script>";
}
