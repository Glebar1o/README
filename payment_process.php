<?php
require_once "../config/system.php";
checkSession();
$cur_id = $_GET["id_user"] = $_SESSION["id"];
$fio = $_POST["fio"];
$email = $_POST["email"];
$role = $_POST["role"];
$id_product = $_POST["id_product"];
$connect->actionsCart("addOrder", "", "", "", "", $cur_id);
$cartbtn = $_GET["cartbtn"] = $_POST["id_product"];
$connect->actionsCart("deleteCartItem", $cur_id, $cartbtn, "", "", "", "");
$connect->actionsCart("addOrderMessage", "", "", "", "", $cur_id);
$connect->actionsCart("editKeyStatus", "", "", "", "", $cur_id);
$itogbalance = $_POST["itogbalance"];
$connect->actionsCart("updateBalancePay", "", $cur_id);
header("Location: ../pages/cart.php");
