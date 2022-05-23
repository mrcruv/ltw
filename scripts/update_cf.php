<?php
global $connection;
global $entity_cf_regex, $expert_cf_regex;
require_once('../includes/open_connection.php');
require_once('../includes/regex.php');
require_once('../includes/session.php');
if (!isset($_POST['update_cf_submit'])) {
    header ('Location: ../me.php?err=errore+update+cf+submit');
    die('errore update cf submit');
}

$username = $_SESSION['username'];
$usertype = $_SESSION['usertype'];

$cf_regex = $usertype == 'ente' ? $entity_cf_regex : $expert_cf_regex;

$new_cf = isset($_POST['new_cf']) ? trim($_POST['new_cf']) : false;

$query = 'SELECT cf FROM utenti WHERE username = ?';
$statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
mysqli_stmt_bind_param($statement, 's', $username) or die(mysqli_error($connection));
mysqli_stmt_execute($statement) or die(mysqli_error($connection));
mysqli_stmt_bind_result($statement, $old_cf) or die(mysqli_error($connection));
if (!mysqli_stmt_fetch($statement)) {
    mysqli_free_result($statement);
    mysqli_stmt_close($statement) or die(mysqli_error($connection));
    header('Location: ../me.php?err=utente+non+esistente');
    die('utente non esistente');
}
else if (!empty($new_cf)) {
    mysqli_stmt_close($statement) or die(mysqli_error($connection));
    if ($new_cf == $old_cf) {
        header('Location: ../me.php?err=il+nuovo+c.f.+deve+essere+diverso+da+quello+attuale:+c.f.+non+modificato');
        die('il nuovo c.f. deve essere diverso da quello attuale: c.f. non modificato');
    }
    if (!preg_match($cf_regex, $new_cf)) {
        header('Location: ../me.php?err=c.f.+non+corretto');
        die('c.f. non corretto');
    }
    $query = 'UPDATE utenti SET cf = ? WHERE username = ?';
    $statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
    mysqli_stmt_bind_param($statement, 'ss', $new_cf, $username) or die(mysqli_error($connection));
    mysqli_stmt_execute($statement) or die(mysqli_error($connection));
    mysqli_stmt_close($statement) or die(mysqli_error($connection));
}
else {
    mysqli_stmt_close($statement) or die(mysqli_error($connection));
    header('Location: ../me.php?err=c.f.+non+inserito');
    die('c.f. non inserito');
}

//require_once('../includes/close_connection.php');
header('Location: ../me.php?msg=c.f.+aggiornato+con+successo');