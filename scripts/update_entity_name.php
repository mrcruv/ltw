<?php
global $connection;
global $entity_name_regex;
require_once('../includes/open_connection.php');
require_once('../includes/regex.php');
require_once('../includes/session.php');
if (!isset($_SESSION['usertype']) or $_SESSION['usertype'] != 'ente') {
    header ('Location: ../me.php?err=sessione+utente+ente+non+attiva');
    die('sessione utente ente non attiva');
}
if (!isset($_POST['update_entity_name_submit'])) {
    header ('Location: ../index.php?err=errore+update+entity+name+submit');
    die('errore update entity name submit');
}

$username = $_SESSION['username'];
$usertype = $_SESSION['usertype'];

$new_entity_name = isset($_GET['new_entity_name']) ? trim($_GET['new_entity_name']) : false;

$query = 'SELECT * FROM utenti WHERE username = ?';
$statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
mysqli_stmt_bind_param($statement, 's', $username) or die(mysqli_error($connection));
mysqli_stmt_execute($statement) or die(mysqli_error($connection));
if (!mysqli_stmt_fetch($statement)) {
    mysqli_stmt_close($statement) or die(mysqli_error($connection));
    header('Location: ../me.php?err=utente+non+esistente');
    die('utente non esistente');
}
else if (!empty($new_entity_name)) {
    if (!preg_match($entity_name_regex, $new_entity_name)) {
        header('Location: ../me.php?err=denominazione+non+corretta');
        die('denominazione non corretta');
    }
    $query = 'UPDATE enti SET denominazione = ? WHERE username = ?';
    $statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
    mysqli_stmt_bind_param($statement, 'ss', $new_entity_name, $username) or die(mysqli_error($connection));
    mysqli_stmt_execute($statement) or die(mysqli_error($connection));
    mysqli_stmt_close($statement) or die(mysqli_error($connection));
}
else {
    header('Location: ../me.php?err=denominazione+non+inserita');
    die('denominazione non inserita');
        }

//require_once('../includes/close_connection.php');
header('Location: ../me.php?msg=denominazione+aggiornata+con+successo');