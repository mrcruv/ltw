<?php
global $connection;
require_once('../includes/open_connection.php');
require_once('../includes/session.php');
if (!isset($_POST['add_competence_submit'])) {
    header ('Location: ../competenze.php?err=errore+add+competence+submit');
    die('errore add competence submit');
}

$name_regex = '/^[a-zA-Z0-9]{1,255}$/';
$area_regex = '/^[a-zA-Z0-9 ]{1,255}$/';
$description_regex = '/^[a-zA-Z0-9 .,;]{1,255}$/';

$username = $_SESSION['username'];
$name = isset($_POST['name']) ? trim($_POST['name']) : false;
$area = isset($_POST['area']) ? trim($_POST['area']) : false;
$description = isset($_POST['description']) ? trim($_POST['description']) : false;

if (empty($name)){
    header('Location: ../competenze.php?err=nome+non+inserito');
    die('nome non inserito');
}
if (!preg_match($name_regex, $name)) {
    header('Location: ../competenze.php?err=nome+non+corretto');
    die('nome non corretto');
}

if (empty($area)){
    header('Location: ../competenze.php?err=area+non+inserita');
    die('area non inserita');
}
if (!preg_match($area_regex, $area)) {
    header('Location: ../competenze.php?err=area+non+corretta');
    die('area non corretta');
}

if (!empty($description) and !preg_match($description_regex, $description)) {
    header('Location: ../competenze.php?err=descrizione+non+corretta');
    die('descrizione non corretta');
}

$query = 'SELECT * FROM competenze WHERE nome=? AND settore=?';
$statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
mysqli_stmt_bind_param($statement, 'ss', $name, $area) or die(mysqli_error($connection));
mysqli_stmt_execute($statement) or die(mysqli_error($connection));
if (!mysqli_stmt_fetch($statement)) {
    mysqli_stmt_close($statement) or die(mysqli_error($connection));
    $query = 'INSERT INTO competenze(nome, settore) VALUES (?, ?);';
    $statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
    mysqli_stmt_bind_param($statement, 'ss', $name, $area) or die(mysqli_error($connection));
    mysqli_stmt_execute($statement) or die(mysqli_error($connection));
}
mysqli_stmt_close($statement) or die(mysqli_error($connection));

$query = 'SELECT * FROM competenze_esperti WHERE competenza=? AND esperto=? AND settore=?';
$statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
mysqli_stmt_bind_param($statement, 'sss', $name, $username, $area) or die(mysqli_error($connection));
mysqli_stmt_execute($statement) or die(mysqli_error($connection));
if (mysqli_stmt_fetch($statement)) {
    mysqli_stmt_close($statement) or die(mysqli_error($connection));
    header('Location: ../competenze.php?err=competenza+gia+inserita');
    die('competenza gia inserita');
}
mysqli_stmt_close($statement) or die(mysqli_error($connection));

$query = 'INSERT INTO competenze_esperti(esperto, competenza, settore, descrizione) VALUES (?, ?, ?, ?);';
$statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
mysqli_stmt_bind_param($statement, 'ssss', $username, $name, $area, $description) or die(mysqli_error($connection));
mysqli_stmt_execute($statement) or die(mysqli_error($connection));
mysqli_stmt_close($statement) or die(mysqli_error($connection));

//require_once('../includes/close_connection.php');
header('Location: ../competenze.php?msg=competenza+inserita+con+successo');
