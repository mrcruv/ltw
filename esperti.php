<?php
global $sitename;
require_once('includes/info.php');
require_once('includes/session.php');
require_once('scripts/show_expert.php');
if (!isset($_SESSION['usertype']) or $_SESSION['usertype'] != 'ente') {
    header ('Location: me.php');
}
if (isset($_GET['username']) and !expert_exists($_GET['username'])) {
    header('Location: esperti.php?err=esperto+non+esistente');
    die('esperto non esistente');
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
    <script src="scripts/error.js"></script>
    <script src="scripts/message.js"></script>

    <title><?php echo($sitename); ?></title>
    <link rel="icon" type="image/x-icon" href="img/prova_logo.ico">
</head>
<body class="d-flex flex-column min-vh-100">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <?php
    require_once('includes/error.php');
    require_once('includes/message.php');
    if (isset($_GET['err'])):
        echo('<script>error();</script>');
    endif;
    if (isset($_GET['msg'])):
        echo('<script>message();</script>');
    endif;
    ?>

    <?php require_once('includes/header.php'); ?>

    <?php if (isset($_GET['username'])): ?>
    <div class="container-fluid">
        <h5>Esperto selezionato: <?php echo($_GET['username']); ?></h5>

        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Titolo</th>
                <th scope="col">Data conseguimento</th>
                <th scope="col">Note</th>
                <th scope="col">Voto</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $array = show_expert_title($_GET['username']);
            $n = count($array);
            if (!is_array($array) or $n <= 0): ?>
                <tr><td colspan="6"><h6>L'esperto selezionato non ha inserito titoli di studio al momento</h6></td></tr>
            <?php else: ?>
                <?php for ($i = 0; $i < $n; $i += 1) { ?>
                    <tr>
                        <th scope="row"><?php echo($i+1); ?></th>
                        <td><?php echo($array[$i]['title']); ?></td>
                        <td><?php echo($array[$i]['date']); ?></td>
                        <td><?php echo($array[$i]['notes']); ?></td>
                        <td><?php echo($array[$i]['grade']); ?></td>
                    </tr>
                <?php } ?>
            <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="container-fluid">
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Competenza</th>
                <th scope="col">Descrizione</th>
            </tr>
            </thead>
            <tbody>
            <?php $array = show_expert_competence($_GET['username']);
            $n = count($array);
            if (!is_array($array) or $n <= 0): ?>
                <tr><td colspan="6"><h6>L'esperto selezionato non ha inserito competenze al momento</h6></td></tr>
            <?php else: ?>
                <?php for ($i = 0; $i < $n; $i += 1) { ?>
                    <tr>
                        <th scope="row"><?php echo($i+1); ?></th>
                        <td><?php echo($array[$i]['competence']); ?></td>
                        <td><?php echo($array[$i]['description']); ?></td>
                    </tr>
                <?php } ?>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php endif; ?>

    <div class="container-fluid">

        <h5>Lista di Esperti</h5>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Username</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Cognome</th>
                    <th scope="col">Città di Nascita</th>
                    <th scope="col">Data di Nascita</th>
                </tr>
            </thead>
            <tbody>
            <?php $array = show_all_experts();
            $n = count($array);
            if (!is_array($array) or $n <= 0): ?>
                <tr><td colspan="6"><h6>Non ci sono Esperti al momento</h6></td></tr>
            <?php else: ?>
                <?php for ($i = 0; $i < $n; $i += 1) { ?>
                <tr>
                    <th scope="row"><?php echo($i+1); ?></th>
                    <td><a href="esperti.php?username=<?php echo($array[$i]['username']); ?>"><?php echo($array[$i]['username']); ?></a></td>
                    <td><?php echo($array[$i]['name']); ?></td>
                    <td><?php echo($array[$i]['surname']); ?></td>
                    <td><?php echo($array[$i]['city']); ?></td>
                    <td><?php echo($array[$i]['date']); ?></td>
                </tr>
                <?php } ?>
            <?php endif; ?>
            </tbody>
        </table>
        
    </div>
    
    <?php require_once('includes/footer.php'); ?>
</body>
</html>
