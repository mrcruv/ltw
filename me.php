<?php
global $sitename, $connection;
require_once('includes/info.php');
require_once('includes/open_connection.php');
require_once('includes/session.php');
$username = $_SESSION['username'];
$usertype = $_SESSION['usertype'];
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
    <script src="scripts/validate_update_password.js"></script>
    <script src="scripts/error.js"></script>
    <script src="scripts/message.js"></script>

    <title><?php echo($sitename . ' - ' . $username); ?></title>
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

    <header class="py-2 shadow p-3 mb-3">
        <div class="text-center my-1">
            <?php if($usertype == 'ente') {?>
                <img class="img-fluid rounded-circle mb-4" src="img/logo_ente.png" alt="..." />
            <?php
            }
            else { ?>
                <img class="img-fluid rounded-circle mb-4" src="img/logo_esperto.png" alt="..." />
            <?php } ?>
            <h1 class="text-black fs-3 fw-bolder"> <?php echo $username ?></h1>
            <p class="text-black-50 mb-0 text-uppercase"><?php echo $usertype ?></p>
        </div>
    </header>


    <?php
    $query = 'SELECT piva, cf, sito_web, pec FROM utenti WHERE username=?';
    $statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
    mysqli_stmt_bind_param($statement, 's', $username) or die(mysqli_error($connection));
    mysqli_stmt_execute($statement) or die(mysqli_error($connection));
    mysqli_stmt_bind_result($statement, $piva, $cf, $website, $pec) or die(mysqli_error($connection));
    if (mysqli_stmt_fetch($statement)) {?>
    <div class="row container-fluid">
        <div class="col-md-4 offset-md-1 text-center">
            <h3>Info</h3>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><small class="text-muted">Codice fiscale</small><h6><?php echo $cf ?></h6></li>
                <li class="list-group-item"><small class="text-muted">Partita IVA</small><h6><?php echo $piva ?></h6></li>
                <li class="list-group-item"><small class="text-muted">Sito web</small><h6><?php echo $website ?></h6></li>
                <li class="list-group-item"><small class="text-muted">PEC</small><h6><?php echo $pec ?></h6></li>
        <?php
        }
        else echo('error');
        mysqli_stmt_close($statement) or die(mysqli_error($connection));

        if ($usertype == 'ente') {
            $query = "SELECT denominazione, tipo FROM enti WHERE username=?";
            $statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
            mysqli_stmt_bind_param($statement, 's', $username) or die(mysqli_error($connection));
            mysqli_stmt_execute($statement) or die(mysqli_error($connection));
            mysqli_stmt_bind_result($statement, $name, $type) or die(mysqli_error($connection));
            if (mysqli_stmt_fetch($statement)) { ?>
                <li class="list-group-item"><small class="text-muted">Denominazione</small><h6><?php echo $name ?></h6></li>
                <li class="list-group-item"><small class="text-muted">Tipo</small><h6><?php echo $type ?></h6></li>
            </ul>

        <?php
            }
            else echo('error');
        }
        else {
            $query = 'SELECT nome, cognome, citta_nascita, data_nascita FROM esperti WHERE username=?';
            $statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
            mysqli_stmt_bind_param($statement, 's', $username) or die(mysqli_error($connection));
            mysqli_stmt_execute($statement) or die(mysqli_error($connection));
            mysqli_stmt_bind_result($statement, $name, $surname, $city, $date) or die(mysqli_error($connection));
            if (mysqli_stmt_fetch($statement)) {?>
                <li class="list-group-item"><small class="text-muted">Nome e Cognome</small><h6><?php echo $name . ' ' . $surname ?></h6></li>
                <li class="list-group-item"><small class="text-muted">Città e Data di Nascita</small><h6><?php echo $city . ', ' . $date ?></h6></li>
            </ul>
        <?php
            }
            else echo('error');
        }
        mysqli_stmt_close($statement) or die(mysqli_error($connection));
        ?>
        </div>
        <div class="col-md-2 offset-md-4 text-center align-middle">
            <h3>Cambia Password</h3>
            <form id="update_password_form" action="<?php echo('scripts/update_password.php'); ?>" method="post">
                <div class="form-group mb-3 mt-4">
                    <input type="password" class="form-control" id="old_password" placeholder="Password attuale" name="old_password"/>
                </div>
                <div class="form-group mb-3">
                    <input type="password" class="form-control" id="new_password" placeholder="Nuova password" name="new_password"/>
                </div>
                <button type="submit" class="btn btn-primary" name="update_password_submit">Cambia password</button>
            </form>
        </div>
    </div>

    <?php require_once('includes/footer.php'); ?>
</body>
</html>
