<?php include('../controller/login.php') ?>

<!DOCTYPE html>
<html lang="de">
<!--  HEAD  -->
<?php 
$pageTitle = 'Login - CMS'; // <title>
include('../partials/head-cms.php') 
?>
<body>

    <main class="main-login">
        <h1>Anmelden</h1>

        <section class="login-form">

            <form action="" method="POST">
                <label for="username">Benutzername</label>
                <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($username); ?>">

                <label for="password">Passwort</label>
                <input type="password" id="password" name="password">

                <!-- Fehlermeldung -->
                <?php if (!empty($errorMessages)): ?>
                    <div class="error-messages">
                        <?php foreach ($errorMessages as $message): ?>
                            <p style="color: red;"><?php echo htmlspecialchars($message); ?></p>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <button type="submit" class="login">Anmelden</button>
            </form>

        </section>
        
    </main>

    <!-- FOOTER -->
    <?php include('../partials/footer-cms.php') ?>
</body>
</html>