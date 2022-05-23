<?php
global $connection;
global $entity_piva_regex, $expert_piva_regex;
require_once('../includes/open_connection.php');
require_once('../includes/regex.php');
require_once('../includes/session.php');

$username = $_SESSION['username'];
$usertype = $_SESSION['usertype'];

$piva_regex = $usertype == 'ente' ? $entity_piva_regex : $expert_piva_regex;

$new_piva = isset($_GET['new_piva']) ? trim($_GET['new_piva']) : false;

if (!empty($new_piva)) {
    if (!preg_match($piva_regex, $new_piva)) {
        header('Location: ../me.php?err=p.iva+non+corretta');
        die('p.iva non corretta');
    }
    $query = 'UPDATE utenti SET cf = ? WHERE username = ?';
    $statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
    mysqli_stmt_bind_param($statement, 'ss', $new_piva, $username) or die(mysqli_error($connection));
    mysqli_stmt_execute($statement) or die(mysqli_error($connection));
    mysqli_stmt_close($statement) or die(mysqli_error($connection));
}
else {
    header('Location: ../me.php?err=piva+non+inserita');
    die('p.iva non inserita');
}

//require_once('../includes/close_connection.php');
header('Location: ../me.php?msg=p.iva+aggiornata+con+successo');