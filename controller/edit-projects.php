<?php

// require von config-file & NewUpload-Klasse
require('config.php');
require_once('class/Auth.class.php');
require_once('class/NewUpload.class.php');

// Prüfen ob User eingeloggt ist anhand von CheckLogIn-Methode von Auth.class.php
Auth::checkLogIn(); 


$feedback = ""; // Allgemeines Feedback

// Arrays für die spezifischen Fehler für jedes Eingabefeld
$errorMessages = [];
$fileErrors = [];
$titleErrors = [];
$descErrors = [];

if (isset($_POST['upload'])) {
    // Eingabefelder auf leere Werte überprüfen
    if (empty($_FILES['upload-file']['name'])) {
        $fileErrors[] = "Bitte wählen Sie eine Datei aus";
    }

    if (empty($_POST['upload-title'])) {
        $titleErrors[] = "Bitte geben Sie einen Titel ein";
    }

    if (empty($_POST['upload-desc'])) {
        $descErrors[] = "Bitte geben Sie eine Beschreibung ein";
    }

    // Nur fortfahren, wenn keine Fehler 
    if (empty($fileErrors) && empty($titleErrors) && empty($descErrors)) {

        // Definieren Zielordner
        $targetFolder = "../images/projects";
        $path = $targetFolder;

        $upload = new NewUpload($host = 'localhost', $user = 'root', $passwd = 'root', $dbname = 'portfolio_jb', $path = $targetFolder);
        $step1 = $upload->checkFileError();

        if ($step1) {
            $step2 = $upload->checkFileInQuarantine();

            if ($step2) {
                $step3 = $upload->moveFile();

                if ($step3) {
                    $errorMessages[] = "Die Datei wurde erfolgreich hochgeladen<br>";
                } else {
                    $errorMessages[] = "Fehler beim hochladen der Datei<br>";
                }
            } else {
                $errorMessages[] = "Fehler beim Überprüfen der Datei";
            }
        } else {
            $errorMessages[] = "Die Datei ist fehlerhaft";
        }

        // Alle Fehler in einem Array zusammenführen
        $errorMessages = array_merge($fileErrors, $titleErrors, $descErrors);

        // Danach Fehler aus der NewUpload-Klasse hinzufügen
        if (!empty($upload->errorMessages)) {
            $errorMessages = array_merge($errorMessages, $upload->errorMessages);
        }
    }
}
?>