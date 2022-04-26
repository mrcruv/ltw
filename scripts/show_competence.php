<?php
require_once("includes/open_connection.php");
global $connection;

if(!isset($_SESSION))
{
    session_start();
}

function show_all_competences()
{
    global $connection;
    $username = $_SESSION["username"];
    $query = "SELECT competenza, settore, descrizione FROM competenze_esperti JOIN competenze ON competenze_esperti.competenza = competenze.nome WHERE esperto=?";
    $statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
    mysqli_stmt_bind_param($statement, 's', $username) or die(mysqli_error($connection));
    mysqli_stmt_execute($statement) or die(mysqli_error($connection));
    mysqli_stmt_bind_result($statement, $name, $area, $description);
    $num_rows = mysqli_stmt_num_rows($statement);
    $i = 0;
    $rows = array();
    while (mysqli_stmt_fetch($statement)) {
        $rows[$i] = array("name" => $name, "area" => $area, "description" => $description);
        $i += 1;
    }
//    require_once("includes/close_connection.php");
    return $rows;
}