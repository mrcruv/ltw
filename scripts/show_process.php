<?php
require_once("includes/open_connection.php");
global $connection;

if(!isset($_SESSION))
{
    session_start();
}

$username = $_SESSION["username"];

$query = "SELECT nome, tipologia, descrizione FROM processi WHERE ente=?";
$statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
mysqli_stmt_bind_param($statement, 's', $username) or die(mysqli_error($connection));
mysqli_stmt_execute($statement) or die(mysqli_error($connection));
mysqli_stmt_bind_result($statement, $name, $type, $description);
echo("<table>");
echo("<tr><th>NOME</th><th>TIPOLOGIA</th><th>DESCRIZIONE</th></tr>");
while (mysqli_stmt_fetch($statement)) {
    echo("<tr>");
    echo("<td>" . $name . "</td>");
    echo("<td>" . $type . "</td>");
    echo("<td>" . $description . "</td>");
    echo("</tr>");
}
echo("</table>");

require_once("includes/close_connection.php");
