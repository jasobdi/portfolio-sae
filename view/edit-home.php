<?php include('../controller/edit-home.php') ?>

<!DOCTYPE html>
<html lang="en">
<!--  HEAD  -->
<?php include('../partials/head-cms.php') ?>
<body>
    <!-- NAVIGATION -->
    <?php include('../partials/nav-cms.php') ?>

    <main class="main-edit-home-cms">
        <h1>Home bearbeiten</h1>
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