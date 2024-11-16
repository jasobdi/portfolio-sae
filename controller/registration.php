<?php

/** KONFIGURATION */
require_once('config.php'); 
try {
    $db = new PDO('mysql:host=localhost;dbname='.DBNAME, DBUSER, DBPASSWORD);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Array Monitor POST-Daten:
// echo '<pre>';
// print_r($_POST);
// echo '</pre>';

/** FORMULARVALIDIERUNG REGISTRIERUNGS-FORMULAR */

$formSuccess = false; // Erfolgsmeldung nach Versand
$errorMessages = array(); // Container für Fehlermeldungen

$username = '';
$email = '';
$password = '';
$confirmpassword = '';
$usertype = '';
$language = '';
$agb = false;

// wenn der Button geklickt wurde
if (isset($_POST['register'])) {
    // SANITIZING
    $username = strip_tags(trim($_POST['username']));
    $email = strip_tags(trim($_POST['email']));
    $password = strip_tags(trim($_POST['password']));
    $confirmpassword = strip_tags(trim($_POST['confirmpassword']));
    $usertype = isset($_POST['usertype']) ? $_POST['usertype'] : '';
    $language = isset($_POST['language']) ? $_POST['language'] : '';
    $agb = isset($_POST['agb']);

    // VALIDIERUNG EINZELNE INPUT-FELDER

    // username
    if (empty($username)) {
        $errorMessages['username'] = 'Bitte Username eingeben';
    } else if (!preg_match("/^[^\s]{4,16}$/", $username)) { // keine Leerzeichen (s), 4-16 Zeichen
        $errorMessages['username'] = 'Verwende 4 - 16 Zeichen und keine Leerzeichen';
    }

    // email 
    if (empty($email)) {
        $errorMessages['email'] = 'Bitte E-Mail eingeben';
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMessages['email'] = 'Die E-Mail ist ungültig';
    }

    // passwort
    if (empty($password)) {
        $errorMessages['password'] = 'Bitte ein Passwort eingeben';
    } else if (!preg_match("/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-_])^[^\s]{8,}$/", $password)) {
        $errorMessages['password'] = 'Verwende mindestens 8 Zeichen (A-Z, a-z, 0-9,#?!@$%^&*-_) und keine Leerzeichen';
    }

    // passwort wiederholung
    if (empty($confirmpassword)) {
        $errorMessages['confirmpassword'] = 'Bitte das Passwort erneut eingeben';
    } else if ($_POST['password'] != $_POST['confirmpassword']) {
        $errorMessages['confirmpassword'] = 'Das Passwort stimmt nicht überein';
    }

    // nutzertyp (Radio-Buttons)
    if (empty($usertype)) {
        $errorMessages['usertype'] = 'Bitte einen Nutzertyp auswählen';
    }

    // sprache (Select-Input)
    if (empty($language)) {
        $errorMessages['language'] = 'Bitte eine Sprache auswählen';
    }

    // AGB (Checkbox)
    if (!$agb) {
        $errorMessages['agb'] = "Bitte die AGB's akzeptieren";
    }

    // wenn keine Fehlermeldungen vorhanden -> Erfolgsmeldung
    if (count($errorMessages) == 0) {
        $formSuccess = true; // Setze die Erfolgsmeldung
    }


    /** VERBINDUNG DATENBANK */

    // nur wenn es keine Fehler mehr gibt:
    if (count($errorMessages) === 0) {

        // Passwort hashing
        $hashedPW = password_hash($password, PASSWORD_DEFAULT);

        // Vorbereitung SQL-Statement 
        $statement = $db->prepare("INSERT INTO user (username, useremail, userpassword, usertype, userlanguage) VALUES (:username, :useremail, :userpassword, :usertype, :userlanguage)");

        // Werte verbinden
        $statement->bindParam(':username', $username);
        $statement->bindParam(':useremail', $email);
        $statement->bindParam(':userpassword', $hashedPW);
        $statement->bindParam(':usertype', $usertype);
        $statement->bindParam(':userlanguage', $language);

        // Ausführen SQL-Statement
        if ($statement->execute()) {
            $formSuccess = true;
            // Weiterleitung 
            header("Location: login.php");
            exit(); // Beenden des Scripts
        } else {
            $formError = "<p style='color:red;background:#db9191;border:solid 1px;border-radius:5px;'>
            Fehler beim Registrieren. Bitte versuche es erneut.</p>";
        }
    }
}

?>