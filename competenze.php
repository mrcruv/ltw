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

<form id="add_competence_form" action="scripts/add_competence.php" method="post">
    <div
    <label for="competence_name">Nome competenza</label>
    <input type="text" id="competence_name" placeholder="Inserisci nome" name="name">
    </div>
    <div
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
    require_once 'scripts/show_competence.php';
    echo("<table>");
    echo("<tr><th>COMPETENZA</th><th>SETTORE</th><th>DESCRIZIONE</th></tr>");
    $array = show_all_competences();
    $n = count($array);
    for ($i = 0; $i < $n; $i += 1) {
        echo("<tr>");
        echo("<td>" . $array[$i]["name"] . "</td>");
        echo("<td>" . $array[$i]["area"] . "</td>");
        echo("<td>" . $array[$i]["description"] . "</td>");
        echo("</tr>");
    }
    echo("</table>");
    ?>

<?php require_once 'includes/footer.php'; ?>
</body>
</html>