<?php 

// Stellt mit PDO eine Datenbankverbindung her & enthält Funktionen für SQL-Befehle

// Konfiguration - Verbindung zum Config-File
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

    // Verbindung zu PDO
    public function getConnection() {
        return $this->db;
    }

    // METHODEN FÜR SQL-BEFEHLE

    public function prepare($query) {
        try {
            return $this->db->prepare($query);
        } catch (PDOException $e) {
            die("Fehler bei der Vorbereitung der Abfrage: " . $e->getMessage());
        }
    }

    // bindParam
    public function bind($stmt, $params) {
        try {
            foreach ($params as $key => $value) {
                $type = is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR;
                $stmt->bindValue($key, $value, $type);
            }
        } catch (PDOException $e) {
            die("Fehler beim Binden der Parameter: " . $e->getMessage());
        }
    }

    public function execute($stmt) {
        try {
            $stmt->execute();
            return $stmt;
        } catch (PDOException $e) {
            die("Fehler beim Ausführen der Abfrage: " . $e->getMessage());
        }
    }

    // METHODEN FÜR REGISTRIERUNG

    // überpfürfen ob Username existiert
    public function checkUsernameExists($username) {
        $query = 'SELECT COUNT(*) FROM user WHERE username = :username';
        $stmt = $this->prepare($query);
        $this->bind($stmt, [':username' => $username]);
        $this->execute($stmt);
        return $stmt->fetchColumn() > 0;
    }

    // überprüfen ob E-Mail existiert
    public function checkEmailExists($email) {
        $query = 'SELECT COUNT(*) FROM user WHERE useremail = :email';
        $stmt = $this->prepare($query);
        $this->bind($stmt, [':email' => $email]);
        $this->execute($stmt);
        return $stmt->fetchColumn() > 0;
    }

    // neuen User hinzufügen
    public function registerUser($username, $email, $password) {
        if ($this->checkUsernameExists($username)) {
            return 'Username ist bereits vergeben.';
        }
        if ($this->checkEmailExists($email)) {
            return 'E-Mail-Adresse ist bereits vergeben.';
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $query = 'INSERT INTO user (username, useremail, userpassword) VALUES (:username, :useremail, :userpassword)';
        $stmt = $this->prepare($query);
        $this->bind($stmt, [
            ':username' => $username,
            ':useremail' => $email,
            ':userpassword' => $hashedPassword
        ]);
        return $this->execute($stmt) ? 'Registrierung erfolgreich' : 'Fehler bei der Registrierung, bitte versuche es erneut.';
    }


    // METHODEN FÜR EDIT-HOME

    // Seitentitel holen
    public function getHomePageTitle() {
        $query = 'SELECT title FROM home WHERE id = 1';
        $stmt = $this->prepare($query);
        $this->execute($stmt);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result : ['title' => 'PORTFOLIO JANICE BADER'];
    }

    // Seitentitel upadte
    public function updateHomePageTitle($newTitle) {
        $query = 'UPDATE home SET title = :title WHERE id = 1';
        $stmt = $this->prepare($query);
        $this->bind($stmt, [':title' => $newTitle]);
        return $this->execute($stmt);
    }


    // METHODEN FÜR EDIT-ABOUT

    // Alle Daten holen (Titel, Beschreibungen, Bilder)
    public function getAboutPageData() {
        $query = 'SELECT title, intro_1, desc_1, image_1, intro_2, desc_2, image_2 FROM about WHERE id = 1';
        $stmt = $this->prepare($query);
        $this->execute($stmt);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ?: [
            'title' => 'About',
            'intro_1' => '',
            'desc_1' => '',
            'image_1' => '',
            'intro_2' => '',
            'desc_2' => '',
            'image_2' => ''
        ];
    }

    // Update alle Daten (Titel, Beschreibungen, Bilder)
    public function updateAboutPageData($newTitle, $newIntroduction1, $newDescription1, $newImage1, $newIntroduction2, $newDescription2, $newImage2) {
        $query = 'UPDATE about SET title = :title, intro_1 = :intro1, desc_1 = :desc1, image_1 = :img1, intro_2 = :intro2, desc_2 = :desc2, image_2 = :img2 WHERE id = 1';
        $stmt = $this->prepare($query);
        $this->bind($stmt, [
            ':title' => $newTitle,
            ':intro1' => $newIntroduction1,
            ':desc1' => $newDescription1,
            ':img1' => $newImage1,
            ':intro2' => $newIntroduction2,
            ':desc2' => $newDescription2,
            ':img2' => $newImage2
        ]);
        return $this->execute($stmt);
    }


    // METHODEN FÜR EDIT-PORTFOLIO

    // Alle Daten holen (Titel, Beschreibung)
    public function getPortfolioData() {
        $sql = 'SELECT title, description FROM portfolio WHERE id = 1';
        $stmt = $this->prepare($sql);
        $stmt = $this->execute($stmt);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result : [
            'title' => 'Portfolio',
            'description' => ''
        ];
    }

    // Update alle Daten (Titel, Beschreibungen, Bilder)
    public function updatePortfolioData($newTitle, $newDesc) {
        $sql = 'UPDATE portfolio SET title = :title, description = :description WHERE id = 1';
        $stmt = $this->prepare($sql);
        $this->bind($stmt, [
            ':title' => $newTitle,
            ':description' => $newDesc
        ]);
        return $this->execute($stmt);
    }


    // METHODEN FÜR EDIT-PROJECTS

    // Abrufen Projekt-Daten aus der Datenbank basierend auf ID
    public function getProjectData($id) {
        $query = 'SELECT ID, filepath, title, description, created_by, created_at FROM project WHERE ID = :id';
        $stmt = $this->prepare($query);
        $this->bind($stmt, [':id' => $id]);
        $this->execute($stmt);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    

    public function updateProjectData($projectId, $newFilepath, $newTitle, $newDescription, $newCreatedBy) {
        $sql = 'UPDATE project SET filepath = :filepath, title = :title, description = :description, created_by = :created_by WHERE ID = :id';
        $stmt = $this->prepare($sql);
        $this->bind($stmt, [
            ':filepath' => $newFilepath,
            ':title' => $newTitle,
            ':description' => $newDescription,
            ':created_by' => $newCreatedBy,
            ':id' => $projectId
        ]);
        return $this->execute($stmt);
    }

    // Daten in die Datenbank speichern
    public function insertProjectData($filePath, $title, $description, $createdBy) {
        $query = 'INSERT INTO project (filepath, title, description, created_by, created_at) VALUES (:filepath, :title, :description, :created_by, CURRENT_TIMESTAMP)';
        $stmt = $this->prepare($query);
        $this->bind($stmt, [
            ':filepath' => $filePath,
            ':title' => $title,
            ':description' => $description,
            ':created_by' => $createdBy
        ]);
        return $this->execute($stmt);
    }


    // Alle Projekte aus der Datenbank abrufen
    public function getAllProjects() {
        $query = 'SELECT ID, filepath, title, description FROM project ORDER BY created_at DESC';
        $stmt = $this->prepare($query);
        $this->execute($stmt);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Limitierte Anzahl Projekte abrufen (hier: 3 neuste)
    public function getLatestProjects($limit = 3) {
        $query = 'SELECT ID, filepath, title, description, created_by, created_at FROM project ORDER BY created_at DESC LIMIT :limit';
        $stmt = $this->prepare($query);
        $this->bind($stmt, [':limit' => $limit]);
        $this->execute($stmt);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}

?>