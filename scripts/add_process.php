<?php
global $connection;
global $process_name_regex, $process_type_regex, $process_description_regex;
global $process_name_maxlength, $process_type_maxlength, $process_description_maxlength;
require_once('../includes/open_connection.php');
require_once('../includes/regex.php');
require_once('../includes/lengths.php');
require_once('../includes/session.php');
if (!isset($_POST['add_process_submit'])) {
    header('Location: ../processi.php?err=errore+add+process+submit');
    die('errore add process submit');
}

$username = $_SESSION['username'];
$name = isset($_POST['name']) ? trim($_POST['name']) : false;
$type = isset($_POST['type']) ? trim($_POST['type']) : false;
$description = isset($_POST['description']) ? trim($_POST['description']) : false;

if (empty($name)) {
    header('Location: ../processi.php?err=nome+non+inserito');
    die('nome non inserito');
}
if (strlen($name) > $process_name_maxlength) {
    header('Location: ../processi.php?err=nome+supera+la+lunghezza+massima+consentita:+' . $process_name_maxlength);
    die('nome supera la lunghezza massima consentita: ' . $process_name_maxlength);
}
if (!preg_match($process_name_regex, $name)) {
    header('Location: ../processi.php?err=nome+non+corretto');
    die('nome non corretto');
}

if (empty($type)) {
    header('Location: ../processi.php?err=tipo+non+inserito');
    die('tipo non inserito');
}
if (strlen($type) > $process_type_maxlength) {
    header('Location: ../processi.php?err=tipo+supera+la+lunghezza+massima+consentita:+' . $process_type_maxlength);
    die('tipo supera la lunghezza massima consentita: ' . $process_type_maxlength);
}
if (!preg_match($process_type_regex, $type)) {
    header('Location: ../processi.php?err=tipo+non+corretto');
    die('tipo non corretto');
}

if (empty($description)) {
    header('Location: ../processi.php?err=descrizione+non+inserita');
    die('descrizione non inserita');
}
if (strlen($description) > $process_description_maxlength) {
    header('Location: ../process.php?err=descrizione+supera+la+lunghezza+massima+consentita:+' . $process_description_maxlength);
    die('descrizione supera la lunghezza massima consentita: ' . $process_description_maxlength);
}
if (!preg_match($process_description_regex, $description)) {
    header('Location: ../processi.php?err=descrizione+non+corretta');
    die('descrizione non corretta');
}

$query = 'SELECT * FROM processi WHERE nome = ?';
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
