<?php

$feedback = ""; // Allgemeines Feedback

// Arrays für die spezifischen Fehler für jedes Eingabefeld
$errorMessages = [];
$fileErrors = [];
$titleErrors = [];
$descErrors = [];

if (isset($_POST['upload'])) {
    // Eingabefelder auf leere Werte überprüfen
    if (empty($_FILES['upload-file']['name'])) {
        $fileErrors[] = "Bitte wählen Sie eine Datei aus";
    }

    if (empty($_POST['upload-title'])) {
        $titleErrors[] = "Bitte geben Sie einen Titel ein";
    }

    if (empty($_POST['upload-desc'])) {
        $descErrors[] = "Bitte geben Sie eine Beschreibung ein";
    }

    // Nur fortfahren, wenn keine Fehler 
    if (empty($fileErrors) && empty($titleErrors) && empty($descErrors)) {

        // Definieren Zielordner
        $targetFolder = "../images/projects";
        $path = $targetFolder;

        // require von config-file & NewUpload-Klasse
        require('../controller/config.php');
        require_once('../controller/class/NewUpload.class.php');
        
        $upload = new NewUpload($host = 'localhost', $user = 'root', $passwd = 'root', $dbname = 'portfolio_jb', $path = $targetFolder);
        $step1 = $upload->checkFileError();

        if ($step1) {
            $step2 = $upload->checkFileInQuarantine();

            if ($step2) {
                $step3 = $upload->moveFile();

                if ($step3) {
                    $errorMessages[] = "Die Datei wurde erfolgreich hochgeladen<br>";
                } else {
                    $errorMessages[] = "Fehler beim hochladen der Datei<br>";
                }
            } else {
                $errorMessages[] = "Fehler beim Überprüfen der Datei";
            }
        } else {
            $errorMessages[] = "Die Datei ist fehlerhaft";
        }

        // Alle Fehler in einem Array zusammenführen
        $errorMessages = array_merge($fileErrors, $titleErrors, $descErrors);

        // Danach Fehler aus der NewUpload-Klasse hinzufügen
        if (!empty($upload->errorMessages)) {
            $errorMessages = array_merge($errorMessages, $upload->errorMessages);
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<!--  HEAD  -->
<?php include('../partials/head.php') ?>

<body>
    <!-- HEADER -->
    <?php include('../partials/nav-backend.php') ?>

    <main class="main-dashboard">
        <h1>DASHBOARD</h1>

        <section class="file-upload">
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
                    <input type="text" name="upload-title" id="upload-title" required>
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
                    <textarea name="upload-desc" id="upload-desc" maxlength="150" cols="50" rows="5" required></textarea>
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
    </main>
</body>

</html>