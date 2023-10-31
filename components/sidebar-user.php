<?php
$akunMhs = query("SELECT * FROM mahasiswa WHERE nim = '$nimMHS'");
?>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="../mahasiswa/index" class="brand-link">
    <img src="../dist/img/hopes.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">HPA STUDENT</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <?php foreach ($akunMhs as $foti) : ?>
          <img src="../dist/img/<?= !$foti['foto'] ? 'avatar.png' : $foti['foto'] ?>" class="elevation-2" alt="User Image" style="border-radius: 50%; width: 50px; height: 50px;">
        <?php endforeach; ?>
      </div>
      <div class="info">
        <a href="profilemhs" class="d-block"><?= $_SESSION['namaMHS'] ?></a>
      </div>
    </div>

    <!-- SidebarSearch Form -->
    <div class="form-inline">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
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
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <li class="nav-header">Dashboard</li>
        <li class="nav-item">
          <a href="index" class="nav-link <?= $page == 'home' ? 'active' : '' ?>">
            <i class="nav-icon fab fa-gg"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        <li class="nav-header">Dosen</li>
        <li class="nav-item">
          <a href="../mahasiswa/mhs-dosen" class="nav-link  <?= $page == 'dosen' ? 'active' : '' ?>">
            <i class="nav-icon fas fa-chalkboard-teacher"></i>
            <p>
              Daftar Dosen
              <span class="right badge badge-danger"><?= $jumlahDosen ?></span>
            </p>
          </a>
        </li>
        <li class="nav-header">Akademik</li>
        <li class="nav-item">
          <a href="../mahasiswa/mhs-matkul" class="nav-link <?= $page == 'matkul' ? 'active' : '' ?>">
            <i class="nav-icon fas fa-copy"></i>
            <p>
              Daftar Mata Kuliah
              <span class="badge badge-info right"><?= $jumlahMatkul ?></span>
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="../mahasiswa/mhs-nilai" class="nav-link <?= $page == 'nilai' ? 'active' : '' ?>">
            <i class="nav-icon fas fa-chart-pie"></i>
            <p>
              Daftar Nilai
            </p>
          </a>
        </li>
        <li class="nav-header">End Session</li>
        <li class="nav-item">
          <a href="../auth/logout" class="nav-link" id="loggedout">
            <i class="nav-icon fas fa-power-off"></i>
            <p>
              Logout
            </p>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>

<script src="../plugins/jquery/jquery.min.js"></script>
<script>
  let btnlogout = document.querySelector('#loggedout');
  btnlogout.addEventListener('click', function(i) {
    i.preventDefault()
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