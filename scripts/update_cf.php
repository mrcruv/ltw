<?php
global $connection;
global $entity_cf_regex, $expert_cf_regex;
require_once('../includes/open_connection.php');
require_once('../includes/regex.php');
require_once('../includes/session.php');

$username = $_SESSION['username'];
$usertype = $_SESSION['usertype'];

$cf_regex = $usertype == 'ente' ? $entity_cf_regex : $expert_cf_regex;

$new_cf = isset($_GET['new_cf']) ? trim($_GET['new_cf']) : false;

if (!empty($new_cf)) {
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
    header('Location: ../me.php?err=c.f.+non+inserito');
    die('c.f. non inserito');
}

//require_once('../includes/close_connection.php');
header('Location: ../me.php?msg=c.f.+aggiornato+con+successo');