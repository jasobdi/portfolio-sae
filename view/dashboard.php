<!-- HTML zuoberst weil das Dokument im Browser sonst im "Quirk Mode" ist -->
<!-- Startseite CMS -->

<!DOCTYPE html>
<html lang="en">

<?php 
require_once('../controller/config.php');
require_once ('../controller/class/Auth.class.php');
require_once('../controller/edit-projects.php');

// Prüfen ob User eingeloggt ist
Auth::checkLogIn(); 

$siteTitle = 'Dashboard - CMS'; // <title>
include('../partials/head-cms.php') 
?>

<body>
    <!-- NAVIGATION -->
    <?php include('../partials/nav-cms.php') ?>

    <main class="main-dashboard-cms">
        <h1>Dashboard</h1>
        <a href="new-project.php" class="btn-new-project">Neues Projekt</a>
        <a href="edit-projects.php" class="btn-view-all">Alle Projekte anzeigen</a>
    </main>
    <!-- FOOTER -->
    <?php include('../partials/footer-cms.php') ?>
</body>
</html>
