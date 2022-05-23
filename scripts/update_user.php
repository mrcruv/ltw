<?php
global $connection;
global $entity_cf_regex, $entity_pec_regex, $entity_piva_regex,
                          $entity_website_regex, $entity_name_regex, $entity_type_regex;
global $expert_cf_regex, $expert_pec_regex, $expert_piva_regex,
      $expert_website_regex;
require_once('../includes/open_connection.php');
require_once('../includes/regex.php');
require_once('../includes/session.php');

$username = $_SESSION['username'];
$usertype = $_SESSION['usertype'];

$cf_regex = $usertype == 'ente' ? $entity_cf_regex : $expert_cf_regex;
$pec_regex = $usertype == 'ente' ? $entity_pec_regex : $expert_pec_regex;
$piva_regex = $usertype == 'ente' ? $entity_piva_regex : $expert_piva_regex;
$website_regex = $usertype == 'ente' ? $entity_website_regex : $expert_website_regex;
$name_regex = $usertype == 'ente' ? $entity_name_regex : null;
$type_regex = $usertype == 'ente' ? $entity_type_regex : null;

$new_cf = isset($_GET['new_cf']) ? trim($_GET['new_cf']) : false;
$new_piva = isset($_GET['new_piva']) ? trim($_GET['new_piva']) : false;
$new_website = isset($_GET['new_website']) ? trim($_GET['new_website']) : false;
$new_pec = isset($_GET['new_pec']) ? trim($_GET['new_pec']) : false;
$new_entity_name = isset($_GET['new_entity_name']) ? trim($_GET['new_entity_name']) : false;
$new_entity_type = isset($_GET['new_entity_type']) ? trim($_GET['new_entity_type']) : false;



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
        $query = 'UPDATE enti SET tipo = ? WHERE username = ?';
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

