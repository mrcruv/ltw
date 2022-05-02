<?php
global $sitename, $paths;
require_once("includes/info.php");
if (!isset($_SESSION))
{
    session_start();
}
if (!isset($_SESSION["usertype"]) or $_SESSION["usertype"] != "esperto") {
    header ("Location: " . $paths["me"]);
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

    <form id="add_competence_form" action="<?php echo($paths["add_competence"]); ?>" method="post">
        <div>
            <label for="competence_name">Nome competenza</label>
            <input type="text" id="competence_name" placeholder="Inserisci nome" name="name">
        </div>
        <div>
            <label for="competence_area">Settore competenza</label>
            <input type="text" id="competence_area" placeholder="Inserisci settore" name="area">
        </div>
        <div>
            <label for="competence_description">Descrizione</label>
            <input type="text" id="competence_description" placeholder="Inserisci descrizione" name="description">
        </div>
        <button type="submit" name="add_competence_submit">Aggiungi competenza</button>
    </form>

    <?php
    require_once($paths["show_competence"]);
    echo("<table>");
    echo("<tr><th>COMPETENZA</th><th>SETTORE</th><th>DESCRIZIONE</th></tr>");
    $array = show_all_competences($_SESSION["username"]);
    $n = count($array);
    if (!is_array($array) or $n <= 0) {
        echo('<tr><td colspan="3">NON CI SONO COMPETENZE AL MOMENTO</td></tr>');
    }
    else {
        for ($i = 0; $i < $n; $i += 1) {
            echo("<tr>");
            echo("<td>" . $array[$i]["name"] . "</td>");
            echo("<td>" . $array[$i]["area"] . "</td>");
            echo("<td>" . $array[$i]["description"] . "</td>");
            echo("</tr>");
        }
    }
    echo("</table>");
    ?>

    <?php require_once($paths["footer"]); ?>
</body>
</html>
