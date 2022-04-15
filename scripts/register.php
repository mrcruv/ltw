<?php
require_once("../includes/open_connection.php");
global $connection;

if (!isset($_POST["register_submit"])) {
    header ("Location: ../index.php");
}

$username = $_POST["username"];
$password = $_POST["password"];
$cf = $_POST["cf"];
$pec = $_POST["pec"];
$piva = $_POST["piva"];
$website = $_POST["website"];
$accept_conditions = $_POST["accept_conditions"];
$name = $_POST["name"];
$type = $_POST["type"];
$hash = password_hash($password, PASSWORD_BCRYPT);

$query = "SELECT * FROM utenti WHERE username=? OR pec=? OR cf=? OR piva=?";
$statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
mysqli_stmt_bind_param($statement, 'ssss', $username, $pec, $cf, $piva) or die(mysqli_error($connection));
mysqli_stmt_execute($statement) or die(mysqli_error($connection));
if (mysqli_stmt_fetch($statement)) {
    echo("error register");
    header("Location: ../index.php");
}

$query = "INSERT INTO utenti(username, password, pec, cf, piva, sito_web)
                    VALUES (?, ?, ?, ?, ?, ?);";
$statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
mysqli_stmt_bind_param($statement, 'ssssss', $username, $hash, $pec, $cf, $piva, $website) or die(mysqli_error($connection));
mysqli_stmt_execute($statement) or die(mysqli_error($connection));

$query = "INSERT INTO enti(username, denominazione, tipo)
                    VALUES (?, ?, ?);";
$statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
mysqli_stmt_bind_param($statement, 'sss', $username, $name, $type) or die(mysqli_error($connection));
mysqli_stmt_execute($statement) or die(mysqli_error($connection));

require_once("../includes/close_connection.php");

header("Location: ../index.php");
