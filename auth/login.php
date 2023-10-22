<?php
session_start();
require "../config/config.php";

if (isset($_POST['logged'])) {
  $username = $_POST['username'];
  $pwadmin = $_POST['pwadmin'];

  $result = mysqli_query($conn, "SELECT * FROM admin WHERE username = '$username'");
  if (mysqli_num_rows($result) === 1) {
    $row = mysqli_fetch_assoc($result);
    if ($pwadmin == $row['password']) {
      $_SESSION["login"] = true;
      $_SESSION["username"] = ucfirst($row['username']);

      echo "
            <script>
            document.location.href ='../index.php'
            </script>
            ";
    } else {
      echo "
      <script>
      alert('Password Salah')
      document.location.href = '../index.php'
      </script>
      ";
    }
  } else {
    echo "
    <script>    
    alert('Akun tidak Ada!');
    document.location.href ='login.php'
    </script>
    ";
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
            <input type="text" class="form-control" placeholder="Username" name="username">
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