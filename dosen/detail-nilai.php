<?php
require '../function/function.php';
session_start();

include '../partials/notlogin.php';

$nim = $_GET['nim'];

$data_matkul = query("SELECT * FROM mata_kuliah");
$join = query("SELECT *, nilai, AVG(nilai) as Nilai, CONCAT(mahasiswa.uni,nim,mahasiswa.ajaran) AS NIM FROM mahasiswa LEFT JOIN nilai AS n USING(nim) JOIN mahasiswa AS m USING(nim) WHERE nim = '$nim' GROUP BY nim")[0];
$selectQuery = query("SELECT *, nilai, CONCAT(mahasiswa.uni,nim,mahasiswa.ajaran) AS NIM FROM mahasiswa LEFT JOIN nilai AS n USING(nim) JOIN mahasiswa AS m USING(nim) JOIN mata_kuliah AS test USING(id_matkul)  WHERE nim = '$nim'");
$no = 1;
$dataMahasiswa = query("SELECT * FROM mahasiswa");

if (!isset($_SESSION['login'])) {
  echo "
  <script>
  alert('Harap login dahulu...')
  document.location.href = '../auth/login'
  </script>";
}

if (isset($_POST['subNilai'])) {
  if (addNilai($_POST) > 0) {
    echo "
    <script>
    document.location.href = 'data-nilai?nilai=1';
    </script>";
  } else {
    echo "
    <script>
      document.location.href = 'data-nilai?fail';
    </script>";
  }
}

if (isset($_POST['updateNilai'])) {
  if (updateNilai($_POST) > 0) {
    echo "
    <script>
    document.location.href = 'detail-nilai?nim=$nim';
    </script>";
  } else {
    echo "
    <script>
      document.location.href = 'detail-nilai?nim=$nim';
    </script>";
  }
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Admin Juan | Data Dosen</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css" />
  <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css" />
  <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css" />
  <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css" />
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css" />
  <link rel="icon" href="../dist/img/hopes.png">
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="../index" class="nav-link">Home</a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <li class="nav-item">
          <a class="nav-link" data-widget="navbar-search" href="#" role="button">
            <i class="fas fa-search"></i>
          </a>
          <div class="navbar-search-block">
            <form class="form-inline">
              <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search" />
                <div class="input-group-append">
                  <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                  </button>
                  <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
            </form>
          </div>
        </li>

        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-comments"></i>
            <span class="badge badge-danger navbar-badge">3</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <a href="#" class="dropdown-item">
              <!-- Message Start -->
              <div class="media">
                <img src="../dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle" />
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    Revin Siregar
                    <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                  </h3>
                  <p class="text-sm">Aduh Bu Meli cakep amat 😅...</p>
                  <p class="text-sm text-muted">
                    <i class="far fa-clock mr-1"></i> 4 Jam Lalu
                  </p>
                </div>
              </div>
              <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <!-- Message Start -->
              <div class="media">
                <img src="../dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3" />
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    Toriq Simatupang
                    <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                  </h3>
                  <p class="text-sm">King tugas Bu Meli dah belom</p>
                  <p class="text-sm text-muted">
                    <i class="far fa-clock mr-1"></i> 5 Jam lalu
                  </p>
                </div>
              </div>
              <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <!-- Message Start -->
              <div class="media">
                <img src="../dist/img/user6-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3" />
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    Dapa Kecap
                    <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                  </h3>
                  <p class="text-sm">Bagi tugas pemweb to</p>
                  <p class="text-sm text-muted">
                    <i class="far fa-clock mr-1"></i> 12 Jam lalu
                  </p>
                </div>
              </div>
              <!-- Message End -->
            </a>
          </div>
        </li>

        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="../index" class="brand-link">
        <img src="../dist/img/hopes.png" alt="AdminJuan Logo" class="brand-image img-circle elevation-3" style="opacity: 0.8" />
        <span class="brand-text font-weight-light">Hope's Peak</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="../dist/img/avatar5.png" class="img-circle elevation-2" alt="User Image" />
          </div>
          <div class="info">
            <a href="#" class="d-block"><?= $_SESSION["username"] ?></a>
          </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
          <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search" />
            <div class="input-group-append">
              <button class="btn btn-sidebar">
                <i class="fas fa-search fa-fw"></i>
              </button>
            </div>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-header">DASHBOARD</li>
            <!-- DASHBOARD -->
            <li class="nav-item">
              <a href="../index" class="nav-link">
                <i class="nav-icon fab fa-gg"></i>
                <p>Dashboard</p>
              </a>
            </li>
            <li class="nav-header">DOSEN</li>
            <!-- DOSEN -->
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-chalkboard-teacher"></i>
                <p>
                  Dosen
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="../dosen/data" class="nav-link">
                    <i class="fas fa-user-tie nav-icon"></i>
                    <p>Daftar Dosen</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="data-jadwal" class="nav-link">
                    <i class="fas fa-calendar-day nav-icon"></i>
                    <p>Daftar Jadwal</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-header">MAHASISWA</li>
            <!-- MAHASISWA -->
            <li class="nav-item menu-open">
              <a href="#" class="nav-link active">
                <i class="nav-icon fas fa-user-graduate"></i>
                <p>
                  Mahasiswa
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="../dosen/data-siswa" class="nav-link">
                    <i class="fa fa-user nav-icon"></i>
                    <p>Daftar Mahasiswa</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="../dosen/data-nilai" class="nav-link active">
                    <i class="fas fa-file-invoice nav-icon"></i>
                    <p>Daftar Nilai</p>
                  </a>
                </li>
              </ul>
            </li>
            <!-- MATA KULIAH -->
            <li class="nav-header">MATA KULIAH</li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-university"></i>
                <p>
                  Mata Kuliah
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="daftar-ruangan" class="nav-link">
                    <i class="far fa-building nav-icon"></i>
                    <p>Daftar Ruangan</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="daftar-matkul" class="nav-link">
                    <i class="far fa-file-alt nav-icon"></i>
                    <p>Daftar Mata Kuliah</p>
                  </a>
                </li>
              </ul>
              <!-- LOGOUT -->
            <li class="nav-header">END SESSION</li>
            <li class="nav-item">
              <a href="#" class="nav-link loggedout" id="loggedout">
                <i class="nav-icon fas fa-power-off"></i>
                <p>
                  Log Out
                </p>
              </a>
            </li>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Data Nilai</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="../index">Home</a></li>
                <li class="breadcrumb-item active">Data Nilai</li>
              </ol>
            </div>
          </div>
        </div>
        <!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Detail Nilai <span class="text-bold"><?= $join['nama_mahasiswa'] ?></span></h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead class="bg-dark text-white">
                      <tr>
                        <th style="width: 10px;">No</th>
                        <th>Mata Kuliah</th>
                        <th style="width: 15px;">Nilai</th>
                        <th style="width: 120px;">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($selectQuery as $showNilai) : ?>
                        <tr>
                          <td><?= $no++; ?>.</td>
                          <td><?= $showNilai['nama_matkul']  ?></td>
                          <td class="text-center"><?= $showNilai['nilai']  ?></td>
                          <td>
                            <a href="#" data-target="#modalEdit<?= $showNilai['nilai'] ?>" data-toggle="modal" class="badge bg-primary"><i class="fas fa-pencil-alt"></i> Update</a>
                            <a href="../function/deleteNilai?matkul=<?= $showNilai['id_matkul'] ?>&nim=<?= $showNilai['nim'] ?>" class="delNilai badge bg-danger float-right"><i class="fas fa-trash"> Delete</i></a>
                          </td>
                        </tr>
                        <!-- Modal -->
                        <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                        <div class="modal fade" id="modalEdit<?= $showNilai['nilai'] ?>" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="modalTitleId">Ubah Nilai <?= $showNilai['nama_matkul']  ?></h5>
                                <button type="button" class="btn btn-close" data-dismiss="modal" aria-label="Close">x</button>
                              </div>
                              <form action="" method="post">
                                <div class="modal-body">
                                  <div class="mb-4" style="margin-top: -15px;">
                                    <label for="nilai" id="nilai" class="form-label">Nilai</label>
                                    <input type="number" name="nilai" id="nilai" class="form-control" min="1" max="4" placeholder="Edit nilai...." value="<?= $showNilai['nilai'] ?>" oninvalid="this.setCustomValidity('Isi kolom dengan range nilai (1-4) ')" oninput="this.setCustomValidity()">
                                    <input type="hidden" name="matkul" value="<?= $showNilai['id_matkul'] ?>">
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                  <button type="submit" name="updateNilai" class="btn btn-primary">Save</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                      <?php endforeach; ?>
                </div>
              </div>
              </tbody>
              <tbody>
                <tr>
                  <td colspan="2">Rata-Rata Nilai : </td>
                  <td colspan="2" class="text-center"><?= $join['Nilai'] ?></td>
                </tr>
                <tr>
                  <?php if ($join['Nilai'] >= 4) {
                    $join['Nilai'] = 'A';
                  } elseif ($join['Nilai'] >= 3) {
                    $join['Nilai'] = 'B';
                  } elseif ($join['Nilai'] >= 2) {
                    $join['Nilai'] = 'C';
                  } elseif ($join['Nilai'] >= 1) {
                    $join['Nilai'] = 'D';
                  } elseif ($join['Nilai'] >= 0) {
                    $join['Nilai'] = 'E';
                  }
                  ?>
                  <td colspan="2">Predikat : </td>
                  <td colspan="2" class="text-center"><?= $join['Nilai'] ?></td>
                </tr>
              </tbody>
              </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer justify-content-between ">
              <a href="../dosen/data-nilai" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
            </div>
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container-fluid -->
  </section>
  <!-- /.content -->
  </div>


  </div>




  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block"><b>Version</b> 3.1</div>
    <strong>Copyright &copy; 2023-2024
      <a href="http://semudah.byethost12.com" target="_blank">rafitojuan</a>.</strong>
    All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="../plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- DataTables  & Plugins -->
  <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="../plugins/jszip/jszip.min.js"></script>
  <script src="../plugins/pdfmake/pdfmake.min.js"></script>
  <script src="../plugins/pdfmake/vfs_fonts.js"></script>
  <script src="../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="../plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../dist/js/adminlte.min.js"></script>

  <!-- Page specific script -->

  <script>
    $(document).ready(function() {
      var i = 1;
      $('#plusRow').click(function(c) {
        i++;
        c.preventDefault();
        $('#dynamicAdd').append('<div id="row' + i + '" class="row"><div class="col-5"><label for="matkul" class="form-label"></label><select name="matkul[]" id="matkul" class="form-control"><?php foreach ($data_matkul as $option) : ?><option value="<?= $option['id_matkul']; ?>"><?= $option['nama_matkul'];  ?></option><?php endforeach; ?></select></div><div class="col-5"><label for="nilai" class="form-label"></label><select name="nilai[]" id="nilai" class="form-control"><option value="4">A</option><option value="3">B</option><option value="2">C</option><option value="1">D</option><option value="0">E</option></select></div> <div class="col-2"><button class="removeRow badge badge-danger border-0" style="margin-top: 20px;" id="' + i + '" > - </button></div></div></div>');
      });
      $(document).on('click', '.removeRow', function(f) {
        f.preventDefault();
        var row_id = $(this).attr("id");
        $('#row' + row_id + '').remove();
      })
    });
  </script>

  <script>
    $('.delNilai').on('click', function(d) {
      d.preventDefault();
      const delLink = $(this).attr('href')

      Swal.fire({
        icon: 'question',
        title: 'Hapus data nilai?',
        showConfirmButton: false,
        showDenyButton: true,
        showCancelButton: true,
        denyButtonText: 'Hapus'
      }).then((result) => {
        if (result.isDenied) {
          Swal.fire({
            icon: 'success',
            title: 'Data nilai berhasil dihapus!',
            timer: '2000',
            timerProgressBar: true
          }).then((result) => {
            if (result.dismiss === Swal.DismissReason.timer) {
              document.location = delLink;
            } else {
              document.location = delLink;
            }
          })
        }
      })
    })
  </script>



  <script>
    const btnlogout = document.querySelector('#loggedout');
    btnlogout.addEventListener('click', function() {
      Swal.fire({
        icon: 'warning',
        title: 'Apakah anda yakin ingin logout?',
        showDenyButton: true,
        showConfirmButton: false,
        showCancelButton: true,
        denyButtonText: 'Logout'
      }).then((result) => {
        if (result.isDenied) {
          Swal.fire({
            title: 'Selamat Tinggal...',
            showConfirmButton: false,
            showDenyButton: true,
            denyButtonText: 'Confirm',
            timer: '2000',
            timerProgressBar: true,
            icon: 'success'
          }).then((result) => {
            if (result.dismiss === Swal.DismissReason.timer) {
              document.location.href = '../auth/logout'
            } else if (result.dismiss === Swal.DismissReason.deny) {
              document.location.href = '../auth/logout'
            } else {
              document.location.href = '../auth/logout'
            }
          })
        }
      })
    })
  </script>

  <script>
    $(function() {
      $("#example1")
        .DataTable({
          responsive: true,
          lengthChange: true,
          lengthMenu: [
            [5, 10, 25, 50, -1],
            [5, 10, 25, 50, 'All']
          ],
          autoWidth: false,
          paging: true,
          searching: true,
          ordering: true,
          buttons: [{
              extend: 'excel',
              className: ''
            },
            {
              extend: 'pdf',
              className: ''
            },
            {
              extend: 'print',
              className: ''
            },
          ]
        })
        .buttons()
        .container()
        .appendTo("#example1_wrapper .col-md-6:eq(0)");
    });
  </script>

  <script>
    localStorage.removeItem("notifOut");
  </script>

  <!-- buttons: [{
  extend: 'collection',
  className: "btn-danger",
  text: 'Export',
  buttons: [{
  extend: "pdf",
  className: "btn-danger"
  }],
  }] -->

  <!-- <script>
  const showPassword = document.querySelector('#showPassword');
  const password = document.querySelector('#pwnya');

  showPassword.addEventListener('click', function(e) {
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    this.classList.toggle('fa-eye-slash');
  });
</script> -->

</body>

</html>