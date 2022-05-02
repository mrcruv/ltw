<?php
global $sitename, $connection, $paths;
require_once("includes/info.php");
require_once($paths["open_connection"]);
if (!isset($_SESSION))
{
    session_start();
}
if (!isset($_SESSION["username"])) {
    header ("Location: " . $paths["index"]);
}
$username = $_SESSION["username"];
$usertype = $_SESSION["usertype"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="keywords" content=""/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <title><?php echo($sitename . " - " . $username); ?></title>
</head>
<body class="d-flex flex-column min-vh-100">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <?php require_once($paths["header"]); ?>

    <?php require_once($paths["session"]); ?>

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

    <form id="update_password_form" action="<?php echo($paths["update_password"]); ?>" method="post" onsubmit="return true;">
        <div>
            <input type="password" id="old_password" placeholder="Password attuale" name="old_password"/>
        </div>
        <div>
            <input type="password" id="new_password" placeholder="Nuova password" name="new_password"/>
        </div>
        <button type="submit" name="update_password_submit">Cambia password</button>
    </form>

    <?php require_once($paths["footer"]); ?>
</body>
</html>
