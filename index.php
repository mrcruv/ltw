<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="keywords" content=""/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Title</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>
<body class="d-flex flex-column min-vh-100">
    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <form id="register_form" action="scripts/register.php" method="post" onsubmit="return validate_register();">
        <div>
            <div>
                <label for="register_username">Username</label>
                <input type="text" id="register_username" placeholder="Inserisci username" name="username">
            </div>
        </div>
        <div>
            <label for="register_pec">PEC</label>
            <input type="email" id="register_pec" placeholder="Inserisci PEC" name="pec">
        </div>
        <div>
            <label for="register_password">Password</label>
            <input type="password" aria-describedby="password_help" id="register_password" placeholder="Inserisci password" name="password">
        </div>
        <div>
            <label for="register_cf">Codice fiscale</label>
            <input type="text" id="register_cf" placeholder="Inserisci codice fiscale" name="cf">
        </div>
        <div>
            <label for="register_piva">Partita Iva</label>
            <input type="text" id="register_piva" placeholder="Inserisci partita iva" name="piva">
        </div>
        <div>
            <label for="register_website">Sito web</label>
            <input type="text" id="register_website" placeholder="Inserisci sito web" name="website">
        </div>

        <br>
        <label>Ente</label>
        <br>

        <div>
            <label for="register_type">Tipo ente</label>
            <select id="register_type" name="type">
                <option value="pubblico">pubblico</option>
                <option value="privato">privato</option>
            </select>
        </div>
        <div>
            <label for="register_company_name">Denominazione</label>
            <input type="text" id="register_company_name" placeholder="Inserisci denominazione" name="company_name">
        </div>

        <br>
            <label>Esperto</label>
        <br>

        <div>
            <label for="register_name">Nome</label>
            <input type="text" id="register_name" placeholder="Inserisci nome" name="name">
        </div>
        <div>
            <label for="register_surname">Cognome</label>
            <input type="text" id="register_surname" placeholder="Inserisci cognome" name="surname">
        </div>
        <div>
            <label for="register_city">Denominazione</label>
            <input type="text" id="register_city" placeholder="Inserisci citta' di nascita" name="city">
        </div>
        <div>
            <label for="register_date">Data di nascita</label>
            <input type="date" id="register_date" placeholder="Inserisci data di nascita" name="date">
        </div>
        <div>
            <input type="checkbox" id="accept_conditions" name="accept_conditions">
            <label for="accept_conditions">Accetto termini e condizioni</label>
        </div>

        <button type="submit" name="register_submit">Registrati!</button>
    </form>

    <br>

    <form id="login_form" action="scripts/login.php" method="post" onsubmit="return validate_login();">
        <div>
            <div>
                <label for="login_username">Username</label>
                <input type="text" id="login_username" placeholder="Inserisci username" name="username">
            </div>
        </div>
        <div>
            <label for="login_password">Password</label>
            <input type="password" aria-describedby="password_help" id="login_password" placeholder="Inserisci password" name="password">
        </div>
        <div>
            <input type="checkbox" id="remember_me_login" name="remember">
            <label for="remember_me_login">Ricordami</label>
        </div>
        <button type="submit" name="login_submit">Effettua il login!</button>
    </form>


    <?php require_once 'includes/footer.php';?>

</body>
</html>
