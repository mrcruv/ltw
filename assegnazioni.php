<?php
global $sitename;
require_once('includes/info.php');
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

    <?php require_once('includes/header.php'); ?>

    <div class="container-fluid">

        <?php if ($_SESSION['usertype'] == 'ente'): ?>
        
        <div class="row">
            <div class="col-4 offset-4 text-center align-middle mb-2">
                <h5>Aggiungi assegnazione</h5>
                <a class="btn btn-primary rounded-circle" id="add_button">+</a>

                <form id="add_availability_form" class="add_form" action="scripts/add_availability.php" method="post">
                    <div>
                        <div>
                            <select id="availability_process" class="form-select mt-4 mb-3" name="process">
                                <option selected disabled value="">Scegli il Processo</option>
                                <?php
                                require_once('scripts/show_process.php');
                                $array = show_all_processes($_SESSION['username']);
                                $n = count($array);
                                for ($i = 0; $i < $n; $i += 1) {
                                    echo('<option value="');
                                    echo($array[$i]['name']);
                                    echo('">');
                                    echo($array[$i]['name']);
                                    echo('</option>');
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div>
                        <div>
                            <select id="availability_expert" class="form-select mb-3" name="expert">
                                <option selected disabled value="">Scegli l'esperto</option>
                                <?php
                                require_once('scripts/show_expert.php');
                                $array = show_all_experts();
                                $n = count($array);
                                for ($i = 0; $i < $n; $i += 1) {
                                    echo('<option value="');
                                    echo($array[$i]['username']);
                                    echo('">');
                                    echo($array[$i]['username']);
                                    echo('</option>');
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary" name="add_availability_submit">Aggiungi</button>
                </form>
            </div>
        </div>

        <?php
        require_once('scripts/show_availability.php'); ?>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Processo</th>
                    <th scope="col">Esperto</th>
                    <th scope="col">Data della Richiesta</th>
                    <th scope="col">Data della Assegnazione</th>
                    <th scope="col">Data della Rifiuto</th>
                    <th scope="col">Stato</th>
                </tr>
            </thead>
            <tbody>
            <?php $array = show_all_availabilities_from_entity($_SESSION['username']);
            $n = count($array);
            if (!is_array($array) or $n <= 0) { ?>
                <tr><td colspan="7"><h6>Non ci sono Assegnazioni al momento</h6></td></tr>
            <?php
            }
            else {
                for ($i = 0; $i < $n; $i += 1) { ?>
                <tr>
                    <th scope="row"><?php echo $i+1?></th>
                    <td><?php echo($array[$i]['process']); ?></td>
                    <td><?php echo($array[$i]['expert']); ?></td>
                    <td><?php echo($array[$i]['request_date']); ?></td>
                    <td><?php echo($array[$i]['allocation_date']); ?></td>
                    <td><?php echo($array[$i]['rejection_date']); ?></td>
                    <?php 
                    if (is_null($array[$i]['allocation_date'])) {
                        if (is_null($array[$i]['rejection_date'])) {
                            echo('<td>' . 'assegnazione pendente' . '</td>');
                        }
                        else {
                            echo('<td>' . 'assegnazione rifiutata' . '</td>');
                        }
                    }
                    else {
                        echo('<td>' . 'assegnazione accettata' . '</td>');
                    }

                    ?>
                </tr>
                <?php
                }
            }  ?> 
            </tbody>
        </table>

        <?php else: ?>

        <?php
        require_once('scripts/show_availability.php'); ?>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Processo</th>
                    <th scope="col">Esperto</th>
                    <th scope="col">Data della Richiesta</th>
                    <th scope="col">Data della Assegnazione</th>
                    <th scope="col">Data del Rifiuto</th>
                    <th scope="col">Stato</th>
                </tr>
            </thead>
            <tbody>
            <?php $array = show_all_availabilities_from_expert($_SESSION['username']);
            $n = count($array);
            if (!is_array($array) or $n <= 0) { ?>
                <tr><td colspan="7"><h6>Non ci sono Assegnazioni al momento</h6></td></tr>
            <?php
            }
            else {
                for ($i = 0; $i < $n; $i += 1) { ?>
                <tr>
                    <th scope="row"><?php echo($i+1); ?></th>
                    <td><?php echo($array[$i]['process']); ?></td>
                    <td><?php echo($array[$i]['entity']); ?></td>
                    <td><?php echo($array[$i]['request_date']); ?></td>
                    <td><?php echo($array[$i]['allocation_date']); ?></td>
                    <td><?php echo($array[$i]['rejection_date']); ?></td>
                    <?php
                    $disabled = '';
                    if (is_null($array[$i]['allocation_date'])) {
                        if (is_null($array[$i]['rejection_date'])) {
                            echo('<td>' . 'assegnazione pendente' . '</td>');
                        }
                        else {
                            $disabled = 'disabled';
                            echo('<td>' . 'assegnazione rifiutata' . '</td>');
                        }
                    }
                    else {
                        $disabled = 'disabled';
                        echo('<td>' . 'assegnazione accettata' . '</td>');
                    }
                    echo('<td><a href="scripts/accept_reject.php?action=accept&process=' . $array[$i]['process'] . '">');
                    echo('<button type="button"' . $disabled . '>' . 'accetta' . '</button></a>');
                    echo('<a href="scripts/accept_reject.php?action=reject&process=' . $array[$i]['process'] . '">');
                    echo('<button type="button"' . $disabled . '>' . 'rifiuta' . '</button></a>');
                    ?>
                </tr>
                <?php
                }
            }  ?> 
            </tbody>
        </table>
        
        <?php endif ?>
    
    </div>

    <?php require_once('includes/footer.php'); ?>
</body>
</html>
