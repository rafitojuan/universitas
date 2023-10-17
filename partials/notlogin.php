<script>
  localStorage.setItem("notifOut", "true");
</script>

<?php
if (!isset($_SESSION['login'])) {
  echo '
  <script>
  alert("Harap Login Terlebih dahulu")
  document.location.href = "../auth/login.php"
  </script>';
}
