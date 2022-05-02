<?php
global $sitename, $connection, $paths;
require_once("includes/info.php");
if (!isset($_SESSION))
{
    session_start();
}
if (!isset($_SESSION["usertype"]) or $_SESSION["usertype"] != "ente") {
    header ("Location: " . $paths["me"]);
}
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

    <title><?php echo($sitename); ?></title>
</head>
<body class="d-flex flex-column min-vh-100">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <?php require_once($paths["header"]); ?>

    <?php require_once($paths["session"]); ?>

    <form id="add_process_form" action="scripts/add_process.php" method="post">
        <div
        <label for="process_name">Nome processo</label>
        <input type="text" id="process_name" placeholder="Inserisci nome processo" name="name">
        </div>
        <div
        <label for="process_type">Tipo processo</label>
        <input type="text" id="process_type" placeholder="Inserisci tipologia processo" name="type">
        </div>
        <div
        <label for="process_description">Descrizione processo</label>
        <input type="text" id="process_description" placeholder="Inserisci descrizione processo" name="description">
        </div>
        <button type="submit" name="add_process_submit">Aggiungi processo</button>
    </form>

    <?php
    require_once($paths["show_process"]);
    echo("<table>");
    echo("<tr><th>NOME</th><th>TIPOLOGIA</th><th>DESCRIZIONE</th></tr>");
    $array = show_all_processes($_SESSION["username"]);
    $n = count($array);
    if (!is_array($array) or $n <= 0) {
        echo('<tr><td colspan="3">NON CI SONO PROCESSI AL MOMENTO</td></tr>');
    }
    else {
        for ($i = 0; $i < $n; $i += 1) {
            echo("<tr>");
            echo("<td>" . $array[$i]["name"] . "</td>");
            echo("<td>" . $array[$i]["type"] . "</td>");
            echo("<td>" . $array[$i]["description"] . "</td>");
            echo("</tr>");
        }
    }
    echo("</table>");
    ?>

    <?php require_once($paths["footer"]); ?>
</body>
</html>
