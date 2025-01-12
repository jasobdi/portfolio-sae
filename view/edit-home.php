<?php 
/** Seite "Home" (home.php) bearbeiten */
include('../controller/edit-home.php') ?>

<!DOCTYPE html>
<html lang="de">
<!--  HEAD  -->
<?php 
$siteTitle = 'Home bearbeiten - CMS'; // <title>
include('../partials/head-cms.php') 
?>

<body>
    <!-- NAVIGATION -->
    <?php include('../partials/nav-cms.php') ?>

    <main class="main-edit-home-cms">
        <h1>Home bearbeiten</h1>

        <!-- Erfolgsmeldung -->
        <?php if (isset($_GET['success']) && $_GET['success'] == 1) { ?>
            <p class="success-message">Die Änderungen wurden erfolgreich gespeichert!</p>
        <?php } ?>

        <!-- Fehlermeldung -->
        <?php if (isset($error)) { ?>
            <p class="error-message"><?php echo htmlspecialchars($error); ?></p>
        <?php } ?>
        
        <form class="edit-home" action="" method="POST" novalidate>

            <label for="pagetitle">Seitentitel*</label>
            <input type="text" name="pagetitle" id="pagetitle" value="<?php echo htmlspecialchars($currentTitle['title'] ?? ''); ?>" required>

            <button type="submit" name="safe">Speichern</button>

        </form>
    </main>

    <!-- FOOTER -->
    <?php include('../partials/footer-cms.php') ?>
</body>
</html>