<?php 

// Stellt mit PDO eine Datenbankverbindung her & enthält Funktionen für SQL-Befehle

// Konfiguration
require_once __DIR__ . '../../config.php';

class Database {
    private static $instance = null;
    private $db;

    // Konstruktor für Verbindung mit PDO
    private function __construct() {
        try {
            $this->db = new PDO('mysql:host=' . DBSERVER . ';dbname=' . DBNAME, DBUSER, DBPASSWORD);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Datenbankverbindung fehlgeschlagen: " . $e->getMessage());
        }
    }

    // Instanz der Database zurückgeben
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    // METHODEN FÜR REGISTRIERUNG

    // überpfürfen ob Username existiert
    public function checkUsernameExists($username) {
        $stmt = $this->db->prepare('SELECT COUNT(*) FROM user WHERE username = :username');
        $stmt->execute([':username' => $username]);
        return $stmt->fetchColumn() > 0;
    }

    // überprüfen ob E-Mail existiert
    public function checkEmailExists($email) {
        $stmt = $this->db->prepare('SELECT COUNT(*) FROM user WHERE useremail = :email');
        $stmt->execute([':email' => $email]);
        return $stmt->fetchColumn() > 0;
    }

    // neuen User hinzufügen
    public function registerUser($username, $email, $password) {
        // Zuerst sicherstellen, dass der Benutzername und die E-Mail nicht bereits existieren
        if ($this->checkUsernameExists($username)) {
            return 'Username ist bereits vergeben.';
        }
        if ($this->checkEmailExists($email)) {
            return 'E-Mail-Adresse ist bereits vergeben.';
        }

        // Passwort hashen
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Benutzer in die Datenbank einfügen
        $stmt = $this->db->prepare("INSERT INTO user (username, useremail, userpassword) VALUES (:username, :useremail, :userpassword)");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':useremail', $email);
        $stmt->bindParam(':userpassword', $hashedPassword);

        if ($stmt->execute()) {
            return 'Registrierung erfolgreich';
        } else {
            return 'Fehler bei der Registrierung, bitte versuche es erneut';
        }
    }

    // METHODEN FÜR EDIT-HOME

    // Seitentitel holen
    public function getHomePageTitle() {
        $stmt = $this->db->prepare('SELECT title FROM home WHERE id = 1');
        $stmt->execute();
        
        // Rückgabe Standardwert, falls keine Zeile gefunden wird
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result : ['title' => 'PORTFOLIO JANICE BADER']; 
    }

    // Seitentitel upadte
    public function updateHomePageTitle($newTitle) {
        $stmt = $this->db->prepare('UPDATE home SET title = :title WHERE id = 1');
        $stmt->bindParam(':title', $newTitle);
        return $stmt->execute();
        }


    // METHODEN FÜR EDIT-ABOUT

    // Alle Daten holen (Titel, Beschreibungen, Bilder)
    public function getAboutPageData() {
        $stmt = $this->db->prepare('SELECT title, description_1, image_1, description_2, image_2 FROM about WHERE id = 1');
        $stmt->execute();

        // Rückgabe Standardwerte, falls keine Zeile gefunden wird
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result : [
            'title' => 'About',
            'description_1' => '',
            'image_1' => '',
            'description_2' => '',
            'image_2' => ''
        ];
    }

    // Update alle Daten (Titel, Beschreibungen, Bilder)
    public function updateAboutPageData($newTitle, $newDescription1, $newImage1, $newDescription2, $newImage2) {
        $stmt = $this->db->prepare('UPDATE about SET title = :title, description_1 = :desc1, image_1 = :img1, description_2 = :desc2, image_2 = :img2 WHERE id = 1');
        
        $stmt->bindParam(':title', $newTitle);
        $stmt->bindParam(':desc1', $newDescription1);
        $stmt->bindParam(':img1', $newImage1);
        $stmt->bindParam(':desc2', $newDescription2);
        $stmt->bindParam(':img2', $newImage2);
        
        return $stmt->execute();
    }




}

?>