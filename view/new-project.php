<?php
/** Neues Projekt erstellen im CMS */
include('../controller/edit-projects.php') ?>

<!DOCTYPE html>
<html lang="de">

<!--  HEAD  -->
<?php
$siteTitle = 'Projekt hinzufügen - CMS'; // <title>
include('../partials/head-cms.php')
?>

<body>
    <!-- NAVIGATION -->
    <?php include('../partials/nav-cms.php') ?>

    <main class="main-new-project-cms">
        <h1>Neues Projekt</h1>

        <!-- Erfolgsmeldung -->
        <?php if (isset($_GET['success']) && $_GET['success'] == 1) { ?>
            <p class="success-message">Die Datei wurde erfolgreich hochgeladen!</p>
        <?php } ?>

        <section class="project-upload">

            <form method="post" enctype="multipart/form-data" novalidate>
                <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $maxFileSize; ?>">
                <!-- Fehlermeldung Dateigrösse -->
                <?php if (!empty($errorMessages)) { ?>
                    <div class="feedback">
                        <?php foreach ($errorMessages as $error) { ?>
                            <p class="error-messages"><?= $error ?></p>
                        <?php } ?>
                    </div>
                <?php } ?>

                <div class="form-check">
                    <label for="upload-file">Bild auswählen</label>
                    <input type="file" accept="image/*" name="upload-file" id="upload-file" required>
                    <!-- Fehlermeldung Bild -->
                    <?php if (!empty($fileErrors)) { ?>
                        <span class="error-messages">
                            <?php foreach ($fileErrors as $fileError) { ?>
                                <p class="error"><?= $fileError ?></p>
                            <?php } ?>
                        </span>
                    <?php } ?>
                </div>

                <div class="form-check">
                    <label for="upload-title">Titel</label>
                    <input type="text" name="upload-title" id="upload-title" value="<?= htmlspecialchars($newTitle ?? '') ?>" required>
                    <!-- Fehlermeldung Titel -->
                    <?php if (!empty($titleErrors)) { ?>
                        <span class="error-messages">
                            <?php foreach ($titleErrors as $titleError) { ?>
                                <p class="error"><?= $titleError ?></p>
                            <?php } ?>
                        </span>
                    <?php } ?>
                </div>

                <div class="form-check">
                    <label for="upload-desc">Beschreibung <small>(max. 150 Zeichen)</small></label>
                    <textarea name="upload-desc" id="upload-desc" maxlength="150" cols="50" rows="5" required><?= htmlspecialchars($newDescription ?? '') ?></textarea>
                    <!-- Fehlermeldung Beschreibung -->
                    <?php if (!empty($descErrors)) { ?>
                        <span class="error-messages">
                            <?php foreach ($descErrors as $descError) { ?>
                                <p class="error"><?= $descError ?></p>
                            <?php } ?>
                        </span>
                    <?php } ?>
                </div>

                <div class="form-check">
                    <button type="submit" name="upload">Hochladen</button>
                </div>
            </form>

        </section>
    </main>
    <!-- FOOTER -->
    <?php include('../partials/footer-cms.php') ?>
</body>

</html>