<?php 

/** FUNKTIONIERT!! */

require_once('config.php');
require_once ('class/Auth.class.php');
require_once('class/Database.class.php');

// Prüfen ob User eingeloggt ist
Auth::checkLogIn(); 

// Datenbankverbindung initialisieren
$db = Database::getInstance();

// aktueller Seitentitel abrufen
$currentPortfolioData = $db->getPortfolioData();

// Prüfen ob Formular abgeschickt wurde
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['safe'])) {
    // Eingabedaten
    $newTitle = trim($_POST['pagetitle']);
    $newDesc = trim($_POST['desc-projects']);
    
    if (!empty($newTitle) && !empty($newDesc)) {
        if ($db->updatePortfolioData($newTitle, $newDesc)) {
            // Erfolgreich gespeichert
            header('Location: edit-portfolio.php?success=1');
            exit();
        } else {
            $error = 'Es gab ein Problem beim Speichern des Titels, bitte versuche es erneut.';
        }
    } else {
        $error = 'Alle Felder müssen ausgefüllt sein.';
    }
}

?>
