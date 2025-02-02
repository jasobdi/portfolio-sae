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

    // Überprüft Dateiendung (File-Extension)
    public function checkFileExtension($file) {
        $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if (!in_array($extension, $this->allowedFileExtensions)) {
            $this->errorMessages[] = "Ungültige Dateiendung. Erlaubt sind: " . implode(", ", $this->allowedFileExtensions);
            return false;
        }
        return true;
    }

    // Überprüft Bildmasse (Height & Width)
    public function checkImageDimensions($file) {
        $imageSize = getimagesize($file['tmp_name']);
        if ($imageSize) {
            [$width, $height] = $imageSize;
            if ($width > $this->maxImageWidth || $height > $this->maxImageHeight) {
                $this->errorMessages[] = "Die Bildmasse dürfen maximal {$this->maxImageWidth}x{$this->maxImageHeight} Pixel betragen.";
                return false;
            }
            return true;
        }
        $this->errorMessages[] = "Die Bildgröße konnte nicht überprüft werden.";
        return false;
    }

    // Datei in Zielordner verschieben
    public function moveFile($file) {
        if (empty($this->errorMessages)) {
            // Ursprünglicher Dateiname
            $originalName = pathinfo($file['name'], PATHINFO_FILENAME);
            $extension = pathinfo($file['name'], PATHINFO_EXTENSION);

            // Zeitstempel im Format 2024-12-10-141024
            $timestamp = date('Y-m-d-His'); 
    
            // Neuen Dateinamen generieren mit Zeitstempel
            $newFileName = $originalName . '_' . $timestamp . '.' . $extension;
    
            // Zielpfad erstellen
            $targetPath = $this->targetFolder . DIRECTORY_SEPARATOR . $newFileName;
            
            // Datei verschieben
            if (move_uploaded_file($file['tmp_name'], $targetPath)) {
                return $newFileName;
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
        if (
            $this->checkFileError($file) && // Dateiupload
            $this->checkFileMimeType($file) && // MIME-Type
            $this->checkFileSize($file) && // Dateigrösse 5MB
            $this->checkFileExtension($file) && // DAteiendung
            $this->checkImageDimensions($file) // Bildmasse 1000x1000px
        ) {
            return $this->moveFile($file);
        }
        return false;
    }
}

