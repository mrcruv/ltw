<?php
require_once("info.php");
global $sitename;
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
                <a class="nav-link" aria-current="page" href="">Opzione 1</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="">Opzione 2</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="">Opzione 3</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="">Opzione 4</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="">Opzione 5</a>
              </li>
            </ul>
          </div>
        </div>
    </nav>
