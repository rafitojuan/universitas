<?php
require '../function/function.php';
session_start();

$nimMHS = $_SESSION['nim'];

if (!isset($_SESSION['mahasiswa'])) {
  echo "
  <script>
  alert('Harap login dahulu...')
  document.location.href = '../auth/login'
  </script>";
}


$ipk = query("SELECT *,nilai, AVG(nilai) as Nilai, SUM(sks) AS SKS FROM mahasiswa LEFT JOIN nilai AS n USING(nim) JOIN mahasiswa AS m USING(nim) LEFT JOIN mata_kuliah AS mk USING(id_matkul)  WHERE nim = $nimMHS GROUP BY nim")[0];
$table = query("SELECT *,nilai, AVG(nilai) as Nilai, SUM(sks) AS SKS FROM mahasiswa LEFT JOIN nilai AS n USING(nim) JOIN mahasiswa AS m USING(nim) LEFT JOIN mata_kuliah AS mk USING(id_matkul) JOIN dosen AS d USING(id_matkul) JOIN jadwal AS j USING(id_dosen) JOIN ruangan AS r USING(id_ruangan) WHERE nim = $nimMHS");

// $jadwal = query("SELECT * FROM nilai JOIN mata_kuliah AS m USING(id_matkul) JOIN dosen AS d USING(id_matkul) JOIN jadwal AS j USING(id_dosen) JOIN ruangan AS r USING(id_ruangan) WHERE nim = $nimMHS");

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
    <?php include '../components/nav-user'; ?>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <?php include '../components/sidebar-user'; ?>

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
          <div class="row">
            <div class="col-12 col-sm-12 col-md-6">
              <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-university"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">IPK :</span>
                  <span class="info-box-number">
                    <?php
                    if ($ipk['nilai'] == NULL) {
                      echo 'Nilai anda kosong';
                    }
                    ?>
                    <?= $ipk['Nilai']  ?>
                  </span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix hidden-md-up"></div>

            <div class="col-12 col-sm-6 col-md-6">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-book"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">Jumlah SKS :</span>
                  <span class="info-box-number">
                    <?php
                    if ($ipk['sks'] == NULL) {
                      echo 'SKS anda kosong';
                    }
                    ?>
                    <?= $ipk['SKS']  ?></span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->

          <div class="row">
            <div class="col-md-12 mb-5">
              <div class="card">
                <div class="card-header">
                  <h5 class="card-title">Jadwal Kuliah Hari Ini</h5>

                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="maximize">
                      <i class="fas fa-expand"></i>
                    </button>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                  <div class="table-responsive">
                    <table class="table m-0">
                      <thead>
                        <tr>
                          <th>Dosen</th>
                          <th>Mata Kuliah</th>
                          <th>Ruangan</th>
                          <th>Waktu</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($table as $items) : ?>
                          <tr>
                            <td><?= $items['nama_dosen'] ?></td>
                            <td><?= $items['nama_matkul']  ?></td>
                            <td><span class="badge badge-success"><?= $items['nama_ruangan']  ?></span></td>
                            <td>
                              <div class="sparkbar" data-color="#00a65a" data-height="20"><?= $items['jam_masuk']  ?> - <?= $items['jam_keluar']  ?></div>
                            </td>
                          </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                  </div>
                  <!-- /.table-responsive -->
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">

                </div>
                <!-- /.card-footer -->
              </div>
              <!-- /.card -->
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
      <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
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