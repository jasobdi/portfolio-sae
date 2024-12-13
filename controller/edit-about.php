<?php 

require_once('config.php');
require_once('class/Auth.class.php');
require_once('class/Database.class.php');
require_once('class/NewUpload.class.php');

// Prüfen, ob der User eingeloggt ist
Auth::checkLogIn(); 

// Datenbankverbindung initialisieren
$db = Database::getInstance();

// Aktuelle Daten aufrufen
$currentData = $db->getAboutPageData();

// Prüfen, ob das Formular abgeschickt wurde und die neuen Daten speichern
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['safe'])) {
    $newTitle = trim($_POST['pagetitle']);
    $newDescription1 = trim($_POST['desc-top']);
    $newDescription2 = trim($_POST['desc-bottom']);

    // Wenn Bilder hochgeladen werden, solltest du den Upload hier durchführen


    // Bild 1
    $newImage1 = '';
    if (isset($_FILES['img-top']) && $_FILES['img-top']['error'] === UPLOAD_ERR_OK) {
        $newImage1 = '/images/' . basename($_FILES['img-top']['name']);
        move_uploaded_file($_FILES['img-top']['tmp_name'], $newImage1);
    }

    // Bild 2
    $newImage2 = '';
    if (isset($_FILES['img-bottom']) && $_FILES['img-bottom']['error'] === UPLOAD_ERR_OK) {
        $newImage2 = 'images/' . basename($_FILES['img-bottom']['name']);
        move_uploaded_file($_FILES['img-bottom']['tmp_name'], $newImage2);
    }

    // Sicherstellen, dass der Titel nicht leer ist
    if (!empty($newTitle) && !empty($newDescription1) && !empty($newDescription2)) {
        if ($db->updateAboutPageData($newTitle, $newDescription1, $newImage1, $newDescription2, $newImage2)) {
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
