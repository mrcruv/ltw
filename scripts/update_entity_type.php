<?php
global $connection;
global $entity_type_regex;
require_once('../includes/open_connection.php');
require_once('../includes/regex.php');
require_once('../includes/session.php');
if (!isset($_SESSION['usertype']) or $_SESSION['usertype'] != 'ente') {
    header ('Location: ../me.php?err=sessione+utente+ente+non+attiva');
    die('sessione utente ente non attiva');
}
if (!isset($_POST['update_entity_type_submit'])) {
    header ('Location: ../index.php?err=errore+update+entity+type+submit');
    die('errore update entity type submit');
}

$username = $_SESSION['username'];
$usertype = $_SESSION['usertype'];

$new_entity_type = isset($_GET['new_entity_type']) ? trim($_GET['new_entity_type']) : false;

$query = 'SELECT * FROM utenti WHERE username = ?';
$statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
mysqli_stmt_bind_param($statement, 's', $username) or die(mysqli_error($connection));
mysqli_stmt_execute($statement) or die(mysqli_error($connection));
if (!mysqli_stmt_fetch($statement)) {
    mysqli_stmt_close($statement) or die(mysqli_error($connection));
    header('Location: ../me.php?err=utente+non+esistente');
    die('utente non esistente');
}
else if (!empty($new_entity_type)) {
        if (!preg_match($entity_type_regex, $new_entity_type)) {
            header('Location: ../me.php?err=tipo+ente+non+corretto');
            die('tipo ente non corretto');
        }
        $query = 'UPDATE enti SET tipo = ? WHERE username = ?';
        $statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
        mysqli_stmt_bind_param($statement, 'ss', $new_entity_type, $username) or die(mysqli_error($connection));
        mysqli_stmt_execute($statement) or die(mysqli_error($connection));
        mysqli_stmt_close($statement) or die(mysqli_error($connection));
    }
else {
    header('Location: ../me.php?err=tipo+non+inserito');
    die('tipo non inserito');
}

//require_once('../includes/close_connection.php');
header('Location: ../me.php?msg=tipo+aggiornato+con+successo');
