<!DOCTYPE html>
<html lang="en">

<!--  HEAD  -->
<?php
$siteTitle = '404 Page Not Found'; // <title>
include('partials/head.php')
?>

<body>
    <main>
        <section class="notfound">
            <h1>404 <br> Seite nicht gefunden</h1>
            <p>Hoppla, diese Seite existiert nicht (mehr)</p>
            <a href="home.php">Weiter zur Startseite</a>
            <img src="/v4_Projektordner_Portfolio_JB/v4_portfolio_janice_bader/images/error-404.png" sizes="(max-width: 768px) 296px, 300px, 400px" alt="gekritzelte Error Symbole">
            <small><a href="https://www.flaticon.com/free-stickers/error-404" title="error 404 stickers">Error 404 stickers created by Stickers - Flaticon</a></small>
        </section>
    </main>

    <!-- FOOTER -->
    <?php include('partials/footer.php') ?>
</body>

</html>