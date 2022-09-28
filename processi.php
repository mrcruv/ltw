<?php
global $sitename_brief, $authors, $connection;
require_once('includes/info.php');
require_once('includes/session.php');
require_once('scripts/show_process.php');
if (!isset($_SESSION['usertype']) or $_SESSION['usertype'] != 'ente') {
    header('Location: me.php?err=sessione+utente+ente+non+attiva');
    die("sessione utente ente non attiva");
}
$username = $_SESSION['username'];
$usertype = $_SESSION['usertype'];
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="utf-8">
    <meta name="keywords" content="processi, processi aziendali, enti, esperti"/>
    <meta name="description" content="gestione dei processi degli enti"/>
    <meta name="author" content="<?php echo(implode(', ', $authors)); ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" type="image/x-icon" href="imgs/prova_logo.ico">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
    <script src="scripts/validate_add_process.js"></script>
    <script src="scripts/error.js"></script>
    <script src="scripts/message.js"></script>
    <title><?php echo($sitename_brief . ': processi - ' . $usertype . ' ' . $username); ?></title>
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
        <h2>Processi - <?php echo($username); ?></h2>
    </div>
    <div class="row">
        <div class="col-lg-8">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Tipologia</th>
                    <th scope="col">Descrizione</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $array = show_all_processes($username);
                $n = count($array);
                if (!is_array($array) or $n <= 0): ?>
                    <tr>
                        <td colspan="4"><h6>Non ci sono processi al momento</h6></td>
                    </tr>
                <?php
                else: ?>
                    <?php
                    for ($i = 0; $i < $n; $i += 1) { ?>
                        <tr>
                            <th scope="row"><?php echo($i + 1); ?></th>
                            <td><?php echo($array[$i]['name']); ?></td>
                            <td><?php echo($array[$i]['type']); ?></td>
                            <td><?php echo($array[$i]['description']); ?></td>
                        </tr>
                    <?php } ?>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="col-lg-4 text-center mb-2">
            <h5>Aggiungi processo</h5>
            <a type="button" class="btn btn-info rounded-circle" id="add_button"><i class="fa fa-plus"></i></a>
            <form id="add_process_form" class="add_form" action="scripts/add_process.php" method="post">
                <div class="form-group mb-3 mt-4">
                    <label class="hiddenlabel" for="process_name"></label>
                    <input type="text" class="form-control" id="process_name" placeholder="Nome processo" name="name">
                </div>
                <div class="form-group mb-3">
                    <label class="hiddenlabel" for="process_type"></label>
                    <input type="text" class="form-control" id="process_type" placeholder="Tipologia processo"
                           name="type">
                </div>
                <div class="form-group mb-3">
                    <label class="hiddenlabel" for="process_description"></label>
                    <textarea form="add_process_form" class="form-control areapicker" id="process_description"
                              placeholder="Descrizione processo" name="description">
                        </textarea>
                </div>
                <button type="submit" class="btn myButton" name="add_process_submit">Aggiungi</button>
            </form>
        </div>
    </div>
</div>
<?php require_once('includes/footer.php'); ?>
</body>
</html>
