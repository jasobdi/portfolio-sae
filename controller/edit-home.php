<?php 

require_once('config.php');
require_once ('class/Auth.class.php');
require_once('class/Database.class.php');

// Prüfen ob User eingeloggt ist anhand von CheckLogIn-Methode von Auth.class.php
Auth::checkLogIn(); 

// Datenbankverbindung initialisieren
$db = new Database();

// aktueller Seitentitel abrufen
$currentTitle = $db->getHomePageTitle();

// Prüfen ob Formular geschickt & neuen Titel speichern
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['safe'])) {
    $newTitle = trim($_POST['pagetitle']);
    
    if (!empty($newTitle)) {
        if ($db->updateHomePageTitle($newTitle)) {
            // Erfolgreich gespeichert
            header('Location: edit-home.php?success=1');
            exit();
        } else {
            $error = 'Es gab ein Problem beim Speichern des Titels, bitte versuche es erneut.';
        }
    } else {
        $error = 'Der Titel darf nicht leer sein.';
    }
}

?>