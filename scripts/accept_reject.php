<?php
require_once("../includes/open_connection.php");
global $connection;
if (!isset($_SESSION))
{
    session_start();
}
if (!isset($_SESSION["usertype"]) or $_SESSION["usertype"] != "esperto") {
    header ("Location: ../assegnazioni.php");
}

function accept()
{
    global $connection;
    $date = date("Y-m-d");
    $query = 'UPDATE disponibilita SET data_assegnazione=$date WHERE processo=? AND esperto=?';
    $statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
    mysqli_stmt_bind_param($statement, 'ss', $process, $username) or die(mysqli_error($connection));
    mysqli_stmt_execute($statement) or die(mysqli_error($connection));
    mysqli_stmt_close($statement) or die(mysqli_error($connection));
}

function reject()
{
    global $connection;
    $date = date("Y-m-d");
    $query = 'UPDATE disponibilita SET data_rifiuto=$date WHERE processo=? AND esperto=?';
    $statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
    mysqli_stmt_bind_param($statement, 'ss', $process, $username) or die(mysqli_error($connection));
    mysqli_stmt_execute($statement) or die(mysqli_error($connection));
    mysqli_stmt_close($statement) or die(mysqli_error($connection));
}

//require_once("../includes/close_connection.php");
header("Location: ../assegnazioni.php");