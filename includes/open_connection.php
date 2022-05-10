<?php
global $host, $port, $db, $username, $password;
require_once('config.php');
$connection = mysqli_connect($host, $username, $password, $db, $port) or die(mysqli_error($connection));

