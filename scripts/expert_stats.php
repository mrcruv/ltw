<?php
require_once('includes/session.php');
require_once('includes/open_connection.php');

function n_title($username)
{
    global $connection;
    $n = 0;
    $query = 'SELECT COUNT(*) AS n FROM titoli_esperti WHERE esperto = ?';
    $statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
    mysqli_stmt_bind_param($statement, 's', $username) or die(mysqli_error($connection));
    mysqli_stmt_execute($statement) or die(mysqli_error($connection));
    mysqli_stmt_bind_result($statement, $n) or die(mysqli_error($connection));
    if (!mysqli_stmt_fetch($statement)) {
        mysqli_stmt_close($statement) or die(mysqli_error($connection));
        return -1;
    }
    mysqli_stmt_close($statement) or die(mysqli_error($connection));
//    require_once('includes/close_connection.php');
    return $n;
}

function n_competence($username)
{
    global $connection;
    $n = 0;
    $query = 'SELECT COUNT(*) AS n FROM competenze_esperti WHERE esperto = ?';
    $statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
    mysqli_stmt_bind_param($statement, 's', $username) or die(mysqli_error($connection));
    mysqli_stmt_execute($statement) or die(mysqli_error($connection));
    mysqli_stmt_bind_result($statement, $n) or die(mysqli_error($connection));
    if (!mysqli_stmt_fetch($statement)) {
        mysqli_stmt_close($statement) or die(mysqli_error($connection));
        return -1;
    }
    mysqli_stmt_close($statement) or die(mysqli_error($connection));
//    require_once('includes/close_connection.php');
    return $n;
}

function n_accepted_from_expert($username)
{
    global $connection;
    $n = 0;
    $query = 'SELECT COUNT(*) AS n FROM disponibilita WHERE esperto = ? AND data_assegnazione IS NOT NULL';
    $statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
    mysqli_stmt_bind_param($statement, 's', $username) or die(mysqli_error($connection));
    mysqli_stmt_execute($statement) or die(mysqli_error($connection));
    mysqli_stmt_bind_result($statement, $n) or die(mysqli_error($connection));
    if (!mysqli_stmt_fetch($statement)) {
        mysqli_stmt_close($statement) or die(mysqli_error($connection));
        return -1;
    }
    mysqli_stmt_close($statement) or die(mysqli_error($connection));
//    require_once('includes/close_connection.php');
    return $n;
}

function n_rejected_from_expert($username)
{
    global $connection;
    $n = 0;
    $query = 'SELECT COUNT(*) AS n FROM disponibilita WHERE esperto = ? AND data_rifiuto IS NOT NULL';
    $statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
    mysqli_stmt_bind_param($statement, 's', $username) or die(mysqli_error($connection));
    mysqli_stmt_execute($statement) or die(mysqli_error($connection));
    mysqli_stmt_bind_result($statement, $n) or die(mysqli_error($connection));
    if (!mysqli_stmt_fetch($statement)) {
        mysqli_stmt_close($statement) or die(mysqli_error($connection));
        return -1;
    }
    mysqli_stmt_close($statement) or die(mysqli_error($connection));
//    require_once('includes/close_connection.php');
    return $n;
}

function n_dangling_from_expert($username)
{
    global $connection;
    $n = 0;
    $query = 'SELECT COUNT(*) AS n FROM disponibilita WHERE esperto = ? AND data_assegnazione IS NULL AND data_rifiuto IS NULL';
    $statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
    mysqli_stmt_bind_param($statement, 's', $username) or die(mysqli_error($connection));
    mysqli_stmt_execute($statement) or die(mysqli_error($connection));
    mysqli_stmt_bind_result($statement, $n) or die(mysqli_error($connection));
    if (!mysqli_stmt_fetch($statement)) {
        mysqli_stmt_close($statement) or die(mysqli_error($connection));
        return -1;
    }
    mysqli_stmt_close($statement) or die(mysqli_error($connection));
//    require_once('includes/close_connection.php');
    return $n;
}

function n_availability_from_expert($username)
{
    global $connection;
    $n = 0;
    $query = 'SELECT COUNT(*) AS n FROM disponibilita WHERE esperto = ?';
    $statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
    mysqli_stmt_bind_param($statement, 's', $username) or die(mysqli_error($connection));
    mysqli_stmt_execute($statement) or die(mysqli_error($connection));
    mysqli_stmt_bind_result($statement, $n) or die(mysqli_error($connection));
    if (!mysqli_stmt_fetch($statement)) {
        mysqli_stmt_close($statement) or die(mysqli_error($connection));
        return -1;
    }
    mysqli_stmt_close($statement) or die(mysqli_error($connection));
//    require_once('includes/close_connection.php');
    return $n;
}