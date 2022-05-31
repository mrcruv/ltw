<?php
global $connection;
global $cf_regex;
global $cf_maxlength;
require_once('../includes/open_connection.php');
require_once('../includes/regex.php');
require_once('../includes/lengths.php');
require_once('../includes/session.php');
if (!isset($_POST['update_cf_submit'])) {
    header('Location: ../me.php?err=errore+update+cf+submit');
    die('errore update cf submit');
}

$username = $_SESSION['username'];
$usertype = $_SESSION['usertype'];

$new_cf = isset($_POST['new_cf']) ? trim($_POST['new_cf']) : false;

$query = 'SELECT cf FROM utenti WHERE username = ?';
$statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
mysqli_stmt_bind_param($statement, 's', $username) or die(mysqli_error($connection));
mysqli_stmt_execute($statement) or die(mysqli_error($connection));
mysqli_stmt_bind_result($statement, $old_cf) or die(mysqli_error($connection));
if (!mysqli_stmt_fetch($statement)) {
    mysqli_stmt_close($statement) or die(mysqli_error($connection));
    header('Location: ../me.php?err=utente+non+esistente');
    die('utente non esistente');
} else if (!empty($new_cf)) {
    mysqli_stmt_close($statement) or die(mysqli_error($connection));
    if (strlen($new_cf) > $cf_maxlength) {
        header('Location: ../me.php?err=il+nuovo+c.f.+supera+la+lunghezza+massima+consentita:+' . $cf_maxlength);
        die('il nuovo c.f. supera la lunghezza massima consentita: ' . $cf_maxlength);
    }
    if ($new_cf == $old_cf) {
        header('Location: ../me.php?err=il+nuovo+c.f.+deve+essere+diverso+da+quello+attuale:+c.f.+non+modificato');
        die('il nuovo c.f. deve essere diverso da quello attuale: c.f. non modificato');
    }
    if (!preg_match($cf_regex, $new_cf)) {
        header('Location: ../me.php?err=c.f.+non+corretto');
        die('c.f. non corretto');
    }
    $query = 'SELECT * FROM utenti WHERE username <> ? AND cf = ?';
    $statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
    mysqli_stmt_bind_param($statement, 'ss', $username, $new_cf) or die(mysqli_error($connection));
    mysqli_stmt_execute($statement) or die(mysqli_error($connection));
    if (mysqli_stmt_fetch($statement)) {
        mysqli_stmt_close($statement) or die(mysqli_error($connection));
        header('Location: ../me.php?err=nuovo+c.f.+gia+assegnato+ad+un+altro+utente');
        die('nuovo c.f. gia assegnato ad un altro utente');
    }
    mysqli_stmt_close($statement) or die(mysqli_error($connection));
    $query = 'UPDATE utenti SET cf = ? WHERE username = ?';
    $statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
    mysqli_stmt_bind_param($statement, 'ss', $new_cf, $username) or die(mysqli_error($connection));
    mysqli_stmt_execute($statement) or die(mysqli_error($connection));
    mysqli_stmt_close($statement) or die(mysqli_error($connection));
} else {
    mysqli_stmt_close($statement) or die(mysqli_error($connection));
    header('Location: ../me.php?err=c.f.+non+inserito');
    die('c.f. non inserito');
}

//require_once('../includes/close_connection.php');
header('Location: ../me.php?msg=c.f.+aggiornato+con+successo');