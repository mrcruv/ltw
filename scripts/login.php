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
    header("Location: ../index.php");
}
else if (password_verify($password, $result_password)){
    session_start();
    $_SESSION['username'] = $username;
    header("Location: ../me.php");
}
else {
    header("Location: ../index.php");
}

require_once("../includes/close_connection.php");
