<?php
global $connection;
require_once('../includes/open_connection.php');
require_once('../includes/session.php');
if (!isset($_POST['add_title_submit'])) {
    header ('Location: ../titoli.php');
}

$name_regex = '/^[a-zA-Z ]{1,255}$/';
$notes_regex = '/^[a-zA-Z0-9 .,;]{1,255}$/';
//$date_regex = '';
$grade_regex = '/^[0-9]{1,3}$/';

$username = $_SESSION['username'];
$name = isset($_POST['name']) ? trim($_POST['name']) : false;
$date = isset($_POST['date']) ? trim($_POST['date']) : false;
$notes = isset($_POST['notes']) ? trim($_POST['notes']) : false;
$grade = isset($_POST['grade']) ? trim($_POST['grade']) : false;

if (empty($name)){
    header('Location: ../titoli.php?err=nome+non+inserito');
    die('nome non inserito');
}
if (!preg_match($name_regex, $name)) {
    header('Location: ../titoli.php?err=nome+non+corretto');
    die('nome non corretto');
}

//if (!empty($date) and !preg_match($date_regex, $date) {
//    header('Location: ../titoli.php?err=data+non+corretta');
//    die('data non corretta');
//}

if (!empty($notes) and !preg_match($notes_regex, $notes)) {
    header('Location: ../titoli.php?err=note+non+corrette');
    die('note non corrette');
}

if (!empty($grade) and !preg_match($grade_regex, $grade)) {
    header('Location: ../titoli.php?err=voto+non+corretto');
    die('voto non corretto');
}


$query = 'SELECT * FROM titoli WHERE denominazione=?';
$statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
mysqli_stmt_bind_param($statement, 's', $name) or die(mysqli_error($connection));
mysqli_stmt_execute($statement) or die(mysqli_error($connection));
if (!mysqli_stmt_fetch($statement)) {
    mysqli_stmt_close($statement) or die(mysqli_error($connection));
    $query = 'INSERT INTO titoli(denominazione) VALUES (?);';
    $statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
    mysqli_stmt_bind_param($statement, 's', $name) or die(mysqli_error($connection));
    mysqli_stmt_execute($statement) or die(mysqli_error($connection));
}
mysqli_stmt_close($statement) or die(mysqli_error($connection));

$query = 'SELECT * FROM titoli_esperti WHERE esperto=? AND titolo=?';
$statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
mysqli_stmt_bind_param($statement, 'ss', $username, $name) or die(mysqli_error($connection));
mysqli_stmt_execute($statement) or die(mysqli_error($connection));
if (mysqli_stmt_fetch($statement)) {
    mysqli_stmt_close($statement) or die(mysqli_error($connection));
    header('Location: ../titoli.php?err=titolo+gia+inserito');
    die('titolo gia inserito');
}
mysqli_stmt_close($statement) or die(mysqli_error($connection));

$query = 'INSERT INTO titoli_esperti(esperto, titolo, data_conseguimento, note, voto)
                    VALUES (?, ?, ?, ?, ?);';
$statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
mysqli_stmt_bind_param($statement, 'sssss', $username, $name, $date, $notes, $grade) or die(mysqli_error($connection));
mysqli_stmt_execute($statement) or die(mysqli_error($connection));
mysqli_stmt_close($statement) or die(mysqli_error($connection));

//require_once("../includes/close_connection.php");
header('Location: ../titoli.php?msg=titolo+inserito+con+successo');
