<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php
require "../config/config.php";

// FETCH DATA
function query($query)
{
  global $conn;

  $result = mysqli_query($conn, $query);
  $rows = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }

  return $rows;
}


///// FUNCTION DOSEN //////
// TAMBAH DOSEN
function addDosen($data)
{
  global $conn;

  $namaDosen = ucwords(htmlspecialchars($data['namaDosen']));

  $query = "INSERT INTO dosen VALUES ('DK','','$namaDosen')";

  mysqli_query($conn, $query);

  return mysqli_affected_rows($conn);
}

// UPDATE DOSEN
function updateDosen($data)
{
  global $conn;

  $id_dosen = $data['id_dosen'];
  $namaDosen = ucwords(htmlspecialchars($data['namaDosen']));

  $query = "UPDATE dosen SET nama_dosen = '$namaDosen' WHERE id_dosen= $id_dosen";

  mysqli_query($conn, $query);

  return mysqli_affected_rows($conn);
}


// HAPUS DOSEN
function deleteDosen($id_dos)
{
  global $conn;

  mysqli_query($conn, "DELETE FROM dosen WHERE id_dosen = $id_dos");

  return mysqli_affected_rows($conn);
}



///// FUNCTION BAGIAN SISWA /////

// TAMBAH SISWA
function addSiswa($data)
{
  global $conn;

  $nama_siswa = ucwords(htmlspecialchars($data['namaSiswa']));
  $tingkat = $data['tingkat'];
  $password = $data['password'];
  $alamat = ucwords(htmlspecialchars($data['alamat']));

  $query = "INSERT INTO mahasiswa VALUES ('HPA/',NULL,'/2023','$nama_siswa','$tingkat','$password','$alamat')";

  mysqli_query($conn, $query);

  return mysqli_affected_rows($conn);
}

// UPDATE SISWA
function updateSiswa($data)
{
  global $conn;

  $nim = $data['nim'];

  $nmSiswa = ucwords(htmlspecialchars($data['namaMahasiswa']));
  $tingkat = $data['tingkat'];
  $password = $data['password'];
  $alamat = ucwords(htmlspecialchars($data['alamat']));

  $query = "UPDATE mahasiswa SET nama_mahasiswa = '$nmSiswa', tingkat = '$tingkat', password = '$password', alamat = '$alamat' WHERE nim = $nim";

  mysqli_query($conn, $query);

  return mysqli_affected_rows($conn);
}

// HAPUS SISWA
function deleteSiswa($id_siswa)
{
  global $conn;

  mysqli_query($conn, "DELETE FROM mahasiswa WHERE nim = $id_siswa");

  return mysqli_affected_rows($conn);
}

/// FUNCTION MATA KULIAH ///

function addRuangan($data)
{
  global $conn;

  $id_ruangan = ucwords(htmlspecialchars($data['idRuangan']));
  $nama_ruangan = ucwords(htmlspecialchars($data['namaRuangan']));

  $query = "INSERT INTO ruangan VALUES ('$id_ruangan','$nama_ruangan')";

  mysqli_query($conn, $query);

  return mysqli_affected_rows($conn);
}

function deleteRuangan($id_ruangan)
{
  global $conn;

  mysqli_query($conn, "DELETE FROM ruangan WHERE id_ruangan = '$id_ruangan'");

  return mysqli_affected_rows($conn);
}

function updateRuangan($data)
{
  global $conn;

  $id = $_GET['id_ruangan'];
  $id_ruangan = ucwords(htmlspecialchars($data['idRuangan']));
  $nama_ruangan = ucwords(htmlspecialchars($data['namaRuangan']));

  $query = "UPDATE ruangan SET id_ruangan = '$id_ruangan', nama_ruangan = '$nama_ruangan' WHERE id_ruangan = '$id'";

  mysqli_query($conn, $query);

  return mysqli_affected_rows($conn);
}

function addMatkul($data)
{
  global $conn;

  $id_matkul = strtoupper(htmlspecialchars($data['idMatkul']));
  $nm_matkul = ucwords(htmlspecialchars($data['namaMatkul']));
  $sks = $data['sks'];
  $semester = $data['semester'];

  $query = "INSERT INTO mata_kuliah VALUES ('$id_matkul','$nm_matkul','$sks','$semester')";

  mysqli_query($conn, $query);

  return mysqli_affected_rows($conn);
}

function deleteMatkul($id_matkul)
{
  global $conn;

  mysqli_query($conn, "DELETE FROM mata_kuliah WHERE id_matkul = '$id_matkul'");

  return mysqli_affected_rows($conn);
}

function updateMatkul($data)
{
  global $conn;

  $id = $_GET['matkul'];

  $id_matkul = strtoupper(htmlspecialchars($data['idMatkul']));
  $nm_matkul = ucwords(htmlspecialchars($data['namaMatkul']));
  $sks = $data['sks'];
  $semester = $data['semester'];

  $query = "UPDATE mata_kuliah SET id_matkul = '$id_matkul', nama_matkul = '$nm_matkul', sks = '$sks', semester = '$semester' WHERE id_matkul = '$id'";

  mysqli_query($conn, $query);

  return mysqli_affected_rows($conn);
}

//// FUNCTION NILAI ////
// TAMBAH NILAI
function addNilai($data)
{
  global $conn;

  $nim = $data['nim'];
  $matkul = $data['matkul'];
  $nilai = $data['nilai'];

  for ($i = 0; $i < count($data['matkul']); $i++) {
    $query = "INSERT INTO nilai VALUES ('$matkul[$i]', '$nim', '$nilai[$i]')";
    mysqli_query($conn, $query);
  }


  return mysqli_affected_rows($conn);
}

function updateNilai($data)
{
  global $conn;

  $getNim = $_GET['nim'];

  $matkul = $data['matkul'];
  $nilai = $data['nilai'];

  $query = "UPDATE nilai SET nilai = '$nilai' WHERE nilai.id_matkul = '$matkul' AND nilai.nim = '$getNim'";

  mysqli_query($conn, $query);

  return mysqli_affected_rows($conn);
}

function deleteNilai($matkul, $nim)
{
  global $conn;

  $query = "DELETE FROM nilai WHERE nilai.id_matkul = '$matkul' AND nilai.nim = $nim";

  mysqli_query($conn, $query);
  return mysqli_affected_rows($conn);
}
