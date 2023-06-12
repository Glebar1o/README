<?php
require_once "../config/system.php";
$id = $_GET["id"];
$sql = "SELECT * FROM topics WHERE id_topic = :id_topic";
$info = $connect->getTopinfo($sql, $id);
header("Location: ../index.php?id=$id");
