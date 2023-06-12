<?php
  require_once "../config/system.php";
if (isset($_POST["login"]) && isset($_POST["password"]) && isset($_POST["description"]) && isset($_POST["gender"])) :
  $connect->regUser();
  header("Location: ../pages/log_in.html");
else :
?>
<?php endif; ?>