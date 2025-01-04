<?php
/** Einzelnes Projekt löschen im CMS */

require_once('config.php');
require_once('class/Auth.class.php');
require_once('class/Database.class.php');

// Prüfen ob der User eingeloggt ist
Auth::checkLogin();

// Prüfen, ob Projekt-ID in URL vorhanden ist
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $projectId = (int) $_GET['id'];

    // Datenbankverbindung initialisieren
    $db = Database::getInstance();

    // Projekt aus der Datenbank löschen
    $stmt = $db->getConnection()->prepare('DELETE FROM project WHERE ID = :id');
    $stmt->bindParam(':id', $projectId, PDO::PARAM_INT);
    $result = $stmt->execute();


    if ($result) {
        // Erfolgreich gelöscht -> Weiterleitung mit Erfolgsmeldung
        header('Location: ../view/edit-projects.php?delete=success');
        exit();
    } else {
        // Fehler beim Löschen -> Weiterleitung mit Fehlermeldung
        header('Location: ../view/edit-projects.php?delete=error');
        exit();
    }
} else {
    // Ungültige ID -> Weiterleitung mit Fehlermeldung
    header('Location: ../view/edit-projects.php?delete=invalid');
    exit();
}
?>
