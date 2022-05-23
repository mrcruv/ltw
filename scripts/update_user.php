<?php
global $connection;
require_once('../includes/open_connection.php');
require_once('../includes/session.php');

$cf_regex = '/[A-Za-z]{6}[0-9lmnpqrstuvLMNPQRSTUV]{2}[abcdehlmprstABCDEHLMPRST]{1}[0-9lmnpqrstuvLMNPQRSTUV]{2}[A-Za-z]{1}[0-9lmnpqrstuvLMNPQRSTUV]{3}[A-Za-z]{1}/';
$pec_regex = '/(?:\w*.?pec(?:.?\w+)*)/';
$piva_regex = '/^[0-9]{11}$/';
$website_regex = '/^((https?|ftp|smtp):\/\/)(www.)[a-z0-9]+\.[a-z]+(\/[a-zA-Z0-9#]+\/?)*$/';
$name_regex = '/^[a-zA-Z0-9]{1,30}$/';
$type_regex = '/^(pubblico|privato)$/';

$username = isset($_POST['entity_username']) ? trim($_POST['entity_username']) : false;
$password = isset($_POST['entity_password']) ? trim($_POST['entity_password']) : false;
$cf = isset($_POST['entity_cf']) ? strtoupper(trim($_POST['entity_cf'])) : false;
$pec = isset($_POST['entity_pec']) ? strtolower(trim($_POST['entity_pec'])) : false;
$piva = isset($_POST['entity_piva']) ? trim($_POST['entity_piva']) : false;
$website = isset($_POST['entity_website']) ? strtolower(trim($_POST['entity_website'])) : false;
$company_name = isset($_POST['entity_name']) ? trim($_POST['entity_name']) : false;
$type = isset($_POST['type']) ? strtolower(trim($_POST['type'])) : false;
$accept_conditions = isset($_POST['entity_term']) ? strtolower(trim($_POST['entity_term'])) : false;


$username = $_SESSION['username'];
$usertype = $_SESSION['usertype'];
$new_cf = isset($_GET['new_cf']) ? trim($_GET['new_cf']) : false;
$new_piva = isset($_GET['new_piva']) ? trim($_GET['new_piva']) : false;
$new_website = isset($_GET['new_website']) ? trim($_GET['new_website']) : false;
$new_pec = isset($_GET['new_pec']) ? trim($_GET['new_pec']) : false;
$new_entity_name = isset($_GET['new_entity_name']) ? trim($_GET['new_entity_name']) : false;
$new_entity_type = isset($_GET['new_entity_type']) ? trim($_GET['new_entity_type']) : false;


$query = 'SELECT ? FROM utenti WHERE username=?';
$result =  mysqli_query($connection, $query) or die(mysqli_error($connection));
$num_rows = mysqli_num_rows($result);
if ($num_rows <= 0) {
    header('Location: ../me.php?err=utente+non+esistente');
    die('utente non esistente');
}
else {
    $msg = 'informazioni aggiornate con successo: ';
    if (!empty($new_cf)) {
        if (!preg_match($cf_regex, $new_cf)) {
            header('Location: ../me.php?err=c.f.+non+corretto');
            die('c.f. non corretto');
        }
        $query = 'UPDATE utenti SET cf = ? WHERE username = ?';
        $statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
        mysqli_stmt_bind_param($statement, 'ss', $new_cf, $username) or die(mysqli_error($connection));
        mysqli_stmt_execute($statement) or die(mysqli_error($connection));
        mysqli_stmt_close($statement) or die(mysqli_error($connection));
        $msg . 'cf, ';
    }
    if (!empty($new_piva)) {
        if (!preg_match($piva_regex, $new_piva)) {
            header('Location: ../me.php?err=p.+iva+non+corretta');
            die('p. iva non corretta');
        }
        $query = 'UPDATE utenti SET piva = ? WHERE username = ?';
        $statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
        mysqli_stmt_bind_param($statement, 'ss', $new_piva, $username) or die(mysqli_error($connection));
        mysqli_stmt_execute($statement) or die(mysqli_error($connection));
        mysqli_stmt_close($statement) or die(mysqli_error($connection));
        $msg . 'piva, ';
    }
    if (!empty($new_website))
        if (!preg_match($website_regex, $new_website)) {
            header('Location: ../me.php?err=sito+web+non+corretto');
            die('sito web non corretto');
        }{
        $query = 'UPDATE utenti SET sito_web = ? WHERE username = ?';
        $statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
        mysqli_stmt_bind_param($statement, 'ss', $new_website, $username) or die(mysqli_error($connection));
        mysqli_stmt_execute($statement) or die(mysqli_error($connection));
        mysqli_stmt_close($statement) or die(mysqli_error($connection));
        $msg . 'sito web, ';
    }
    if (!empty($new_pec)) {
        if (!preg_match($pec_regex, $new_pec)) {
            header('Location: ../me.php?err=pec+non+corretta');
            die('pec non corretta');
        }
        $query = 'UPDATE utenti SET pec = ? WHERE username = ?';
        $statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
        mysqli_stmt_bind_param($statement, 'ss', $new_pec, $username) or die(mysqli_error($connection));
        mysqli_stmt_execute($statement) or die(mysqli_error($connection));
        mysqli_stmt_close($statement) or die(mysqli_error($connection));
        $msg . 'pec, ';
    }
    if($usertype == 'ente') {
        if (!empty($new_entity_name)) {
            if (!preg_match($name_regex, $new_entity_name)) {
                header('Location: ../me.php?err=denominazione+non+corretta');
                die('denominazione non corretta');
            }
            $query = 'UPDATE enti SET denominazione = ? WHERE username = ?';
            $statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
            mysqli_stmt_bind_param($statement, 'ss', $new_cf, $username) or die(mysqli_error($connection));
            mysqli_stmt_execute($statement) or die(mysqli_error($connection));
            mysqli_stmt_close($statement) or die(mysqli_error($connection));
            $msg . 'denominazione, ';
        }
        if (!empty($new_entity_type)) {
            if (!preg_match($type_regex, $new_entity_type)) {
                header('Location: ../me.php?err=tipo+ente+non+corretto');
                die('tipo ente non corretto');
            }
            $query = 'UPDATE enti SET denominazione = ? WHERE username = ?';
            $statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
            mysqli_stmt_bind_param($statement, 'ss', $new_entity_type, $username) or die(mysqli_error($connection));
            mysqli_stmt_execute($statement) or die(mysqli_error($connection));
            mysqli_stmt_close($statement) or die(mysqli_error($connection));
            $msg . 'tipo ente, ';
        }
    }
    $msg = substr($msg, 0, -2);
    $msg .= '.';
    header('Location: ../me.php?msg='. $msg);
}
