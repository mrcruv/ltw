<?php
global $connection;
require_once('../includes/open_connection.php');
require_once('../includes/session.php');
if (!isset($_POST['add_availability_submit'])) {
    header ('Location: ../assegnazioni.php');
}

$username = $_SESSION['username'];
$expert = trim($_POST['expert']);
$process = trim($_POST['process']);

if ($process == 'empty') {
    header ('Location: ../assegnazioni.php?err=selezionare+processo');
    die("selezionare processo");
}
if ($expert == 'empty') {
    header ('Location: ../assegnazioni.php?err=selezionare+esperto');
    die("selezionare esperto");
}

$query = 'SELECT * FROM esperti WHERE username=?';
$statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
mysqli_stmt_bind_param($statement, 's', $expert) or die(mysqli_error($connection));
mysqli_stmt_execute($statement) or die(mysqli_error($connection));
if (!mysqli_stmt_fetch($statement)) {
    mysqli_stmt_close($statement) or die(mysqli_error($connection));
    header ('Location: ../assegnazioni.php?err=esperto+non+esistente');
}
mysqli_stmt_close($statement) or die(mysqli_error($connection));

$query = 'SELECT * FROM processi WHERE nome=?';
$statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
mysqli_stmt_bind_param($statement, 's', $process) or die(mysqli_error($connection));
mysqli_stmt_execute($statement) or die(mysqli_error($connection));
if (!mysqli_stmt_fetch($statement)) {
    mysqli_stmt_close($statement) or die(mysqli_error($connection));
    header ('Location: ../assegnazioni.php?err=processo+non+esistente');
}
mysqli_stmt_close($statement) or die(mysqli_error($connection));

$query = 'SELECT * FROM disponibilita WHERE processo=? AND esperto=?';
$statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
mysqli_stmt_bind_param($statement, 'ss', $process, $expert) or die(mysqli_error($connection));
mysqli_stmt_execute($statement) or die(mysqli_error($connection));
if (mysqli_stmt_fetch($statement)) {
    mysqli_stmt_close($statement) or die(mysqli_error($connection));
    header ('Location: ../assegnazioni.php?err=assegnazione+gia+inserita');
}
mysqli_stmt_close($statement) or die(mysqli_error($connection));

$query = "INSERT INTO disponibilita(processo, ente, esperto) VALUES (?, ?, ?);";
$statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
mysqli_stmt_bind_param($statement, 'sss', $process, $username, $expert) or die(mysqli_error($connection));
mysqli_stmt_execute($statement) or die(mysqli_error($connection));
mysqli_stmt_close($statement) or die(mysqli_error($connection));

//require_once('../includes/close_connection.php');
header('Location: ../assegnazioni.php?msg=assegnazione+inserita+con+successo');
