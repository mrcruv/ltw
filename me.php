<?php
global $sitename_brief, $authors, $connection;
require_once('includes/info.php');
require_once('includes/open_connection.php');
require_once('includes/session.php');
require_once('scripts/entity_stats.php');
require_once('scripts/expert_stats.php');
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
    <link rel="icon" type="image/x-icon" href="imgs/prova_logo.ico">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
    <script src="scripts/error.js"></script>
    <script src="scripts/message.js"></script>
    <script src="scripts/toggle_psw.js"></script>
    <script src="scripts/update_info.js"></script>
    <script src="scripts/validate_update_cf.js"></script>
    <script src="scripts/validate_update_pec.js"></script>
    <script src="scripts/validate_update_piva.js"></script>
    <script src="scripts/validate_update_website.js"></script>
    <script src="scripts/validate_update_password.js"></script>
    <script src="scripts/validate_update_entity_name.js"></script>
    <script src="scripts/validate_update_entity_type.js"></script>
    <title><?php echo($sitename_brief . ': dashboard - ' . $usertype . ' ' . $username); ?></title>
</head>
<body class="d-flex flex-column min-vh-100">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
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
            <img class="img-fluid rounded-circle mb-4" src="imgs/logo_ente.png" alt="..."/>
            <?php
        } else { ?>
            <img class="img-fluid rounded-circle mb-4" src="imgs/logo_esperto.png" alt="..."/>
        <?php } ?>
        <h1 class="text-black fs-3 fw-bolder"><?php echo($username); ?></h1>
        <p class="text-black-50 mb-0 text-uppercase"><?php echo($usertype); ?></p>
    </div>
</header>
<?php
$query = 'SELECT piva, cf, sito_web, pec FROM utenti WHERE username = ?';
$statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
mysqli_stmt_bind_param($statement, 's', $username) or die(mysqli_error($connection));
mysqli_stmt_execute($statement) or die(mysqli_error($connection));
mysqli_stmt_bind_result($statement, $piva, $cf, $website, $pec) or die(mysqli_error($connection));
if (mysqli_stmt_fetch($statement)) { ?>
<div class="row container-fluid">
    <div class="col-xl-4 text-center mt-4">
        <h3>Info</h3>
        <ul class="list-group list-group-flush">
            <li class="list-group-item"><small class="text-muted">Codice fiscale</small>
                <form id="update_cf_form" method="post" action="scripts/update_cf.php" class="update">
                    <div class="row">
                        <div class="col-lg-8 offset-lg-2 text-center">
                            <label class="hiddenlabel" for="text_cf"></label>
                            <input type="text" class="hiddenborder text-center" id="text_cf" name="new_cf"
                                   value="<?php echo($cf); ?>" disabled>
                        </div>
                        <div class="col-lg-2 d-flex justify-content-center">
                            <a class="edit pointer" id="cf_e"><i class="material-icons">&#xE254;</i></a>
                            <a class="cancel pointer" id="cf_c"><i class="material-icons icon-red">close</i></a>
                            <i class="material-icons save">
                                <button type="submit" class="mdc-icon-button buttonSave" name="update_cf_submit">
                                    &#xE161;
                                </button>
                            </i>
                        </div>
                    </div>
                </form>
            </li>

            <li class="list-group-item"><small class="text-muted">Partita IVA</small>
                <form id="update_piva_form" method="post" action="scripts/update_piva.php" class="update">
                    <div class="row">
                        <div class="col-lg-8 offset-lg-2 text-center">
                            <label class="hiddenlabel" for="text_piva"></label>
                            <input type="text" class="hiddenborder text-center" id="text_piva" name="new_piva"
                                   value="<?php echo($piva); ?>" disabled/>
                        </div>
                        <div class="col-lg-2 d-flex justify-content-center">
                            <a class="edit pointer" title="Edit" data-toggle="tooltip" id="piva_e"><i
                                        class="material-icons">&#xE254;</i></a>
                            <a class="cancel pointer" title="Cancel" data-toggle="tooltip" id="piva_c"><i
                                        class="material-icons icon-red">close</i></a>
                            <i class="material-icons save">
                                <button type="submit" class="mdc-icon-button buttonSave" name="update_piva_submit">
                                    &#xE161;
                                </button>
                            </i>
                        </div>
                    </div>
                </form>
            </li>
            <li class="list-group-item"><small class="text-muted">Sito web</small>
                <form id="update_website_form" method="post" action="scripts/update_website.php" class="update">
                    <div class="row">
                        <div class="col-lg-8 offset-lg-2 text-center">
                            <label class="hiddenlabel" for="text_website"></label>
                            <?php if ($website == null) { ?>
                                <input type="text" class="hiddenborder text-center" id="text_website"
                                       name="new_website"
                                       value="N.D." disabled>
                            <?php } else { ?>
                                <input type="text" class="hiddenborder text-center" id="text_website"
                                       name="new_website"
                                       value="<?php echo($website); ?>" disabled>
                            <?php } ?>
                        </div>
                        <div class="col-lg-2 d-flex justify-content-center">
                            <a class="edit pointer" title="Edit" data-toggle="tooltip" id="website_e"><i
                                        class="material-icons">&#xE254;</i></a>
                            <a class="delete" title="Delete" data-toggle="tooltip" href="scripts/remove_website.php"><i
                                        class="material-icons icon-red">&#xE872;</i></a>
                            <a class="cancel pointer" title="Cancel" data-toggle="tooltip" id="website_c"><i
                                        class="material-icons icon-red">close</i></a>
                            <i class="material-icons save">
                                <button type="submit" class="mdc-icon-button buttonSave" name="update_website_submit">
                                    &#xE161;
                                </button>
                            </i>
                        </div>
                    </div>
                </form>
            </li>
            <li class="list-group-item"><small class="text-muted">PEC</small>
                <form id="update_pec_form" method="post" action="scripts/update_pec.php" class="update">
                    <div class="row">
                        <div class="col-lg-8 offset-lg-2 text-center">
                            <label class="hiddenlabel" for="text_pec"></label>
                            <input type="text" class="hiddenborder text-center" id="text_pec" name="new_pec"
                                   value="<?php echo($pec); ?>" disabled>
                        </div>
                        <div class="col-lg-2 d-flex justify-content-center">
                            <a class="edit pointer" title="Edit" data-toggle="tooltip" id="pec_e"><i
                                        class="material-icons">&#xE254;</i></a>
                            <a class="cancel pointer" title="Cancel" data-toggle="tooltip" id="pec_c"><i
                                        class="material-icons icon-red">close</i></a>
                            <i class="material-icons save">
                                <button type="submit" class="mdc-icon-button buttonSave" name="update_pec_submit">
                                    &#xE161;
                                </button>
                            </i>
                        </div>
                    </div>
                </form>
            </li>
            <?php
            }
            else die('error');
            mysqli_stmt_close($statement) or die(mysqli_error($connection));
            if ($usertype == 'ente') {
            $query = "SELECT denominazione, tipo FROM enti WHERE username = ?";
            $statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
            mysqli_stmt_bind_param($statement, 's', $username) or die(mysqli_error($connection));
            mysqli_stmt_execute($statement) or die(mysqli_error($connection));
            mysqli_stmt_bind_result($statement, $name, $type) or die(mysqli_error($connection));
            if (mysqli_stmt_fetch($statement)) { ?>
            <li class="list-group-item"><small class="text-muted">Denominazione</small>
                <form id="update_entity_name_form" method="post" action="scripts/update_entity_name.php" class="update">
                    <div class="row">
                        <div class="col-lg-8 offset-lg-2 text-center">
                            <label class="hiddenlabel" for="text_entityName"></label>
                            <input type="text" class="hiddenborder text-center" id="text_entityName"
                                   name="new_entity_name"
                                   value="<?php echo($name); ?>" disabled>
                        </div>
                        <div class="col-lg-2 d-flex justify-content-center">
                            <a class="edit pointer" title="Edit" data-toggle="tooltip" id="entityName_e"><i
                                        class="material-icons">&#xE254;</i></a>
                            <a class="cancel pointer" title="Cancel" data-toggle="tooltip" id="entityName_c"><i
                                        class="material-icons icon-red">close</i></a>
                            <i class="material-icons save">
                                <button type="submit" class="mdc-icon-button buttonSave"
                                        name="update_entity_name_submit">
                                    &#xE161;
                                </button>
                            </i>
                        </div>
                    </div>
                </form>
            </li>
            <li class="list-group-item"><small class="text-muted">Tipo</small>
                <form id="update_entity_type_form" method="post" action="scripts/update_entity_type.php" class="update">
                    <div class="row">
                        <div class="col-lg-8 offset-lg-2 text-center">
                            <label class="hiddenlabel" for="text_entityType"></label>
                            <select class="hiddenborder text-center" id="text_entityType" name="new_entity_type"
                                    disabled>
                                <option value="<?php echo($type); ?>" selected>Ente <?php echo($type); ?></option>
                                <?php
                                if ($type == 'pubblico') {
                                    ?>
                                    <option value="privato">Ente privato</option>
                                <?php } else { ?>
                                    <option value="pubblico">Ente pubblico</option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-lg-2 d-flex justify-content-center">
                            <a class="edit pointer" title="Edit" data-toggle="tooltip" id="entityType_e"><i
                                        class="material-icons">&#xE254;</i></a>
                            <a class="cancel pointer" title="Cancel" data-toggle="tooltip" id="entityType_c"><i
                                        class="material-icons icon-red">close</i></a>
                            <i class="material-icons save">
                                <button type="submit" class="mdc-icon-button buttonSave"
                                        name="update_entity_type_submit">
                                    &#xE161;
                                </button>
                            </i>
                        </div>
                    </div>
                </form>
            </li>
        </ul>
        <?php
        }
        else die('error');
        }
        else {
            $query = 'SELECT nome, cognome, citta_nascita, data_nascita FROM esperti WHERE username = ?';
            $statement = mysqli_prepare($connection, $query) or die(mysqli_error($connection));
            mysqli_stmt_bind_param($statement, 's', $username) or die(mysqli_error($connection));
            mysqli_stmt_execute($statement) or die(mysqli_error($connection));
            mysqli_stmt_bind_result($statement, $name, $surname, $city, $date) or die(mysqli_error($connection));
            if (mysqli_stmt_fetch($statement)) { ?>
                <li class="list-group-item"><small class="text-muted">Nome e cognome</small>
                    <h6><?php echo($name . ' ' . $surname); ?></h6></li>
                <li class="list-group-item"><small class="text-muted">Città e data di dascita</small>
                    <h6><?php echo($city . ', ' . $date); ?></h6></li>
                </ul>
                <?php
            } else die('error');
        }
        mysqli_stmt_close($statement) or die(mysqli_error($connection));
        ?>
    </div>
    <div class="col-xl-4 align-items-center text-center mt-4">
        <?php if ($usertype == 'esperto') { ?>
            <h3>Statistiche esperto</h3>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><small class="text-muted"># Titoli di studio</small>
                    <h6><a href="titoli.php"><?php echo(n_title($username)); ?></a></h6>
                </li>
                <li class="list-group-item"><small class="text-muted"># Competenze</small>
                    <h6><a href="competenze.php"><?php echo(n_competence($username)); ?></a></h6>
                </li>
                <li class="list-group-item"><small class="text-muted"># Assegnazioni</small>
                    <h6><a href="assegnazioni.php"><?php echo(n_availability_from_expert($username)); ?></a></h6>
                </li>
                <li class="list-group-item"><small class="text-muted"># Assegnazioni pendenti</small>
                    <h6><?php echo(n_dangling_from_expert($username)); ?></h6>
                </li>
                <li class="list-group-item"><small class="text-muted"># Assegnazioni accettate</small>
                    <h6><?php echo(n_accepted_from_expert($username)); ?></h6>
                </li>
                <li class="list-group-item"><small class="text-muted"># Assegnazioni rifiutate</small>
                    <h6><?php echo(n_rejected_from_expert($username)); ?></h6>
                </li>
            </ul>
        <?php } else { ?>
            <h3>Statistiche ente</h3>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><small class="text-muted"># Processi</small>
                    <h6><a href="processi.php"><?php echo(n_process($username)); ?></a></h6>
                </li>
                <li class="list-group-item"><small class="text-muted"># Assegnazioni</small>
                    <h6><a href="assegnazioni.php"><?php echo(n_availability_from_entity($username)); ?></a></h6>
                </li>
                <li class="list-group-item"><small class="text-muted"># Assegnazioni pendenti</small>
                    <h6><?php echo(n_dangling_from_entity($username)); ?></h6>
                </li>
                <li class="list-group-item"><small class="text-muted"># Assegnazioni accettate</small>
                    <h6><?php echo(n_accepted_from_entity($username)); ?></h6>
                </li>
                <li class="list-group-item"><small class="text-muted"># Assegnazioni rifiutate</small>
                    <h6><?php echo(n_rejected_from_entity($username)); ?></h6>
                </li>
            </ul>
        <?php } ?>
    </div>
    <div class="col-xl-3 offset-xl-1 mt-4 mb-2">
        <h3 class="text-center">Cambia password</h3>
        <form id="update_password_form" action="scripts/update_password.php" method="post" class="update">
            <div class="form-group mb-3 mt-3">
                <label class="hiddenlabel" for="old_password"></label>
                <input type="password" aria-describedby="password_help"
                       id="old_password" class="form-control"
                       placeholder="Password attuale" name="old_password"/>
                <span toggle="#old_password"
                      class="fa fa-fw fa-eye field-icon toggle-password"></span>
            </div>
            <div class="form-group mb-3">
                <label class="hiddenlabel" for="new_password"></label>
                <input type="password" aria-describedby="password_help"
                       id="new_password" class="form-control"
                       placeholder="Nuova password" name="new_password"/>
                <span toggle="#new_password"
                      class="fa fa-fw fa-eye field-icon toggle-password"></span>
            </div>
            <div class="text-center">
                <button type="submit" class="btn myButton" name="update_password_submit">Cambia password</button>
            </div>
        </form>
    </div>
</div>
<?php require_once('includes/footer.php'); ?>
</body>
</html>

