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
    } else if (!preg_match("/^.{4,16}$/", $username)) { // 4-16 Zeichen
        $errorMessages['username'] = 'Der Username muss zwischen 4 und 16 Zeichen lang sein.';
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
    } else if (!preg_match("/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-_]).{8,}$/", $password)) {
        $errorMessages['password'] = 'Das Passwort ist ungültig';
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

<!-- HTML -->

<!DOCTYPE html>
<html lang="de">
<!--  HEAD  -->
<?php include('partials/head.php') ?>

<body>

    <!-- HEADER -->
    <header>
        <?php include('partials/nav.php') ?>
    </header>

    <main class="main-registration">
        <h1>Registrieren</h1>

        <?php
    // Erfolgsmeldung anzeigen
    if ($formSuccess) {
        echo '<span style="color:#2d700f;font-weight:600;margin-bottom:2rem;">Registrierung erfolgreich</span>';
    }
    ?>

        <section class="registration-form">
            <form action="" method="POST" novalidate>

                <label for="username">Benutzername</label>
                <input type="text" id="username" name="username" required value="<?php echo htmlspecialchars($username); ?>">
                <?php if (isset($errorMessages['username'])): ?>
                    <span><?php echo $errorMessages['username']; ?></span>
                <?php endif; ?>


                <label for="email">E-Mail</label>
                <input type="email" id="email" name="email" required value="<?php echo htmlspecialchars($email); ?>">
                <?php if (isset($errorMessages['email'])): ?>
                    <span><?php echo $errorMessages['email']; ?></span>
                <?php endif; ?>

                <label for="password">Passwort</label>
                <input type="password" id="password" name="password" required value="<?php echo htmlspecialchars($password); ?>">
                <?php if (isset($errorMessages['password'])): ?>
                    <span><?php echo $errorMessages['password']; ?></span>
                <?php endif; ?>

                <label for="confirmpassword">Passwort wiederholen</label>
                <input type="password" id="confirmpassword" name="confirmpassword" required value="<?php echo htmlspecialchars($confirmpassword); ?>">
                <?php if (isset($errorMessages['confirmpassword'])): ?>
                    <span><?php echo $errorMessages['confirmpassword']; ?></span>
                <?php endif; ?>

                <legend>Nutzertyp</legend>
                <div class="radio-registration">
                    <input type="radio" id="administrator" name="usertype" value="1" <?php echo ($usertype == '1') ? 'checked' : ''; ?>>
                    <label for="administrator">Administrator</label>
                </div>
                <div class="radio-registration">
                    <input type="radio" id="user" name="usertype" value="2" <?php echo ($usertype == '2') ? 'checked' : ''; ?>>
                    <label for="user">Nutzer</label>
                </div>
                <?php if (isset($errorMessages['usertype'])): ?>
                    <span><?php echo $errorMessages['usertype']; ?></span>
                <?php endif; ?>


                <label for="language">Bevorzugte Sprache</label>
                <select name="language" id="language" required>
                    <option value="" selected hidden>Sprache auswählen</option>
                    <option value="deutsch" <?php echo ($language == 'deutsch') ? 'selected' : ''; ?>>Deutsch</option>
                    <option value="english" <?php echo ($language == 'english') ? 'selected' : ''; ?>>English</option>
                    <option value="francais" <?php echo ($language == 'francais') ? 'selected' : ''; ?>>Francais</option>
                    <option value="italiano" <?php echo ($language == 'italiano') ? 'selected' : ''; ?>>Italiano</option>
                </select>
                <?php if (isset($errorMessages['language'])): ?>
                    <span><?php echo $errorMessages['language']; ?></span>
                <?php endif; ?>


                <legend>AGB's akzeptieren</legend>
                <div class="checkbox-registration">
                    <input type="checkbox" id="agb" name="agb" <?php echo $agb ? 'checked' : ''; ?>>
                    <label for="agb">Ich akzeptiere die AGB's</label>
                </div>
                <?php if (isset($errorMessages['agb'])): ?>
                    <span><?php echo $errorMessages['agb']; ?></span>
                <?php endif; ?>

                <button type="submit" class="register" name="register">Registrieren</button>
            </form>
        </section>
    </main>

    <!-- FOOTER -->
    <?php include('partials/footer.php') ?>

</body>

</html>