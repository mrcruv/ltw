<?php
global $connection;
global $website_regex;
global $website_maxlength;
require_once('../includes/open_connection.php');
require_once('../includes/regex.php');
require_once('../includes/lengths.php');
require_once('../includes/session.php');
if (!isset($_POST['update_website_submit'])) {
    header('Location: ../me.php?err=errore+update+website+submit');
    die('errore update website submit');
}

$username = $_SESSION['username'];
$usertype = $_SESSION['usertype'];

$new_website = isset($_POST['new_website']) ? trim($_POST['new_website']) : false;

$query = 'SELECT sito_web FROM utenti WHERE username = ?';
$statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
mysqli_stmt_bind_param($statement, 's', $username) or die(mysqli_error($connection));
mysqli_stmt_execute($statement) or die(mysqli_error($connection));
mysqli_stmt_bind_result($statement, $old_website) or die(mysqli_error($connection));
if (!mysqli_stmt_fetch($statement)) {
    mysqli_stmt_close($statement) or die(mysqli_error($connection));
    header('Location: ../me.php?err=utente+non+esistente');
    die('utente non esistente');
} else if (!empty($new_website)) {
    mysqli_stmt_close($statement) or die(mysqli_error($connection));
    if (strlen($new_website) > $website_maxlength) {
        header('Location: ../me.php?err=la+nuova+denominazioneil+nuovo+sito+web+supera+la+lunghezza+massima+consentita:+' . $website_maxlength);
        die('il nuovo sito web supera la lunghezza massima consentita: ' . $website_maxlength);
    }
    if ($new_website == $old_website) {
        header('Location: ../me.php?err=il+nuovo+sito+web+deve+essere+diverso+da+quello+attuale:+sito+web+non+modificato');
        die('il nuovo sito web deve essere diverso da quello attuale: sito web non modificato');
    }
    if (!preg_match($website_regex, $new_website)) {
        header('Location: ../me.php?err=sito+web+non+corretto');
        die('sito web non corretto');
    }
    $query = 'UPDATE utenti SET sito_web = ? WHERE username = ?';
    $statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
    mysqli_stmt_bind_param($statement, 'ss', $new_website, $username) or die(mysqli_error($connection));
    mysqli_stmt_execute($statement) or die(mysqli_error($connection));
    mysqli_stmt_close($statement) or die(mysqli_error($connection));
} else {
    mysqli_stmt_close($statement) or die(mysqli_error($connection));
    header('Location: ../me.php?err=sito+web+non+inserito');
    die('sito web non inserito');
}

//require_once('../includes/close_connection.php');
header('Location: ../me.php?msg=sito+web+aggiornato+con+successo');