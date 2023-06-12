<?php
require_once "../config/system.php";
$chapter = $_GET["chapter"];
$topic = $_GET["topic"];
$answer = $_GET["answer"];
$connect->actionsAnswer("deleteAnswer", $chapter, $topic, $answer, "", "", "", "");
$user = $_GET["user"] = $_SESSION["login"];
$connect->logInfo("delete_answer", $user);
header("Location: ../index.php?topic=1");
