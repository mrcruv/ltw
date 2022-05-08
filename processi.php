<?php
global $sitename, $connection;
require_once('includes/info.php');
require_once('includes/session.php');
if (!isset($_SESSION['usertype']) or $_SESSION['usertype'] != 'ente') {
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
    <link rel="stylesheet" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <title><?php echo($sitename); ?></title>
</head>
<body class="d-flex flex-column min-vh-100">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="scripts/add_form.js"></script>


    <?php require_once('includes/header.php'); ?>

    <div class="container-fluid">

        <div class="row">
            <div class="col-md-3 offset-md-4 text-center align-middle">
                <h5>Aggiungi Processo</h5>
                <a class="btn btn-primary rounded-circle" id="add_button">+</a>

                <form id="add_process_form" class="add_form" action="scripts/add_process.php" method="post">
                    <div class="form-group mb-3 mt-4">
                        <input type="text" class="form-control" id="process_name" placeholder="Nome processo" name="name">
                    </div>
                    <div class="form-group mb-3">
                        <input type="text" class="form-control" id="process_type" placeholder="Tipologia processo" name="type">
                    </div>
                    <div class="form-group mb-3">
                        <input type="text area" class="form-control" id="process_description" placeholder="Descrizione processo" name="description">
                    </div>
                    <button type="submit" class="btn btn-primary" name="add_process_submit">Aggiungi</button>
                </form>
            </div>
        </div>
        
        <?php
        require_once('scripts/show_process.php'); ?>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Tipologia</th>
                    <th scope="col">Descrizione</th>
                </tr>
            </thead>
            <tbody>
            <?php $array = show_all_processes($_SESSION['username']);
            $n = count($array);
            if (!is_array($array) or $n <= 0) { ?>
                <tr><td colspan="4"><h6>Non ci sono Processi al momento</h6></td></tr>
            <?php
            }
            else {
                for ($i = 0; $i < $n; $i += 1) { ?>
                <tr>
                    <th scope="row"><?php echo $i+1?></th>
                    <td><?php echo $array[$i]['name']?></td>
                    <td><?php echo $array[$i]['type']?></td>
                    <td><?php echo $array[$i]['description']?></td>
                </tr>
                <?php
                }
            }  ?> 
            </tbody>
        </table>

    </div>

    <?php require_once('includes/footer.php'); ?>
</body>
</html>
