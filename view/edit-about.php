<?php include('../controller/edit-about.php') ?>

<!DOCTYPE html>
<html lang="de">
<!-- HEAD -->
<?php 
$siteTitle = 'About bearbeiten - CMS'; // <title>
include('../partials/head-cms.php') 
?>
<body>
    <!-- NAVIGATION -->
    <?php include('../partials/nav-cms.php') ?>

    <main class="main-edit-about-cms">
        <h1>About bearbeiten</h1>

        <!-- Erfolgsmeldung -->
        <?php if (isset($_GET['success']) && $_GET['success'] == 1){ ?>
            <p class="success-message">Die Änderungen wurden erfolgreich gespeichert!</p>
        <?php } ?>

        <!-- Fehlermeldung -->
        <?php if (isset($error)) { ?>
            <p class="error-message"><?php echo $error; ?></p>
        <?php } ?>

        <form class="edit-about" action="" method="POST" enctype="multipart/form-data" novalidate>
            <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $maxFileSize; ?>">

            <label for="pagetitle">Seitentitel*</label>
            <input type="text" name="pagetitle" id="pagetitle" value="<?php echo htmlspecialchars($currentData['title']); ?>" required>

            <label for="intro-top">Text 1</label>
            <textarea name="intro-top" id="intro-top" cols="30" rows="10" required><?php echo htmlspecialchars($currentData['intro_1']); ?></textarea>

            <label for="desc-top">Bildbeschreibung 1</label>
            <input type="text" name="desc-top" id="desc-top" value="<?php echo htmlspecialchars($currentData['desc_1']); ?>">

            <label for="img-top">Bild 1</label>
            <input type="file" name="img-top" id="img-top">

            <?php if ($currentData['image_1']) { ?>
                <img src="../images/about/<?php echo htmlspecialchars($currentData['image_1']); ?>" class="img1" alt="Bild 1">
            <?php } ?>


            <label for="intro-bottom">Text 2</label>
            <textarea name="intro-bottom" id="intro-bottom" cols="30" rows="10" required><?php echo htmlspecialchars($currentData['intro_2']); ?></textarea>

            <label for="desc-bottom">Bildbeschreibung 2</label>
            <input type="text" name="desc-bottom" id="desc-bottom" value="<?php echo htmlspecialchars($currentData['desc_2']); ?>">

            <label for="img-bottom">Bild 2</label>
            <input type="file" name="img-bottom" id="img-bottom">

            <?php if ($currentData['image_2']) { ?>
                <img src="../images/about/<?php echo htmlspecialchars($currentData['image_2']); ?>" class="img2" alt="Bild 2">
            <?php } ?>

            <button type="submit" name="safe">Speichern</button> 
        </form>
    </main>

    <!-- FOOTER -->
    <?php include('../partials/footer-cms.php') ?>
</body>
</html>
