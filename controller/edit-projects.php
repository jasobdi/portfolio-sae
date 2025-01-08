<?php

require_once('config.php');
require_once('class/Auth.class.php');
require_once('class/Database.class.php');
require_once('class/NewUpload.class.php');

// Prüfen ob User eingeloggt ist
Auth::checkLogIn(); 

// Datenbankverbindung initialisieren
$db = Database::getInstance();

// Überprüfen ob eine ID in URL vorhanden ist
$id = isset($_GET['id']) ? $_GET['id'] : null;

// Arrays für die spezifischen Fehler für jedes Eingabefeld
$errorMessages = [];
$fileErrors = [];
$titleErrors = [];
$descErrors = [];

// Aktuelle Projekt-Daten aus Datenbank holen
$currentProject = $db->getProjectData($id); 
// Alle Projekte aus der Datenbank holen
$allProjects = $db->getAllProjects();


// Prüfen, ob das Formular abgeschickt wurde
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['upload'])) {
    // Eingabedaten aus dem Formular
    $newTitle = trim($_POST['upload-title']);
    $newDescription = trim($_POST['upload-desc']);
    $newCreatedBy = Auth::getUserName();
    
    // Zielordner für die Bilder
    $targetFolder = "../images/projects"; 

    // Instanz der NewUpload-Klasse für den Upload
    $upload = new NewUpload($targetFolder);
    
    // Bild hochladen
    $uploadedProjectImage = '';

    if (isset($_FILES['upload-file']) && $_FILES['upload-file']['error'] === UPLOAD_ERR_OK) {
        $uploadedProjectImage = $upload->uploadFile($_FILES['upload-file']);
        if (!$uploadedProjectImage) {
            $errorMessages = array_merge($errorMessages, $upload->getErrorMessages());
        }
    }

    // Überprüfen, ob alle Pflichtfelder ausgefüllt sind
    if (!empty($newTitle) && !empty($newDescription) && $uploadedProjectImage) {
        if ($db->insertProjectData($uploadedProjectImage, $newTitle, $newDescription, $newCreatedBy)) {
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