<?php
require_once("../includes/open_connection.php");
global $connection;

if (!isset($_POST["login_submit"])) {
    header ("Location: ../index.php");
}

$username = $_POST["username"];
$password = $_POST["password"];
$hash = password_hash($password, PASSWORD_BCRYPT);



$query = "SELECT * FROM utenti WHERE username=? OR password=?";
$statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
mysqli_stmt_bind_param($statement, 'ss', $username, $hash) or die(mysqli_error($connection));
mysqli_stmt_execute($statement) or die(mysqli_error($connection));

if (!mysqli_stmt_fetch($statement)) {
    header("Location: ../index.php");
}
else{
    //si avvia la sessione
    session_start();

    $_SESSION['username'] = $username;
    header("Location: ../me.php");


}

require_once("../includes/close_connection.php");
