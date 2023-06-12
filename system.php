<?php
require_once "database.php";
$connect = new Database("conf");
$connect->getDb();
session_start();


function saveAuth($id)
{
    global $connect;
    $_SESSION["id"] = $id;
    $sql = "SELECT id_user, user_login, user_gender, user_description, group_name, group_rules, user_datetime FROM users JOIN authorizkey.groups WHERE users.id_group = groups.id_group AND id_user = :id";
    $query = $connect->getDb()->prepare($sql);
    $query->execute(array("id" => $id));
    $user = $query->fetch(PDO::FETCH_ASSOC);
    $_SESSION["login"] = $user["user_login"];
    $_SESSION["gender"] = $user["user_gender"];
    $_SESSION["description"] = $user["user_description"];
    $_SESSION["status"] = $user["group_name"];
    $_SESSION["rule"] = $user["group_rules"];
    $_SESSION["time"] = $user["user_datetime"];
    $user = $_GET["user"] = $_SESSION["login"];
    $connect->logInfo("log_in", $user);
}


function checkRule()
{
    global $connect;
    if (isset($_SESSION["id"]) && isset($_SESSION["rule"]) && isset($_SESSION["login"])) {
        $sql = "SELECT id_user, group_rules FROM users JOIN authorizkey.groups WHERE users.id_group = groups.id_group AND id_user = :id";
        $query = $connect->getDb()->prepare($sql);
        $query->execute(array("id" => $_SESSION["id"]));
        $user = $query->fetch(PDO::FETCH_ASSOC);
        if ($_SESSION["rule"] == $user["group_rules"]) {
            return $_SESSION["rule"];
        } else {
            $_SESSION["rule"] == $user["group_rules"];
            return $user["group_rules"];
        }
    } else {
        return 25;
    }
}

function guestSession() {
    if(!isset($_SESSION["id"])) {
        $_SESSION["id"] = NULL;
        $_SESSION["login"] = NULL;
        $_SESSION["gender"] = NULL;
        $_SESSION["description"] = NULL;
        $_SESSION["status"] = NULL;
        $_SESSION["rule"] = NULL;
        $_SESSION["time"] = NULL;
        $_SESSION["login"] = NULL;
    }
}

function checkSession() {
    if(!isset($_SESSION["id"])) {
        header("Location: ../index.php");
    }
}

function checkTab() {
    if(!isset($_GET["topic"])) {
        $_GET["topic"] = 1;
    }
}

function checkTa() {
    if(!isset($_GET["ds"])) {
        $_GET["ds"] = 1;
    }
}

function checkT() {
    if(!isset($_GET["bb"])) {
        $_GET["bb"] = 1;
    }
}