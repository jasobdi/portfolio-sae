<!-- Neuer Seitenname: "Portfolio" - Dateiname bleibt vorerst "Projekte.php" -->

<?php
require_once('../controller/class/Database.class.php');

// Database-Klasse Initialisieren
$db = Database::getInstance(); 

// Titel & Beschreibung aus 'portfolio'-Tabelle SQL
$portfolioData = $db->getPortfolioData(); 

// Titel, Beschreibung & Bild aus 'project'-Tabelle SQL
$projectData = $db->getAllProjects(); 
?>

<!DOCTYPE html>
<html lang="de">
    
<!--  HEAD  -->
<?php
$siteTitle = 'Portfolio - Portfolio Janice Bader'; // <title>
include('../partials/head.php')
?>
<body>

    <!-- HEADER -->
    <header>
        <?php include('../partials/nav.php') ?>
    </header>

    <!-- MAIN -->
    <main class="main-projects">

        <h1><?php echo htmlspecialchars($portfolioData['title']); ?></h1>
        <p><?php echo nl2br(htmlspecialchars($portfolioData['description'])); ?></p>

        <section class="projects-wrap">
            <?php foreach ($projectData as $project) { ?>
                <ul class="post">
                    <li class="project-img">
                        <img src="../images/projects/<?php echo htmlspecialchars($project['filepath']); ?>" alt="<?php echo htmlspecialchars($project['title']); ?>">
                    </li>
                    <li class="project-title">
                        <a href="#"><?php echo htmlspecialchars($project['title']); ?></a>
                    </li>
                    <li class="project-description">
                        <?php echo nl2br(htmlspecialchars($project['description'])); ?>
                    </li>
                </ul>
            <?php } ?>
        </section>

    </main>

    <!-- FOOTER -->
    <?php include('../partials/footer.php') ?>

</body>

</html>