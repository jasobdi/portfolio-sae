<?php include('../controller/registration.php') ?>

<!DOCTYPE html>
<html lang="de">

<!--  HEAD  -->
<?php
$siteTitle = 'Registrieren - CMS'; // <title>
include('../partials/head-cms.php')
?>

<body>
    <!-- NAVIGATION -->
    <?php include('../partials/nav-cms.php') ?>
    
    <main class="main-registration">
        <h1>Registrieren</h1>

        <section class="registration-form">

            <form action="" method="POST" novalidate>

                <label for="username">Benutzername</label>
                <input type="text" id="username" name="username" required value="<?php echo htmlspecialchars($registrData['username']); ?>">
                <ul>
                    <li>4-16 Zeichen</li>
                    <li>keine Leerzeichen</li>
                </ul>
                <!-- Fehlermeldung Benutzername -->
                <?php if (isset($errorMessages['username'])): ?>
                    <span><?php echo $errorMessages['username']; ?></span>
                <?php endif; ?>

                <label for="email">E-Mail</label>
                <input type="email" id="email" name="email" required value="<?php echo htmlspecialchars($registrData['email']); ?>">
                <!-- Fehlermeldung E-Mail -->
                <?php if (isset($errorMessages['email'])): ?>
                    <span><?php echo $errorMessages['email']; ?></span>
                <?php endif; ?>

                <label for="password">Passwort</label>
                <input type="password" id="password" name="password" required value="<?php echo htmlspecialchars($registrData['password']); ?>">
                <ul>
                    <li>mindestens 8 Zeichen</li>
                    <li>Grossbuchstabe</li>
                    <li>Kleinbuchstabe</li>
                    <li>Sonderzeichen #?!@$%^&*-_</li>
                    <li>Zahl</li>
                    <li>keine Leerzeichen</li>
                </ul>
                <!-- Fehlermeldung Passwort -->
                <?php if (isset($errorMessages['password'])): ?>
                    <span><?php echo $errorMessages['password']; ?></span>
                <?php endif; ?>


                <label for="confirmpassword">Passwort wiederholen</label>
                <input type="password" id="confirmpassword" name="confirmpassword" required value="<?php echo htmlspecialchars($registrData['confirmpw']); ?>">
                <!-- Fehlermeldung Passwortwiederholung -->
                <?php if (isset($errorMessages['confirmpassword'])): ?>
                    <span><?php echo $errorMessages['confirmpassword']; ?></span>
                <?php endif; ?>

                <button type="submit" class="register" name="register">Registrieren</button>
            </form>

        </section>
    </main>

    <!-- FOOTER -->
    <?php include('../partials/footer-cms.php') ?>

</body>

</html>