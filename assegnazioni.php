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
                echo("<td>" . $array[$i]["name"] . "</td>");
                echo("</option>");
            }
            ?>
        </select>
    </div>

    </div>
    <div>
    <label for="expert">Esperto</label>
    <input type="text" id="expert" placeholder="Inserisci esperto" name="expert">
    </div>
    <button type="submit" name="add_availability_submit">Aggiungi assegnazione</button>
</form>

<?php //require_once 'scripts/show_availability.php'; ?>

<?php require_once 'includes/footer.php'; ?>
</body>
</html>