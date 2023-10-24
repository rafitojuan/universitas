<?php
require 'function.php';

$matkul = $_GET['matkul'];
$nim = $_GET['nim'];

if (deleteNilai($matkul, $nim) > 0) {
  echo "
  <script>
    document.location.href = '../dosen/detail-nilai?nim=$nim';
</script>";
} else {
  echo "
  <script>
    document.location.href = '../dosen/daftar-matkul';
  </script>";
}
