<?php
global $connection;
global $contains_lowercase, $contains_uppercase, $contains_special, $contains_digit,
       $username_regex, $cf_regex, $pec_regex, $piva_regex, $website_regex,
       $entity_name_regex, $entity_type_regex, $accept_conditions_regex;
global $username_maxlength, $password_minlength, $password_maxlength, $cf_maxlength,
       $pec_maxlength, $piva_maxlength, $website_maxlength, $entity_name_maxlength;
require_once('../includes/open_connection.php');
require_once('../includes/regex.php');
require_once('../includes/lengths.php');
if (!isset($_POST['register_entity_submit'])) {
    header('Location: ../index.php?err=errore+register+entity+submit');
    die('errore register entity submit');
}

$username = isset($_POST['entity_username']) ? trim($_POST['entity_username']) : false;
$password = isset($_POST['entity_password']) ? trim($_POST['entity_password']) : false;
$cf = isset($_POST['entity_cf']) ? strtoupper(trim($_POST['entity_cf'])) : false;
$pec = isset($_POST['entity_pec']) ? strtolower(trim($_POST['entity_pec'])) : false;
$piva = isset($_POST['entity_piva']) ? trim($_POST['entity_piva']) : false;
$website = isset($_POST['entity_website']) ? strtolower(trim($_POST['entity_website'])) : false;
$entity_name = isset($_POST['entity_name']) ? trim($_POST['entity_name']) : false;
$type = isset($_POST['type']) ? strtolower(trim($_POST['type'])) : false;
$accept_conditions = isset($_POST['entity_term']) ? strtolower(trim($_POST['entity_term'])) : false;

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
}

if (empty($entity_name)) {
    header('Location: ../index.php?err=denominazione+non+inserita');
    die('denominazione non inserita');
}
if (strlen($entity_name) > $entity_name_maxlength) {
    header('Location: ../index.php?err=denominazione+supera+la+lunghezza+massima+consentita:+' . $entity_name_maxlength);
    die('denominazione supera la lunghezza massima consentita: ' . $entity_name_maxlength);
}
if (!preg_match($entity_name_regex, $entity_name)) {
    header('Location: ../index.php?err=denominazione+non+corretta');
    die('denominazione non corretta');
}

if (empty($type)) {
    header('Location: ../index.php?err=tipo+non+inserito');
    die('tipo non inserito');
}
if (!preg_match($entity_type_regex, $type)) {
    header('Location: ../index.php?err=tipo+non+corretto');
    die('tipo non corretto');
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

$query = 'INSERT INTO enti(username, denominazione, tipo)
                VALUES (?, ?, ?)';
$statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
mysqli_stmt_bind_param($statement, 'sss', $username, $entity_name, $type) or die(mysqli_error($connection));
mysqli_stmt_execute($statement) or die(mysqli_error($connection));
mysqli_stmt_close($statement) or die(mysqli_error($connection));

//require_once('../includes/close_connection.php');
header('Location: ../index.php?msg=utente+ente+registrato+con+successo');
