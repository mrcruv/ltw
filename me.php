<?php
global $sitename_brief, $authors, $connection;
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
    <meta name="keywords" content="utenti, enti, esperti"/>
    <meta name="description" content="visualizzazione dashboard utente"/>
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
    <script src="scripts/validate_update_password.js"></script>
    <script src="scripts/error.js"></script>
    <script src="scripts/message.js"></script>
    <title><?php echo($sitename_brief . ': dashboard - ' . $usertype . ' ' . $username); ?></title>
</head>
<body class="d-flex flex-column min-vh-100">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
<script>
    $(document).ready(function () {
        $('.edit').click(function () {
            var id = $(this).attr('id');
            var array = id.split("_");
            $('#text_' + array[0]).prop('disabled', false);
            $('#text_' + array[0]).removeClass("notEditable");
            $(this).parents("li").find(".edit, .add").toggle();
        });

        $('.add').click(function () {
            var id = $(this).attr('id');
            var array = id.split("_");
            $('#text_' + array[0]).prop('disabled', true);
            $('#text_' + array[0]).addClass("notEditable");
            $(this).parents("li").find(".edit, .add").toggle();
        });
    });
</script>
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
        <?php if ($usertype == 'ente') { ?>
            <img class="img-fluid rounded-circle mb-4" src="img/logo_ente.png" alt="..."/>
            <?php
        } else { ?>
            <img class="img-fluid rounded-circle mb-4" src="img/logo_esperto.png" alt="..."/>
        <?php } ?>
        <h1 class="text-black fs-3 fw-bolder"><?php echo($username); ?></h1>
        <p class="text-black-50 mb-0 text-uppercase"><?php echo($usertype); ?></p>
    </div>
</header>
<?php
$query = 'SELECT piva, cf, sito_web, pec FROM utenti WHERE username=?';
$statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
mysqli_stmt_bind_param($statement, 's', $username) or die(mysqli_error($connection));
mysqli_stmt_execute($statement) or die(mysqli_error($connection));
mysqli_stmt_bind_result($statement, $piva, $cf, $website, $pec) or die(mysqli_error($connection));
if (mysqli_stmt_fetch($statement)) { ?>
<div class="row container-fluid">
    <div class="col-md-4 offset-md-1 text-center">
        <h3>Info</h3>
        <ul class="list-group list-group-flush">
            <form method="post" action="script/update_cf.php">
                <li class="list-group-item"><small class="text-muted">Codice fiscale</small>
                    <div>
                        <label class="hiddenlabel" for="text_cf"></label>
                        <input type="text" class="notEditable text-center" id="text_cf" name="cf"
                               value="<?php echo($cf); ?>" disabled>
                    </div>
                    <a class="edit" title="Edit" data-toggle="tooltip" href="#" id="cf_e"><i class="material-icons">&#xE254;</i></a>
                    <a class="add" type="submit" title="Add" data-toggle="tooltip" href="#" id="cf_a"><i
                                class="material-icons">&#xE161;</i></a>
                </li>
            </form>
            <form method="post" action="script/update_piva.php">
                <li class="list-group-item"><small class="text-muted">Partita IVA</small>
                    <div>
                        <label class="hiddenlabel" for="text_piva"></label>
                        <input type="text" class="notEditable text-center" id="text_piva" name="piva"
                               value="<?php echo($piva); ?>" disabled>
                    </div>
                    <a class="edit" title="Edit" data-toggle="tooltip" href="#" id="piva_e"><i class="material-icons">&#xE254;</i></a>
                    <a class="add" type="submit" title="Add" data-toggle="tooltip" href="#" id="piva_a"><i
                                class="material-icons">&#xE161;</i></a>
                </li>
            </form>
            <form method="post" action="script/update_website.php">
                <li class="list-group-item"><small class="text-muted">Sito web</small>
                    <div>
                        <label class="hiddenlabel" for="text_website"></label>
                        <input type="text" class="notEditable text-center" id="text_website" name="website"
                               value="<?php echo($website); ?>" disabled>
                    </div>
                    <a class="edit" title="Edit" data-toggle="tooltip" href="#" id="website_e"><i
                                class="material-icons">&#xE254;</i></a>
                    <a class="add" type="submit" title="Add" data-toggle="tooltip" href="#" id="website_a"><i
                                class="material-icons">&#xE161;</i></a>
                </li>
            </form>
            <form method="post" action="script/update_pec.php">
                <li class="list-group-item"><small class="text-muted">PEC</small>
                    <div>
                        <label class="hiddenlabel" for="text_pec"></label>
                        <input type="text" class="notEditable text-center" id="text_pec" name="pec"
                               value="<?php echo($pec); ?>" disabled>
                    </div>
                    <a class="edit" title="Edit" data-toggle="tooltip" href="#" id="pec_e"><i class="material-icons">&#xE254;</i></a>
                    <a class="add" type="submit" title="Add" data-toggle="tooltip" href="#" id="pec_a"><i
                                class="material-icons">&#xE161;</i></a>
                </li>
            </form>
            <?php
            }
            else die('error');
            mysqli_stmt_close($statement) or die(mysqli_error($connection));
            if ($usertype == 'ente') {
            $query = "SELECT denominazione, tipo FROM enti WHERE username=?";
            $statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
            mysqli_stmt_bind_param($statement, 's', $username) or die(mysqli_error($connection));
            mysqli_stmt_execute($statement) or die(mysqli_error($connection));
            mysqli_stmt_bind_result($statement, $name, $type) or die(mysqli_error($connection));
            if (mysqli_stmt_fetch($statement)) { ?>
            <form method="post" action="script/update_entity_name.php">
                <li class="list-group-item"><small class="text-muted">Denominazione</small>
                    <div>
                        <label class="hiddenlabel" for="text_entityName"></label>
                        <input type="text" class="notEditable text-center" id="text_entityName" name="name"
                               value="<?php echo($name); ?>" disabled>
                    </div>
                    <a class="edit" title="Edit" data-toggle="tooltip" href="#" id="entityName_e"><i
                                class="material-icons">&#xE254;</i></a>
                    <a class="add" type="submit" title="Add" data-toggle="tooltip" href="#" id="entityName_a"><i
                                class="material-icons">&#xE161;</i></a>
                </li>
            </form>
            <form method="post" action="script/update_entity_type.php">
                <li class="list-group-item"><small class="text-muted">Tipo</small>
                    <div>
                        <label class="hiddenlabel" for="text_entityType"></label>
                        <input type="text" class="notEditable text-center" id="text_entityType" name="type"
                               value="<?php echo($type); ?>" disabled>
                    </div>
                    <a class="edit" title="Edit" data-toggle="tooltip" href="#" id="entityType_e"><i
                                class="material-icons">&#xE254;</i></a>
                    <a class="add" type="submit" title="Add" data-toggle="tooltip" href="#" id="entityType_a"><i
                                class="material-icons">&#xE161;</i></a>
                </li>
            </form>
        </ul>
        <?php
        }
        else die('error');
        }
        else {
            $query = 'SELECT nome, cognome, citta_nascita, data_nascita FROM esperti WHERE username=?';
            $statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
            mysqli_stmt_bind_param($statement, 's', $username) or die(mysqli_error($connection));
            mysqli_stmt_execute($statement) or die(mysqli_error($connection));
            mysqli_stmt_bind_result($statement, $name, $surname, $city, $date) or die(mysqli_error($connection));
            if (mysqli_stmt_fetch($statement)) { ?>
                <li class="list-group-item"><small class="text-muted">Nome e Cognome</small>
                    <h6><?php echo($name . ' ' . $surname); ?></h6></li>
                <li class="list-group-item"><small class="text-muted">Città e Data di Nascita</small>
                    <h6><?php echo($city . ', ' . $date); ?></h6></li>
                </ul>
                <?php
            } else die('error');
        }
        mysqli_stmt_close($statement) or die(mysqli_error($connection));
        ?>
    </div>
    <div class="col-md-2 offset-md-4 text-center align-middle">
        <h3>Cambia Password</h3>
        <form id="update_password_form" action="scripts/update_password.php" method="post">
            <div class="form-group mb-3 mt-4">
                <label class="hiddenlabel" for="old_password"></label>
                <input type="password" class="form-control" id="old_password" placeholder="Password attuale"
                       name="old_password"/>
            </div>
            <div class="form-group mb-3">
                <label class="hiddenlabel" for="new_password"></label>
                <input type="password" class="form-control" id="new_password" placeholder="Nuova password"
                       name="new_password"/>
            </div>
            <button type="submit" class="btn btn-primary" name="update_password_submit">Cambia password</button>
        </form>
    </div>
</div>
<?php require_once('includes/footer.php'); ?>
</body>
</html>
