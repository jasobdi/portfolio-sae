<?php

/** KONFIGURATION */
require_once('config.php');

// Session initialisieren
session_name(SESSIONCOOKIE_NAME);
session_start(); // Sessionzugriff aktivieren

// Datenbankverbindung initialisieren
$db = new PDO('mysql:host=' . DBSERVER . ';dbname=' . DBNAME, DBUSER, DBPASSWORD);

$hasError = false;
$errorMessages = array();
$username = ''; // leere Variable

// LOGIN PRÜFEN
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = strip_tags(trim($_POST['username']));
    $password = strip_tags(trim($_POST['password']));

    // gibt es in der Datenbank einen Username mit dem $username?
    $query = 'SELECT * FROM `user` WHERE username = :username';
    $statement = $db->prepare($query);
    $values = array('username' => $username);
    $statement->execute($values);

    $user = $statement->fetch(PDO::FETCH_ASSOC); // Assoziatives Array mit User-Daten
    if ($user === false || !password_verify($password, $user['userpassword'])) {
        // Benutzer nicht gefunden oder Passwort stimmt nicht
        $hasError = true;
    }

    if ($hasError) {
        $errorMessages[] = 'Benutzername oder Passwort stimmt nicht';
    } else {
        // Benutzer einloggen
        $_SESSION['username'] = $user['username'];
        $_SESSION['userid'] = $user['ID'];
        $_SESSION['logintime'] = time(); // Zeitstempel
        header("Location: dashboard.php"); // Weiterleitung nach dem Login
        exit();
    }
}
session_regenerate_id(); // Session ID erneuern gegen Session Hijacking

?>