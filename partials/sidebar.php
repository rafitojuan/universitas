<aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="index.php" class="brand-link">
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
              <a href="../index.php" class="nav-link">
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
                  <a href="../dosen/data.php" class="nav-link">
                    <i class="fas fa-user-tie nav-icon"></i>
                    <p>Daftar Dosen</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="dosen/#" class="nav-link">
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
                  <a href="../dosen/data-siswa.php" class="nav-link">
                    <i class="fa fa-user nav-icon"></i>
                    <p>Daftar Mahasiswa</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="../dosen/data-nilai.php" class="nav-link active">
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
                  <a href="daftar-ruangan.php" class="nav-link">
                    <i class="far fa-building nav-icon"></i>
                    <p>Daftar Ruangan</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="daftar-matkul.php" class="nav-link">
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