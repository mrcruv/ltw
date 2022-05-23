<?php
global $connection;
global $entity_pec_regex, $expert_pec_regex;
require_once('../includes/open_connection.php');
require_once('../includes/regex.php');
require_once('../includes/session.php');
if (!isset($_POST['update_pec_submit'])) {
    header ('Location: ../index.php?err=errore+update+pec+submit');
    die('errore update pec submit');
}

$username = $_SESSION['username'];
$usertype = $_SESSION['usertype'];

$pec_regex = $usertype == 'ente' ? $entity_pec_regex : $expert_pec_regex;

$new_pec = isset($_POST['new_pec']) ? trim($_POST['new_pec']) : false;

$query = 'SELECT * FROM utenti WHERE username = ?';
$statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
mysqli_stmt_bind_param($statement, 's', $username) or die(mysqli_error($connection));
mysqli_stmt_execute($statement) or die(mysqli_error($connection));
if (!mysqli_stmt_fetch($statement)) {
    mysqli_stmt_close($statement) or die(mysqli_error($connection));
    header('Location: ../me.php?err=utente+non+esistente');
    die('utente non esistente');
}
else if (!empty($new_pec)) {
    if (!preg_match($pec_regex, $new_pec)) {
        header('Location: ../me.php?err=pec+non+corretta');
        die('pec non corretta');
    }
    $query = 'UPDATE utenti SET pec = ? WHERE username = ?';
    $statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
    mysqli_stmt_bind_param($statement, 'ss', $new_pec, $username) or die(mysqli_error($connection));
    mysqli_stmt_execute($statement) or die(mysqli_error($connection));
    mysqli_stmt_close($statement) or die(mysqli_error($connection));
}
else {
    header('Location: ../me.php?err=pec+non+inserita');
    die('pec non inserita');
}

//require_once('../includes/close_connection.php');
header('Location: ../me.php?msg=pec+aggiornata+con+successo');