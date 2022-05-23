<?php
global $connection;
global $entity_website_regex, $expert_website_regex;
require_once('../includes/open_connection.php');
require_once('../includes/regex.php');
require_once('../includes/session.php');
if (!isset($_POST['update_website_submit'])) {
    header ('Location: ../me.php?err=errore+update+website+submit');
    die('errore update website submit');
}

$username = $_SESSION['username'];
$usertype = $_SESSION['usertype'];

$website_regex = $usertype == 'ente' ? $entity_website_regex : $expert_website_regex;

$new_website = isset($_POST['new_website']) ? trim($_POST['new_website']) : false;

$query = 'SELECT * FROM utenti WHERE username = ?';
$statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
mysqli_stmt_bind_param($statement, 's', $username) or die(mysqli_error($connection));
mysqli_stmt_execute($statement) or die(mysqli_error($connection));
if (!mysqli_stmt_fetch($statement)) {
    mysqli_stmt_close($statement) or die(mysqli_error($connection));
    header('Location: ../me.php?err=utente+non+esistente');
    die('utente non esistente');
}
else if (!empty($new_website)) {
    mysqli_stmt_close($statement) or die(mysqli_error($connection));
    if (!preg_match($website_regex, $new_website)) {
        header('Location: ../me.php?err=c.f.+non+corretto');
        die('c.f. non corretto');
    }
    $query = 'UPDATE utenti SET sito_web = ? WHERE username = ?';
    $statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
    mysqli_stmt_bind_param($statement, 'ss', $new_website, $username) or die(mysqli_error($connection));
    mysqli_stmt_execute($statement) or die(mysqli_error($connection));
    mysqli_stmt_close($statement) or die(mysqli_error($connection));
}
else {
    mysqli_stmt_close($statement) or die(mysqli_error($connection));
    header('Location: ../me.php?err=sito+web+non+inserito');
    die('sito web non inserito');
}

//require_once('../includes/close_connection.php');
header('Location: ../me.php?msg=sito+web+aggiornato+con+successo');