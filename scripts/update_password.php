<?php
global $connection;
global $contains_lowercase, $contains_uppercase, $contains_special, $contains_digit;
global $password_maxlength, $password_minlength;
require_once('../includes/open_connection.php');
require_once('../includes/regex.php');
require_once('../includes/lengths.php');
require_once('../includes/session.php');
if (!isset($_POST['update_password_submit'])) {
    header('Location: ../me.php?err=errore+update+password+submit');
    die('errore update password submit');
}

$username = $_SESSION['username'];
$old_password = trim($_POST['old_password']);
$old_hash = password_hash($old_password, PASSWORD_BCRYPT);
$new_password = trim($_POST['new_password']);
$new_hash = password_hash($new_password, PASSWORD_BCRYPT);

if (empty($old_password)) {
    header('Location: ../me.php?err=password+attuale+non+inserita');
    die('password attuale non inserita');
}

if (empty($new_password)) {
    header('Location: ../me.php?err=nuova+password+non+inserita');
    die('nuova password non inserita');
}
if (strlen($new_password) < $password_minlength) {
    header('Location: ../index.php?err=nuova+password+non+raggiunge+la+lunghezza+minima:+' . $password_minlength);
    die('nuova password non raggiunge la lunghezza minima: ' . $password_minlength);
}
if (strlen($new_password) > $password_maxlength) {
    header('Location: ../index.php?err=nuova+password+supera+la+lunghezza+massima+consentita:+' . $password_maxlength);
    die('nuova password supera la lunghezza massima consentita: ' . $password_maxlength);
}
$msg = '';
strlen($new_password) >= 8 or $msg .= 'lunghezza+minima+non+raggiunta';
preg_match($contains_lowercase, $new_password) or $msg .= 'lowercase+non+incluso';
preg_match($contains_special, $new_password) or $msg .= 'special+non+incluso';
preg_match($contains_uppercase, $new_password) or $msg .= 'uppercase+non+incluso';
preg_match($contains_digit, $new_password) or $msg .= 'digit+non+inclusa';
if ($msg != '') {
    header('Location: ../me.php?err=' . $msg);
    die(str_replace('+', ' ', $msg));
}

$query = 'SELECT password FROM utenti WHERE username = ?';
$statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
mysqli_stmt_bind_param($statement, 's', $username) or die(mysqli_error($connection));
mysqli_stmt_execute($statement) or die(mysqli_error($connection));
mysqli_stmt_bind_result($statement, $result_hash) or die(mysqli_error($connection));
if (!mysqli_stmt_fetch($statement)) {
    mysqli_stmt_close($statement) or die(mysqli_error($connection));
    header('Location: ../me.php?err=utente+non+esistente');
    die('utente non esistente');
} else if (password_verify($old_password, $result_hash)) {
    mysqli_stmt_close($statement) or die(mysqli_error($connection));
    $query = 'UPDATE utenti SET password = ? WHERE username = ?';
    $statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
    mysqli_stmt_bind_param($statement, 'ss', $new_hash, $username) or die(mysqli_error($connection));
    mysqli_stmt_execute($statement) or die(mysqli_error($connection));
    mysqli_stmt_close($statement) or die(mysqli_error($connection));
    header('Location: logout.php?msg=password+aggiornata+con+successo');
} else {
    mysqli_stmt_close($statement) or die(mysqli_error($connection));
    header('Location: ../me.php?err=password+attuale+incorretta');
    die('password attuale incorretta');
}

