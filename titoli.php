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

<form id="add_title_form" action="scripts/add_title.php" method="post">
    <div
    <label for="title_name">Denominazione titolo</label>
    <input type="text" id="title_name" placeholder="Inserisci denominazione" name="name">
    </div>
    <div
    <label for="title_date">Data conseguimento titolo</label>
    <input type="date" id="title_date" placeholder="Inserisci data conseguimento" name="date">
    </div>
    <div
    <label for="title_notes">Note</label>
    <input type="text" id="title_notes" placeholder="Inserisci note" name="notes">
    </div>
    <div>
    <label for="title_grade">Voto</label>
    <input type="number" id="title_grade" placeholder="Inserisci voto" name="grade">
    </div>
    <button type="submit" name="add_title_submit">Aggiungi titolo di studio</button>
</form>

<?php
require_once 'scripts/show_title.php';
echo("<table>");
echo("<tr><th>NOME</th><th>DATA CONSEGUIMENTO</th><th>NOTE</th><th>VOTO</th></tr>");
$array = show_all_titles();
$n = count($array);
for ($i = 0; $i < $n; $i += 1) {
    echo("<tr>");
    echo("<td>" . $array[$i]["name"] . "</td>");
    echo("<td>" . $array[$i]["date"] . "</td>");
    echo("<td>" . $array[$i]["notes"] . "</td>");
    echo("<td>" . $array[$i]["grade"] . "</td>");
    echo("</tr>");
}
echo("</table>");
?>

<?php require_once 'includes/footer.php'; ?>
</body>
</html>