<?php
require_once 'includes/info.php';
global $sitename;
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

    <script src="scripts/form_switch.js"></script>
    <script>
        $(document).ready(function(){
            $("#expert_fields").hide();
            $("#entity_button").attr("disabled", true);
            $("#register_user_type").prop('checked', true);
            switch_form_handler();
        });
    </script>

    <title><?php echo($sitename); ?></title>
</head>
<body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>


<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <img src="" alt="Image" class="img-fluid">
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
                        <form id="login_form" action="scripts/login.php" method="post" onsubmit="return validate_login();">

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
                                    <a href="#!">Forgot password?</a>
                                </div>

                                <button type="submit" class="btn btn-primary btn-block mb-4" name="login_submit">Sign in</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="tab-content">
                    <div class="tab" data-tab="pills-register">
                        <ul class="nav nav-pills nav-justified mb-3 border rounded" id="entity_expert_name" role="tablist">
                            <button class="btn switch" type="button" id="entity_button">Ente</button>
                            <button class="btn switch" type="button" id="expert_button">Esperto</button>
                            <input type="checkbox" id="register_user_type" name="user_type">
                        </ul>

                        <h3 id="text_entity">Ente</h3>
                        <h3 id="text_expert">Esperto</h3>

                        <form id="register_form" action="scripts/register.php" method="post" onsubmit="return validate_register();">
                            <div class="form-outline mb-2">
                                <input type="text" id="register_username" class="form-control" placeholder="Username" name="username"/>
                            </div>

                            <div class="form-outline mb-2">
                                <input type="email" id="register_pec" class="form-control" placeholder="PEC" name="pec"/>
                            </div>

                            <div class="form-outline mb-2">
                                <input type="text" id="register_cf" class="form-control" placeholder="Codice Fiscale" name="cf"/>
                            </div>

                            <div class="form-outline mb-2">
                                <input type="text" id="register_piva" class="form-control" placeholder="Partita IVA" name="piva"/>
                            </div>

                            <div class="form-outline mb-4">
                                <input type="text" id="register_website" class="form-control" placeholder="Sito Web" name="website"/>
                            </div>

                            <div class="form-outline mb-4">
                                <input type="password" aria-describedby="password_help" id="register_password" class="form-control" placeholder="Password" name="password"/>
                            </div>

                            <div id="entity_fields">
                                <div class="form-outline mb-2">
                                    <select class="form-select" id="register_type" name="type">
                                        <option selected>Scegli il tipo di Ente</option>
                                        <option value="Pubblico">Pubblico</option>
                                        <option value="Privato">Privato</option>
                                    </select>
                                </div>

                                <div class="form-outline mb-4">
                                    <input type="text" id="register_entity_name" class="form-control" placeholder="Denominazione" name="entity_name"/>
                                </div>
                            </div>

                            <div id="expert_fields">
                                <div class="form-outline mb-2">
                                    <input type="text" id="register_name" class="form-control" placeholder="Nome" name="name"/>
                                </div>

                                <div class="form-outline mb-2">
                                    <input type="text" id="register_surname" class="form-control" placeholder="Cognome" name="surname"/>
                                </div>

                                <div class="form-outline mb-2">
                                    <input type="text" id="register_city" class="form-control" placeholder="Città di Nascita" name="city"/>
                                </div>

                                <div class="form-outline mb-4">
                                    <input type="date" id="register_date" class="form-control" placeholder="Data di Nascita" name="date"/>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md d-flex justify-content-center">
                                    <div class="form-check mb-2 mb-md-0">
                                        <input class="form-check-input" type="checkbox" value="" id="termCheck"/>
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
</div>

<script src="script.js"></script>

</body>
</html>
