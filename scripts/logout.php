<?php
// remove all session variables
session_unset();
// destroy the session
session_destroy();
//Reindirizza alla home page
header("location: ../index.php");

