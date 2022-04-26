<?php
require_once("includes/open_connection.php");
global $connection;

if(!isset($_SESSION))
{
    session_start();
}

$username = $_SESSION["username"];

$query = "SELECT titolo, data_conseguimento, note, voto FROM titoli_esperti WHERE esperto=?";
$statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
mysqli_stmt_bind_param($statement, 's', $username) or die(mysqli_error($connection));
mysqli_stmt_execute($statement) or die(mysqli_error($connection));
mysqli_stmt_bind_result($statement, $name, $date, $notes, $grade);
echo("<table>");
echo("<tr><th>NOME</th><th>DATA CONSEGUIMENTO</th><th>NOTE</th><th>VOTO</th></tr>");
while (mysqli_stmt_fetch($statement)) {
    echo("<tr>");
    echo("<td>" . $name . "</td>");
    echo("<td>" . $date . "</td>");
    echo("<td>" . $notes . "</td>");
    echo("<td>" . $grade . "</td>");
    echo("</tr>");
}
echo("</table>");

require_once("includes/close_connection.php");
