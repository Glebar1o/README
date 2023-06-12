<?php
$chapter = $_GET["chapter"];
$topic = $_GET["topic"];
require_once "../config/system.php";
$connect->actionsTopic("deleteTopic", $chapter, $topic, "", "", "", "");
$user = $_GET["user"] = $_SESSION["login"];
$connect->logInfo("delete_topic", $user);
header("Location: ../index.php?topic=1");