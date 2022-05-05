<?php
require_once('includes/open_connection.php');
require_once('includes/session.php');

function show_all_experts()
{
    global $connection;
    $query = 'SELECT username, nome, cognome, citta_nascita, data_nascita FROM esperti';
    $result =  mysqli_query($connection, $query);
    $rows = array();
    $num_rows = mysqli_num_rows($result);
    $i = 0;
    while ($row = mysqli_fetch_row($result)) {
        $rows[$i] = array('username' => $row['0'], 'name' => $row['1'], 'surname' => $row['2'],
            'city' => $row['3'], 'date' => $row['4']);
        $i += 1;
    }
//    require_once('includes/close_connection.php');
    return $rows;
}
