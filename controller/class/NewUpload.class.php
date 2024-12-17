<?php

class NewUpload extends PDO {

    // Zielverzeichnis
    private $targetFolder;

    // Erlaubte MIME-Typen
    private $allowedMimeTypes = ["image/jpeg", "image/png", "image/webp"];

    // Erlaubte Dateiendungen
    private $allowedFileExtensions = ["jpeg", "JPEG", "jpg", "JPG", "png", "PNG", "webp", "WEBP"];

    // Maximale Bildbreite und -höhe
    private $maxImageWidth = 1000;
    private $maxImageHeight = 1000;

    // Eigenschaft für die maximale Dateigröße
    private $maxFileSize = 500000;

    // Array Fehlermeldungen
    public $errorMessages = [];



    /** KONSTRUKTOR */

    // Verbindung Zielordner
    public function __construct($targetFolder) {
        $this->targetFolder = $targetFolder;
    }

    // Überprüft, ob es beim Dateiupload Fehler gibt
    public function checkFileError($file) {
        if ($file['error'] !== UPLOAD_ERR_OK) {
            $this->errorMessages[] = "Fehler beim Hochladen der Datei: " . $file['error'];
            return false;
        }
        return true;
    }

    // Überprüft MIME-Type
    public function checkFileMimeType($file) {
        $mimeType = mime_content_type($file['tmp_name']);
        if (!in_array($mimeType, $this->allowedMimeTypes)) {
            $this->errorMessages[] = "Ungültiger Dateityp. Erlaubt: JPEG, JPG, PNG, WEBP";
            return false;
        }
        return true;
    }

    // Überprüft Dateigrösse (File-Size)
    public function checkFileSize($file) {
        if ($file['size'] > $this->maxFileSize) {
            $this->errorMessages[] = "Die Datei ist zu groß. Maximale Grösse: 5 MB";
            return false;
        }
        return true;
    }

    // Datei in Zielordner verschieben
    public function moveFile($file) {
        if (empty($this->errorMessages)) {
            $fileName = basename($file['name']);
            $targetPath = $this->targetFolder . DIRECTORY_SEPARATOR . $fileName;
            
            if (move_uploaded_file($file['tmp_name'], $targetPath)) {
                return $targetPath; // Erfolgreich hochgeladen
            } else {
                $this->errorMessages[] = "Fehler beim Verschieben der Datei.";
                return false;
            }
        }
        return false;
    }

    // Ausgabe aller Fehler
    public function getErrorMessages() {
        return $this->errorMessages;
    }
    
        // Validiert und führt den gesamten Uploadprozess aus
    public function uploadFile($file) {
        if ($this->checkFileError($file) && $this->checkFileMimeType($file) && $this->checkFileSize($file)) {
            return $this->moveFile($file);
        }
        return false;
    }
}

