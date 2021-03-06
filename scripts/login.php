<?php
global $connection;
require_once('../includes/open_connection.php');
if (!isset($_POST['login_submit'])) {
    header('Location: ../index.php?err=errore+login+submit');
    die('errore login submit');
}

$username = isset($_POST['username']) ? trim($_POST['username']) : false;
$password = isset($_POST['password']) ? trim($_POST['password']) : false;
$hash = password_hash($password, PASSWORD_BCRYPT);

if (empty($username)) {
    header('Location: ../index.php?err=username+non+inserito');
    die('username non inserito');
}
if (empty($password)) {
    header('Location: ../index.php?err=password+non+inserita');
    die('password non inserita');
}

$query = 'SELECT password FROM utenti WHERE username = ?';
$statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
mysqli_stmt_bind_param($statement, 's', $username) or die(mysqli_error($connection));
mysqli_stmt_execute($statement) or die(mysqli_error($connection));
mysqli_stmt_bind_result($statement, $result_password) or die(mysqli_error($connection));
if (!mysqli_stmt_fetch($statement)) {
    mysqli_stmt_close($statement) or die(mysqli_error($connection));
    header('Location: ../index.php?err=utente+non+esistente');
    die('utente non esistente');
} else if (password_verify($password, $result_password)) {
    mysqli_stmt_close($statement) or die(mysqli_error($connection));
    session_start();

    $_SESSION['username'] = $username;

    $query = 'SELECT username FROM enti WHERE username=?';
    $statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
    mysqli_stmt_bind_param($statement, 's', $username) or die(mysqli_error($connection));
    mysqli_stmt_execute($statement) or die(mysqli_error($connection));
    mysqli_stmt_bind_result($statement, $result_password) or die(mysqli_error($connection));
    if (!mysqli_stmt_fetch($statement)) {
        $_SESSION['usertype'] = 'esperto';
    } else {
        $_SESSION['usertype'] = 'ente';
    }
    mysqli_stmt_close($statement) or die(mysqli_error($connection));

    header('Location: ../me.php?msg=login+effettuato+con+successo,+bentornato+' . $username . '!');
} else {
    mysqli_stmt_close($statement) or die(mysqli_error($connection));
    header('Location: ../index.php?err=password+errata');
    die('password errata');
}

//require_once('../includes/close_connection.php');
