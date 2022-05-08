<?php
global $connection;
require_once('../includes/open_connection.php');
if (!isset($_POST['register_submit'])) {
    header ('Location: ../me.php');
}

$username = $_POST['expert_username'];
$password = $_POST['expert_password'];
$cf = $_POST['expert_cf'];
$pec = $_POST['expert_pec'];
$piva = $_POST['expert_piva'];

$query = 'SELECT * FROM utenti WHERE username=? OR pec=? OR cf=? OR piva=?';
$statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
mysqli_stmt_bind_param($statement, 'ssss', $username, $pec, $cf, $piva) or die(mysqli_error($connection));
mysqli_stmt_execute($statement) or die(mysqli_error($connection));
if (mysqli_stmt_fetch($statement)) {
    mysqli_stmt_close($statement) or die(mysqli_error($connection));
    header('Location: ../index.php');
}
mysqli_stmt_close($statement) or die(mysqli_error($connection));

$website = $_POST['expert_website'];
#$accept_conditions = $_POST['accept_conditions'];
$hash = password_hash($password, PASSWORD_BCRYPT);

    $query = 'INSERT INTO utenti(username, password, pec, cf, piva, sito_web)
                    VALUES (?, ?, ?, ?, ?, ?)';
    $statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
    mysqli_stmt_bind_param($statement, 'ssssss', $username, $hash, $pec, $cf, $piva, $website) or die(mysqli_error($connection));
    mysqli_stmt_execute($statement) or die(mysqli_error($connection));
    mysqli_stmt_close($statement) or die(mysqli_error($connection));

    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $city = $_POST['city'];
    $date = $_POST['date'];

    $query = 'INSERT INTO esperti(username, nome, cognome, citta_nascita, data_nascita)
                    VALUES (?, ?, ?, ?, ?)';
    $statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
    mysqli_stmt_bind_param($statement, 'sssss', $username, $name, $surname, $city, $date) or die(mysqli_error($connection));
    mysqli_stmt_execute($statement) or die(mysqli_error($connection));
    mysqli_stmt_close($statement) or die(mysqli_error($connection));


    //require_once('../includes/close_connection.php');
    header('Location: ../index.php');
