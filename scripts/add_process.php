<?php
global $connection;
require_once('../includes/open_connection.php');
require_once('../includes/session.php');
if (!isset($_POST['add_process_submit'])) {
    header ('Location: ../processi.php');
}

$name_regex = '/^[a-zA-Z0-9]{1,255}$/';
$type_regex = '/^[a-zA-Z0-9 ]{1,255}$/';
$description_regex = '/^[a-zA-Z0-9 .,;]{1,255}$/';

$username = $_SESSION['username'];
$name = trim($_POST['name']);
$type = trim($_POST['type']);
$description = trim($_POST['description']);

!empty($name) or die('nome non inserito');
preg_match($name_regex, $name) or die('nome non corretto');

!empty($type) or die('tipo non inserito');
preg_match($type_regex, $type) or die('tipo non corretto');

!empty($description) or die('descrizione non inserita');
preg_match($description_regex, $description) or die('descrizione non corretta');

$query = 'SELECT * FROM processi WHERE nome=?';
$statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
mysqli_stmt_bind_param($statement, 's', $name) or die(mysqli_error($connection));
mysqli_stmt_execute($statement) or die(mysqli_error($connection));
if (mysqli_stmt_fetch($statement)) {
    mysqli_stmt_close($statement) or die(mysqli_error($connection));
    header('Location: ../processi.php?err=processo+gia+inserito');
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
