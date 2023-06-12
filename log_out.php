<?php
require_once "../config/system.php";
$user = $_GET["user"] = $_SESSION["login"];
$connect->logInfo("log_out", $user);

unset($_SESSION['id']);

session_unset();
session_destroy();
header("Location: ../index.php");