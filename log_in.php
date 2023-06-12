<?php
  require_once "../config/system.php";
if (isset($_POST["login"]) && $_POST["password"]) {
  global $connect;
  $sql = "SELECT * FROM users WHERE user_login=:login AND user_password=:password";
  $query = $connect->getDb()->prepare($sql);
  $query->execute(array(
    "login" => $_POST["login"],
    "password" => $_POST["password"],
  ));

  if ($query->rowCount() == 1) {
    $user = $query->fetch(PDO::FETCH_ASSOC);
    saveAuth($user["id_user"]);
    header("Location: ../index.php");
  } else {
    echo "<link rel=stylesheet href=../styles/account.css /><nav class=log_in_nav><p class=reg_info>Имя пользователя или пароль введены неверно.</p></nav>";
  }
} else {
}

