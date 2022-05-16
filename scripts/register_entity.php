<?php
global $connection;
require_once('../includes/open_connection.php');
if (!isset($_POST['register_entity_submit'])) {
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

$username = isset($_POST['entity_username']) ? trim($_POST['entity_username']) : false;
$password = isset($_POST['entity_password']) ? trim($_POST['entity_password']) : false;
$cf = isset($_POST['entity_cf']) ? strtoupper(trim($_POST['entity_cf'])) : false;
$pec = isset($_POST['entity_pec']) ? strtolower(trim($_POST['entity_pec'])) : false;
$piva = isset($_POST['entity_piva']) ? trim($_POST['entity_piva']) : false;
$website = isset($_POST['entity_website']) ? strtolower(trim($_POST['entity_website'])) : false;
$company_name = isset($_POST['entity_name']) ? trim($_POST['entity_name']) : false;
$type = isset($_POST['type']) ? strtolower(trim($_POST['type'])) : false;
$accept_conditions = isset($_POST['entity_term']) ? strtolower(trim($_POST['entity_term'])) : false;

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

if (empty($company_name)) {
    header('Location: ../index.php?err=denominazione+non+inserita');
    die('denominazione non inserita');
}
if (!preg_match($name_regex, $company_name)) {
    header('Location: ../index.php?err=denominazione+non+corretta');
    die('denominazione non corretta');
}

if (empty($type)) {
    header('Location: ../index.php?err=tipo+non+inserito');
    die('tipo non inserito');
}
if ($type != 'pubblico' and $type != 'privato') {
    header('Location: ../index.php?err=tipo+non+corretto');
    die('tipo non corretto');
}

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

$query = 'INSERT INTO enti(username, denominazione, tipo)
                VALUES (?, ?, ?)';
$statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
mysqli_stmt_bind_param($statement, 'sss', $username, $company_name, $type) or die(mysqli_error($connection));
mysqli_stmt_execute($statement) or die(mysqli_error($connection));
mysqli_stmt_close($statement) or die(mysqli_error($connection));

//require_once('../includes/close_connection.php');
header('Location: ../index.php?msg=utente+ente+registrato+con+successo');
