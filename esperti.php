<?php
global $sitename_brief, $authors;
require_once('includes/info.php');
require_once('includes/session.php');
require_once('scripts/show_expert.php');
if (!isset($_SESSION['usertype']) or $_SESSION['usertype'] != 'ente') {
    header('Location: me.php?err=sessione+utente+ente+non+attiva');
    die('sessione utente ente non attiva');
}
if (isset($_GET['username']) and !expert_exists($_GET['username'])) {
    header('Location: esperti.php?err=esperto+non+esistente');
    die('esperto non esistente');
}
$username = $_SESSION['username'];
$usertype = $_SESSION['usertype'];
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="utf-8">
    <meta name="keywords" content="esperti, competenze, titoli di studio"/>
    <meta name="description" content="visualizzazione degli esperti"/>
    <meta name="author" content="<?php echo(implode(', ', $authors)); ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" type="image/x-icon" href="img/prova_logo.ico">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="scripts/error.js"></script>
    <script src="scripts/message.js"></script>
    <title><?php echo($sitename_brief . ': esperti - ' . $usertype . ' ' . $username); ?></title>
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
<div class="container-fluid">
    <div class="row border-bottom border-3 mb-5">
        <h2>Esperti</h2>
    </div>
    <?php
    if (isset($_GET['username'])) {
        echo('<script type="text/javascript">
			$(document).ready(function(){
				$("#exampleModalToggle").modal("show");
			});
		    </script>');
    }
    ?>
    <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"
         tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalToggleLabel">Titoli di studio</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Titolo</th>
                            <th scope="col">Data conseguimento</th>
                            <th scope="col">Note</th>
                            <th scope="col">Voto</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $array = show_expert_title($_GET['username']);
                        $n = count($array);
                        if (!is_array($array) or $n <= 0): ?>
                            <tr>
                                <td colspan="6"><h6>L'esperto selezionato non ha inserito titoli di studio al
                                        momento</h6></td>
                            </tr>
                        <?php else: ?>
                            <?php
                            for ($i = 0; $i < $n; $i += 1) { ?>
                                <tr>
                                    <th scope="row"><?php echo($i + 1); ?></th>
                                    <td><?php echo($array[$i]['title']); ?></td>
                                    <td><?php echo($array[$i]['date']); ?></td>
                                    <td><?php echo($array[$i]['notes']); ?></td>
                                    <td><?php echo($array[$i]['grade']); ?></td>
                                </tr>
                            <?php } ?>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-outline-primary" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal"
                            data-bs-dismiss="modal">Passa alle competenze
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2"
         tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalToggleLabel2">Competenze</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Competenza</th>
                            <th scope="col">Settore</th>
                            <th scope="col">Descrizione</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $array = show_expert_competence($_GET['username']);
                        $n = count($array);
                        if (!is_array($array) or $n <= 0): ?>
                            <tr>
                                <td colspan="6"><h6>L'esperto selezionato non ha inserito competenze al momento</h6>
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php for ($i = 0; $i < $n; $i += 1) { ?>
                                <tr>
                                    <th scope="row"><?php echo($i + 1); ?></th>
                                    <td><?php echo($array[$i]['competence']); ?></td>
                                    <td><?php echo($array[$i]['area']); ?></td>
                                    <td><?php echo($array[$i]['description']); ?></td>
                                </tr>
                            <?php } ?>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-outline-primary" data-bs-target="#exampleModalToggle" data-bs-toggle="modal"
                            data-bs-dismiss="modal">Torna ai titoli di studio
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <?php
        $array = show_all_experts();
        $n = count($array);
        $numOfCols = 6;
        $rowCount = 0;
        $bootstrapColWidth = 12 / $numOfCols;
        if (!is_array($array) or $n <= 0): ?>
            <h6>Non ci sono esperti al momento</h6>
        <?php else: ?>
        <?php for ($i = 0; $i < $n; $i += 1) { ?>
            <div class="col-md-<?php echo($bootstrapColWidth); ?>">
                <div class="card radius-15 shadow">
                    <div class="card-body text-center">
                        <div class="p-4 border radius-15">
                            <img src="img/logo_esperto.png" class="rounded-circle shadow" alt="">
                            <h5 class="mb-0 mt-2">
                                <?php if (!is_null($array[$i]['website'])): ?>
                                    <a href="<?php echo($array[$i]['website']) ?>"><?php echo($array[$i]['username']); ?></a>
                                <?php else:
                                    echo($array[$i]['username']);
                                endif;
                                ?>
                            </h5>
                            <p class="mb-1"><?php echo($array[$i]['name'] . " " . $array[$i]['surname']); ?> </p>
                            <p class="mb-1"><?php echo($array[$i]['pec']); ?></p>
                            <p class="mb-1"><?php echo($array[$i]['city']); ?></p>
                            <p class="mb-3"><?php echo($array[$i]['date']); ?></p>
                            <a class="btn btn-outline-primary"
                               href="esperti.php?username=<?php echo($array[$i]['username']); ?>"
                               role="button">Altro</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            $rowCount++;
            if ($rowCount % $numOfCols == 0) echo('</div><div class="row">'); ?>
        <?php } ?>
    </div>
<?php endif; ?>
</div>
<?php require_once('includes/footer.php'); ?>
</body>
</html>

