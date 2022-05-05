<?php
global $sitename, $paths;
require_once("includes/info.php");
if (!isset($_SESSION))
{
    session_start();
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

    <title><?php echo($sitename); ?></title>
</head>
<body class="d-flex flex-column min-vh-100">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <?php require_once($paths["header"]); ?>

    <?php require_once($paths["session"]); ?>

    <?php if ($_SESSION["usertype"] == 'ente'): ?>
    <form id="add_availability_form" action="<?php echo($paths["add_availability"]); ?>" method="post">
        <div>
            <label for="process">Processo</label>
            <div>
                <select id="availability_process" name="process">
                    <option selected>Scegli il processo</option>
                    <?php
                    require_once($paths["show_process"]);
                    $array = show_all_processes($_SESSION["username"]);
                    $n = count($array);
                    for ($i = 0; $i < $n; $i += 1) {
                        echo("<option value=");
                        echo($array[$i]["name"]);
                        echo(">");
                        echo($array[$i]["name"]);
                        echo("</option>");
                    }
                    ?>
                </select>
            </div>
        </div>

        <div>
            <label for="expert">Esperto</label>
            <div>
                <select id="availability_expert" name="expert">
                    <option selected>Scegli l'esperto</option>
                    <?php
                    require_once($paths["show_expert"]);
                    $array = show_all_experts();
                    $n = count($array);
                    for ($i = 0; $i < $n; $i += 1) {
                        echo("<option value=");
                        echo($array[$i]["username"]);
                        echo(">");
                        echo($array[$i]["username"]);
                        echo("</option>");
                    }
                    ?>
                </select>
            </div>
        </div>
        <button type="submit" name="add_availability_submit">Aggiungi assegnazione</button>
    </form>

    <?php
    require_once($paths["show_availability"]);
    echo("<table>");
    echo("<tr><th>PROCESSO</th><th>ESPERTO</th><th>DATA RICHIESTA</th>
    <th>DATA ASSEGNAZIONE</th><th>DATA RIFIUTO</th><th>STATO</th></tr>");
    $array = show_all_availabilities_from_entity($_SESSION["username"]);
    $n = count($array);
    if (!is_array($array) or $n <= 0) {
        echo('<tr><td colspan="5">NON CI SONO ASSEGNAZIONI AL MOMENTO</td></tr>');
    }
    else {
        for ($i = 0; $i < $n; $i += 1) {
            echo("<tr>");
            echo("<td>" . $array[$i]["process"] . "</td>");
            echo("<td>" . $array[$i]["expert"] . "</td>");
            echo("<td>" . $array[$i]["request_date"] . "</td>");
            echo("<td>" . $array[$i]["allocation_date"] . "</td>");
            echo("<td>" . $array[$i]["rejection_date"] . "</td>");
            if (is_null($array[$i]["allocation_date"])) {
                if (is_null($array[$i]["rejection_date"])) {
                    echo("<td>" . "assegnazione pendente" . "</td>");
                }
                else {
                    echo("<td>" . "assegnazione rifiutata" . "</td>");
                }
            }
            else {
                echo("<td>" . "assegnazione accettata" . "</td>");
            }
            echo("</tr>");
        }
    }
    echo("</table>");
    ?>

    <?php else: ?>

    <?php
    require_once($paths["show_availability"]);
    echo("<table>");
    echo("<tr><th>PROCESSO</th><th>ENTE</th><th>DATA RICHIESTA</th>
        <th>DATA ASSEGNAZIONE</th><th>DATA RIFIUTO</th><th>STATO</th><th></th></tr>");
    $array = show_all_availabilities_from_expert($_SESSION["username"]);
    $n = count($array);
    if (!is_array($array) or $n <= 0) {
        echo('<tr><td colspan="5">NON CI SONO ASSEGNAZIONI AL MOMENTO</td></tr>');
    }
    else {
        for ($i = 0; $i < $n; $i += 1) {
            echo("<tr>");
            echo("<td>" . $array[$i]["process"] . "</td>");
            echo("<td>" . $array[$i]["entity"] . "</td>");
            echo("<td>" . $array[$i]["request_date"] . "</td>");
            echo("<td>" . $array[$i]["allocation_date"] . "</td>");
            echo("<td>" . $array[$i]["rejection_date"] . "</td>");
            if (is_null($array[$i]["allocation_date"])) {
                if (is_null($array[$i]["rejection_date"])) {
                    echo("<td>" . "assegnazione pendente" . "</td>");
                    echo("<td><a href=\"scripts/accept_reject.php?action=accept&process=" . $array[$i]["process"] . "\">");
                    echo("<button type='button'>accetta</button></a>");
                    echo("<a href=\"scripts/accept_reject.php?action=reject&process=" . $array[$i]["process"] . "\">");
                    echo("<button type='button'>rifiuta</button></a>" . "</td>");
                }
                else {
                    echo("<td>" . "assegnazione rifiutata" . "</td>");
                }
            }
            else {
                echo("<td>" . "assegnazione accettata" . "</td>");
            }
        }
    }
    echo("</table>");
    ?>
    <?php endif ?>

    <?php require_once($paths["footer"]); ?>
</body>
</html>