<?php
require_once "../config/system.php";
$connect->actionsCart("addKeyAdmin", "", "");
$user = $_GET["user"] = $_SESSION["login"];
header("Location: ../pages/profile.php");
