<?php
global $connection;
require_once('../includes/open_connection.php');
require_once('../includes/session.php');
if (!isset($_SESSION['usertype']) or $_SESSION['usertype'] != 'esperto') {
    header ('Location: ../titoli.php?err=sessione+utente+esperto+non+attiva');
    die('sessione utente esperto non attiva');
}

$username = $_SESSION['username'];
$name = isset($_GET['name']) ? trim($_GET['name']) : false;

if (empty($name)){
    header('Location: ../titoli.php?err=titolo+non+selezionato');
    die('titolo non selezionato');
}

$query = 'SELECT * FROM titoli WHERE denominazione=?';
$statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
mysqli_stmt_bind_param($statement, 's', $name) or die(mysqli_error($connection));
mysqli_stmt_execute($statement) or die(mysqli_error($connection));
if (!mysqli_stmt_fetch($statement)) {
    mysqli_stmt_close($statement) or die(mysqli_error($connection));
    header('Location: ../titoli.php?err=titolo+non+esistente');
    die('titolo non esistente');
}
mysqli_stmt_close($statement) or die(mysqli_error($connection));

$query = 'SELECT * FROM titoli_esperti WHERE esperto=? AND titolo=?';
$statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
mysqli_stmt_bind_param($statement, 'ss', $username, $name) or die(mysqli_error($connection));
mysqli_stmt_execute($statement) or die(mysqli_error($connection));
if (!mysqli_stmt_fetch($statement)) {
    mysqli_stmt_close($statement) or die(mysqli_error($connection));
    header('Location: ../titoli.php?err=titolo+non+inserito');
    die('titolo non inserito');
}
mysqli_stmt_close($statement) or die(mysqli_error($connection));

$query = 'DELETE FROM titoli_esperti WHERE esperto=? AND titolo=?';
$statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
mysqli_stmt_bind_param($statement, 'ss', $username, $name) or die(mysqli_error($connection));
mysqli_stmt_execute($statement) or die(mysqli_error($connection));
mysqli_stmt_close($statement) or die(mysqli_error($connection));

//require_once("../includes/close_connection.php");
header('Location: ../titoli.php?msg=titolo+eliminato+con+successo');
