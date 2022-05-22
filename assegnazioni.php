<?php
global $sitename_brief;
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
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="scripts/error.js"></script>
    <script src="scripts/message.js"></script>

    <title><?php echo($sitename_brief . ': assegnazioni - ' . $usertype . ' ' . $username); ?></title>
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
        <div class="row border-bottom border-3 mb-5">
            <h2>Assegnazioni - <?php echo($username); ?> </h2>
        </div>

        <?php if ($usertype == 'ente'): ?>
        
        <div class="row">
            <div class="col-4 offset-4 text-center align-middle mb-2">
                <h5>Aggiungi assegnazione</h5>
                <a type="button" class="btn btn-info rounded-circle" id="add_button"><i class="fa fa-plus"></i></a>

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

        <div class="row mt-3">
            <?php $array = show_all_availabilities_from_entity($_SESSION['username']);
            $n = count($array);
            $numOfCols = 4;
            $rowCount = 0;
            $bootstrapColWidth = 12 / $numOfCols;
            if (!is_array($array) or $n <= 0) { ?>
                <h6>Non ci sono Assegnazioni al momento</h6>
            <?php
            }
            else {
                for ($i = 0; $i < $n; $i += 1) { ?>
                <div class="col-md-<?php echo($bootstrapColWidth); ?>">
                    <div class="card p-3 mb-2 shadow">
                        <div class="d-flex justify-content-between">
                            <div class="d-flex flex-row align-items-center">
                                <div class="ms-2 c-details">
                                    <h6 class="mb-0">Data della richiesta</h6> <span><?php echo($array[$i]['request_date']); ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="mt-5">
                            <h3 class="heading"><?php echo($array[$i]['process']); ?></h3>
                            <h5><?php echo($array[$i]['description']); ?></h5>
                            <h4><?php echo($array[$i]['expert']); ?></h4>
                            <div class="mt-5">
                            <?php 
                                if (is_null($array[$i]['allocation_date'])) {
                                    if (is_null($array[$i]['rejection_date'])) {?>

                                        <div class="mt-2"> <span class="text1"><span class="text2">Richiesta pendente</span></span> </div>
                                        <div class="progress mt-1">
                                            <div class="progress-bar" role="progressbar" style="width: 50%; background-color: blue;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    <?php
                                    }
                                    else {?>
                                        <div class="mt-2"> <span class="text1">Assegnazione rifiutata:<span class="text2"></span> <?php echo($array[$i]['rejection_date']); ?></span> </div>
                                        <div class="progress mt-1">
                                            <div class="progress-bar" role="progressbar" style="width: 100%; background-color: red;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    <?php
                                    }
                                }
                                else {?>
                                        <div class="mt-2"> <span class="text1">Assegnazione accettata:<span class="text2"></span> <?php echo($array[$i]['allocation_date']); ?></span> </div>
                                        <div class="progress mt-1">
                                            <div class="progress-bar" role="progressbar" style="width: 100%; background-color: green;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    <?php
                                }

                            ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                $rowCount++;
                if($rowCount % $numOfCols == 0) echo('</div><div class="row">');
                }
            }  ?> 
        </div>
        <?php else: ?>

        <?php
        require_once('scripts/show_availability.php'); ?>

        <div class="row mt-5">

            <?php $array = show_all_availabilities_from_expert($_SESSION['username']);
            $n = count($array);
            $numOfCols = 4;
            $rowCount = 0;
            $bootstrapColWidth = 12 / $numOfCols;
            if (!is_array($array) or $n <= 0) { ?>
            <h6>Non ci sono Assegnazioni al momento</h6>
            <?php
            }
            else {
                for ($i = 0; $i < $n; $i += 1) { ?>
                <div class="col-md-<?php echo($bootstrapColWidth); ?>">
                    <div class="card p-3 mb-2 shadow">
                        <div class="d-flex justify-content-between">
                            <div class="d-flex flex-row align-items-center">
                                <div class="ms-2 c-details">
                                    <h6 class="mb-0">Data della richiesta</h6> <span><?php echo($array[$i]['request_date']); ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="mt-5">
                            <h3 class="heading"><?php echo($array[$i]['process']); ?></h3>
                            <h5><?php echo($array[$i]['description']); ?></h5>
                            <h4><?php echo($array[$i]['entity']); ?></h4>
                            <div class="mt-5">
                            <?php 
                                $disabled = '';
                                if (is_null($array[$i]['allocation_date'])) {
                                    if (is_null($array[$i]['rejection_date'])) {?>
                                        <div class="mt-2 text-center">
                                            <a class="align-left" href="scripts/accept_reject.php?action=accept&process=<?php echo($array[$i]['process']); ?>" ><button class="btn btn-success" type="button" <?php echo($disabled); ?>>Accetta</button></a>
                                            <a class="align-right" href="scripts/accept_reject.php?action=reject&process=<?php echo($array[$i]['process']); ?>" ><button class="btn btn-danger" type="button" <?php echo($disabled); ?>>Rifiuta</button></a>
                                        </div>
                                    <?php
                                    }
                                    else {?>
                                        <div class="mt-2"> <span class="text1">Assegnazione rifiutata:<span class="text2"></span> <?php echo($array[$i]['rejection_date']); ?></span> </div>
                                        <div class="progress mt-1">
                                            <div class="progress-bar" role="progressbar" style="width: 100%; background-color: red;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    <?php
                                    }
                                }
                                else {?>
                                        <div class="mt-2"> <span class="text1">Assegnazione accettata:<span class="text2"></span> <?php echo($array[$i]['allocation_date']); ?></span> </div>
                                        <div class="progress mt-1">
                                            <div class="progress-bar" role="progressbar" style="width: 100%; background-color: green;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    <?php
                                }

                            ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                $rowCount++;
                if($rowCount % $numOfCols == 0) echo('</div><div class="row">');
                }
            }
            ?>
            </div>
        
        <?php endif ?>
    
    </div>

    <?php require_once('includes/footer.php'); ?>
</body>
</html>
