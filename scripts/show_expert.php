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
//    require_once('includes/close_connection.php');
    mysqli_free_result($result);
    return $rows;
}

function show_expert_title($username)
{
    global $connection;
    $query = 'SELECT esperto, titolo, data_conseguimento, note, voto FROM titoli_esperti WHERE esperto = ?';
    $statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
    mysqli_stmt_bind_param($statement, 's', $username) or die(mysqli_error($connection));
    mysqli_stmt_execute($statement) or die(mysqli_error($connection));
    mysqli_stmt_bind_result($statement, $username, $title, $date, $notes, $grade) or die(mysqli_error($connection));
    $num_rows = mysqli_stmt_num_rows($statement);
    $i = 0;
    $rows = array();
    while (mysqli_stmt_fetch($statement)) {
        $rows[$i] = array('username' => $username, 'title' => $title, 'date' => $date, 'notes' => $notes, 'grade' => $grade);
        $i += 1;
    }
    mysqli_stmt_close($statement) or die(mysqli_error($connection));
//    require_once('includes/close_connection.php');
    return $rows;
}

function show_expert_competence($username)
{
    global $connection;
    $query = 'SELECT esperto, competenza, settore, descrizione FROM competenze_esperti WHERE esperto = ?';
    $statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
    mysqli_stmt_bind_param($statement, 's', $username) or die(mysqli_error($connection));
    mysqli_stmt_execute($statement) or die(mysqli_error($connection));
    mysqli_stmt_bind_result($statement, $username, $competence, $area, $description) or die(mysqli_error($connection));
    $num_rows = mysqli_stmt_num_rows($statement);
    $i = 0;
    $rows = array();
    while (mysqli_stmt_fetch($statement)) {
        $rows[$i] = array('username' => $username, 'competence' => $competence, 'area' => $area, 'description' => $description);
        $i += 1;
    }
    mysqli_stmt_free_result($statement);
    mysqli_stmt_close($statement) or die(mysqli_error($connection));
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
