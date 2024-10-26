<?php 
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
                <input type="text" id="username">

                <label for="password">Passwort</label>
                <input type="password" id="password">

                <button type="submit" class="login" >Login</button>
            </form>
        </section>
    </main>

    <!-- FOOTER -->
    <?php include('partials/footer.php') ?>