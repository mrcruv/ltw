<?php
$msg = isset($_GET['msg']) ? trim($_GET['msg']) : false;
session_start();
session_unset();
session_destroy();
if (!empty($msg)) header('Location: ../index.php?msg=' . str_replace('%20', '+', $msg));
else header('Location: ../index.php?msg=logout+effettuato+con+successo');

