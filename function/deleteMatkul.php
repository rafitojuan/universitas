<?php
require 'function.php';

$id_matkul = $_GET['matkul'];

if (deleteMatkul($id_matkul) > 0) {
  echo "
  <script>
    document.location.href = '../dosen/daftar-matkul';
</script>";
} else {
  echo "
  <script>
    document.location.href = '../dosen/daftar-matkul';
  </script>";
}
