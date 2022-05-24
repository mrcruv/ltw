<?php
global $sitename;
require_once('info.php');
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['username'])) {
    header('Location: ../index.php?err=sessione+utente+non+attiva');
    die('sessione utente non attiva');
}
$username = $_SESSION['username'];
$usertype = $_SESSION['usertype'];
?>

<nav class="navbar navbar-expand-lg navbar-light shadow p-2 mb-4" id="nav_header">
    <div class="container-fluid">
        <div class="title">
            <a class="navbar-brand"><?php echo($sitename); ?></a>
        </div>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="me.php">Dashboard</a>
                </li>
                <?php if ($usertype == 'ente'): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="processi.php">Processi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="esperti.php">Esperti</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="titoli.php">Titoli di studio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="competenze.php">Competenze</a>
                    </li>
                <?php endif ?>
                <li class="nav-item">
                    <a class="nav-link" href="assegnazioni.php">Assegnazioni</a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="scripts/logout.php">
                        <button class="btn btn-secondary btn-lg btn-sm" type="button">Logout</button>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

