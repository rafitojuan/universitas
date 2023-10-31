<?php
$page = 'profile';
require '../function/function.php';
session_start();

$nimMHS = $_SESSION['nim'];

if (!isset($_SESSION['mahasiswa'])) {
  $isnotMahasiswa = '
            <script src="../plugins/sweetalert2/sweetalert2.all.min.js"></script>
            <script>
                function passAlert() {
                    Swal.fire({
                        title: "Oopss!",
                        text: "Harap login terlebih dahulu!",
                        icon: "error",
                    }).then(function() {
                        document.location.href="../auth/login";
                    });
                };
            </script>';

  echo $isnotMahasiswa;
  echo '<p class="text-center" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: #ffffff; z-index: 1000;"></p>';
  echo '<script>passAlert();</script>';
}

if (isset($_POST['save'])) {
  if (updateProfile($_POST) > 0) {
    $isSuccess = '
                <script src="../plugins/sweetalert2/sweetalert2.all.min.js"></script>
                <script>
                    function isUpdated() {
                        Swal.fire({
                            title: "Berhasil!",
                            text: "Akun berhasil diperbarui!",
                            icon: "success",
                        }).then(function() {
                            document.location.href="../mahasiswa/profilemhs";
                        });
                    };
                </script>';

    echo $isSuccess;
    echo '<p class="text-center" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: #ffffff; z-index: 1000;"></p>';
    echo '<script>isUpdated();</script>';
  } else {
    echo "
    <script>
    alert('gagal diubah...')
    document.location.href = 'profilemhs.php';
    </script>";
  }
}

$dosen = mysqli_query($conn, "SELECT * FROM dosen");
$jumlahDosen = mysqli_num_rows($dosen);

$daftarMatkul = mysqli_query($conn, "SELECT *, CONCAT(prefix,mata_kuliah.id_matkul) AS kode FROM nilai JOIN mata_kuliah USING(id_matkul) WHERE nim = '$nimMHS'");
$jumlahMatkul = mysqli_num_rows($daftarMatkul);

$akunMhs = query("SELECT * FROM mahasiswa WHERE nim = '$nimMHS'");
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard Mahasiswa</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">.
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
</head>

<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
  <div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__wobble" src="../dist/img/hopes.png" alt="hopes peak" height="60" width="60">
    </div>

    <!-- Navbar -->
    <?php include '../components/nav-user.php'; ?>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <?php include '../components/sidebar-user.php'; ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Dashboard Mahasiswa</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="index">Home</a></li>
                <li class="breadcrumb-item active">Dashboard Mahasiswa</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <!-- Info boxes -->

          <!-- /.row -->

          <div class="row">
            <div class="col-md-12 mb-5">
              <div class="container-xl px-4 mt-4">
                <!-- Account page navigation-->
                <div class="row">
                  <div class="col-xl-4">
                    <form action="" method="post" enctype="multipart/form-data">
                      <!-- Profile picture card-->
                      <div class="card mb-4 mb-xl-0">
                        <div class="card-header">Foto Profile</div>
                        <div class="card-body text-center">
                          <!-- Profile picture image-->
                          <?php foreach ($akunMhs as $foto) : ?>
                            <img class="img-account-profile rounded-circle mb-2" src="../dist/img/<?= !$foto['foto'] ? 'avatar.png' : $foto['foto'] ?>" width="250px" height="250px" alt="">
                          <?php endforeach; ?>
                          <!-- Profile picture help block-->
                          <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                          <!-- Profile picture upload button-->
                          <label for="upload">
                            <?php foreach ($akunMhs as $pfp) : ?>
                              <input type="file" name="uploadFP" class="d-none" id="upload" value="<?= $pfp['foto'] ?>">
                            <?php endforeach; ?>
                            <span class="btn btn-primary"><i class="fas fa-upload"></i> Upload Gambar</span>
                          </label>
                        </div>
                      </div>
                  </div>
                  <div class="col-xl-8">
                    <!-- Account details card-->
                    <div class="card mb-4">
                      <div class="card-header">Detail Akun</div>
                      <div class="card-body">
                        <?php foreach ($akunMhs as $akun) : ?>
                          <input type="hidden" name="nimMhs" value="<?= $akun['nim'] ?>" id="">
                          <!-- Form Group (username)-->
                          <div class="mb-3">
                            <label class="small mb-1" for="inputUsername">Username</label>
                            <input class="form-control" name="namaMhs" id="inputUsername" type="text" placeholder="Masukkan username" required value="<?= $akun['nama_mahasiswa'] ?>">
                          </div>
                          <!-- Form Row-->
                          <div class="row gx-3 mb-3">
                            <!-- Form Group (first name)-->
                            <div class="col-md-6">
                              <label class="small mb-1" for="inputPassword">Password</label>
                              <input class="form-control" id="inputPassword" type="password" name="password" required placeholder="Masukkan Password Baru">
                            </div>
                            <!-- Form Group (last name)-->
                            <div class="col-md-6">
                              <label class="small mb-1" for="konfirm">Konfirmasi Password</label>
                              <input class="form-control" id="konfirm" type="password" name="confirmPassword" required placeholder="Konfirmasi Password">
                            </div>
                          </div>
                        <?php endforeach; ?>
                        <!-- Save changes button-->
                        <button class="btn btn-primary" name="save" type="submit">Simpan perubahan</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div><!--/. container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <footer class="main-footer">
      <strong>Copyright &copy; 2014-2021 <a href="http://semudah.byethost12.com" target="_blank">rafitojuan</a>.</strong>
      All rights reserved.
      <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 3.2.0
      </div>
    </footer>
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->
  <!-- jQuery -->
  <script src="../plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../dist/js/adminlte.js"></script>

  <!-- PAGE PLUGINS -->
  <!-- jQuery Mapael -->
  <script src="../plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
  <script src="../plugins/raphael/raphael.min.js"></script>
  <script src="../plugins/jquery-mapael/jquery.mapael.min.js"></script>
  <script src="../plugins/jquery-mapael/maps/usa_states.min.js"></script>
  <!-- ChartJS -->
  <script src="../plugins/chart.js/Chart.min.js"></script>

  <!-- AdminLTE for demo purposes -->
  <script src="../dist/js/demo.js"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="../dist/js/pages/dashboard2.js"></script>
</body>

</html>