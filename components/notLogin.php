<?php

if (!isset($_SESSION['login'])) {
  $isNotLogin = '
<script src="../plugins/sweetalert2/sweetalert2.all.min.js"></script>
<script>
    function authAlert() {
        Swal.fire({
            title: "Oopss!",
            text: "Anda belum login!",
            icon: "error",
        }).then(function() {
            document.location.href="auth/login";
        });
    };
</script>';

  echo $isNotLogin;
  echo '<p class="text-center" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: #ffffff; z-index: 1000;"></p>';
  echo '<script>authAlert();</script>';
}
