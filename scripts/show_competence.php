<?php
require_once('includes/session.php');
require_once('includes/open_connection.php');

function show_all_competences($username)
{
    global $connection;
    $query = 'SELECT competenza, settore, descrizione FROM competenze_esperti WHERE esperto = ?';
    $statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
    mysqli_stmt_bind_param($statement, 's', $username) or die(mysqli_error($connection));
    mysqli_stmt_execute($statement) or die(mysqli_error($connection));
    mysqli_stmt_bind_result($statement, $name, $area, $description) or die(mysqli_error($connection));
    $num_rows = mysqli_stmt_num_rows($statement);
    $i = 0;
    $rows = array();
    while (mysqli_stmt_fetch($statement)) {
        $rows[$i] = array('name' => $name, 'area' => $area, 'description' => $description);
        $i += 1;
    }
    mysqli_stmt_close($statement) or die(mysqli_error($connection));

//    require_once('includes/close_connection.php');
    return $rows;
}