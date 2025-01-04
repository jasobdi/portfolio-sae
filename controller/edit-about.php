<?php
require_once('config.php');
require_once('class/Auth.class.php');
require_once('class/Database.class.php');
require_once('class/NewUpload.class.php');

// Prüfen ob der User eingeloggt ist
Auth::checkLogIn();

// Fehlermeldungen Array
$errorMessages = [];

// Datenbankverbindung initialisieren
$db = Database::getInstance();

// Aktuelle Daten holen
$currentData = $db->getAboutPageData();

// Prüfen ob das Formular abgeschickt wurde
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['safe'])) {
    // Eingabedaten
    $newTitle = trim($_POST['pagetitle']);
    $newIntroduction1 = trim($_POST['intro-top']);
    $newDescription1 = trim($_POST['desc-top']);
    $newIntroduction2 = trim($_POST['intro-bottom']);
    $newDescription2 = trim($_POST['desc-bottom']);

    // Zielordner für die Bilder
    $targetFolder = "../images/about";

    // Neue Upload-Instanz für die Bilder
    $upload = new NewUpload($targetFolder);
    
    // Bild 1 hochladen
    $newImage1 = '';
    if (isset($_FILES['img-top'])) {
        $uploadedImage1 = $upload->uploadFile($_FILES['img-top']);
        if ($uploadedImage1) {
            $newImage1 = $uploadedImage1; // Pfad zum hochgeladenen Bild
        } else {
            $errorMessages = array_merge($errorMessages, $upload->getErrorMessages());
        }
    }

    // Bild 2 hochladen
    $newImage2 = '';
    if (isset($_FILES['img-bottom'])) {
        $uploadedImage2 = $upload->uploadFile($_FILES['img-bottom']);
        if ($uploadedImage2) {
            $newImage2 = $uploadedImage2; // Pfad zum hochgeladenen Bild
        } else {
            $errorMessages = array_merge($errorMessages, $upload->getErrorMessages());
        }
    }

    // Sicherstellen, dass die Pflichtfelder ausgefüllt sind
    if (!empty($newTitle) && !empty($newIntroduction1) && !empty($newDescription1) &&  !empty($newIntroduction2) && !empty($newDescription2)) {
        if ($db->updateAboutPageData($newTitle, $newIntroduction1, $newDescription1, $newImage1, $newIntroduction2, $newDescription2, $newImage2)) {
            // Erfolgreich gespeichert
            header('Location: edit-about.php?success=1');
            exit();
        } else {
            $error = 'Es gab ein Problem beim Speichern der Daten, bitte versuche es erneut.';
        }
    } else {
        $error = 'Alle Felder müssen ausgefüllt sein.';
    }
}
?>
