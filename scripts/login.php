<?php
require_once("../includes/open_connection.php");
global $connection;
if (!isset($_POST["login_submit"])) {
    header ("Location: ../index.php");
}

$username = $_POST["username"];
$password = $_POST["password"];
$hash = password_hash($password, PASSWORD_BCRYPT);

$query = "SELECT password FROM utenti WHERE username=?";
$statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
mysqli_stmt_bind_param($statement, 's', $username) or die(mysqli_error($connection));
mysqli_stmt_execute($statement) or die(mysqli_error($connection));
mysqli_stmt_bind_result($statement, $result_password);
if (!mysqli_stmt_fetch($statement)) {
    mysqli_stmt_free_result($statement);
    mysqli_stmt_close($statement) or die(mysqli_error($connection));
    header("Location: ../index.php");
}
else if (password_verify($password, $result_password)){
    mysqli_stmt_free_result($statement);
    mysqli_stmt_close($statement) or die(mysqli_error($connection));
    session_start();

    $_SESSION['username'] = $username;

    $query = "SELECT username FROM enti WHERE username=?";
    $statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
    mysqli_stmt_bind_param($statement, 's', $username) or die(mysqli_error($connection));
    mysqli_stmt_execute($statement) or die(mysqli_error($connection));
    mysqli_stmt_bind_result($statement, $result_password);
    if (!mysqli_stmt_fetch($statement)) {
        $_SESSION['usertype'] = 'esperto';
    }
    else {
        $_SESSION['usertype'] = 'ente'; 
    }
    mysqli_stmt_free_result($statement);
    mysqli_stmt_close($statement) or die(mysqli_error($connection));

    header("Location: ../me.php");
}
else {
    header("Location: ../index.php");
}

//require_once("../includes/close_connection.php");
