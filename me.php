<?php
require_once 'includes/info.php';
require_once("includes/open_connection.php");
global $sitename, $connection;
if(!isset($_SESSION))
{
    session_start();
}
$username = $_SESSION["username"];
$usertype = $_SESSION["usertype"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="keywords" content=""/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo($sitename . " - " . $username); ?></title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>
<body class="d-flex flex-column min-vh-100">
    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <?php require_once 'includes/header.php'; ?>

    <?php require_once 'scripts/session.php'; ?>

    <?php
    $query = "SELECT piva, cf, sito_web, pec FROM utenti WHERE username=?";
    $statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
    mysqli_stmt_bind_param($statement, 's', $username) or die(mysqli_error($connection));
    mysqli_stmt_execute($statement) or die(mysqli_error($connection));
    mysqli_stmt_bind_result($statement, $piva, $cf, $website, $pec);
    if (mysqli_stmt_fetch($statement)) {
        echo("username: " . $username . "<br>");
        echo("codice fiscale: " . $cf . "<br>");
        echo("partita IVA: " . $piva . "<br>");
        echo("sito web: " . $website . "<br>");
        echo("PEC: " . $pec . "<br>");
        echo("tipo utente: " . $usertype . "<br>");
    }
    else echo("error");
    mysqli_stmt_close($statement);

    if ($usertype == 'ente') {
        $query = "SELECT denominazione, tipo FROM enti WHERE username=?";
        $statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
        mysqli_stmt_bind_param($statement, 's', $username) or die(mysqli_error($connection));
        mysqli_stmt_execute($statement) or die(mysqli_error($connection));
        mysqli_stmt_bind_result($statement, $name, $type);
        if (mysqli_stmt_fetch($statement)) {
            echo("denominazione ente: " . $name . "<br>");
            echo("tipo ente: " . $type . "<br>");
        }
        else echo("error");
    }
    else {
        $query = "SELECT nome, cognome, citta_nascita, data_nascita FROM esperti WHERE username=?";
        $statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
        mysqli_stmt_bind_param($statement, 's', $username) or die(mysqli_error($connection));
        mysqli_stmt_execute($statement) or die(mysqli_error($connection));
        mysqli_stmt_bind_result($statement, $name, $surname, $city, $date);
        if (mysqli_stmt_fetch($statement)) {
            echo("nome e cognome esperto: " . $name . " " . $surname . "<br>");
            echo("città e data di nascita: " . $city . ", " . $date . "<br>");
        }
        else echo("error");
    }
    mysqli_stmt_close($statement);
    ?>

    <?php require_once 'includes/footer.php'; ?>

</body>
</html>
