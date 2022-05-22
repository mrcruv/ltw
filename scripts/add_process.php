<?php
global $connection;
require_once('../includes/open_connection.php');
require_once('../includes/session.php');
if (!isset($_POST['add_process_submit'])) {
    header ('Location: ../processi.php?err=errore+add+process+submit');
    die('errore add process submit');
}

$name_regex = '/^[a-zA-Z0-9]{1,255}$/';
$type_regex = '/^[a-zA-Z0-9 ]{1,255}$/';
$description_regex = '/^[a-zA-Z0-9 .,;]{1,255}$/';

$username = $_SESSION['username'];
$name = isset($_POST['name']) ? trim($_POST['name']) : false;
$type = isset($_POST['type']) ? trim($_POST['type']) : false;
$description = isset($_POST['description']) ? trim($_POST['description']) : false;

if (empty($name)){
    header('Location: ../processi.php?err=nome+non+inserito');
    die('nome non inserito');
}
if (!preg_match($name_regex, $name)) {
    header('Location: ../processi.php?err=nome+non+corretto');
    die('nome non corretto');
}

if (empty($type)){
    header('Location: ../processi.php?err=tipo+non+inserito');
    die('tipo non inserito');
}
if (!preg_match($type_regex, $type)) {
    header('Location: ../processi.php?err=tipo+non+corretto');
    die('tipo non corretto');
}

if (empty($description)){
    header('Location: ../processi.php?err=descrizione+non+inserita');
    die('descrizione non inserita');
}
if (!preg_match($description_regex, $description)) {
    header('Location: ../processi.php?err=descrizione+non+corretta');
    die('descrizione non corretta');
}

$query = 'SELECT * FROM processi WHERE nome=?';
$statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
mysqli_stmt_bind_param($statement, 's', $name) or die(mysqli_error($connection));
mysqli_stmt_execute($statement) or die(mysqli_error($connection));
if (mysqli_stmt_fetch($statement)) {
    mysqli_stmt_close($statement) or die(mysqli_error($connection));
    header('Location: ../processi.php?err=processo+gia+inserito');
    die('processo gia inserito');
}
mysqli_stmt_close($statement) or die(mysqli_error($connection));

$query = 'INSERT INTO processi(ente, nome, tipologia, descrizione)
                    VALUES (?, ?, ?, ?);';
$statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
mysqli_stmt_bind_param($statement, 'ssss', $username, $name, $type, $description) or die(mysqli_error($connection));
mysqli_stmt_execute($statement) or die(mysqli_error($connection));
mysqli_stmt_close($statement) or die(mysqli_error($connection));

//require_once('../includes/close_connection.php');
header('Location: ../processi.php?msg=processo+inserito+con+successo');
