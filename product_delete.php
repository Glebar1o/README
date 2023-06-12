<?php
require_once "../config/system.php";
$cartbtn = $_GET["cartbtn"];
$connect->actionsCart("deleteCartItem", $cur_id, $cartbtn, "", "", "", "");
header("Location: ../pages/cart.php")
;
