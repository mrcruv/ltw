<?php
global $connection;
require_once('../includes/open_connection.php');
require_once('../includes/session.php');
if (!isset($_POST['update_password_submit'])) {
    header ('Location: ../index.php');
}

$contains_lowercase = '/[a-z]/';
$contains_uppercase = '/[A-Z]/';
$contains_special = '/[!@#$%^&*-]/';
$contains_digit = '/[0-9]/';

$username = $_SESSION['username'];
$old_password = trim($_POST['old_password']);
$old_hash = password_hash($old_password, PASSWORD_BCRYPT);
$new_password = trim($_POST['new_password']);
$new_hash = password_hash($new_password, PASSWORD_BCRYPT);

!empty($new_password) or die('nuova password non inserita');
$msg = '';
strlen($new_password) >= 8 or $msg = $msg . 'lunghezza minima non raggiunta ';
preg_match($contains_lowercase, $new_password) or $msg = $msg . 'lowercase non incluso ';
preg_match($contains_special, $new_password) or $msg = $msg . 'special non incluso';
preg_match($contains_uppercase, $new_password) or $msg = $msg . 'uppercase non incluso ';
preg_match($contains_digit, $new_password) or $msg = $msg . 'digit non inclusa';
$msg == '' or die($msg);

$query = 'SELECT password FROM utenti WHERE username=?';
$statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
mysqli_stmt_bind_param($statement, 's', $username) or die(mysqli_error($connection));
mysqli_stmt_execute($statement) or die(mysqli_error($connection));
mysqli_stmt_bind_result($statement, $result_hash) or die(mysqli_error($connection));
if (!mysqli_stmt_fetch($statement)) {
    mysqli_stmt_free_result($statement);
    mysqli_stmt_close($statement) or die(mysqli_error($connection));
    echo('error');
    header('Location: ../me.php');
}
else if (password_verify($old_password, $result_hash)) {
    mysqli_stmt_free_result($statement);
    mysqli_stmt_close($statement) or die(mysqli_error($connection));
    $query = 'UPDATE utenti SET password=? WHERE username=?';
    $statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
    mysqli_stmt_bind_param($statement, 'ss', $new_hash, $username) or die(mysqli_error($connection));
    mysqli_stmt_execute($statement) or die(mysqli_error($connection));
    mysqli_stmt_close($statement) or die(mysqli_error($connection));
    header('Location: logout.php');
}
else {
    mysqli_stmt_free_result($statement);
    mysqli_stmt_close($statement) or die(mysqli_error($connection));
    echo('password attuale incorretta');
    header('Location: ../me.php');
}

