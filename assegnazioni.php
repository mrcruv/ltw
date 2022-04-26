<?php
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
    <title>Title</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>
<body class="d-flex flex-column min-vh-100">
<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<?php require_once 'includes/header.php'; ?>

<?php require_once 'scripts/session.php'; ?>

<?php if ($usertype == 'ente') { ?>
<form id="add_availability_form" action="scripts/add_availability.php" method="post">
    <div>
    <label for="process">Processo</label>
    <div>
        <select id="availability_process" name="process">
            <option selected>Scegli il processo</option>
            <?php
            require_once 'scripts/show_process.php';
            $array = show_all_processes();
            $n = count($array);
            for ($i = 0; $i < $n; $i += 1) {
                echo("<option value='$array[$i]['name']'>");
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
                require_once 'scripts/show_expert.php';
                $array = show_all_experts();
                $n = count($array);
                for ($i = 0; $i < $n; $i += 1) {
                    echo("<option value='$array[$i]['username']'>");
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
    require_once 'scripts/show_availability.php';
    echo("<table>");
    echo("<tr><th>PROCESSO</th><th>ESPERTO</th><th>DATA RICHIESTA</th>
    <th>DATA ASSEGNAZIONE</th><th>DATA RIFIUTO</th></tr>");
    $array = show_all_availabilities_entity();
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
            echo("</tr>");
        }
    }
    echo("</table>");
    ?>

<?php } else { ?>

<?php
require_once 'scripts/show_availability.php';
echo("<table>");
echo("<tr><th>PROCESSO</th><th>ENTE</th><th>DATA RICHIESTA</th>
    <th>DATA ASSEGNAZIONE</th><th>DATA RIFIUTO</th></tr>");
$array = show_all_availabilities_expert();
$n = count($array);
if (!is_array($array) or !isset($array['process'])) {
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
        echo("</tr>");
    }
}
echo("</table>");
?>
<?php } ?>

<?php require_once 'includes/footer.php'; ?>
</body>
</html>