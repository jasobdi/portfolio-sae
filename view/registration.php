<?php include('../controller/registration.php') ?>

<!DOCTYPE html>
<html lang="de">
<!--  HEAD  -->
<?php include('../partials/head-cms.php') ?>

<body>

    <!-- HEADER -->
    <header>
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

                <!-- <legend>Nutzertyp</legend>
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
                <?php endif; ?> -->

                <button type="submit" class="register" name="register">Registrieren</button>
            </form>
        </section>
    </main>

    <!-- FOOTER -->
    <?php include('../partials/footer-cms.php') ?>

</body>

</html>