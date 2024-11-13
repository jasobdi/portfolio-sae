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
        header("Location: index.php"); // Weiterleitung nach dem Login
        exit();
    }
}
session_regenerate_id(); // Session ID erneuern gegen Session Hijacking

?>

<!DOCTYPE html>
<html lang="de">
<!--  HEAD  -->
<?php include('partials/head.php') ?>

<body>

    <!-- HEADER -->
    <header>
        <?php include('partials/nav.php') ?>
    </header>

    <main class="main-login">
        <h1>Login</h1>

        <section class="login-form">
            <form action="" method="POST">
                <label for="username">Benutzername</label>
                <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($username); ?>">

                <label for="password">Passwort</label>
                <input type="password" id="password" name="password">

                <?php if (!empty($errorMessages)): ?>
                    <div class="error-messages">
                        <?php foreach ($errorMessages as $message): ?>
                            <p style="color: red;"><?php echo htmlspecialchars($message); ?></p>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <button type="submit" class="login">Login</button>
            </form>
        </section>
    </main>

    <!-- FOOTER -->
    <?php include('partials/footer.php') ?>
</body>
</html>