<?php
require_once('../includes/open_connection.php');
require_once('../includes/session.php');
if (!isset($_SESSION['usertype']) or $_SESSION['usertype'] != 'esperto') {
    header ('Location: ../assegnazioni.php');
}

function accept_reject($query, $process, $username)
{
    global $connection;
    $date = date('Y-m-d');
    $statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
    mysqli_stmt_bind_param($statement, 'sss', $date, $process, $username) or die(mysqli_error($connection));
    mysqli_stmt_execute($statement) or die(mysqli_error($connection));
    mysqli_stmt_close($statement) or die(mysqli_error($connection));
}

$action = $_GET['action'];
$process = $_GET['process'];
$username = $_SESSION['username'];

if ($action == 'accept') {
    $query = 'UPDATE disponibilita SET data_assegnazione=? WHERE processo=? AND esperto=?';
}
else {
    $query = 'UPDATE disponibilita SET data_rifiuto=? WHERE processo=? AND esperto=?';
}

accept_reject($query, $process, $username);

//require_once('../includes/close_connection.php');
header('Location: ../assegnazioni.php');