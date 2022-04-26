<?php
require_once("includes/open_connection.php");
global $connection;

if(!isset($_SESSION))
{
    session_start();
}

function show_all_titles()
{
    global $connection;
    $username = $_SESSION["username"];
    $query = "SELECT titolo, data_conseguimento, note, voto FROM titoli_esperti WHERE esperto=?";
    $statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
    mysqli_stmt_bind_param($statement, 's', $username) or die(mysqli_error($connection));
    mysqli_stmt_execute($statement) or die(mysqli_error($connection));
    mysqli_stmt_bind_result($statement, $name, $date, $notes, $grade);
    $num_rows = mysqli_stmt_num_rows($statement);
    $i = 0;
    $rows = array($num_rows);
    while (mysqli_stmt_fetch($statement)) {
        $rows[$i] = array("name" => $name, "date" => $date, "notes" => $notes, "grade" => $grade);
        $i += 1;
    }
    require_once("includes/close_connection.php");
    return $rows;
}
