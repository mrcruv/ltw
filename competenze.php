<?php
global $sitename_brief, $authors;
require_once('includes/info.php');
require_once('includes/session.php');
require_once('scripts/show_competence.php');
if (!isset($_SESSION['usertype']) or $_SESSION['usertype'] != 'esperto') {
    header('Location: me.php?err=sessione+utente+esperto+non+attiva');
    die('sessione utente esperto non attiva');
}
$username = $_SESSION['username'];
$usertype = $_SESSION['usertype'];
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="utf-8">
    <meta name="keywords" content="competenze, esperti"/>
    <meta name="description" content="gestione delle competenze degli esperti"/>
    <meta name="author" content="<?php echo(implode(', ', $authors)); ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" type="image/x-icon" href="img/prova_logo.ico">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
    <script src="scripts/validate_add_competence.js"></script>
    <script src="scripts/error.js"></script>
    <script src="scripts/message.js"></script>
    <title><?php echo($sitename_brief . ': competenze - ' . $usertype . ' ' . $username); ?></title>
</head>
<body class="d-flex flex-column min-vh-100">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
<script src="scripts/add_form.js"></script>
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
<div class="container-fluid">
    <div class="row border-bottom border-3 mb-5">
        <h2>Competenze</h2>
    </div>
    <div class="row">
        <div class="col-7">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Competenza</th>
                    <th scope="col">Settore</th>
                    <th scope="col">Descrizione</th>
                    <th class="text-center" scope="col">Azioni</th>
                </tr>
                </thead>
                <tbody>
                <?php $array = show_all_competences($username);
                $n = count($array);
                if (!is_array($array) or $n <= 0): ?>
                    <tr>
                        <td colspan="5"><h6>Non ci sono competenze al momento</h6></td>
                    </tr>
                <?php else:
                    for ($i = 0; $i < $n; $i += 1) { ?>
                        <tr>
                            <td><?php echo($i + 1); ?></td>
                            <td><?php echo($array[$i]['name']); ?></td>
                            <td><?php echo($array[$i]['area']); ?></td>
                            <td><?php echo($array[$i]['description']); ?></td>
                            <td class="text-center">
                                <?php
                                echo('<a class="delete" title="Delete" data-toggle="tooltip" href="scripts/delete_competence.php?name=' . $array[$i]['name'] . '&area=' . $array[$i]['area'] . '">');
                                echo('<i class="material-icons icon-red">&#xE872;</i></a>');
                                ?>
                            </td>
                        </tr>
                    <?php } ?>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="col-1"></div>
        <div class="col-4 text-center mb-2">
            <h5>Aggiungi competenza</h5>
            <a type="button" class="btn btn-info rounded-circle" id="add_button"><i class="fa fa-plus"></i></a>
            <form id="add_competence_form" class="add_form" action="scripts/add_competence.php" method="post">
                <div class="form-group mb-3 mt-4">
                    <label class="hiddenlabel" for="competence_name"></label>
                    <input type="text" id="competence_name" class="form-control" placeholder="Nome competenza"
                           name="name">
                </div>
                <div class="form-group mb-3">
                    <label class="hiddenlabel" for="competence_area"></label>
                    <input type="text" id="competence_area" class="form-control" placeholder="Settore" name="area">
                </div>
                <div class="form-group mb-3">
                    <label class="hiddenlabel" for="competence_description"></label>
                    <textarea class="form-control" id="competence_description" placeholder="Descrizione"
                              name="description" rows="3"></textarea>
                </div class="form-group mb-3">
                <button type="submit" class="btn btn-primary" name="add_competence_submit">Aggiungi</button>
            </form>
        </div>
    </div>
</div>
<?php require_once('includes/footer.php'); ?>
</body>
</html>
