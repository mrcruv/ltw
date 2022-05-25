<?php
global $connection;
require_once('../includes/open_connection.php');
require_once('../includes/session.php');
if (!isset($_POST['remove_website_submit'])) {
    header('Location: ../me.php?err=errore+remove+website+submit');
    die('errore remove website submit');
}

$username = $_SESSION['username'];
$usertype = $_SESSION['usertype'];

$query = 'SELECT sito_web FROM utenti WHERE username = ?';
$statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
mysqli_stmt_bind_param($statement, 's', $username) or die(mysqli_error($connection));
mysqli_stmt_execute($statement) or die(mysqli_error($connection));
mysqli_stmt_bind_result($statement, $old_website) or die(mysqli_error($connection));
if (!mysqli_stmt_fetch($statement)) {
    mysqli_free_result($statement);
    mysqli_stmt_close($statement) or die(mysqli_error($connection));
    header('Location: ../me.php?err=utente+non+esistente');
    die('utente non esistente');
} else {
    mysqli_stmt_close($statement) or die(mysqli_error($connection));
    $query = 'UPDATE utenti SET sito_web = NULL WHERE username = ?';
    $statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
    mysqli_stmt_bind_param($statement, 's', $username) or die(mysqli_error($connection));
    mysqli_stmt_execute($statement) or die(mysqli_error($connection));
    mysqli_stmt_close($statement) or die(mysqli_error($connection));
}

//require_once('../includes/close_connection.php');
header('Location: ../me.php?msg=sito+web+rimosso+con+successo');