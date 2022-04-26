<?php
require_once("info.php");
global $sitename;
if(!isset($_SESSION))
{
    session_start();
}
$username = $_SESSION["username"];
$usertype = $_SESSION["usertype"];
?>

<nav class="navbar navbar-expand-lg navbar-light" id="nav_header">
        <div class="container-fluid">
          <div class="title">
            <a class="navbar-brand"><?php echo($sitename); ?></a>
          </div>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="me.php">Dashboard</a>
              </li>
          <?php if($usertype == 'ente') { ?>
              <li class="nav-item">
                <a class="nav-link" href="processi.php">Processi</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="esperti.php">Esperti</a>
              </li>
          <?php } else { ?>
              <li class="nav-item">
                <a class="nav-link" href="titoli.php">Titoli di studio</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="competenze.php">Competenze</a>
              </li>
          <?php } ?>
              <li class="nav-item">
                <a class="nav-link" href="assegnazioni.php">Assegnazioni</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="scripts/logout.php"><button type="button">LOGOUT</button></a>
              </li>
            </ul>
          </div>
        </div>
    </nav>
