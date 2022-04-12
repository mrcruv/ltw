<?php
require_once('config.php');
global $connection;
mysqli_close($connection) or die(mysqli_error($connection));
