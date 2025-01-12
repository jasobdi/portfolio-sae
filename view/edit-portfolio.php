<?php 
/** Seite "Portfolio" (projekte.php) anpassen */
include('../controller/edit-portfolio.php') ?>

<!DOCTYPE html>
<html lang="de">

<!--  HEAD  -->
<?php 
$siteTitle = 'Portfolio bearbeiten - CMS'; // <title>
include('../partials/head-cms.php') 
?>
<body>
    <!-- NAVIGATION -->
    <?php include('../partials/nav-cms.php') ?>

    <main class="main-edit-portfolio-cms">
        <h1>Portfolio bearbeiten</h1>

        <!-- Erfolgsmeldung -->
        <?php if (isset($_GET['success']) && $_GET['success'] == 1) { ?>
            <p class="success-message">Die Änderungen wurden erfolgreich gespeichert!</p>
        <?php } ?>

        <!-- Fehlermeldung -->
        <?php if (isset($error)) { ?>
            <p class="error-message"><?php echo htmlspecialchars($error); ?></p>
        <?php } ?>

        <form class="edit-portfolio" action="" method="POST" novalidate>
            <label for="pagetitle">Seitentitel*</label>
            <input type="text" name="pagetitle" id="pagetitle" value="<?php echo htmlspecialchars($currentPortfolioData['title']); ?>" required>

            <label for="desc-projects">Beschreibung</label>
            <textarea name="desc-projects" id="desc-projects" cols="30" rows="10"><?php echo htmlspecialchars($currentPortfolioData['description']); ?></textarea>
                
            <button type="submit" name="safe">Speichern</button> 
        </form>
    </main>

    <!-- FOOTER -->
    <?php include('../partials/footer-cms.php') ?>
</body>
</html>