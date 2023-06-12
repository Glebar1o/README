<?php
$chapter = $_GET["chapter"];
require_once "../config/system.php";
$connect->actionsChapter("deleteChapter", $chapter, "");
$user = $_GET["user"] = $_SESSION["login"];
$connect->logInfo("delete_chapter", $user);
header("Location: ../index.php?topic=1");
