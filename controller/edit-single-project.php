<?php
require_once('config.php');
require_once('class/Auth.class.php');
require_once('class/Database.class.php');
require_once('class/NewUpload.class.php');

// // Prüfen ob der User eingeloggt ist
Auth::checkLogin();

// Projekt-ID aus URL abrufen
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: edit-projects.php?error=invalid-id');
    exit();
}

$projectId = (int) $_GET['id'];

// Datenbankverbindung initialisieren
$db = Database::getInstance();

// Einzelnes Projekt aus der Datenbank abrufen
$project = $db->getProjectData($projectId);

// Prüfen, ob das Projekt existiert
if (!$project) {
    header('Location: edit-projects.php?error=not-found');
    exit();
}

// Fehler und Erfolgsmeldungen
$errorMessage = null;

// Formularverarbeitung
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);

    // Zielordner für das Bild
    $targetFolder = "../images/projects";

    // Instanz der NewUpload-Klasse
    $upload = new NewUpload($targetFolder);

    // Neues Bild hochladen (optional)
    $newImagePath = $project['filepath']; // aktuelles Bild behalten
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadedProjectImage = $upload->uploadFile($_FILES['image']);
        if ($uploadedProjectImage) {
            $newImagePath = $uploadedProjectImage; // Bildpfad aktualisieren
        } else {
            $errorMessage = implode(', ', $upload->getErrorMessages());
        }
    }

    // Pflichtfelder prüfen
    if (empty($title) || empty($description)) {
        $errorMessage = 'Titel und Beschreibung dürfen nicht leer sein.';
    }

    // Änderungen speichern
    if (!$errorMessage) {
        $result = $db->updateProjectData($projectId, $newImagePath, $title, $description, Auth::getUserName());
        if ($result) {
            header("Location: edit-single-project.php?id=$projectId&success=1");
            exit();
        } else {
            $errorMessage = 'Es gab ein Problem beim Speichern der Änderungen.';
        }
    }
}
