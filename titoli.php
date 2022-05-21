<?php
global $sitename;
require_once('includes/info.php');
require_once('includes/session.php');
if (!isset($_SESSION['usertype']) or $_SESSION['usertype'] != 'esperto') {
    header ('Location: me.php');
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
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
    <script src="scripts/validate_add_title.js"></script>
    <script src="scripts/error.js"></script>
    <script src="scripts/message.js"></script>

    <title><?php echo($sitename); ?></title>
    <link rel="icon" type="image/x-icon" href="img/prova_logo.ico">
</head>
<body class="d-flex flex-column min-vh-100">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
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

    <?php
    require_once('includes/header.php');
    require_once('scripts/show_title.php');
    ?>

    <div class="container-fluid">
        <div class="row border-bottom border-3 mb-5">
            <h2>Titoli di Studio</h2>
        </div>
        <div class="row">
            <div class="col-7">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Data di Conseguimento</th>
                            <th scope="col">Note</th>
                            <th scope="col">Voto</th>
                            <th class="text-center" scope="col">Azioni</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $array = show_all_titles($_SESSION["username"]);
                    $n = count($array);
                    if (!is_array($array) or $n <= 0) { ?>
                        <tr><td colspan="6"><h6>Non ci sono Titoli di studio al momento</h6></td></tr>
                    <?php
                    }
                    else {
                        for ($i = 0; $i < $n; $i += 1) { ?>
                        <tr>
                            <td scope="row"><?php echo $i+1?></td>
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
                    }  ?> 
                    </tbody>
                </table>
            </div>
            <div class="col-1"></div>
            <div class="col-4 text-center mb-2">
                <h5>Aggiungi Titolo di Studio</h5>
                <a type="button" class="btn btn-info rounded-circle" id="add_button"><i class="fa fa-plus"></i></a>

                <form id="add_title_form" class="add_form" action="scripts/add_title.php" method="post">
                    <div class="form-group mb-3 mt-4">
                        <input type="text" id="title_name" class="form-control" placeholder="Denominazione" name="name">
                    </div>
                    <div class="form-group mb-3">
                        <input type="text" id="title_date" class="form-control" placeholder="Data conseguimento" onfocus="(this.type='date')" name="date">
                    </div>
                    <div class="form-group mb-3">
                        <input type="text" id="title_notes" class="form-control" placeholder="Note" name="notes">
                    </div>
                    <div class="form-group mb-3">
                        <input type="number" id="title_grade" class="form-control" placeholder="Voto" name="grade">
                    </div>
                    <button type="submit" class="btn btn-primary" name="add_title_submit">Aggiungi</button>
                </form>
            </div>
        </div>

    </div>

    <?php require_once('includes/footer.php'); ?>
</body>
</html>
