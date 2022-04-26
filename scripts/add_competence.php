<?php
require_once("../includes/open_connection.php");
global $connection;
if (!isset($_SESSION))
{
    session_start();
}
if (!isset($_POST["add_competence_submit"])) {
    header ("Location: ../competenze.php");
}

$username = $_SESSION["username"];
$name = $_POST["name"];
$area = $_POST["area"];
$description = $_POST["description"];

$query = "SELECT * FROM competenze WHERE nome=?";
$statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
mysqli_stmt_bind_param($statement, 's', $name) or die(mysqli_error($connection));
mysqli_stmt_execute($statement) or die(mysqli_error($connection));
if (!mysqli_stmt_fetch($statement)) {
    mysqli_stmt_close($statement) or die(mysqli_error($connection));
    $query = "INSERT INTO competenze(nome, settore) VALUES (?, ?);";
    $statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
    mysqli_stmt_bind_param($statement, 'ss', $name, $area) or die(mysqli_error($connection));
    mysqli_stmt_execute($statement) or die(mysqli_error($connection));
}
mysqli_stmt_close($statement) or die(mysqli_error($connection));

$query = "SELECT * FROM competenze_esperti WHERE competenza=?";
$statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
mysqli_stmt_bind_param($statement, 's', $name) or die(mysqli_error($connection));
mysqli_stmt_execute($statement) or die(mysqli_error($connection));
if (mysqli_stmt_fetch($statement)) {
    mysqli_stmt_close($statement) or die(mysqli_error($connection));
    header("Location: ../competenze.php");
}
mysqli_stmt_close($statement) or die(mysqli_error($connection));

$query = "INSERT INTO competenze_esperti(esperto, competenza, descrizione) VALUES (?, ?, ?);";
$statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
mysqli_stmt_bind_param($statement, 'sss', $username, $name, $description) or die(mysqli_error($connection));
mysqli_stmt_execute($statement) or die(mysqli_error($connection));
mysqli_stmt_close($statement) or die(mysqli_error($connection));

//require_once("../includes/close_connection.php");
header("Location: ../competenze.php");
