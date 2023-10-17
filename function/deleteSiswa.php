<?php 
require 'function.php';

$id_siswa = $_GET['nim'];

if (deleteSiswa($id_siswa) > 0) {
  echo "
    <script>
      document.location.href = '../dosen/data-siswa.php';
    </script>";
} else {
  echo "
    <script>
      document.location.href = '../dosen/data-siswa.php';
    </script>";
}
