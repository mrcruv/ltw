<?php
require_once("includes/open_connection.php");

if (!isset($_SESSION)) {
    session_start();
}

function show_all_processes() {
    global $connection;
    $username = $_SESSION["username"];
    $query = "SELECT nome, tipologia, descrizione FROM processi WHERE ente=?";
    $statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
    mysqli_stmt_bind_param($statement, 's', $username) or die(mysqli_error($connection));
    mysqli_stmt_execute($statement) or die(mysqli_error($connection));
    mysqli_stmt_bind_result($statement, $name, $type, $description);
    $num_rows = mysqli_stmt_num_rows($statement);
    $i = 0;
    $rows = array();
    while (mysqli_stmt_fetch($statement)) {
        $rows[$i] = array("name" => $name, "type" => $type, "description" => $description);
        $i += 1;
    }
//    require_once("includes/close_connection.php");
    return $rows;
}
