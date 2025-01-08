<?php include('../controller/edit-projects.php') ?>

<!DOCTYPE html>
<html lang="en">
<!--  HEAD  -->
<?php 
$siteTitle = 'Projekte - CMS'; // <title>
include('../partials/head-cms.php') 
?>

<body>
    <!-- NAVIGATION -->
    <?php include('../partials/nav-cms.php') ?>

    <main class="main-edit-projects-cms">
        <h1>Projekte</h1>

        <!-- Erfolgsmeldung -->
        <?php if (isset($_GET['success']) && $_GET['success'] == 1){ ?>
            <p class="success-message">Die Datei wurde erfolgreich hochgeladen!</p>
        <?php } ?>
        <a href="new-project.php" class="btn-new-project">Neues Projekt</a>
        <section class="project-edit">
                <?php if (isset($_GET['delete'])): ?>
                    <?php if ($_GET['delete'] == 'success'): ?>
                    <p class="success-message">Das Projekt wurde erfolgreich gelöscht!</p>
                        <?php elseif ($_GET['delete'] == 'error'): ?>
                        <p class="error-message">Es gab ein Problem beim Löschen des Projekts. Bitte versuchen Sie es erneut.</p>
                        <?php elseif ($_GET['delete'] == 'invalid'): ?>
                        <p class="error-message">Ungültige Projekt-ID. Das Projekt konnte nicht gelöscht werden.</p>
                    <?php endif; ?>
                <?php endif; ?>

            <?php if (!empty($allProjects)): ?>
        <table class="project-table">
            <tbody>
                <?php foreach ($allProjects as $project){ ?>
                    <tr>
                        <td><?php echo htmlspecialchars($project['title']); ?></td>
                        <td>
                            <!-- Bearbeiten-Button -->
                            <a href="edit-single-project.php?id=<?php echo $project['ID']; ?>" class="btn-edit">Bearbeiten</a>
                            <!-- Löschen-Button -->
                            <a href="../controller/delete-project.php?id=<?php echo $project['ID']; ?>" class="btn-delete" onclick="return confirm('Möchten Sie dieses Projekt wirklich löschen?');">Löschen</a>

                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Es wurden noch keine Projekte hinzugefügt.</p>
    <?php endif; ?>
        </section>
    </main>
    <!-- FOOTER -->
    <?php include('../partials/footer-cms.php') ?>
</body>

</html>