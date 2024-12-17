<?php

require_once('config.php');
require_once('class/Auth.class.php');
require_once('class/Database.class.php');
require_once('class/NewUpload.class.php');

// Prüfen ob User eingeloggt ist
Auth::checkLogIn(); 

// Datenbankverbindung initialisieren
$db = Database::getInstance();

// Arrays für die spezifischen Fehler für jedes Eingabefeld
$errorMessages = [];
$fileErrors = [];
$titleErrors = [];
$descErrors = [];

// Aktuelle Projekt-Daten aus Datenbank holen
$currentProject = $db->getProjectData(); 


// Prüfen, ob das Formular abgeschickt wurde
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['upload'])) {
    // Eingabedaten aus dem Formular
    $projectId = $_POST['project_id']; // Projekt-ID
    $newTitle = trim($_POST['title']);
    $newDescription = trim($_POST['description']);
    $newCreatedBy = $_POST['created_by'];
    
    // Zielordner für die Bilder
    $targetFolder = "../images/projects"; 

    // Instanz der NewUpload-Klasse für den Upload
    $upload = new NewUpload($targetFolder);
    
    // Bild hochladen
    $newProjectImage = '';
    if (isset($_FILES['upload-file'])) {
        $uploadedImage = $upload->uploadFile($_FILES['upload-file']);
        if ($uploadedImage) {
            $newProjectImage = $uploadedImage; // Pfad zum hochgeladenen Bild
        } else {
            // Fehlermeldungen aus NewUpload-Klasse holen
            $errorMessages = array_merge($errorMessages, $upload->getErrorMessages());
        }
    }

    // Überprüfen, ob Pflichtfelder ausgefüllt sind
    if (!empty($newTitle) && !empty($newDescription)) {
        // Wenn alle Felder korrekt -> Daten speichern
        if ($db->updateProjectData($newTitle, $newDescription, $newFilepath, $newCreatedBy, $newCreatedAt)) {
            // Erfolgreich gespeichert
            header('Location: edit-projects.php?success=1');
            exit();
        } else {
            $errorMessages[] = 'Es gab ein Problem beim Speichern der Daten, bitte versuche es erneut.';
        }
    } else {
        $errorMessages[] = 'Alle Felder müssen ausgefüllt sein.';
    }
}
?>