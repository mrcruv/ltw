<?php
require_once("includes/open_connection.php");

if(!isset($_SESSION))
{
    session_start();
}

function show_all_availabilities_expert()
{
    global $connection;
    $username = $_SESSION["username"];
    $query = "SELECT processo, ente, data_richiesta, data_assegnazione, data_rifiuto FROM disponibilita WHERE esperto=?";
    $statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
    mysqli_stmt_bind_param($statement, 's', $username) or die(mysqli_error($connection));
    mysqli_stmt_execute($statement) or die(mysqli_error($connection));
    mysqli_stmt_bind_result($statement, $process, $entity, $request_date, $allocation_date, $rejection_date);
    $num_rows = mysqli_stmt_num_rows($statement);
    $i = 0;
    $rows = array();
    while (mysqli_stmt_fetch($statement)) {
        $rows[$i] = array("process" => $process, "entity" => $entity, "request_date" => $request_date,
            "allocation_date" => $allocation_date, "rejection_date" => $rejection_date);
        $i += 1;
    }
//    require_once("includes/close_connection.php");
    return $rows;
}

function show_all_availabilities_entity()
{
    global $connection;
    $username = $_SESSION["username"];
    $query = "SELECT processo, esperto, data_richiesta, data_assegnazione, data_rifiuto FROM disponibilita WHERE ente=?";
    $statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
    mysqli_stmt_bind_param($statement, 's', $username) or die(mysqli_error($connection));
    mysqli_stmt_execute($statement) or die(mysqli_error($connection));
    mysqli_stmt_bind_result($statement, $process, $expert, $request_date, $allocation_date, $rejection_date);
    $num_rows = mysqli_stmt_num_rows($statement);
    $i = 0;
    $rows = array();
    while (mysqli_stmt_fetch($statement)) {
        $rows[$i] = array("process" => $process, "expert" => $expert, "request_date" => $request_date,
            "allocation_date" => $allocation_date, "rejection_date" => $rejection_date);
        $i += 1;
    }
//    require_once("includes/close_connection.php");
    return $rows;
}