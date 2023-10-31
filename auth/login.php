<?php
session_start();
require "../function/function.php";

$akun = query("SELECT * FROM admin JOIN mahasiswa");

if (isset($_POST['logged'])) {
  $username = $_POST['username'];
  $pwadmin = $_POST['pwadmin'];

  $result = mysqli_query($conn, "SELECT * FROM admin WHERE username = '$username'");
  if (mysqli_num_rows($result) === 1) {
    $row = mysqli_fetch_assoc($result);
    if ($username == $row['username'] && $pwadmin == $row['password']) {
      $_SESSION["login"] = true;
      $_SESSION["username"] = ucfirst($row['username']);

      echo "
            <script>
            document.location.href ='../index'
            </script>
            ";
    } else {
      // style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: #ffffff; z-index: 1000;"
    }
  }

  $user = $_POST['username'];
  $pwuser = $_POST['pwadmin'];

  $masis = mysqli_query($conn, "SELECT * FROM mahasiswa WHERE nim = '$user'");
  if (mysqli_num_rows($masis) === 1) {
    $baris = mysqli_fetch_assoc($masis);
    if ($user == $baris['nim'] && $pwuser == $baris['password']) {
      $_SESSION["mahasiswa"] = true;
      $_SESSION["namaMHS"] = ucfirst($baris['nama_mahasiswa']);
      $_SESSION["nim"] = $baris['nim'];
      $_SESSION['foto'] = $baris['foto'];

      echo "
            <script>
            document.location.href ='../mahasiswa/index'
            </script>
            ";
    } else {
      $isWrongPass = '
            <script src="../plugins/sweetalert2/sweetalert2.all.min.js"></script>
            <script>
                function passAlert() {
                    Swal.fire({
                        title: "Oopss!",
                        text: "Username atau Password tidak sesuai!",
                        icon: "error",
                    }).then(function() {
                        document.location.href="login";
                    });
                };
            </script>';

      echo $isWrongPass;
      echo '<p class="text-center" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: #ffffff; z-index: 1000;"></p>';
      echo '<script>passAlert();</script>';
    }
  } else {
    $isWrongPass = '
            <script src="../plugins/sweetalert2/sweetalert2.all.min.js"></script>
            <script>
                function passAlert() {
                    Swal.fire({
                        title: "Oopss!",
                        text: "Username atau Password tidak sesuai!",
                        icon: "error",
                    }).then(function() {
                        document.location.href="login";
                    });
                };
            </script>';

    echo $isWrongPass;
    echo '<p class="text-center" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: #ffffff; z-index: 1000;"></p>';
    echo '<script>passAlert();</script>';
  }
}

if (isset($_SESSION['login'])) {
  echo '
  <script>
  document.location = "../index.php"
  </script>';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Log in | Admin</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="../plugins/toastr/toastr.min.css">
  <link rel="stylesheet" href="../dist/css/select2.min.css">
  <link rel="icon" href="../dist/img/hopes.png">
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <p>Login <b>HPA</b></p>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Pengguna Harap Login</p>

        <form action="" method="post">
          <div class="input-group mb-3">
            <select name="username" id="username" class="Select2 form-control">
              <?php foreach ($akun as $data) : ?>
                <option value="<?= $data['nim'] ?>"><?= $data['nama_mahasiswa'] ?></option>
              <?php endforeach; ?>
            </select>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Password" name="pwadmin">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-8">
              <div class="icheck-primary">
                <input type="checkbox" id="remember">
                <label for="remember">
                  Remember Me
                </label>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" name="logged" class="btn btn-primary btn-block">Log In</button>
            </div>
            <!-- /.col -->
          </div>
        </form>


        <p class="mt-4 text-center">
          <i>-- Login Page --</i>
        </p>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="../plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../dist/js/adminlte.min.js"></script>
  <!-- Toastr -->
  <script src="../plugins/toastr/toastr.min.js"></script>
  <!-- Include -->
  <script src="../dist/js/select2.min.js"></script>
  <!-- SELECT2 -->
  <script>
    $(document).ready(function() {
      $('.Select2').select2({
        placeholder: 'Login Sebagai...',
        tags: true,
        width: 'resolve'
      })
    })
  </script>
  <!-- logout toastr -->
  <script>
    toastr.options = {
      "closeButton": false,
      "debug": false,
      "newestOnTop": false,
      "progressBar": true,
      "positionClass": "toast-top-right",
      "preventDuplicates": false,
      "onclick": null,
      "showDuration": "300",
      "hideDuration": "1000",
      "timeOut": "8000",
      "extendedTimeOut": "1000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut"
    };

    if (!localStorage.getItem("notifOut")) {

      toastr.info('Anda telah Logout...');

      localStorage.setItem("notifOut", "true");
    };
  </script>
  <!-- Ilangin Toastr -->
  <script>
    localStorage.removeItem("notificationShown");
  </script>
</body>

</html>