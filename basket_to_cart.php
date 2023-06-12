<?php
require_once "../config/system.php";
$cur_id = $_GET["id_user"] = $_SESSION["id"];
$cartbtn = $_GET["cartbtn"];
$connect->actionsCart("deleteBasketItem", $cur_id, $cartbtn, "", "", "", "");
$productpage =  $_GET["cartbtn"];
$connect->actionsCart("addCart", $productpage, $cur_id, $cartbtn);
header("Location: ../pages/basket.php")
;
