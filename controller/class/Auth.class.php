<?php 

// Prüft ob der User eingeloggt ist

class Auth {
    // prüfen ob Benutzer eingeloggt ist
    public static function checkLogin() {
        // Sessionstart falls noch nicht passiert
        if(session_status() == PHP_SESSION_NONE) {
            session_name(SESSIONCOOKIE_NAME);
            session_start(); // Session starten
        }

        // Debugging: Überprüfen, ob die Session-Variablen gesetzt sind
       // echo '<pre>';
       // print_r($_SESSION); // Ausgabe der Session-Variablen zur Fehleranalyse
       // echo '</pre>';

        // keine userid gesetzt oder userid leer
        if(!isset($_SESSION['userid']) || empty($_SESSION['userid'])) {
            // Benutzer ist nicht eingeloggt -> Umleiten auf Login-Seite
            header('Location: login.php');
            exit(); // Script abbrechen nach der Umleitung
        }
    }

    // eingeloggten Benutzernamen abrufen
    public static function getUserName() {
        return isset($_SESSION['username']) ? $_SESSION['username'] : 'Unbekannt';
    }

    // eingeloggte User-ID abrufen
    public static function getUserId() {
        return isset($_SESSION['userid']) ? $_SESSION['userid'] : null;
    }

    // Login prüfen
    public static function login($username, $password, $db) {
        $username = strip_tags(trim($username));
        $password = strip_tags(trim($password));

        // Hat es in der Datenbank einen User mit dem $username?
        $query = 'SELECT * FROM `user` WHERE username = :username';
        $statement = $db->prepare($query);
        $values = array('username' => $username);
        $statement->execute($values);

        $user = $statement->fetch(PDO::FETCH_ASSOC); // Assoziatives Array mit User-Daten

        // User wurde gefunden, Passwort überprüfen
        if ($user !== false && password_verify($password, $user['userpassword'])) {
            // Benutzer einloggen: Session-Daten speichern
            $_SESSION['username'] = $user['username'];
            $_SESSION['userid'] = $user['ID'];
            $_SESSION['logintime'] = time(); // Zeitstempel für die Session
            return true;
        } else { 
            // Benutzername oder Passwort ungültig
            return false;
        }
    }

        // SESSION ID erneuern (gegen Session Hijacking)
        public static function regenerateSession() {
            // Sessionstart falls noch nicht passiert
            if (session_status() == PHP_SESSION_NONE) {
                session_name(SESSIONCOOKIE_NAME);
                session_start(); // Session starten
            }
            session_regenerate_id(); // Session ID erneuern
        }
    
        // Überprüfen ob User gerade angemeldet ist
        public static function isLoggedIn() {
            return isset($_SESSION['userid']) && !empty($_SESSION['userid']);
        }
    }

?>