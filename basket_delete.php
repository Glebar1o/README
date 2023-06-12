<?php
require_once "../config/system.php";
$cartbtn = $_GET["cartbtn"];
$connect->actionsCart("deleteBasketItem", $cur_id, $cartbtn, "", "", "", "");
header("Location: ../pages/basket.php")
;
