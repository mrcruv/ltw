<?php
global $connection;
require_once('../includes/open_connection.php');
require_once('../includes/session.php');
if (!isset($_POST['add_title_submit'])) {
    header ('Location: ../titoli.php');
}

$username = $_SESSION['username'];
$name = $_POST['name'];
$date = $_POST['date'];
$notes = $_POST['notes'];
$grade = $_POST['grade'];

$query = 'SELECT * FROM titoli WHERE denominazione=?';
$statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
mysqli_stmt_bind_param($statement, 's', $name) or die(mysqli_error($connection));
mysqli_stmt_execute($statement) or die(mysqli_error($connection));
if (!mysqli_stmt_fetch($statement)) {
    mysqli_stmt_close($statement) or die(mysqli_error($connection));
    $query = 'INSERT INTO titoli(denominazione) VALUES (?);';
    $statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
    mysqli_stmt_bind_param($statement, 's', $name) or die(mysqli_error($connection));
    mysqli_stmt_execute($statement) or die(mysqli_error($connection));
}
mysqli_stmt_close($statement) or die(mysqli_error($connection));

$query = 'SELECT * FROM titoli_esperti WHERE esperto=? AND titolo=?';
$statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
mysqli_stmt_bind_param($statement, 'ss', $username, $name) or die(mysqli_error($connection));
mysqli_stmt_execute($statement) or die(mysqli_error($connection));
if (mysqli_stmt_fetch($statement)) {
    mysqli_stmt_close($statement) or die(mysqli_error($connection));
    header('Location: ../titoli.php');
}
mysqli_stmt_close($statement) or die(mysqli_error($connection));

$query = 'INSERT INTO titoli_esperti(esperto, titolo, data_conseguimento, note, voto)
                    VALUES (?, ?, ?, ?, ?);';
$statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
mysqli_stmt_bind_param($statement, 'sssss', $username, $name, $date, $notes, $grade) or die(mysqli_error($connection));
mysqli_stmt_execute($statement) or die(mysqli_error($connection));
mysqli_stmt_close($statement) or die(mysqli_error($connection));

//require_once("../includes/close_connection.php");
header('Location: ../titoli.php');
