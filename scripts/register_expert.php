<?php
global $connection;
require_once('../includes/open_connection.php');
if (!isset($_POST['register_submit'])) {
    header ('Location: ../me.php');
}

$contains_lowercase = '/[a-z]/';
$contains_uppercase = '/[A-Z]/';
$contains_special = '/[!@#$%^&*-]/';
$contains_digit = '/[0-9]/';
$username_regex = '/^[a-zA-Z0-9_]{1,30}$/';
$cf_regex = '/[A-Za-z]{6}[0-9lmnpqrstuvLMNPQRSTUV]{2}[abcdehlmprstABCDEHLMPRST]{1}[0-9lmnpqrstuvLMNPQRSTUV]{2}[A-Za-z]{1}[0-9lmnpqrstuvLMNPQRSTUV]{3}[A-Za-z]{1}/';
$pec_regex = '/(?:\w*.?pec(?:.?\w+)*)/';
$piva_regex = '/^[0-9]{11}$/';
$website_regex = '/^((https?|ftp|smtp):\/\/)?(www.)?[a-z0-9]+\.[a-z]+(\/[a-zA-Z0-9#]+\/?)*$/';
$name_regex = '/^[a-zA-Z0-9]{1,30}$/';
//$date_regex = '';

$username = trim($_POST['expert_username']);
$password = trim($_POST['expert_password']);
$cf = strtoupper(trim($_POST['expert_cf']));
$pec = strtolower(trim($_POST['expert_pec']));
$piva = trim($_POST['expert_piva']);
$website = strtolower(trim($_POST['expert_website']));
$accept_conditions = isset($_POST['expert_term']) ? $_POST['expert_term'] : 'no';
$name = trim($_POST['name']);
$surname = trim($_POST['surname']);
$city = trim($_POST['city']);
$date = $_POST['date'];

!empty($username) or header('Location: ../index.php?err=username+non+inserito');
preg_match($username_regex, $username) or header('Location: ../index.php?err=username+non+corretto');

!empty($password) or header('Location: ../index.php?err=password+non+inserita');
$msg = '';
strlen($password) >= 8 or $msg = $msg . 'lunghezza+minima+non+raggiunta';
preg_match($contains_lowercase, $password) or $msg = $msg . 'lowercase+non+incluso';
preg_match($contains_special, $password) or $msg = $msg . 'special+non+incluso';
preg_match($contains_uppercase, $password) or $msg = $msg . 'uppercase+non+incluso';
preg_match($contains_digit, $password) or $msg = $msg . 'digit+non+inclusa';
$msg == '' or header('Location: ../index.php?err=' . $msg);

!empty($cf) or header('Location: ../index.php?err=c.f.+non+inserito');
preg_match($cf_regex, $cf) or header('Location: ../index.php?err=c.f.+non+corretto');

!empty($pec) or header('Location: ../index.php?err=pec+non+inserita');
preg_match($pec_regex, $pec) or header('Location: ../index.php?err=pec+non+corretta');

!empty($piva) or header('Location: ../index.php?err=p.+iva+non+inserita');
preg_match($piva_regex, $piva) or header('Location: ../index.php?err=p.+iva+non+corretta');

if (!empty($website)) preg_match($website_regex, $website) or header('Location: ../index.php?err=sito+web+non+corretto');

!empty($name) or header('Location: ../index.php?err=nome+non+inserito');
preg_match($name_regex, $name) or  header('Location: ../index.php?err=nome+non+corretto');

!empty($surname) or header('Location: ../index.php?err=cognome+non+inserito');
preg_match($name_regex, $surname) or header('Location: ../index.php?err=cognome+non+corretto');

!empty($city) or header('Location: ../index.php?err=città+non+inserita');
preg_match($name_regex, $city) or header('Location: ../index.php?err=città+non+corretta');

//!empty($date) or die('data non inserita');
//preg_match($date_regex, $date) or die('data non corretta');

($accept_conditions == 'yes') or header('Location: ../index.php?err=condizioni+non+accettate');

$query = 'SELECT * FROM utenti WHERE username=? OR pec=? OR cf=? OR piva=?';
$statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
mysqli_stmt_bind_param($statement, 'ssss', $username, $pec, $cf, $piva) or die(mysqli_error($connection));
mysqli_stmt_execute($statement) or die(mysqli_error($connection));
if (mysqli_stmt_fetch($statement)) {
    mysqli_stmt_close($statement) or die(mysqli_error($connection));
    echo('utente già esistente');
    header('Location: ../index.php?err=utente+gia+esistente');
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
header('Location: ../index.php?msg=utente+registrato+con+successo');
