<?php
global $connection;
global $title_name_regex, $title_grade_regex, $title_notes_regex;
global $title_name_maxlength, $title_grade_maxlength, $title_notes_maxlength;
require_once('../includes/open_connection.php');
require_once('../includes/regex.php');
require_once('../includes/lengths.php');
require_once('../includes/session.php');
if (!isset($_POST['add_title_submit'])) {
    header('Location: ../titoli.php?err=errore+add+title+submit');
    die('errore add title submit');
}

$username = $_SESSION['username'];
$name = isset($_POST['name']) ? trim($_POST['name']) : false;
$date = isset($_POST['date']) ? trim($_POST['date']) : false;
$notes = isset($_POST['notes']) ? trim($_POST['notes']) : false;
$grade = isset($_POST['grade']) ? trim($_POST['grade']) : false;
$year = (int)Date('Y', strtotime($date));
$month = (int)Date('m', strtotime($date));
$day = (int)Date('d', strtotime($date));

if (empty($name)) {
    header('Location: ../titoli.php?err=nome+non+inserito');
    die('nome non inserito');
}
if (strlen($name) > $title_name_maxlength) {
    header('Location: ../titoli.php?err=nome+supera+la+lunghezza+massima+consentita:+' . $title_name_maxlength);
    die('nome supera la lunghezza massima consentita: ' . $title_name_maxlength);
}
if (!preg_match($title_name_regex, $name)) {
    header('Location: ../titoli.php?err=nome+non+corretto');
    die('nome non corretto');
}

if (!strtotime($date) or !empty($date) and !checkdate($month, $day, $year)) {
    header('Location: ../titoli.php?err=data+non+corretta');
    die('data non corretta');
}

if (!empty($notes)) {
    if (strlen($notes) > $title_notes_maxlength) {
        header('Location: ../titoli.php?err=note+superano+la+lunghezza+massima+consentita:+' . $title_notes_maxlength);
        die('note superano la lunghezza massima consentita: ' . $title_notes_maxlength);
    }
    if (!preg_match($title_notes_regex, $notes)) {
        header('Location: ../titoli.php?err=note+non+corrette');
        die('note non corrette');
    }
}

if (!empty($grade)) {
    if (strlen($grade) > $title_grade_maxlength) {
        header('Location: ../titoli.php?err=voto+supera+la+lunghezza+massima+consentita:+' . $title_grade_maxlength);
        die('voto supera la lunghezza massima consentita: ' . $title_grade_maxlength);
    }
    if (!preg_match($title_grade_regex, $grade)) {
        header('Location: ../titoli.php?err=voto+non+corretto');
        die('voto non corretto');
    }
}

$query = 'SELECT * FROM titoli_esperti WHERE esperto = ? AND titolo = ?';
$statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
mysqli_stmt_bind_param($statement, 'ss', $username, $name) or die(mysqli_error($connection));
mysqli_stmt_execute($statement) or die(mysqli_error($connection));
if (mysqli_stmt_fetch($statement)) {
    mysqli_stmt_close($statement) or die(mysqli_error($connection));
    header('Location: ../titoli.php?err=titolo+gia+inserito');
    die('titolo gia inserito');
}
mysqli_stmt_close($statement) or die(mysqli_error($connection));

$query = 'INSERT INTO titoli_esperti(esperto, titolo, data_conseguimento, note, voto)
                    VALUES (?, ?, ?, ?, ?);';
$statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
mysqli_stmt_bind_param($statement, 'sssss', $username, $name, $date, $notes, $grade) or die(mysqli_error($connection));
mysqli_stmt_execute($statement) or die(mysqli_error($connection));
mysqli_stmt_close($statement) or die(mysqli_error($connection));

//require_once("../includes/close_connection.php");
header('Location: ../titoli.php?msg=titolo+inserito+con+successo');
