<?php
global $connection;
require_once('../includes/open_connection.php');
require_once('../includes/session.php');
if (!isset($_POST['add_competence_submit'])) {
    header ('Location: ../competenze.php');
}

$name_regex = '/^[a-zA-Z0-9]{1,255}$/';
$area_regex = '/^[a-zA-Z0-9 ]{1,255}$/';
$description_regex = '/^[a-zA-Z0-9 .,;]{1,255}$/';

$username = $_SESSION['username'];
$name = trim($_POST['name']);
$area = trim($_POST['area']);
$description = trim($_POST['description']);

!empty($name) or die('nome non inserito');
preg_match($name_regex, $name) or die('nome non corretto');

!empty($area) or die('area non inserita');
preg_match($area_regex, $area) or die('area non corretta');

if (!empty($description)) preg_match($description_regex, $description) or die('descrizione non corretta');

$query = 'SELECT * FROM competenze WHERE nome=?';
$statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
mysqli_stmt_bind_param($statement, 's', $name) or die(mysqli_error($connection));
mysqli_stmt_execute($statement) or die(mysqli_error($connection));
if (!mysqli_stmt_fetch($statement)) {
    mysqli_stmt_close($statement) or die(mysqli_error($connection));
    $query = 'INSERT INTO competenze(nome, settore) VALUES (?, ?);';
    $statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
    mysqli_stmt_bind_param($statement, 'ss', $name, $area) or die(mysqli_error($connection));
    mysqli_stmt_execute($statement) or die(mysqli_error($connection));
}
mysqli_stmt_close($statement) or die(mysqli_error($connection));

$query = 'SELECT * FROM competenze_esperti WHERE competenza=? AND esperto=?';
$statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
mysqli_stmt_bind_param($statement, 'ss', $name, $username) or die(mysqli_error($connection));
mysqli_stmt_execute($statement) or die(mysqli_error($connection));
if (mysqli_stmt_fetch($statement)) {
    mysqli_stmt_close($statement) or die(mysqli_error($connection));
    header('Location: ../competenze.php?err=competenza+gia+inserita');
}
mysqli_stmt_close($statement) or die(mysqli_error($connection));

$query = 'INSERT INTO competenze_esperti(esperto, competenza, descrizione) VALUES (?, ?, ?);';
$statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
mysqli_stmt_bind_param($statement, 'sss', $username, $name, $description) or die(mysqli_error($connection));
mysqli_stmt_execute($statement) or die(mysqli_error($connection));
mysqli_stmt_close($statement) or die(mysqli_error($connection));

//require_once('../includes/close_connection.php');
header('Location: ../competenze.php?msg=competenza+inserita+con+successo');
