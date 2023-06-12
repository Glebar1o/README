<?php
require_once "../config/system.php";
$productsd = $_GET["productsd"];
$connect->actionsCart("deleteProductByAdmin", $productsd, "", "", "", "");
header("Location: ../pages/profile.php")
;
