<?php
class NewUpload
{

    // Zielverzeichnis
    private $targetFolder = "../../images/projects";

    // Array Fehlermeldungen
    public $errorMessages = [];

    // Eigenschaft für die maximale Dateigröße
    private $maxFileSize = 300000;

    // Erlaubte MIME-Typen
    private $allowedMimeTypes = ["image/jpeg", "image/png", "image/webp"];

    // Erlaubte Dateiendungen
    private $allowedFileExtensions = ["jpeg", "JPEG", "jpg", "JPG", "png", "PNG", "webp", "WEBP"];

    // Maximale Bildbreite und -höhe
    private $maxImageWidth = 1000;
    private $maxImageHeight = 1000;

    /** KONSTRUKTOR */
    function __construct($path)
    {

        // Test, ob das Zielverzeichnis existiert
        if (isset($path) && is_dir($path)) {
            $this->targetFolder = $path;
        } else {
            // abbruch wenn der Ordner nicht existiert
            exit("Zielverzeichnis existiert nicht<br>");
        }
    }

    /** METHODE Fehlermeldungen verarbeiten */
    function checkFileError()
    {
        $errorNo = $_FILES['upload-file']['error'];
        // Überprüfe die Fehlermeldungen mit Hilfe einer switch Anweisung
        // Formuliere die Feedbacks klar und einfach

        // Div. Änderungen
        switch ($errorNo) {
            case 0:
                // echo "Es liegt kein Fehler vor, die Datei wurde erfolgreich ins TMP-Verzeichnis hochgeladen.";
                $this->errorMessages[] = "Die Datei wurde nich vollständig hochgeladen, bitte überprüfen Sie die Dateiendung oder wenden Sie sich an Ihren Web-Administrator.<br>";
                break;
            case 1:
                // echo "Die hochgeladene Datei überschreitet die in der php.ini-Anweisung upload_max_filesize festgelegte Größe.";
                $this->errorMessages[] = "Die hochgeladene Datei ist zu gross.<br>";
                break;
            case 2:
                // echo "Die hochgeladene Datei überschreitet die im HTML-Formular mittels der Anweisung MAX_FILE_SIZE angegebene maximale Dateigröße.";
                $this->errorMessages[] = "Die hochgeladene Datei ist zu gross.<br>";
                break;
            case 3:
                // echo "Die Datei wurde nur teilweise hochgeladen.";
                $this->errorMessages[] = "Die Datei wurde nur teilweise hochgeladen, überprüfen Sie Ihre Internetverbindung.<br>";
                break;
            case 4:
                // echo "Es wurde keine Datei hochgeladen.";
                $this->errorMessages[] = "Bitte wählen Sie eine Datei aus.<br>";
                break;
                // Die 5 fehlt :-o
            case 6:
                // echo "Fehlender temporärer Ordner.";
                $this->errorMessages[] = "Konnte die Datei nicht hochladen, bitte wenden Sie sich an den Web-Administrator.<br>";
                break;
            case 7:
                // echo "Speichern der Datei auf die Festplatte ist fehlgeschlagen.";
                $this->errorMessages[] = "Konnte die Datei in Folge eines Serverproblems nicht speichern, bitte wenden Sie sich an den Web-Administrator.<br>";
                break;
            case 8:
                // echo "Eine PHP-Erweiterung hat das Hochladen der Datei gestoppt. PHP bietet keine Möglichkeit an, um festzustellen welche Erweiterung das Hochladen der Datei gestoppt hat. Die Überprüfung aller geladenen Erweiterungen mittels phpinfo() könnte helfen.";
                $this->errorMessages[] = "Konnte die Datei nicht hochladen, bitte wenden Sie sich an den Web-Administrator.<br>";
                break;
        }

        if ($errorNo == 0) {
            return true;
        } else {
            return false;
        }
    }

    /** METHODE Datei in "Quarantäne" (temp. Verzeichnis) wird nochmals überprüft */
    function checkFileInQuarantine()
    {
        // Gibt es Fehler?
        $hasErrors = false;
        // Dateigrösse nochmals überprüfen
        if ($_FILES['upload-file']['size'] > $this->maxFileSize) {
            $this->errorMessages[] = "Die Datei ist zu gross.<br>";
            $hasErrors = true;
            // abbrechen wenn die Dateigrösse nicht stimmt -> könnte ein Hackversuch sein
            return false;
        }

        // Dateiendung überpfüfen
        $extension = pathinfo($_FILES['upload-file']['name'], PATHINFO_EXTENSION);
        if (!in_array($extension, $this->allowedFileExtensions)) {
            $this->errorMessages[] = "Diese Dateiendung ist nicht erlaubt.<br>";
            $hasErrors = true;
            // abbrechen wenn die Dateiendung nicht stimmt -> könnte ein Hackversuch sein
            return false;
        }

        // MIME-Type überprüfen
        $mimeFromBrowser = $_FILES['upload-file']['type'];
        if (!in_array($mimeFromBrowser, $this->allowedMimeTypes)) {
            $this->errorMessages[] = "Dieser MIME-Type ist nicht erlaubt.<br>";
            $hasErrors = true;
            // abbrechen wenn der Mimetype nicht stimmt -> könnte ein Hackversuch sein
            return false;
        }

        // MIME-Sniffing überprüft den Inhalt der Datei (nicht die Dateiendung)
        $filepath = realpath($_FILES['upload-file']['tmp_name']);
        //  escape spaces in $filename due to their separating effect 
        $filepath = str_replace(" ", "\\ ", $filepath);
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeFromFile = finfo_file($finfo, $filepath);
        finfo_close($finfo);
        if (!in_array($mimeFromFile, $this->allowedMimeTypes)) {
            $this->errorMessages[] = "Diese Datei hat keinen erlaubten MIME-Type. Erlaubt sind nur Bilder.<br>";
            $hasErrors = true;
            // abbrechen wenn der Mimetype nicht stimmt -> könnte ein Hackversuch sein
            return false;
        }

        // Bilddimensionen bestimmen
        $sizes = getimagesize($_FILES['upload-file']['tmp_name']);
        $width = $sizes[0]; // Breite in Pixel
        $height = $sizes[1]; // Höhe in Pixel

        if ($width > $this->maxImageWidth) {
            // Bild ist zu breit
            $hasErrors = true;
            $this->errorMessages[] = "Das Bild ist zu breit.<br>";
        }

        if ($height > $this->maxImageHeight) {
            // Bild ist zu hoch
            $hasErrors = true;
            $this->errorMessages[] = "Das Bild ist zu hoch.<br>";
        }

        if ($hasErrors) {
            return false;
        } else {
            return true;
        }


        // Validierung & Sanitizing Benutzereingaben
        $title = isset($title) ? trim($title) : '';
        $title = strip_tags($title);

        // Beschreibung sanitizing
        $description = isset($description) ? trim($description) : '';
        $description = strip_tags($description);

        // Validierung der Beschreibungslänge (max. 150 Zeichen)
        if (strlen($description) > 150) {
            $this->errorMessages[] = "Die Beschreibung darf nicht mehr als 150 Zeichen enthalten.<br>";
            return false;
        }

        return [$title, $description];
    }

    function moveFile()
    {
        if (is_uploaded_file($_FILES['upload-file']['tmp_name'])) {
            $tmp_name = $_FILES["upload-file"]["tmp_name"];
            $name = basename($_FILES["upload-file"]["name"]);

            // Timestamp hinzufügen
            $now = time();

            // Vollständiger Zielpfad
            $targetPath = $this->targetFolder . "/" . $now . "-" . $name;

            // Überprüfen, ob die Datei verschoben werden konnte
            if (move_uploaded_file($tmp_name, $targetPath)) {
                $this->errorMessages[] = "Die Datei wurde erfolgreich im Ordner &quot;" . $this->targetFolder . "&quot; gespeichert.<br>";
                return true;
            } else {
                // Fehler beim Verschieben der Datei
                $this->errorMessages[] = "Fehler beim Verschieben der Datei.<br>";
                return false;
            }
        } else {
            // Wenn die Datei nicht hochgeladen wurde
            $this->errorMessages[] = "Die Datei konnte nicht hochgeladen werden.<br>";
            return false;
        }
    }
}
