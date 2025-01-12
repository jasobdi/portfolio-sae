<!-- HTML zuoberst weil das Dokument im Browser sonst im "Quirk Mode" ist -->
<!-- Startseite CMS -->

<!DOCTYPE html>
<html lang="en">

<?php 
require_once('../controller/config.php');
require_once ('../controller/class/Auth.class.php');
require_once('../controller/class/Database.class.php');
require_once('../controller/edit-projects.php');

// Prüfen ob User eingeloggt ist
Auth::checkLogIn(); 

// Datenbankverbindung initialisieren
$db = Database::getInstance()->getConnection();

// Methode für neuste 3 Projekte abrufen
$latestProjects = Database::getInstance()->getLatestProjects();

$siteTitle = 'Dashboard - CMS'; // <title>
include('../partials/head-cms.php') 
?>

<body>
    <!-- NAVIGATION -->
    <?php include('../partials/nav-cms.php') ?>

    <main class="main-dashboard-cms">
        <h1>Dashboard</h1>
        <div class="dashboard-btns">
            <a href="new-project.php" class="btn-new-project-dashboard">Neues Projekt erstellen</a>
            <a href="edit-projects.php" class="btn-view-all-dashboard">Alle Projekte ansehen</a>
        </div>

        <!-- 3 neuste Projekte -->
        <section class="latest-projects-dashboard">
            <h2>Neuste Projekte</h2>

            <?php if (!empty($latestProjects)): ?>
                <div class="projects-grid">
                        <?php foreach ($latestProjects as $project): ?>
                            <div class="project-card">
                                <!-- Bild -->
                                <div class="project-card-image">
                                    <img src="../images/projects/<?php echo htmlspecialchars($project['filepath']); ?>" alt="<?php echo htmlspecialchars($project['title']); ?>" class="project-image">
                                </div>
                                <!-- Titel -->
                                <h3 class="project-card-title">
                                    <?php echo htmlspecialchars($project['title']); ?>
                                </h3>
                                <!-- Beschreibung -->
                                <p class="project-card-description">
                                    <?php echo htmlspecialchars($project['description']); ?>
                                </p>
                                <div class="project-card-actions">
                                    <!-- Bearbeiten Button -->
                                    <a href="edit-single-project.php?id=<?php echo $project['ID']; ?>" class="btn-edit-dashboard">Bearbeiten</a>
                                    <!-- Löschen-Button -->
                                    <a href="../controller/delete-project.php?id=<?php echo $project['ID']; ?>" class="btn-delete-dashboard" onclick="return confirm('Möchten Sie dieses Projekt wirklich löschen?');">Löschen</a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                </div>
                <!-- Wenn noch keine Projekte hochgeladen wurden: -->
            <?php else: ?>
                <p>Es wurden noch keine Projekte hinzugefügt.</p>
            <?php endif; ?>
        </section>

    </main>

    <!-- FOOTER -->
    <?php include('../partials/footer-cms.php') ?>
</body>
</html>
