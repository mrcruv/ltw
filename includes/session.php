<?php
if(!isset($_SESSION))
{
    session_start();
}
if(!isset($_SESSION['username'])) {
    header('Location: index.php?err=sessione+utente+non+attiva');
    die('sessione utente non attiva');
}