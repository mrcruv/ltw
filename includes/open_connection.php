<?php
require_once('config.php');
global $host, $port, $db, $username, $password;
$connection = mysqli_connect($host, $username, $password, $db, $port) or die(mysqli_error($connection));

