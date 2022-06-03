<?php
require_once('includes/open_connection.php');
require_once('includes/session.php');

function show_all_experts()
{
    global $connection;
    $query = 'SELECT username, nome, cognome, citta_nascita, data_nascita, sito_web, pec FROM esperti NATURAL JOIN utenti';
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
    $rows = array();
    $num_rows = mysqli_num_rows($result);
    $i = 0;
    while ($row = mysqli_fetch_row($result)) {
        $rows[$i] = array('username' => $row[0], 'name' => $row[1], 'surname' => $row[2],
            'city' => $row[3], 'date' => $row[4], 'website' => $row[5], 'pec' => $row[6]);
        $i += 1;
    }
    mysqli_free_result($result);
//    require_once('includes/close_connection.php');
    return $rows;
}

function expert_exists($username)
{
    global $connection;
    $query = 'SELECT * FROM esperti WHERE username = ?';
    $statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
    mysqli_stmt_bind_param($statement, 's', $username) or die(mysqli_error($connection));
    mysqli_stmt_execute($statement) or die(mysqli_error($connection));
    $exists = mysqli_stmt_fetch($statement);
    mysqli_stmt_free_result($statement);
    mysqli_stmt_close($statement) or die(mysqli_error($connection));
//    require_once('includes/close_connection.php');
    return $exists;
}
