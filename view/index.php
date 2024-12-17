<?php

/** FUNKTIONIERT!! */

// Datenbankverbindung herstellen
require_once('../controller/config.php');
require_once('../controller/class/Database.class.php');

$db = Database::getInstance(); // Database-Klasse Initialisieren
$title = $db->getHomePageTitle(); // Titel aus der Datenbank holen

// Fallback falls kein Titel vorhanden ist
$pageTitle = $title['title'] ?? 'PORTFOLIO JANICE BADER'; 

?>

<!DOCTYPE html>
<html lang="de">
    <!--  HEAD  -->
    <?php include('../partials/head.php') ?>
<body>

    <!-- HEADER -->
    <header>
        <?php include('../partials/nav.php') ?>
    </header>

    <!-- MAIN -->
    <main class="main-home">
        <h1><?php echo htmlspecialchars($pageTitle); ?></h1>
        <hr> 

    <!-- IMAGE SLIDER -->
            <div class="slider">
                <!-- logo redbull -->
                <div class="slide">
                    <img
                        srcset="../images/image_slider/redbull_redesign_logo_296w.png 296w, ../images/image_slider/redbull_redesign_logo_400w.png 400w, ../images/image_slider/redbull_redesign_logo_500w.png 500w" 
                        sizes="(max-width: 768px) 296px, 400px, 500px"
                        alt="Redesign Redbull Logo">
                </div>
                <!-- logo alpenblick -->
                <div class="slide">
                    <img 
                        srcset="../images/image_slider/alpenblick_logo_296w.png 296w, ../images/image_slider/alpenblick_logo_400w.png 400w, ../images/image_slider/alpenblick_logo_500w.png 500w" 
                        sizes="(max-width: 768px) 296px, 400px, 500px"
                        alt="Logo für das fiktive Cafe Alpenblick">
                </div>
                <!-- screendesign -->
                <div class="slide">
                    <img 
                        srcset="../images/image_slider/screendesign_296w.png 296w, ../images/image_slider/screendesign_400w.png 400w, ../images/image_slider/screendesign_500w.png 500w" 
                        sizes="(max-width: 768px) 296px, 400px 500px"
                        alt="Erste Version Screendesign Potfolio Webseite">
                </div>
                <!-- portfolio-webseite -->
                <div class="slide">
                    <img 
                        srcset="../images/image_slider/portfolio_webseite_296w.png 296w, ../images/image_slider/portfolio_webseite_400w.png 400w, ../images/image_slider/portfolio_webseite_500w.png 500w" 
                        sizes="(max-width: 768px) 296px, 400px, 500px"
                        alt="Erste Version Portfolio Webseite mit HTML & CSS">
                </div>
                <!-- image-slider -->
                <div class="slide">
                    <img 
                        srcset="../images/image_slider/image_slider_296w.png 296w, ../images/image_slider/image_slider_400w.png 400w, ../images/image_slider/image_slider_500w.png 500w " 
                        sizes="(max-width: 768px) 296px, 400px, 500px"
                        alt="Image Slider Portfolio Webseite mit Javascript">
                </div>
                <!-- logo jb -->
                <div class="slide">
                    <img 
                        srcset="../images/image_slider/logo_jb_296w.png 296w, ../images/image_slider/logo_jb_400w.png 400w, ../images/image_slider/logo_jb_500w.png 500w" 
                        sizes="(max-width: 768px) 296px, 400px, 500px"
                        alt="Logo Janice Bader">
                </div>
            </div>
            <hr>
            <div class="description">
                <p>description</p>
            </div>
            <div class="container-buttons">
                <button class="slider-btn left" aria-label="arrow-left"><i class="fa-solid fa-arrow-left"></i></button>
                <div class="control-container">
                    <button class="pause-play stop" aria-label="pause"><i class="fa-solid fa-pause"></i></button>
                    <button class="pause-play start hidden" aria-label="play"><i class="fa-solid fa-play"></i></button>
                </div>
                <button class="slider-btn right" aria-label="arrow-right"><i class="fa-solid fa-arrow-right"></i></button>
            </div>
    </main>
    <hr>

    <!-- FOOTER -->
    <?php include('../partials/footer.php') ?>

</body>
</html>