<?php
global $connection;
require_once('../includes/open_connection.php');
require_once('../includes/session.php');
if (!isset($_SESSION['usertype']) or $_SESSION['usertype'] != 'esperto') {
    header('Location: ../assegnazioni.php?err=sessione+utente+esperto+non+attiva');
    die('sessione utente esperto non attiva');
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

$username = $_SESSION['username'];
$action = isset($_GET['action']) ? trim($_GET['action']) : false;
$process = isset($_GET['process']) ? trim($_GET['process']) : false;

if (empty($process)) {
    header('Location: ../assegnazioni.php?err=processo+non+inserito');
    die('processo non inserito');
}
if (empty($username)) {
    header('Location: ../assegnazioni.php?err=esperto+non+inserito');
    die('esperto non inserito');
}

$query = 'SELECT * FROM processi WHERE nome = ?';
$statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
mysqli_stmt_bind_param($statement, 's', $process) or die(mysqli_error($connection));
mysqli_stmt_execute($statement) or die(mysqli_error($connection));
if (!mysqli_stmt_fetch($statement)) {
    mysqli_stmt_close($statement) or die(mysqli_error($connection));
    header('Location: ../assegnazioni.php?err=processo+non+esistente');
    die('processo non esistente');
}
mysqli_stmt_close($statement) or die(mysqli_error($connection));

$query = 'SELECT * FROM esperti WHERE username = ?';
$statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
mysqli_stmt_bind_param($statement, 's', $username) or die(mysqli_error($connection));
mysqli_stmt_execute($statement) or die(mysqli_error($connection));

if (!mysqli_stmt_fetch($statement)) {
    mysqli_stmt_close($statement) or die(mysqli_error($connection));
    header('Location: ../assegnazioni.php?err=esperto+non+esistente');
    die('esperto non esistente');
}
mysqli_stmt_close($statement) or die(mysqli_error($connection));

$query = 'SELECT data_assegnazione, data_rifiuto FROM assegnazioni WHERE processo = ? AND esperto = ?';
$statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
mysqli_stmt_bind_param($statement, 'ss', $process, $username) or die(mysqli_error($connection));
mysqli_stmt_execute($statement) or die(mysqli_error($connection));
mysqli_stmt_bind_result($statement, $allocation_date, $rejection_date) or die(mysqli_error($connection));
if (!mysqli_stmt_fetch($statement)) {
    mysqli_stmt_close($statement) or die(mysqli_error($connection));
    header('Location: ../assegnazioni.php?err=assegnazione+non+esistente');
    die('assegnazione non esistente');
} else {
    if (!is_null($allocation_date)) {
        header('Location: ../assegnazioni.php?err=assegnazione+gia+accettata+in+data+' . $allocation_date);
        die('assegnazione gia accettata in data ' . $allocation_date);
    }
    if (!is_null($rejection_date)) {
        header('Location: ../assegnazioni.php?err=assegnazione+gia+rifiutata+in+data+' . $rejection_date);
        die('assegnazione gia rifiutata in data ' . $rejection_date);
    }
    mysqli_stmt_close($statement) or die(mysqli_error($connection));
}

if (empty($action)) {
    header('Location: ../assegnazioni.php?err=operazione+non+inserita');
    die('azione non inserita');
} else if ($action == 'accept') {
    $query = 'UPDATE assegnazioni SET data_assegnazione = ? WHERE processo = ? AND esperto = ?';
} else if ($action == 'reject') {
    $query = 'UPDATE assegnazioni SET data_rifiuto = ? WHERE processo = ? AND esperto = ?';
} else {
    header('Location: ../assegnazioni.php?err=operazione+non+valida');
    die('operazione non valida');
}

accept_reject($query, $process, $username);

//require_once('../includes/close_connection.php');
header('Location: ../assegnazioni.php?msg=operazione+effettuata+con+successo');