<?php
require_once("../includes/open_connection.php");
global $connection;

if(!isset($_SESSION))
{
    session_start();
}

if (!isset($_POST["add_title_submit"])) {
    header ("Location: ../titoli.php");
}

$username = $_SESSION["username"];
$name = $_POST["name"];
$date = $_POST["date"];
$notes = $_POST["notes"];
$grade = $_POST["grade"];

$query = "SELECT * FROM titoli WHERE denominazione=?";
$statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
mysqli_stmt_bind_param($statement, 's', $name) or die(mysqli_error($connection));
mysqli_stmt_execute($statement) or die(mysqli_error($connection));
if (!mysqli_stmt_fetch($statement)) {
    $query = "INSERT INTO titoli(denominazione)
                    VALUES (?);";
    $statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
    mysqli_stmt_bind_param($statement, 's', $name) or die(mysqli_error($connection));
    mysqli_stmt_execute($statement) or die(mysqli_error($connection));
}

$query = "INSERT INTO titoli_esperti(esperto, titolo, data_conseguimento, note, voto)
                    VALUES (?, ?, ?, ?, ?);";
$statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
mysqli_stmt_bind_param($statement, 'sssss', $username, $name, $date, $notes, $grade) or die(mysqli_error($connection));
mysqli_stmt_execute($statement) or die(mysqli_error($connection));

require_once("../includes/close_connection.php");

header("Location: ../titoli.php");
