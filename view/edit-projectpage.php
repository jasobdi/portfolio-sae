<?php include('../controller/edit-projectpage.php') ?>

<!DOCTYPE html>
<html lang="en">
<!--  HEAD  -->
<?php include('../partials/head-cms.php') ?>
<body>
    <!-- NAVIGATION -->
    <?php include('../partials/nav-cms.php') ?>

    <main class="main-edit-projectpage-cms">
        <h1>Projektseite bearbeiten</h1>
        <form class="edit-projectpage" action="" novalidate>
            <label for="pagetitle">Seitentitel*</label>
            <input type="text" name="pagetitle" id="pagetitle" required>

            <label for="desc-projects">Beschreibung</label>
            <textarea name="desc-projects" id="desc-projects"></textarea>
                
            <button type="submit" name="safe">Speichern</button> 
        </form>
    </main>
    <!-- FOOTER -->
    <?php include('../partials/footer-cms.php') ?>
</body>
</html>