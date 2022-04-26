<?php
require_once("../includes/open_connection.php");
global $connection;

if(!isset($_SESSION))
{
    session_start();
}

if (!isset($_POST["add_process_submit"])) {
    header ("Location: ../processi.php");
}

$username = $_SESSION["username"];
$name = $_POST["name"];
$type = $_POST["type"];
$description = $_POST["description"];

$query = "SELECT * FROM processi WHERE nome=?";
$statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
mysqli_stmt_bind_param($statement, 's', $name) or die(mysqli_error($connection));
mysqli_stmt_execute($statement) or die(mysqli_error($connection));
if (mysqli_stmt_fetch($statement)) {
    echo("error register");
    header("Location: ../processi.php");
}

$query = "INSERT INTO processi(ente, nome, tipologia, descrizione)
                    VALUES (?, ?, ?, ?);";
$statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
mysqli_stmt_bind_param($statement, 'ssss', $username, $name, $type, $description) or die(mysqli_error($connection));
mysqli_stmt_execute($statement) or die(mysqli_error($connection));

require_once("../includes/close_connection.php");

header("Location: ../processi.php");
