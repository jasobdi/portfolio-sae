<?php 
require_once('../controller/config.php');
require_once ('../controller/class/Auth.class.php');

// Prüfen ob User eingeloggt ist anhand von CheckLogIn-Methode von Auth.class.php
Auth::checkLogIn(); 
?>

<!DOCTYPE html>
<html lang="en">
<!--  HEAD  -->
<?php include('../partials/head-cms.php') ?>
<body>
    <!-- NAVIGATION -->
    <?php include('../partials/nav-cms.php') ?>

    <main class="main-dashboard-cms">
        <h1>Dashboard</h1>
        <button class="new-project-btn"> 
            <a href="edit-projects.php">Neues Projekt
                <i class="fa-solid fa-circle-plus"></i>
            </a>
        </button>
    </main>
    <!-- FOOTER -->
    <?php include('../partials/footer-cms.php') ?>
</body>
</html>