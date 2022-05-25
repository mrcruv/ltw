<?php
global $connection;
require_once('../includes/open_connection.php');
require_once('../includes/session.php');
if (!isset($_SESSION['usertype']) or $_SESSION['usertype'] != 'esperto') {
    header('Location: ../competenze.php?err=sessione+utente+esperto+non+attiva');
    die('sessione utente esperto non attiva');
}

$username = $_SESSION['username'];
$name = isset($_GET['name']) ? trim($_GET['name']) : false;
$area = isset($_GET['area']) ? trim($_GET['area']) : false;

if (empty($name)) {
    header('Location: ../competenze.php?err=nome+competenza+non+selezionato');
    die('nome competenza non selezionato');
}
if (empty($area)) {
    header('Location: ../competenze.php?err=area+competenza+non+selezionata');
    die('area competenza non selezionata');
}

$query = 'SELECT * FROM competenze_esperti WHERE esperto = ? AND competenza = ? AND settore = ?';
$statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
mysqli_stmt_bind_param($statement, 'sss', $username, $name, $area) or die(mysqli_error($connection));
mysqli_stmt_execute($statement) or die(mysqli_error($connection));
if (!mysqli_stmt_fetch($statement)) {
    mysqli_stmt_close($statement) or die(mysqli_error($connection));
    header('Location: ../competenze.php?err=competenza+non+inserita');
    die('competenza non inserita');
}
mysqli_stmt_close($statement) or die(mysqli_error($connection));

$query = 'DELETE FROM competenze_esperti WHERE esperto = ? AND competenza = ? AND settore = ?';
$statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
mysqli_stmt_bind_param($statement, 'sss', $username, $name, $area) or die(mysqli_error($connection));
mysqli_stmt_execute($statement) or die(mysqli_error($connection));
mysqli_stmt_close($statement) or die(mysqli_error($connection));

//require_once("../includes/close_connection.php");
header('Location: ../competenze.php?msg=competenza+eliminata+con+successo');
