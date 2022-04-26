<?php
require_once("../includes/open_connection.php");
global $connection;
if (!isset($_POST["update_password_submit"])) {
    header ("Location: ../me.php");
}

$username = $_POST["username"];
$password = $_POST["password"];
$cf = $_POST["cf"];
$pec = $_POST["pec"];
$piva = $_POST["piva"];

$query = "SELECT * FROM utenti WHERE username=? OR pec=? OR cf=? OR piva=?";
$statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
mysqli_stmt_bind_param($statement, 'ssss', $username, $pec, $cf, $piva) or die(mysqli_error($connection));
mysqli_stmt_execute($statement) or die(mysqli_error($connection));
if (mysqli_stmt_fetch($statement)) {
    mysqli_stmt_close($statement) or die(mysqli_error($connection));
    header("Location: ../index.php");
}
mysqli_stmt_close($statement) or die(mysqli_error($connection));

$website = $_POST["website"];
$accept_conditions = $_POST["accept_conditions"];
$hash = password_hash($password, PASSWORD_BCRYPT);

$query = "INSERT INTO utenti(username, password, pec, cf, piva, sito_web)
                VALUES (?, ?, ?, ?, ?, ?)";
$statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
mysqli_stmt_bind_param($statement, 'ssssss', $username, $hash, $pec, $cf, $piva, $website) or die(mysqli_error($connection));
mysqli_stmt_execute($statement) or die(mysqli_error($connection));
mysqli_stmt_close($statement) or die(mysqli_error($connection));

if(isset($_POST['register_box'])){
    $company_name = $_POST["entity_name"];
    $type = $_POST["type"];

    $query = "INSERT INTO enti(username, denominazione, tipo)
                    VALUES (?, ?, ?)";
    $statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
    mysqli_stmt_bind_param($statement, 'sss', $username, $company_name, $type) or die(mysqli_error($connection));
    mysqli_stmt_execute($statement) or die(mysqli_error($connection));
    mysqli_stmt_close($statement) or die(mysqli_error($connection));
}
else {
    $name = $_POST["name"];
    $surname = $_POST["surname"];
    $city = $_POST["city"];
    $date = $_POST["date"];

    $query = "INSERT INTO esperti(username, nome, cognome, citta_nascita, data_nascita)
                    VALUES (?, ?, ?, ?, ?)";
    $statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
    mysqli_stmt_bind_param($statement, 'sssss', $username, $name, $surname, $city, $date) or die(mysqli_error($connection));
    mysqli_stmt_execute($statement) or die(mysqli_error($connection));
    mysqli_stmt_close($statement) or die(mysqli_error($connection));
}

//require_once("../includes/close_connection.php");
header("Location: ../index.php");
