<?php
global $connection;
global $competence_name_regex, $competence_area_regex, $competence_description_regex;
global $competence_name_maxlength, $competence_area_maxlength, $competence_description_maxlength;
require_once('../includes/open_connection.php');
require_once('../includes/regex.php');
require_once('../includes/lengths.php');
require_once('../includes/session.php');
if (!isset($_POST['add_competence_submit'])) {
    header('Location: ../competenze.php?err=errore+add+competence+submit');
    die('errore add competence submit');
}

$username = $_SESSION['username'];
$name = isset($_POST['name']) ? trim($_POST['name']) : false;
$area = isset($_POST['area']) ? trim($_POST['area']) : false;
$description = isset($_POST['description']) ? trim($_POST['description']) : false;

if (empty($name)) {
    header('Location: ../competenze.php?err=nome+non+inserito');
    die('nome non inserito');
}
if (strlen($name) > $competence_name_maxlength) {
    header('Location: ../competenze.php?err=nome+supera+la+lunghezza+massima+consentita:+' . $competence_name_maxlength);
    die('nome supera la lunghezza massima consentita: ' . $competence_name_maxlength);
}
if (!preg_match($competence_name_regex, $name)) {
    header('Location: ../competenze.php?err=nome+non+corretto');
    die('nome non corretto');
}

if (empty($area)) {
    header('Location: ../competenze.php?err=area+non+inserita');
    die('area non inserita');
}
if (strlen($area) > $competence_area_maxlength) {
    header('Location: ../competenze.php?err=area+supera+la+lunghezza+massima+consentita:+' . $competence_area_maxlength);
    die('are supera la lunghezza massima consentita: ' . $competence_area_maxlength);
}
if (!preg_match($competence_area_regex, $area)) {
    header('Location: ../competenze.php?err=area+non+corretta');
    die('area non corretta');
}

if (!empty($description)) {
    if (strlen($description) > $competence_description_maxlength) {
        header('Location: ../competenze.php?err=descrizione+supera+la+lunghezza+massima+consentita:+' . $competence_description_maxlength);
        die('descrizione supera la lunghezza massima consentita: ' . $competence_description_maxlength);
    }
    if (!preg_match($competence_description_regex, $description)) {
        header('Location: ../competenze.php?err=descrizione+non+corretta');
        die('descrizione non corretta');
    }
}

$query = 'SELECT * FROM competenze_esperti WHERE competenza = ? AND esperto = ? AND settore = ?';
$statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
mysqli_stmt_bind_param($statement, 'sss', $name, $username, $area) or die(mysqli_error($connection));
mysqli_stmt_execute($statement) or die(mysqli_error($connection));
if (mysqli_stmt_fetch($statement)) {
    mysqli_stmt_close($statement) or die(mysqli_error($connection));
    header('Location: ../competenze.php?err=competenza+gia+inserita');
    die('competenza gia inserita');
}
mysqli_stmt_close($statement) or die(mysqli_error($connection));

$query = 'INSERT INTO competenze_esperti(esperto, competenza, settore, descrizione) VALUES (?, ?, ?, ?);';
$statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
mysqli_stmt_bind_param($statement, 'ssss', $username, $name, $area, $description) or die(mysqli_error($connection));
mysqli_stmt_execute($statement) or die(mysqli_error($connection));
mysqli_stmt_close($statement) or die(mysqli_error($connection));

//require_once('../includes/close_connection.php');
header('Location: ../competenze.php?msg=competenza+inserita+con+successo');
