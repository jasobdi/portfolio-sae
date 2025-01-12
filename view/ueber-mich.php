<?php 
require_once('../controller/config.php');
require_once('../controller/class/Database.class.php');

// Database-Klasse Initialisieren
$db = Database::getInstance();  

// Daten aus der Datenbank holen
$aboutData = $db->getAboutPageData(); 
?>

<!DOCTYPE html>
<html lang="de">
    <!--  HEAD  -->
    <?php 
    $siteTitle = 'About - Portfolio Janice Bader'; // <title>
    include('../partials/head.php') 
    ?>
<body>

    <!-- HEADER -->
    <header>
        <?php include('../partials/nav.php') ?>
    </header>

    <!-- MAIN -->
    <main class="main-about">
        <section class="about-me">
        <h1><?php echo htmlspecialchars($aboutData['title'] ?? 'About'); ?></h1>

            <!-- INTRODUCTION -->
            <div class="introduction-left">
                <p class="introduction now">
                    <?php echo nl2br(htmlspecialchars($aboutData['intro_1'] ?? '')); ?>
                </p>

                <?php if (!empty($aboutData['image_1'])): ?>
                    <img src="../images/about/<?php echo htmlspecialchars($aboutData['image_1']); ?>" alt="<?php echo htmlspecialchars($aboutData['desc_1']); ?>">
                <?php endif; ?>
            </div>

            <div class="introduction-right">
                <p class="introduction me">
                    <?php echo nl2br(htmlspecialchars($aboutData['intro_2'] ?? '')); ?>
                </p>
                
                <?php if (!empty($aboutData['image_2'])): ?>
                    <img src="../images/about/<?php echo htmlspecialchars($aboutData['image_2']); ?>" alt="<?php echo htmlspecialchars($aboutData['desc_2']); ?>">
                <?php endif; ?>
            </div>

        </section>

        <!-- KONTAKTFORMULAR -->
        <section class="contact-form">
                
            <form novalidate>
                <h2>Kontakt</h2>
                <label for="name-title">*Anrede</label>
                <select name="name-title" id="name-title" required>
                    <option value="" selected hidden>Anrede auswählen</option>
                    <option value="frau">Frau</option>
                    <option value="herr">Herr</option>
                    <option value="none">keine Anrede</option>
                </select>
                <label for="first-name">*Vorname(n)</label>
                <input type="text" id="first-name">
                <label for="last-name">*Nachname(n)</label>
                <input type="text" id="last-name">
                <label for="company">Firma</label>
                <input type="text" id="company">
                <label for="street">*Strasse</label>
                <input type="text" id="street">
                <label for="plz">*PLZ</label>
                <input type="number" id="plz">
                <label for="city">*Ort</label>
                <input type="text" id="city">
                <label for="email">*E-Mail</label>
                <input type="email" id="email">
                <label for="phone">*Telefon</label>
                <input type="tel" id="phone" placeholder="079 123 23 23">
                <label for="message">*Nachricht</label>
                <textarea name="message" id="message" cols="30" rows="10"></textarea>
                <small>*Pflichtfelder</small>
                <button type="submit" class="submit">Absenden</button>
            </form>
        </section>

    </main>

    <!-- FOOTER -->
    <?php include('../partials/footer.php') ?>
    
</body>
</html>