<?php
require_once('includes/open_connection.php');
require_once('includes/session.php');

function show_all_processes($username)
{
    global $connection;
    $query = 'SELECT nome, tipologia, descrizione FROM processi WHERE ente=?';
    $statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
    mysqli_stmt_bind_param($statement, 's', $username) or die(mysqli_error($connection));
    mysqli_stmt_execute($statement) or die(mysqli_error($connection));
    mysqli_stmt_bind_result($statement, $name, $type, $description) or die(mysqli_error($connection));
    $num_rows = mysqli_stmt_num_rows($statement);
    $i = 0;
    $rows = array();
    while (mysqli_stmt_fetch($statement)) {
        $rows[$i] = array('name' => $name, 'type' => $type, 'description' => $description);
        $i += 1;
    }
    mysqli_stmt_free_result($statement);
    mysqli_stmt_close($statement) or die(mysqli_error($connection));
//    require_once('includes/close_connection.php');
    return $rows;
}
