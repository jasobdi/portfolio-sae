<?php

// FOR TESTING
// if (isset($_POST['upload'])) {
//     echo "<div class=\"output\">";
//     echo "<pre>";
//     print_r($_FILES['upload-file']);
//     echo "</pre>";
//     echo "</div>";
// }


if (isset($_POST['upload'])) {
    // Eingabefelder auf leere Werte überprüfen
    if (empty($_FILES['upload-file']['name'])) {
        $feedback .= "Bitte wählen Sie eine Datei aus.<br>";
    }

    if (empty($_POST['upload-title'])) {
        $feedback .= "Bitte geben Sie einen Titel ein.<br>";
    }

    if (empty($_POST['upload-desc'])) {
        $feedback .= "Bitte geben Sie eine Beschreibung ein.<br>";
    }

    // Nur fortfahren, wenn keine Fehler 
    if (empty($feedback)) {

        // Definieren Zielordner
        $targetFolder = "../images/projects";
        $path = $targetFolder;

        // Instanz der NewUpload-Klasse erstellen
        require_once('../controller/class/NewUpload.class.php');

        $feedback = "";
        $upload = new NewUpload($targetFolder);
        $step1 = $upload->checkFileError();

        if ($step1) {
            $step2 = $upload->checkFileInQuarantine();

            if ($step2) {
                $step3 = $upload->moveFile();

                if ($step3) {
                    $feedback .= "Die Datei wurde erfolgreich hochgeladen.<br>";
                } else {
                    $feedback .= "Fehler beim hochladen der Datei.<br>";
                }
            } else {
                $feedback .= "Fehler beim Überprüfen der Datei.<br>";
            }
        } else {
            $feedback .= "Die Datei ist fehlerhaft.<br>";
        }

        // Fehlermeldungen ausgeben
        foreach ($upload->errorMessages as $error) {
            $feedback .= $error;
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
                <input type="hidden" name="MAX_FILE_SIZE" value="<? $maxFileSize ?>">

                <?php if (!empty($feedback)): ?>
                    <div class="feedback">
                    <p><?= $feedback ?></p>
                    </div>
                <?php endif; ?>

                <div class="form-check">
                    <label for="upload-file">Bild auswählen</label>
                    <input type="file" accept="image/*" name="upload-file" id="upload-file" required>
                </div>

                <div class="form-check">
                    <label for="upload-title">Titel</label>
                    <input type="text" name="upload-title" id="upload-title" required>
                </div>

                <div class="form-check">
                    <label for="upload-desc">Beschreibung <small>(max. 150 Zeichen)</small></label>
                    <textarea name="upload-desc" id="upload-desc" maxlength="150" cols="50" rows="5" required></textarea>
                </div>

                <div class="form-check">
                    <button type="submit" name="upload">Hochladen</button>
                </div>
            </form>
        </section>
    </main>
</body>

</html>