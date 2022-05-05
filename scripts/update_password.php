<?php
global $connection;
require_once('../includes/open_connection.php');
if (!isset($_POST['update_password_submit'])) {
    header ('Location: ../index.php');
}
if (!isset($_SESSION))
{
    session_start();
}

$username = $_SESSION['username'];
$old_password = $_POST['old_password'];
$old_hash = password_hash($old_password, PASSWORD_BCRYPT);
$new_password = $_POST['new_password'];
$new_hash = password_hash($new_password, PASSWORD_BCRYPT);

$query = 'SELECT password FROM utenti WHERE username=?';
$statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
mysqli_stmt_bind_param($statement, 's', $username) or die(mysqli_error($connection));
mysqli_stmt_execute($statement) or die(mysqli_error($connection));
mysqli_stmt_bind_result($statement, $result_hash);
if (!mysqli_stmt_fetch($statement)) {
    mysqli_stmt_free_result($statement);
    mysqli_stmt_close($statement) or die(mysqli_error($connection));
    header('Location: ../me.php');
    echo('error');
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

