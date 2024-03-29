<?php
global $sitename_brief, $authors;
require_once('includes/info.php');
require_once('includes/session.php');
require_once('scripts/show_title.php');
if (!isset($_SESSION['usertype']) or $_SESSION['usertype'] != 'esperto') {
    header('Location: me.php?err=sessione+utente+esperto+non+attiva');
    die("sessione utente esperto non attiva");
}
$username = $_SESSION['username'];
$usertype = $_SESSION['usertype'];
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="utf-8">
    <meta name="keywords" content="esperti, titoli di studio, laurea, diploma"/>
    <meta name="description" content="gestione dei titoli di studio degli esperti"/>
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
    <script src="scripts/validate_add_title.js"></script>
    <script src="scripts/error.js"></script>
    <script src="scripts/message.js"></script>
    <title><?php echo($sitename_brief . ': titoli - ' . $usertype . ' ' . $username); ?></title>
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
        <h2>Titoli di studio</h2>
    </div>
    <div class="row">
        <div class="col-lg-8">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Data conseguimento</th>
                        <th scope="col">Note</th>
                        <th scope="col">Voto</th>
                        <th class="text-center" scope="col">Azioni</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $array = show_all_titles($username);
                    $n = count($array);
                    if (!is_array($array) or $n <= 0) { ?>
                        <tr>
                            <td colspan="6"><p class="empty">Non ci sono titoli di studio al momento</p></td>
                        </tr>
                        <?php
                    } else {
                        for ($i = 0; $i < $n; $i += 1) { ?>
                            <tr>
                                <td><?php echo($i + 1); ?></td>
                                <td><?php echo($array[$i]['name']); ?></td>
                                <td><?php if ($array[$i]['date'] != '0000-00-00') echo($array[$i]['date']); else echo('N.D.'); ?></td>
                                <td><?php echo($array[$i]['notes']); ?></td>
                                <td><?php echo($array[$i]['grade']); ?></td>
                                <td class="text-center">
                                    <?php
                                    echo('<a class="delete" title="Delete" data-toggle="tooltip" href="scripts/delete_title.php?name=' . $array[$i]['name'] . '">');
                                    echo('<i class="material-icons icon-red">&#xE872;</i></a>');
                                    ?>
                                </td>
                            </tr>
                            <?php
                        }
                    } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-lg-4 text-center mb-2">
            <h5>Aggiungi titolo di studio</h5>
            <a type="button" class="btn btn-info rounded-circle" id="add_button"><i class="fa fa-plus"></i></a>
            <form id="add_title_form" class="add_form" action="scripts/add_title.php" method="post">
                <div class="form-group mb-3 mt-4">
                    <label class="hiddenlabel" for="title_name"></label>
                    <input type="text" id="title_name" class="form-control" placeholder="Denominazione" name="name">
                </div>
                <div class="form-group mb-3">
                    <label class="hiddenlabel" for="title_date"></label>
                    <input type="text" id="title_date" class="form-control" placeholder="Data conseguimento"
                           onfocus="(this.type='date')" name="date">
                </div>
                <div class="form-group mb-3">
                    <label class="hiddenlabel" for="title_notes"></label>
                    <input type="text" id="title_notes" class="form-control" placeholder="Note" name="notes">
                </div>
                <div class="form-group mb-3">
                    <label class="hiddenlabel" for="title_grade"></label>
                    <input type="number" id="title_grade" class="form-control" placeholder="Voto" name="grade">
                </div>
                <button type="submit" class="btn myButton" name="add_title_submit">Aggiungi</button>
            </form>
        </div>
    </div>
</div>
<?php require_once('includes/footer.php'); ?>
</body>
</html>
