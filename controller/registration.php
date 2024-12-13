<?php

// Konfiguration
require_once('class/Database.class.php');

// Array Monitor POST-Daten für Testing
// echo '<pre>';
// print_r($_POST);
// echo '</pre>';

// Container für Fehler Validierung
$errorMessages = array(); // Container für Fehlermeldungen


/** VALIDIERUNG REGISTRIERUNG */

// Array mit leeren Variablen für Input-Daten
$registrData = [ 
    'username' => '',
    'email' => '',
    'password' => '',
    'confirmpw' => ''
];

// wenn der Button 'register' geklickt wurde
if (isset($_POST['register'])) {
    // SANITIZING Input-Daten
    $registrData['username'] = strip_tags(trim($_POST['username']));
    $registrData['email'] = strip_tags(trim($_POST['email']));
    $registrData['password'] = strip_tags(trim($_POST['password']));
    $registrData['confirmpw'] = strip_tags(trim($_POST['confirmpassword']));


    // VALIDIERUNG EINZELNE INPUT-FELDER

    // username
    if (empty($registrData['username'])) {
        $errorMessages['username'] = 'Bitte Benutzername eingeben';
    } else if (!preg_match("/^[^\s]{4,16}$/", $registrData['username'])) { // keine Leerzeichen (s), 4-16 Zeichen
        $errorMessages['username'] = 'Benutzername ungültig, bitte beachte die Vorgaben';
    }

    // email 
    if (empty($registrData['email'])) {
        $errorMessages['email'] = 'Bitte E-Mail eingeben';
    } else if (!filter_var($registrData['email'], FILTER_VALIDATE_EMAIL)) {
        $errorMessages['email'] = 'Die E-Mail ist ungültig';
    }

    // passwort
    if (empty($registrData['password'])) {
        $errorMessages['password'] = 'Bitte ein Passwort eingeben';
    } else if (!preg_match("/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-_])^[^\s]{8,}$/", $registrData['password'])) {
        $errorMessages['password'] = 'Passwort ungültig, bitte beachte die Vorgaben';
    }

    // passwort wiederholung
    if (empty($registrData['confirmpw'])) {
        $errorMessages['confirmpassword'] = 'Bitte das Passwort erneut eingeben';
    } else if ($_POST['password'] != $_POST['confirmpassword']) {
        $errorMessages['confirmpassword'] = 'Das Passwort stimmt nicht überein';
    }

    // wenn keine Fehler vorhanden -> User registrieren
    if (count($errorMessages) == 0) {

        // Instanz der Datenbank
        $db = Database::getInstance(); 

        // User registrieren
        $result = $db->registerUser($registrData['username'], $registrData['email'], $registrData['password']);

        if ($result === 'Registrierung erfolgreich') {
            // weiterleiten auf login.php
            header("Location: login.php");
            exit();
        } else {
            // Fehler bei der Registrierung
            $formError = "<p>{$result}</p>";
        }
    }
}

?>