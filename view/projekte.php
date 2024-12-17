<?php 
// Datenbankverbindung & Abrufen von Daten
require_once('../controller/class/Database.class.php');
$db = Database::getInstance(); // Database-Klasse Initialisieren
$PortfolioData = $db->getPortfolioData(); // Daten aus der Datenbank holen
?>


<!DOCTYPE html>
<html lang="de">
    <!--  HEAD  -->
    <?php include('../partials/head.php') ?>
    
<body>

    <!-- HEADER -->
    <header>
        <?php include('../partials/nav.php') ?>
    </header>

    <!-- MAIN -->
    <main class="main-projects">
        <h1><?php echo htmlspecialchars($PortfolioData['title']); ?></h1>
        <p><?php echo nl2br(htmlspecialchars($PortfolioData['description'])); ?></p>
        <section class="projects-wrap">
            <!-- java script: projekte.json -->
        </section>
    </main>

    <!-- FOOTER -->
    <?php include('../partials/footer.php') ?>
    
</body>
</html>