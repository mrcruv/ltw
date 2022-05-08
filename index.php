<?php
global $sitename;
require_once('includes/info.php');
if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION['username'])) {
    header('Location: me.php');
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>

    <script src="scripts/form_switch.js"></script>
    <script src="scripts/validate_register_entity.js"></script>
    <script src="scripts/validate_register_expert.js"></script>

    <title><?php echo($sitename); ?></title>
</head>
<body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>


<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <img src="img/img1.png" alt="Image" class="img-fluid">
            </div>
            <div class="col-md-2"></div>
            <div class="col-md-5 contents">

                <ul class="nav nav-pills nav-justified mb-3" id="login_register_nav" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" data-target="pills-login" href="#">Login</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="tab-register" data-target="pills-register" href="#">Register</a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div class="tab active" data-tab="pills-login">
                        <form id="login_form" action="<?php echo('scripts/login.php'); ?>" method="post">

                            <div class="form-outline mb-2">
                                <input type="text" id="login_username" class="form-control" placeholder="Username" name="username"/>
                            </div>

                            <div class="form-outline mb-4">
                                <input type="password" id="login_password" class="form-control" placeholder="Password" name="password" aria-describedby="password_help"/>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-6 d-flex justify-content-center">
                                    <div class="form-check mb-3 mb-md-0">
                                        <input class="form-check-input" type="checkbox" id="remember_me_login" name="remember"/>
                                        <label class="form-check-label" for="remember_me_login"> Remember me </label>
                                    </div>
                                </div>

                                <div class="col-md-6 d-flex justify-content-center mb-2">
                                    <a href="#">Forgot password?</a>
                                </div>

                                <button type="submit" class="btn btn-primary btn-block mb-4" name="login_submit">Sign in</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="tab-content">
                    <div class="tab" data-tab="pills-register">
                        <ul class="nav nav-pills nav-justified mb-3 border rounded" id="entity_expert_name" role="tablist">
                            <li><button class="btn switch" type="button" id="entity_button">Ente</button></li>
                            <li><button class="btn switch" type="button" id="expert_button">Esperto</button></li>
                            <!--<input type="checkbox" id="register_user_type" name="user_type">-->
                        </ul>

                        <h3 id="text_entity">Ente</h3>
                        <h3 id="text_expert">Esperto</h3>

                        <form id="register_entity_form" action="<?php echo('scripts/register_entity.php'); ?>" method="post">

                            <div class="form-outline mb-2">
                                <input type="text" id="register_entity_username" class="form-control" placeholder="Username" name="entity_username"/>
                            </div>

                            <div class="form-outline mb-2">
                                <input type="email" id="register_entity_pec" class="form-control" placeholder="PEC" name="entity_pec"/>
                            </div>

                            <div class="form-outline mb-2">
                                <input type="text" id="register_entity_cf" class="form-control" placeholder="Codice Fiscale" name="entity_cf"/>
                            </div>

                            <div class="form-outline mb-2">
                                <input type="text" id="register_entity_piva" class="form-control" placeholder="Partita IVA" name="entity_piva"/>
                            </div>

                            <div class="form-outline mb-4">
                                <input type="text" id="register_entity_website" class="form-control" placeholder="Sito Web" name="entity_website"/>
                            </div>

                            <div class="form-outline mb-4">
                                <input type="password" aria-describedby="password_help" id="register_entity_password" class="form-control" placeholder="Password" name="entity_password"/>
                            </div>

                            <div class="form-outline mb-2">
                                <select class="form-select" id="register_entity_type" name="type">
                                    <option selected disabled>Scegli il tipo di Ente</option>
                                    <option value="pubblico">Ente pubblico</option>
                                    <option value="privato">Ente privato</option>
                                </select>
                            </div>

                            <div class="form-outline mb-4">
                                <input type="text" id="register_entity_name" class="form-control" placeholder="Denominazione" name="entity_name"/>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md d-flex justify-content-center">
                                    <div class="form-check mb-2 mb-md-0">
                                        <input class="form-check-input" type="checkbox" value="yes" id="termCheck_entity" name="entity_term"/>
                                        <label class="form-check-label mb-2" for="termCheck">Accetta Termini & Condizioni</label>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary btn-block" name="register_submit">Registrati</button>
                            </div>
                        
                        </form>

                        <form id="register_expert_form" action="<?php echo('scripts/register_expert.php'); ?>" method="post">

                            <div class="form-outline mb-2">
                                <input type="text" id="register_expert_username" class="form-control" placeholder="Username" name="expert_username"/>
                            </div>

                            <div class="form-outline mb-2">
                                <input type="email" id="register_expert_pec" class="form-control" placeholder="PEC" name="expert_pec"/>
                            </div>

                            <div class="form-outline mb-2">
                                <input type="text" id="register_expert_cf" class="form-control" placeholder="Codice Fiscale" name="expert_cf"/>
                            </div>

                            <div class="form-outline mb-2">
                                <input type="text" id="register_expert_piva" class="form-control" placeholder="Partita IVA" name="expert_piva"/>
                            </div>

                            <div class="form-outline mb-4">
                                <input type="text" id="register_expert_website" class="form-control" placeholder="Sito Web" name="expert_website"/>
                            </div>

                            <div class="form-outline mb-4">
                                <input type="password" aria-describedby="password_help" id="register_expert_password" class="form-control" placeholder="Password" name="expert_password"/>
                            </div>

                            <div class="form-outline mb-2">
                                    <input type="text" id="register_expert_name" class="form-control" placeholder="Nome" name="name"/>
                            </div>

                            <div class="form-outline mb-2">
                                <input type="text" id="register_expert_surname" class="form-control" placeholder="Cognome" name="surname"/>
                            </div>

                            <div class="form-outline mb-2">
                                <input type="text" id="register_expert_city" class="form-control" placeholder="Città di Nascita" name="city"/>
                            </div>

                            <div class="form-outline mb-4">
                                <input type="date" id="register_expert_date" class="form-control" placeholder="Data di Nascita" name="date"/>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md d-flex justify-content-center">
                                    <div class="form-check mb-2 mb-md-0">
                                        <input class="form-check-input" type="checkbox" value="" id="termCheck_expert" name="expert_term"/>
                                        <label class="form-check-label mb-2" for="termCheck">Accetta Termini & Condizioni</label>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary btn-block" name="register_submit">Registrati</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>

