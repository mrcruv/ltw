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

<?php
require_once 'scripts/show_expert.php';
echo("<table>");
echo("<tr><th>USERNAME</th><th>NOME</th><th>COGNOME</th><th>CITTA DI NASCITA</th><th>DATA DI NASCITA</th></tr>");
$array = show_all_experts();
$n = count($array);
if (!is_array($array) or $n <= 0) {
    echo('<tr><td colspan="4">NON CI SONO TITOLI DI STUDIO AL MOMENTO</td></tr>');
}
else {
    for ($i = 0; $i < $n; $i += 1) {
        echo("<tr>");
        echo("<td>" . $array[$i]["username"] . "</td>");
        echo("<td>" . $array[$i]["name"] . "</td>");
        echo("<td>" . $array[$i]["surname"] . "</td>");
        echo("<td>" . $array[$i]["city"] . "</td>");
        echo("<td>" . $array[$i]["date"] . "</td>");
        echo("</tr>");
    }
}
echo("</table>");
?>

<?php require_once 'includes/footer.php'; ?>
</body>
</html>