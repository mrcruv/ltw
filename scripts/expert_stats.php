<?php
require_once('includes/session.php');
require_once('includes/open_connection.php');
if (!isset($_SESSION['usertype']) or $_SESSION['usertype'] != 'esperto') {
    header ('Location: ../me.php?err=sessione+utente+esperto+non+attiva');
    die('sessione utente esperto non attiva');
}

$username = $_SESSION['username'];

function n_title()
{
    global $connection, $username;
    $query = 'SELECT COUNT(*) FROM titoli_esperti WHERE esperto = ?';
    $statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
    mysqli_stmt_bind_param($statement, 's', $username) or die(mysqli_error($connection));
    mysqli_stmt_execute($statement) or die(mysqli_error($connection));
    mysqli_stmt_bind_result($statement, $n) or die(mysqli_error($connection));
    mysqli_stmt_free_result($statement);
    mysqli_stmt_close($statement) or die(mysqli_error($connection));
//    require_once('includes/close_connection.php');
    return $n;
}

function n_competence()
{
    global $connection, $username;
    $query = 'SELECT COUNT(*) FROM competenze_esperti WHERE esperto = ?';
    $statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
    mysqli_stmt_bind_param($statement, 's', $username) or die(mysqli_error($connection));
    mysqli_stmt_execute($statement) or die(mysqli_error($connection));
    mysqli_stmt_bind_result($statement, $n) or die(mysqli_error($connection));
    mysqli_stmt_free_result($statement);
    mysqli_stmt_close($statement) or die(mysqli_error($connection));
//    require_once('includes/close_connection.php');
    return $n;
}

function n_accepted()
{
    global $connection, $username;
    $query = 'SELECT COUNT(*) FROM disponibilita WHERE esperto = ? AND data_assegnazione IS NOT NULL';
    $statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
    mysqli_stmt_bind_param($statement, 's', $username) or die(mysqli_error($connection));
    mysqli_stmt_execute($statement) or die(mysqli_error($connection));
    mysqli_stmt_bind_result($statement, $n) or die(mysqli_error($connection));
    mysqli_stmt_free_result($statement);
    mysqli_stmt_close($statement) or die(mysqli_error($connection));
//    require_once('includes/close_connection.php');
    return $n;
}

function n_rejected()
{
    global $connection, $username;
    $query = 'SELECT COUNT(*) FROM disponibilita WHERE esperto = ? AND data_rifiuto IS NOT NULL';
    $statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
    mysqli_stmt_bind_param($statement, 's', $username) or die(mysqli_error($connection));
    mysqli_stmt_execute($statement) or die(mysqli_error($connection));
    mysqli_stmt_bind_result($statement, $n) or die(mysqli_error($connection));
    mysqli_stmt_free_result($statement);
    mysqli_stmt_close($statement) or die(mysqli_error($connection));
//    require_once('includes/close_connection.php');
    return $n;
}

function n_dangling()
{
    global $connection, $username;
    $query = 'SELECT COUNT(*) FROM disponibilita WHERE esperto = ? AND data_assegnazione IS NULL AND data_rifiuto IS NULL';
    $statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
    mysqli_stmt_bind_param($statement, 's', $username) or die(mysqli_error($connection));
    mysqli_stmt_execute($statement) or die(mysqli_error($connection));
    mysqli_stmt_bind_result($statement, $n) or die(mysqli_error($connection));
    mysqli_stmt_free_result($statement);
    mysqli_stmt_close($statement) or die(mysqli_error($connection));
//    require_once('includes/close_connection.php');
    return $n;
}

function n_availability()
{
    global $connection, $username;
    $query = 'SELECT COUNT(*) FROM disponibilita WHERE esperto = ?';
    $statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
    mysqli_stmt_bind_param($statement, 's', $username) or die(mysqli_error($connection));
    mysqli_stmt_execute($statement) or die(mysqli_error($connection));
    mysqli_stmt_bind_result($statement, $n) or die(mysqli_error($connection));
    mysqli_stmt_free_result($statement);
    mysqli_stmt_close($statement) or die(mysqli_error($connection));
//    require_once('includes/close_connection.php');
    return $n;
}