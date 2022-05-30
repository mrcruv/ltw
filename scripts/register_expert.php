<?php
global $connection;
global $contains_lowercase, $contains_uppercase, $contains_special, $contains_digit,
       $username_regex, $cf_regex, $pec_regex, $piva_regex, $website_regex,
       $expert_name_regex, $expert_surname_regex, $expert_city_regex, $accept_conditions_regex;
global $username_maxlength, $password_minlength, $password_maxlength, $cf_maxlength,
       $pec_maxlength, $piva_maxlength, $website_maxlength, $expert_name_maxlength,
       $expert_surname_maxlength, $expert_city_maxlength;
require_once('../includes/open_connection.php');
require_once('../includes/regex.php');
require_once('../includes/lengths.php');
if (!isset($_POST['register_expert_submit'])) {
    header('Location: ../index.php?err=errore+register+expert+submit');
    die('errore register expert submit');
}

$username = isset($_POST['expert_username']) ? trim($_POST['expert_username']) : false;
$password = isset($_POST['expert_password']) ? trim($_POST['expert_password']) : false;
$cf = isset($_POST['expert_cf']) ? strtoupper(trim($_POST['expert_cf'])) : false;
$pec = isset($_POST['expert_pec']) ? strtolower(trim($_POST['expert_pec'])) : false;
$piva = isset($_POST['expert_piva']) ? trim($_POST['expert_piva']) : false;
$website = isset($_POST['expert_website']) ? strtolower(trim($_POST['expert_website'])) : false;
$accept_conditions = isset($_POST['expert_term']) ? strtolower(trim($_POST['expert_term'])) : false;
$name = isset($_POST['name']) ? trim($_POST['name']) : false;
$surname = isset($_POST['surname']) ? trim($_POST['surname']) : false;
$city = isset($_POST['city']) ? trim($_POST['city']) : false;
$date = isset($_POST['date']) ? trim($_POST['date']) : false;
$current_date = date('Y-m-d');
$calculated_age = floor((abs(strtotime($current_date) - strtotime($date)) / 86400) / 365);
$year = (int)Date('Y', strtotime($date));
$month = (int)Date('m', strtotime($date));
$day = (int)Date('d', strtotime($date));

if (empty($username)) {
    header('Location: ../index.php?err=username+non+inserito');
    die('username non inserito');
}
if (strlen($username) > $username_maxlength) {
    header('Location: ../index.php?err=username+supera+la+lunghezza+massima+consentita:+' . $username_maxlength);
    die('username supera la lunghezza massima consentita: ' . $username_maxlength);
}
if (!preg_match($username_regex, $username)) {
    header('Location: ../index.php?err=username+non+corretto');
    die('username non corretto');
}

if (empty($password)) {
    header('Location: ../index.php?err=password+non+inserita');
    die('password non inserita');
}
if (strlen($password) < $password_minlength) {
    header('Location: ../index.php?err=password+non+raggiunge+la+lunghezza+minima:+' . $password_minlength);
    die('password non raggiunge la lunghezza minima: ' . $password_minlength);
}
if (strlen($password) > $password_maxlength) {
    header('Location: ../index.php?err=password+supera+la+lunghezza+massima+consentita:+' . $password_maxlength);
    die('password supera la lunghezza massima consentita: ' . $password_maxlength);
}
$msg = '';
preg_match($contains_lowercase, $password) or $msg .= 'lowercase+non+incluso';
preg_match($contains_special, $password) or $msg .= 'special+non+incluso';
preg_match($contains_uppercase, $password) or $msg .= 'uppercase+non+incluso';
preg_match($contains_digit, $password) or $msg .= 'digit+non+inclusa';
if ($msg != '') {
    header('Location: ../index.php?err=' . $msg);
    die(str_replace('+', ' ', $msg));
}

if (empty($cf)) {
    header('Location: ../index.php?err=c.f.+non+inserito');
    die('c.f. non inserito');
}
if (strlen($cf) > $cf_maxlength) {
    header('Location: ../index.php?err=cf+supera+la+lunghezza+massima+consentita:+' . $cf_maxlength);
    die('cf supera la lunghezza massima consentita: ' . $cf_maxlength);
}
if (!preg_match($cf_regex, $cf)) {
    header('Location: ../index.php?err=c.f.+non+corretto');
    die('c.f. non corretto');
}

if (empty($pec)) {
    header('Location: ../index.php?err=pec+non+inserita');
    die('pec non inserita');
}
if (strlen($pec) > $pec_maxlength) {
    header('Location: ../index.php?err=pec+supera+la+lunghezza+massima+consentita:+' . $pec_maxlength);
    die('pec supera la lunghezza massima consentita: ' . $pec_maxlength);
}
if (!preg_match($pec_regex, $pec)) {
    header('Location: ../index.php?err=pec+non+corretta');
    die('pec non corretta');
}

if (empty($piva)) {
    header('Location: ../index.php?err=p.+iva+non+inserita');
    die('p. iva non inserita');
}
if (strlen($piva) > $piva_maxlength) {
    header('Location: ../index.php?err=p.+iva+supera+la+lunghezza+massima+consentita:+' . $piva_maxlength);
    die('p. iva supera la lunghezza massima consentita: ' . $piva_maxlength);
}
if (!preg_match($piva_regex, $piva)) {
    header('Location: ../index.php?err=p.+iva+non+corretta');
    die('p. iva non corretta');
}

if (!empty($website)) {
    if (strlen($website) > $website_maxlength) {
        header('Location: ../index.php?err=sito+web+supera+la+lunghezza+massima+consentita:+' . $website_maxlength);
        die('sito web supera la lunghezza massima consentita: ' . $website_maxlength);
    }
    if (!preg_match($website_regex, $website)) {
        header('Location: ../index.php?err=sito+web+non+corretto');
        die('sito web non corretto');
    }
} else $website = null;

if (empty($name)) {
    header('Location: ../index.php?err=nome+non+inserito');
    die('nome non inserito');
}
if (strlen($name) > $expert_name_maxlength) {
    header('Location: ../index.php?err=nome+supera+la+lunghezza+massima+consentita:+' . $username_maxlength);
    die('nome supera la lunghezza massima consentita: ' . $expert_name_maxlength);
}
if (!preg_match($expert_name_regex, $name)) {
    header('Location: ../index.php?err=nome+non+corretto');
    die('nome non corretto');
}

if (empty($surname)) {
    header('Location: ../index.php?err=cognome+non+inserito');
    die('cognome non inserito');
}
if (strlen($surname) > $expert_surname_maxlength) {
    header('Location: ../index.php?err=cognome+supera+la+lunghezza+massima+consentita:+' . $expert_surname_maxlength);
    die('cognome supera la lunghezza massima consentita: ' . $expert_surname_maxlength);
}
if (!preg_match($expert_surname_regex, $surname)) {
    header('Location: ../index.php?err=cognome+non+corretto');
    die('cognome non corretto');
}

if (empty($city)) {
    header('Location: ../index.php?err=città+non+inserita');
    die('città non inserita');
}
if (strlen($city) > $expert_city_maxlength) {
    header('Location: ../index.php?err=citta+supera+la+lunghezza+massima+consentita:+' . $expert_city_maxlength);
    die('citta supera la lunghezza massima consentita: ' . $expert_city_maxlength);
}
if (!preg_match($expert_city_regex, $city)) {
    header('Location: ../index.php?err=citta+non+corretta');
    die('citta non corretta');
}

if (empty($date)) {
    header('Location: ../index.php?err=data+non+inserita');
    die('data non inserita');
}
if (!strtotime($date) or !checkdate($month, $day, $year)) {
    header('Location: ../index.php?err=data+non+corretta');
    die('data non corretta');
}
if ($calculated_age < 18) {
    header('Location: ../index.php?err=l\'+esperto+deve+essere+maggiorenne');
    die('l\'esperto deve essere maggiorenne');
}

if (empty($accept_conditions) or !preg_match($accept_conditions_regex, $accept_conditions)) {
    header('Location: ../index.php?err=condizioni+non+accettate');
    die('condizioni non accettate');
}

$query = 'SELECT * FROM utenti WHERE username = ? OR pec = ? OR cf = ? OR piva = ?';
$statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
mysqli_stmt_bind_param($statement, 'ssss', $username, $pec, $cf, $piva) or die(mysqli_error($connection));
mysqli_stmt_execute($statement) or die(mysqli_error($connection));
if (mysqli_stmt_fetch($statement)) {
    mysqli_stmt_close($statement) or die(mysqli_error($connection));
    header('Location: ../index.php?err=utente+gia+esistente');
    die('utente già esistente');
}
mysqli_stmt_close($statement) or die(mysqli_error($connection));

$hash = password_hash($password, PASSWORD_BCRYPT);

$query = 'INSERT INTO utenti(username, password, pec, cf, piva, sito_web)
                VALUES (?, ?, ?, ?, ?, ?)';
$statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
mysqli_stmt_bind_param($statement, 'ssssss', $username, $hash, $pec, $cf, $piva, $website) or die(mysqli_error($connection));
mysqli_stmt_execute($statement) or die(mysqli_error($connection));
mysqli_stmt_close($statement) or die(mysqli_error($connection));

$query = 'INSERT INTO esperti(username, nome, cognome, citta_nascita, data_nascita)
                VALUES (?, ?, ?, ?, ?)';
$statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
mysqli_stmt_bind_param($statement, 'sssss', $username, $name, $surname, $city, $date) or die(mysqli_error($connection));
mysqli_stmt_execute($statement) or die(mysqli_error($connection));
mysqli_stmt_close($statement) or die(mysqli_error($connection));

//require_once('../includes/close_connection.php');
header('Location: ../index.php?msg=utente+esperto+registrato+con+successo');
