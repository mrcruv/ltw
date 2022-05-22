<?php
require_once('includes/open_connection.php');
require_once('includes/session.php');

function show_all_availabilities_from_expert($expert_username)
{
    global $connection;
    $query = 'SELECT processo, descrizione, tipologia, disponibilita.ente, data_richiesta, data_assegnazione, data_rifiuto, data_conclusione
    FROM disponibilita JOIN processi ON
    disponibilita.processo = processi.nome WHERE esperto=?';
    $statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
    mysqli_stmt_bind_param($statement, 's', $expert_username) or die(mysqli_error($connection));
    mysqli_stmt_execute($statement) or die(mysqli_error($connection));
    mysqli_stmt_bind_result($statement, $process, $description, $type, $entity, $request_date, $allocation_date, $rejection_date, $conclusion_date) or die(mysqli_error($connection));
    $num_rows = mysqli_stmt_num_rows($statement);
    $i = 0;
    $rows = array();
    while (mysqli_stmt_fetch($statement)) {
        $rows[$i] = array('process' => $process, 'description' => $description, 'type' => $type, 'entity' => $entity, 'request_date' => $request_date,
            'allocation_date' => $allocation_date, 'rejection_date' => $rejection_date, 'conclusion_date' => $conclusion_date);
        $i += 1;
    }
    mysqli_stmt_free_result($statement);
    mysqli_stmt_close($statement) or die(mysqli_error($connection));
//    require_once('includes/close_connection.php');
    return $rows;
}

function show_all_availabilities_from_entity($entity_username)
{
    global $connection;
    $query = 'SELECT processo, descrizione, tipologia, esperto, data_richiesta, data_assegnazione, data_rifiuto, data_conclusione
    FROM disponibilita JOIN processi ON
    disponibilita.processo = processi.nome WHERE disponibilita.ente=?';
    $statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
    mysqli_stmt_bind_param($statement, 's', $entity_username) or die(mysqli_error($connection));
    mysqli_stmt_execute($statement) or die(mysqli_error($connection));
    mysqli_stmt_bind_result($statement, $process, $description, $type, $expert, $request_date, $allocation_date, $rejection_date, $conclusion_date) or die(mysqli_error($connection));
    $num_rows = mysqli_stmt_num_rows($statement);
    $i = 0;
    $rows = array();
    while (mysqli_stmt_fetch($statement)) {
        $rows[$i] = array('process' => $process, 'description' => $description, 'type' => $type, 'expert' => $expert, 'request_date' => $request_date,
            'allocation_date' => $allocation_date, 'rejection_date' => $rejection_date, 'conclusion_date' => $conclusion_date);
        $i += 1;
    }
    mysqli_stmt_free_result($statement);
    mysqli_stmt_close($statement) or die(mysqli_error($connection));
//    require_once('includes/close_connection.php');
    return $rows;
}