<?php
require_once "../config/system.php";
checkSession();
$id_user = $_POST["id_user"];
$user_login = $_POST["user_login"];
$id_group = $_POST["id_group"];
$balance = $_POST["balance"];

$kkkkkkk = $_GET["kkkkkkk"];

$connect->actionsCart("editUserInfo", "$kkkkkkk", "", "", "");
header("Location: ../pages/profile.php");
