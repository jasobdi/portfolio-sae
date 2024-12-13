<?php

// Konfiguration
require_once('config.php');
require_once ('class/Auth.class.php');
require_once('class/Database.class.php');

// Session initialisieren
Auth::regenerateSession();

// Datenbankverbindung initialisieren durch Database.class.php
$db = Database::getInstance();

// Fehlerhandling
$username = ''; // leere Variable
$errorMessages = array();

// Wenn das Formular abgeschickt wird:
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Versuche den Benutzer einzuloggen
    if (Auth::login($username, $password, $db)) {
        // Weiterleitung nach erfolgreichem Login
        header("Location: dashboard.php");
        exit();
    } else {
        // Fehlermeldung: Benutzername oder Passwort stimmt nicht
        $errorMessages[] = 'Benutzername oder Passwort ist ungültig';
    }
}

?>