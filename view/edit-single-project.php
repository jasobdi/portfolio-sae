<?php 
/** Einzelnes Projekt bearbeiten im CMS */
require_once('../controller/edit-single-project.php');
?>

<!DOCTYPE html>
<html lang="de">
<!-- HEAD -->
<?php 
$siteTitle = 'Projekt bearbeiten - CMS'; // <title>
include('../partials/head-cms.php') 
?>

<body>
    <!-- NAVIGATION -->
    <?php include('../partials/nav-cms.php') ?>

    <main class="main-edit-single-project-cms">
        <h1>Projekt bearbeiten</h1>

        <!-- Erfolgsmeldung -->
        <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
            <p class="success-message">Die Änderungen wurden erfolgreich gespeichert!</p>
        <?php elseif (isset($errorMessage)): ?>
            <p class="error-message"><?php echo htmlspecialchars($errorMessage); ?></p>
        <?php endif; ?>

        <form method="post" enctype="multipart/form-data" novalidate>
            <input type="hidden" name="project_id" value="<?php echo htmlspecialchars($project['ID']); ?>">

            <div class="form-check">
                <label for="title">Titel</label>
                <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($project['title']); ?>" required>
            </div>

            <div class="form-check">
                <label for="description">Beschreibung</label>
                <textarea id="description" name="description" rows="5" required><?php echo htmlspecialchars($project['description']); ?></textarea>
            </div>

            <div class="form-check">
                <label for="image">Bild</label>
                <input type="file" id="image" name="image">
                <?php if (!empty($project['filepath'])): ?>
                    <img src="../images/projects/<?php echo htmlspecialchars($project['filepath']); ?>" alt="Projektbild" width="200">
                <?php endif; ?>
            </div>

            <button type="submit" name="update">Speichern</button>
        </form>
    </main>

    <!-- FOOTER -->
    <?php include('../partials/footer-cms.php') ?>
</body>
</html>
