<?php
global $connection;
require_once('../includes/open_connection.php');
if (!isset($_POST['register_expert_submit'])) {
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
$surname_regex = $name_regex;
//$date_regex = '';

$username = isset($_POST['expert_username']) ? trim($_POST['expert_username']) : false;
$password = isset($_POST['expert_password']) ? trim($_POST['expert_password']) : false;
$cf = isset($_POST['expert_cf']) ? strtoupper(trim($_POST['expert_cf'])) : false;
$pec = isset($_POST['expert_pec']) ? strtolower(trim($_POST['expert_pec'])) : false;
$piva = isset($_POST['expert_piva']) ? trim($_POST['expert_piva']) : false;
$website = isset($_POST['expert_website']) ? strtolower(trim($_POST['expert_website'])) :false;
$accept_conditions = isset($_POST['expert_term']) ? strtolower(trim($_POST['expert_term'])) : false;
$name = isset($_POST['name']) ? trim($_POST['name']) : false;
$surname = isset($_POST['surname']) ? trim($_POST['surname']) : false;
$city = isset($_POST['city']) ? trim($_POST['city']) : false;
$date = isset($_POST['date']) ? trim($_POST['date']) : false;

if (empty($username)) {
    header('Location: ../index.php?err=username+non+inserito');
    die('username non inserito');
}
if (!preg_match($username_regex, $username)) {
    header('Location: ../index.php?err=username+non+corretto');
    die('username non corretto');
}

if (empty($password)) {
    header('Location: ../index.php?err=password+non+inserita');
    die('password non inserita');
}
$msg = '';
strlen($password) >= 8 or $msg .= 'lunghezza+minima+non+raggiunta';
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
if (!preg_match($cf_regex, $cf)) {
    header('Location: ../index.php?err=c.f.+non+corretto');
    die('c.f. non corretto');
}

if (empty($pec)) {
    header('Location: ../index.php?err=pec+non+inserita');
    die('pec non inserita');
}
if (!preg_match($pec_regex, $pec)) {
    header('Location: ../index.php?err=pec+non+corretta');
    die('pec non corretta');
}

if (empty($piva)) {
    header('Location: ../index.php?err=p.+iva+non+inserita');
    die('p. iva non inserita');
}
if (!preg_match($piva_regex, $piva)) {
    header('Location: ../index.php?err=p.+iva+non+corretta');
    die('p. iva non corretta');
}

if (!empty($website) and !preg_match($website_regex, $website)) {
    header('Location: ../index.php?err=sito+web+non+corretto');
    die('sito web non corretto');
}

if (empty($name)){
    header('Location: ../index.php?err=nome+non+inserito');
    die('nome non inserito');
}
if (!preg_match($name_regex, $name)){
    header('Location: ../index.php?err=nome+non+corretto');
    die('nome non corretto');
}

if (empty($surname)){
    header('Location: ../index.php?err=cognome+non+inserito');
    die('cognome non inserito');
}
if (!preg_match($surname_regex, $surname)){
    header('Location: ../index.php?err=cognome+non+corretto');
    die('cognome non corretto');
}

if (empty($city)){
    header('Location: ../index.php?err=città+non+inserita');
    die('città non inserita');
}
if (!preg_match($name_regex, $city)){
    header('Location: ../index.php?err=città+non+corretta');
    die('città non corretta');
}

//if (empty($date)) {
//    header('Location: ../index.php?err=data+non+inserita');
//    die('data non inserita');
//}
//if (!preg_match($date_regex, $date)){
//    header('Location: ../index.php?err=data+non+corretta');
//    die('data non corretta');
//}

if (empty($accept_conditions) or ($accept_conditions != 'true')){
    header('Location: ../index.php?err=condizioni+non+accettate');
    die('condizioni non accettate');
}

$query = 'SELECT * FROM utenti WHERE username=? OR pec=? OR cf=? OR piva=?';
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
