<?php include('../controller/edit-projects.php') ?>

<!DOCTYPE html>
<html lang="en">
<!--  HEAD  -->
<?php include('../partials/head-cms.php') ?>

<body>
    <!-- NAVIGATION -->
    <?php include('../partials/nav-cms.php') ?>

    <main class="main-edit-projects-cms">
        <h1>Projekte</h1>

        <section class="project-upload">
            <h2>Neues Projekt</h2>

            <form method="post" enctype="multipart/form-data" novalidate>
                <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $maxFileSize; ?>">

                <?php if (!empty($errorMessages)){ ?>
                    <div class="feedback">
                        <?php foreach ($errorMessages as $error){ ?>
                            <p class="error"><?= $error ?></p>
                        <?php } ?>
                    </div>
                <?php } ?>

                <div class="form-check">
                    <label for="upload-file">Bild auswählen</label>
                    <input type="file" accept="image/*" name="upload-file" id="upload-file" required>
                    <?php if (!empty($fileErrors)){ ?>
                        <span class="error-messages">
                            <?php foreach ($fileErrors as $fileError){ ?>
                                <p class="error"><?= $fileError ?></p>
                            <?php } ?>
                        </span>
                    <?php } ?>
                </div>

                <div class="form-check">
                    <label for="upload-title">Titel</label>
                    <input type="text" name="upload-title" id="upload-title" value="<?= htmlspecialchars($newTitle ?? '') ?>" required>
                    <?php if (!empty($titleErrors)) { ?>
                        <span class="error-messages">
                            <?php foreach ($titleErrors as $titleError){ ?>
                                <p class="error"><?= $titleError ?></p>
                            <?php } ?>
                        </span>
                    <?php } ?>
                </div>

                <div class="form-check">
                    <label for="upload-desc">Beschreibung <small>(max. 150 Zeichen)</small></label>
                    <textarea name="upload-desc" id="upload-desc" maxlength="150" cols="50" rows="5" required><?= htmlspecialchars($newDescription ?? '') ?></textarea>
                    <?php if (!empty($descErrors)) { ?>
                        <span class="error-messages">
                            <?php foreach ($descErrors as $descError){ ?>
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
        <section class="project-edit">
            <h2>Projekte bearbeiten</h2>
        </section>
    </main>
    <!-- FOOTER -->
    <?php include('../partials/footer-cms.php') ?>
</body>

</html>