<?php
global $connection;
global $piva_regex;
global $piva_maxlength;
require_once('../includes/open_connection.php');
require_once('../includes/regex.php');
require_once('../includes/lengths.php');
require_once('../includes/session.php');
if (!isset($_POST['update_piva_submit'])) {
    header('Location: ../me.php?err=errore+update+piva+submit');
    die('errore update piva submit');
}

$username = $_SESSION['username'];
$usertype = $_SESSION['usertype'];

$new_piva = isset($_POST['new_piva']) ? trim($_POST['new_piva']) : false;

$query = 'SELECT piva FROM utenti WHERE username = ?';
$statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
mysqli_stmt_bind_param($statement, 's', $username) or die(mysqli_error($connection));
mysqli_stmt_execute($statement) or die(mysqli_error($connection));
mysqli_stmt_bind_result($statement, $old_piva) or die(mysqli_error($connection));
if (!mysqli_stmt_fetch($statement)) {
    mysqli_stmt_close($statement) or die(mysqli_error($connection));
    header('Location: ../me.php?err=utente+non+esistente');
    die('utente non esistente');
} else if (!empty($new_piva)) {
    mysqli_stmt_close($statement) or die(mysqli_error($connection));
    if (strlen($new_piva) > $piva_maxlength) {
        header('Location: ../me.php?err=la+nuova+p.iva+supera+la+lunghezza+massima+consentita:+' . $piva_maxlength);
        die('la nuova p.iva supera la lunghezza massima consentita: ' . $piva_maxlength);
    }
    if ($new_piva == $old_piva) {
        header('Location: ../me.php?err=la+nuova+p.iva+deve+essere+diversa+da+quella+attuale:+p.iva+non+modificata');
        die('la nuova p.iva deve essere diversa da quella attuale: p.iva non modificata');
    }
    if (!preg_match($piva_regex, $new_piva)) {
        header('Location: ../me.php?err=p.iva+non+corretta');
        die('p.iva non corretta');
    }
    $query = 'SELECT * FROM utenti WHERE username <> ? AND piva = ?';
    $statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
    mysqli_stmt_bind_param($statement, 'ss', $username, $new_piva) or die(mysqli_error($connection));
    mysqli_stmt_execute($statement) or die(mysqli_error($connection));
    if (mysqli_stmt_fetch($statement)) {
        mysqli_stmt_close($statement) or die(mysqli_error($connection));
        header('Location: ../me.php?err=nuova+p.iva+gia+assegnata+ad+un+altro+utente');
        die('nuova p.iva gia assegnata ad un altro utente');
    }
    mysqli_stmt_close($statement) or die(mysqli_error($connection));
    $query = 'UPDATE utenti SET piva = ? WHERE username = ?';
    $statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
    mysqli_stmt_bind_param($statement, 'ss', $new_piva, $username) or die(mysqli_error($connection));
    mysqli_stmt_execute($statement) or die(mysqli_error($connection));
    mysqli_stmt_close($statement) or die(mysqli_error($connection));
} else {
    mysqli_stmt_close($statement) or die(mysqli_error($connection));
    header('Location: ../me.php?err=piva+non+inserita');
    die('p.iva non inserita');
}

//require_once('../includes/close_connection.php');
header('Location: ../me.php?msg=p.iva+aggiornata+con+successo');