<?php
global $connection;
require_once('config.php');
mysqli_close($connection) or die(mysqli_error($connection));
