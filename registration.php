<?php

/*
* FORMULARVALIDIERUNG REGISTRIERUNGSFORMULAR
*/

/** Hilfestellung */

// Wenn der Submit Button geklickt wurde
if(isset($_POST['register'])){
    // Array Monitor:
    echo '<pre>';
    print_r($_POST);
    echo '</pre>';

    echo 'Das Formular wurde verschickt <br>';

/** Hilfestellung beim testen */
    foreach($_POST as $key => $value){
        echo "Name: <strong>".$key."</strong>, Wert: <strong>".$value."</strong><br>";
    }

    if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    $username = strip_tags(trim($_POST['username']));
    $email = strip_tags(trim($_POST['email']));
    $password = strip_tags(trim($_POST['password']));
    $usertype = ($_POST['usertype']);
    $language = ($_POST['language']);
    $agb = ($_POST['agb']);

    echo 'die Formulare sind vorhanden';
    }

} else {
    echo 'Das Formular wurde nicht verschickt';

    $username = '';
    $email = '';
    $password = '';
    $usertype = '';
    $language = '';
    $agb = '';
}

$errorMessages = array(); // Container für alle Fehlermeldungen

// leere Variablen für die Input-Felder
// $username = '';
// $email = '';
// $password = '';
// $usertype = '';
// $language = '';
// $agb = '';

/* mit dem if-statement wird überprüft ob die Input-Felder ausgfüllt sind und 
    wenn sie es sind, dann bleiben die Werte in den Feldern vorhanden
    ansonsten werden sie rausgelöscht und man müsste sie erneut eingeben  */

// Abfrage ob POST-Daten vorhanden sind - wenn nicht, muss auch keine Verarbeitung gemacht werden

if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) 
&& isset($_POST['usertype']) && isset($_POST['language']) && isset($_POST['agb'])){
    // strip_tags: bereinigt den Wert in der Textbox (abgesichert) -> sanitizing
    // trim: keine Leerschläge am Anfang/Ende zulassen
    // Wertre aus dem POST-Array in die vorher erstellten Variablen holen


    // $username = strip_tags(trim($_POST['username']));
    // $email = strip_tags(trim($_POST['email']));
    // $password = strip_tags(trim($_POST['password']));
    // $usertype = ($_POST['usertype']);
    // $language = ($_POST['language']);
    // $agb = ($_POST['agb']); 

    // echo 'die Formulare sind vorhanden';

    /* 
    * VALIDIERUNG DER EINZELNEN INPUTS
    */

    // username
    if(empty($username)){
        $errorMessages[] = 'Bitte Username eingeben';
    } else if (!preg_match("/{4, 16}$/", $username)){ // 4-16 Zeichen, keine Leerzeichen
        $errorMessages[] = 'Der Username ist ungültig';
    }


    // email 
    if(empty($email)){
        $errorMessages[] = 'Bitte E-mail eingeben';
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $errorMessages[] = 'Die E-mail ist ungültig';
    } 

    // passwort
    if(empty($password)){
        $errorMessages[] = 'Bitte ein Passwort eingeben';
    } else if (!preg_match("/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-_]).{8,}$/", $password)){ 
        /* Passwort muss folgende Kriterien erfüllen:
        min. 1 Grossbuchtabe, 1 Kleinbuchstabe, 1 Zahl, 1 Sonderzeichen, 8 Zeichen, keine Leerzeichen
    */
        $errorMessages[] = 'Das Passwort ist ungültig';
    }

    // nutzertyp
    if(!isset($_POST['usertype'])){
        $errorMessages[] = 'Bitte einen Nutzertyp auswählen';
    }

    // sprache
    if(empty($language)){
        $errorMessages[] = 'Bitte eine Sprache auswählen';
    }

    // AGB
    if(!isset($_POST['agb'])){
        $errorMessages[] = "Bitte die AGB's akzeptieren";
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

    // gesammelte Fehlermeldungen aus $errorMessages als span ausgeben
    if( count($errorMessages) > 0){
        echo '<span style = "color:red">';
        echo implode('<br>', $errorMessages); 
        echo '</span>';
    }
    ?>

        <section class="registration-form">
        
            <form action="" method="POST">

                <label for="username">Benutzername</label>
                <!-- Informationsfeld: Vorgaben Username -->
                <!-- <i class="fa-solid fa-circle-info">
                    <div class="form-info-overlay">Benutzername: <br>
                    4 - 16 Zeichen <br> 
                    keine Leerzeichen</div></i>  -->
                <input type="text" id="username" name="username" value="<?php echo $username ?>">
                

                <label for="email">E-Mail</label>
                <input type="email" id="email" name="email" value="<?php echo $email ?>">

                <label for="password">Passwort</label>
                <!-- Informationsfeld: Vorgaben PW -->
                <!-- <i class="fa-solid fa-circle-info">
                    <div class="form-info-overlay">Passwort: <br>
                    Mindestens 8 Zeichen, davon mindestens <br>
                    1 Grossbuchstabe <br>
                    1 Kleinbuchstabe <br>
                    1 Zahl <br>
                    1 Sonderzeichen und <br> 
                    keine Leerzeichen</div></i>  -->
                <input type="password" id="password" name="password" value="<?php echo $password ?>">

                <legend>Nutzertyp</legend>
                <div class="radio-registration">
                    <input type="radio" id="administrator" name="usertype" value="administrator">
                    <label for="administrator">Administrator</label>
                </div>
                <div class="radio-registration">
                    <input type="radio" id="user" name="usertype" value="user">
                    <label for="user">Nutzer</label>
                </div>

                <label for="language">Bevorzugte Sprache</label>
                <select name="language" id="language" value="<?php echo $language ?>">
                    <option value="" selected hidden>Sprache auswählen</option>
                    <option value="deutsch">Deutsch</option>
                    <option value="english">English</option>
                    <option value="francais">Francais</option>
                    <option value="italiano">Italiano</option>
                </select>

                <legend>AGB's akzeptieren</legend>
                <div class="checkbox-registration">
                    <input type="checkbox" id="agb" name="agb" value="<?php echo $agb ?>">
                    <label for="agb">Ich akzeptiere die AGB's</label>
                </div>

                <button type="submit" class="register" name="register">Registrieren</button>
            </form>
        </section>
    </main>

    <!-- FOOTER -->
    <?php include('partials/footer.php') ?>

</body>

</html>