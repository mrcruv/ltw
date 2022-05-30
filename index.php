<?php
global $sitename, $authors;
require_once('includes/info.php');
if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION['username'])) {
    header('Location: me.php?err=sessione+utente+gia+attiva');
    die('sessione utente gia attiva');
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="utf-8">
    <meta name="keywords" content="registrazione, accesso, enti, esperti"/>
    <meta name="description" content="login e registrazione per enti ed esperti"/>
    <meta name="author" content="<?php echo(implode(', ', $authors)); ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" type="image/x-icon" href="img/prova_logo.ico">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
    <script src="scripts/form_switch.js"></script>
    <script src="scripts/validate_login.js"></script>
    <script src="scripts/validate_register_entity.js"></script>
    <script src="scripts/validate_register_expert.js"></script>
    <script src="scripts/error.js"></script>
    <script src="scripts/message.js"></script>
    <script src="scripts/toggle_psw.js"></script>
    <script src="scripts/register_slide.js"></script>
    <title><?php echo($sitename . ': index'); ?></title>
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
<section class="h-100 gradient-form">
    <div class="container py-3 h-100">
        <div class="row d-flex justify-content-center h-100 shadow rounded-2">
            <div class="col-lg-6 align-self-center h-75">
                <div class="text-center">
                    <img src="img/prova_logo.png" class="dimImg" alt="logo">
                    <h4 class="mb-5 mt-1 pb-1"><?php echo($sitename); ?></h4>
                </div>
                <div class="row">
                    <div class="col-lg-8 offset-lg-2 px-2">
                        <ul class="nav nav-pills nav-justified mb-3" id="login_register_nav" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" data-target="pills-login" href="#">Login</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="tab-register" data-target="pills-register" href="#">Registrazione</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab active" data-tab="pills-login">
                                <form id="login_form" action="scripts/login.php" method="post" class="login">
                                    <div class="form-outline mt-4 mb-2">
                                        <label class="hiddenlabel" for="login_username"></label>
                                        <input type="text" id="login_username" class="form-control"
                                               placeholder="Username" name="username"/>
                                    </div>
                                    <div class="form-outline mb-4">
                                        <label class="hiddenlabel" for="login_password"></label>
                                        <input type="password" id="login_password" class="form-control"
                                               placeholder="Password" name="password" aria-describedby="password_help"/>
                                        <span toggle="#login_password"
                                              class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                    </div>
                                    <div class="row mx-1 mb-4">
                                        <button type="submit" class="btn btn-block myButton mb-4"
                                                name="login_submit">Accedi
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="tab-content">
                            <div class="tab" data-tab="pills-register">
                                <ul class="nav nav-pills nav-justified border rounded mt-4 mb-4" id="entity_expert_name"
                                    role="tablist">
                                    <li>
                                        <button class="btn switch selected" type="button" id="entity_button">Ente</button>
                                    </li>
                                    <li>
                                        <button class="btn switch" type="button" id="expert_button">Esperto</button>
                                    </li>
                                </ul>
                                <form id="register_entity_form" action="scripts/register_entity.php" class="register"
                                      method="post">
                                    <div class="step1">
                                        <div class="form-card">
                                            <div class="form-outline mb-2">
                                                <label class="hiddenlabel" for="register_entity_name"></label>
                                                <input type="text" id="register_entity_name" class="form-control"
                                                       placeholder="Denominazione" name="entity_name"/>
                                            </div>
                                            <div class="form-outline mb-2">
                                                <label class="hiddenlabel" for="register_entity_website"></label>
                                                <input type="text" id="register_entity_website" class="form-control"
                                                       placeholder="Sito Web" name="entity_website"/>
                                            </div>
                                            <div class="form-outline mb-5">
                                                <label class="hiddenlabel" for="register_entity_type"></label>
                                                <select class="form-select selectpicker" id="register_entity_type" name="type">
                                                    <option selected disabled>Scegli il tipo di ente</option>
                                                    <option value="pubblico">Ente pubblico</option>
                                                    <option value="privato">Ente privato</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="step2">
                                        <div class="form-card">
                                            <div class="form-outline mb-2">
                                                <label class="hiddenlabel" for="register_entity_cf"></label>
                                                <input type="text" id="register_entity_cf" class="form-control"
                                                       placeholder="Codice fiscale" name="entity_cf"/>
                                            </div>
                                            <div class="form-outline mb-2">
                                                <label class="hiddenlabel" for="register_entity_piva"></label>
                                                <input type="text" id="register_entity_piva" class="form-control"
                                                       placeholder="Partita IVA" name="entity_piva"/>
                                            </div>
                                            <div class="form-outline mb-5">
                                                <label class="hiddenlabel" for="register_entity_pec"></label>
                                                <input type="email" id="register_entity_pec" class="form-control"
                                                       placeholder="PEC" name="entity_pec"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="step3">
                                        <div class="form-card">
                                            <div class="form-outline mb-2">
                                                <label class="hiddenlabel" for="register_entity_username"></label>
                                                <input type="text" id="register_entity_username" class="form-control"
                                                       placeholder="Username" name="entity_username"/>
                                            </div>
                                            <div class="form-outline mb-2">
                                                <label class="hiddenlabel" for="register_entity_password"></label>
                                                <input type="password" aria-describedby="password_help"
                                                       id="register_entity_password" class="form-control"
                                                       placeholder="Password" name="entity_password"/>
                                                <span toggle="#register_entity_password"
                                                      class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-md d-flex justify-content-center">
                                                    <div class="form-check mb-md-0">
                                                        <input class="form-check-input" type="checkbox" value="true"
                                                               id="term_check_expert" name="entity_term" checked/>
                                                        <label class="form-check-label mb-2" for="term_check_expert">
                                                            <a href="includes/terms.html" download="terms.html">
                                                                Accetta termini e condizioni
                                                            </a>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mx-1 mb-3">
                                        <button type="submit" class="btn btn-block myButton register_button"
                                                name="register_entity_submit">Registrati
                                        </button>
                                    </div>
                                </form>
                                <form id="register_expert_form" action="scripts/register_expert.php" class="register"
                                      method="post">
                                    <div class="step1">
                                        <div class="form-card">
                                            <div class="form-outline mb-2">
                                                <label class="hiddenlabel" for="register_expert_name"></label>
                                                <input type="text" id="register_expert_name" class="form-control"
                                                       placeholder="Nome" name="name"/>
                                            </div>
                                            <div class="form-outline mb-2">
                                                <label class="hiddenlabel" for="register_expert_surname"></label>
                                                <input type="text" id="register_expert_surname" class="form-control"
                                                       placeholder="Cognome" name="surname"/>
                                            </div>
                                            <div class="form-outline mb-2">
                                                <label class="hiddenlabel" for="register_expert_city"></label>
                                                <input type="text" id="register_expert_city" class="form-control"
                                                       placeholder="Città di nascita" name="city"/>
                                            </div>
                                            <div class="form-outline mb-3">
                                                <label class="hiddenlabel" for="register_expert_date"></label>
                                                <input type="text" id="register_expert_date" class="form-control"
                                                       placeholder="Data di nascita" onfocus="(this.type='date')"
                                                       name="date"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="step2">
                                        <div class="form-card">
                                            <div class="form-outline mb-2">
                                                <label class="hiddenlabel" for="register_expert_cf"></label>
                                                <input type="text" id="register_expert_cf" class="form-control"
                                                       placeholder="Codice fiscale" name="expert_cf"/>
                                            </div>
                                            <div class="form-outline mb-2">
                                                <label class="hiddenlabel" for="register_expert_website"></label>
                                                <input type="text" id="register_expert_website" class="form-control"
                                                       placeholder="Sito Web" name="expert_website"/>
                                            </div>
                                            <div class="form-outline mb-2">
                                                <label class="hiddenlabel" for="register_expert_piva"></label>
                                                <input type="text" id="register_expert_piva" class="form-control"
                                                       placeholder="Partita IVA" name="expert_piva"/>
                                            </div>
                                            <div class="form-outline mb-3">
                                                <label class="hiddenlabel" for="register_expert_pec"></label>
                                                <input type="email" id="register_expert_pec" class="form-control"
                                                       placeholder="PEC" name="expert_pec"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="step3">
                                        <div class="form-card">
                                            <div class="form-outline mb-2">
                                                <label class="hiddenlabel" for="register_expert_username"></label>
                                                <input type="text" id="register_expert_username" class="form-control"
                                                       placeholder="Username" name="expert_username"/>
                                            </div>
                                            <div class="form-outline mb-2">
                                                <input type="password" aria-describedby="password_help"
                                                       id="register_expert_password" class="form-control"
                                                       placeholder="Password" name="expert_password"/>
                                                <span toggle="#register_expert_password"
                                                      class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                            </div>
                                            <div class="row mb-4">
                                                <div class="col-md d-flex justify-content-center">
                                                    <div class="form-check mb-md-0">
                                                        <input class="form-check-input" type="checkbox" value="true"
                                                               id="term_check_expert" name="expert_term" checked/>
                                                        <label class="form-check-label mb-2" for="term_check_expert">
                                                            <a href="includes/terms.html" download="terms.html">
                                                                Accetta termini e condizioni
                                                            </a>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mx-1 mb-4">
                                        <button type="submit" class="btn btn-block myButton register_button"
                                                name="register_expert_submit">Registrati
                                        </button>
                                    </div>
                                </form>
                                <div class="d-flex justify-content-between mb-3">
                                    <div>
                                        <button type="button" id="prev" class="btn btn-secondary btn-sm">
                                            <span class="glyphicon glyphicon-chevron-left">Prev</span>
                                        </button>
                                    </div>
                                    <div>
                                        <button type="button" id="next" class="btn btn-secondary btn-sm">
                                            <span class="glyphicon glyphicon-chevron-right">Next</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                    <h4 class="mb-1 mt-3">Piattaforma per l'esternalizzazione dei processi aziendali</h4>
                    <span class="small mb-0">Mettiamo in comunicazione enti pubblici e privati con i migliori esperti
                        in tutti i settori del business, della tecnologia e della finanza. Se non sei già registrato,
                        iscriviti subito per metterti a disposizione, se sei un esperto, o per proporre i tuoi progetti,
                        se sei un ente.
                    </span>
                    <h4 class="mb-1 mt-3">Registrazione rapida ed intuitiva, bastano 5 minuti!</h4>
                    <span class="small mb-0">
                        Avrai bisogno di una partita IVA e di un indirizzo di posta elettronica certificata (PEC) per registrarti;
                        ricordati anche di avere a portata di mano il tuo codice fiscale!
                    </span>
                    <h4 class="mb-1 mt-3">Applicazione web sicura ed in continuo aggiornamento</h4>
                    <span class="small mb-0">
                        Abbiamo a cuore la protezione dei tuoi dati personali e delle informazioni sensibili: è per questo che adottiamo
                        politiche di sicurezza informatica che scongiurano attacchi come SQL injection, XSS e brute-force password attacks.
                        Segui le indicazioni in fase di registrazione e scegli una password robusta, la sicurezza informatica parte dagli utenti!
                    </span>
                </div>
            </div>
        </div>
    </div>
</section>
<!--<?php require_once('includes/footer.php'); ?>-->
</body>
</html>

