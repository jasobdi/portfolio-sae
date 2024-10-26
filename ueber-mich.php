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

    <!-- MAIN -->
    <main class="main-about">
        <section class="about-me">
            <h1>Über mich</h1>

            <!-- INTRODUCTION -->
            <div class="introduction-left">
                <p class="introduction now">
                    Ich bin Janice. <br>
                    Zurzeit absolviere ich meine Ausbildung im Bereich Webdesign und -Development am SAE Institut in Zürich. Nebenbei arbeite ich am Empfang eines internationalen Software-Unternehmens. <br> <br>
                    Design, Programmieren und IT interessieren mich schon eine Weile, durch die SAE habe ich die Möglichkeit meine Interessen zum Beruf zu machen.
                </p>
                <img 
                srcset="images/janice_bader_296w.png 296w, images/janice_bader_300w.png 300w, images/janice_bader_400w.png 400w " 
                sizes="(max-width: 768px) 296px, 300px, 400px"
                alt="junge Frau mit Brille und geraden blonden Haaren lächelt für ein Bewerbungsfoto">
            </div>
            <div class="introduction-right">
                <p class="introduction me">
                    In meiner Freizeit male und zeichne ich gerne, ausserdem spiele ich Unihockey und bewege mich viel im Ausgleich zum Alltag vor dem Bildschirm.
                </p>
                <img 
                srcset="images/janice_black_white_296w.png 296w, images/janice_black_white_300w.png 300w, images/janice_black_white_400w.png 400w" 
                sizes="(max-width: 768px) 296px, 300px, 400px"
                alt="schwarz-weiss-Bild von einer jugen Frau mit gewellten Haaren und Hut, die im Wald steht">
            </div>

            <!-- BUTTON-LEBENSLAUF -->
            <div class="cv"><a href="assets/CV_JB.pdf">Download Lebenslauf</a></div>
        </section>
            

        <!-- PROGRESS-BARS-SKILLS zu einem späteren Zeitpunkt-->
        <!-- <section class="skills-bars">
                <h2>Kenntnisse</h2>
                <p>Adobe Photoshop</p>
                <div class="skills-container">
                    <div class="skills ps">60%</div>
                </div>
                <p>Adobe Illustrator</p>
                <div class="skills-container">
                    <div class="skills ai">70%</div>
                </div>
                <p>Adobe Xd</p>
                <div class="skills-container">
                    <div class="skills xd">90%</div>
                </div>
                <p>Adobe InDesign</p>
                <div class="skills-container">
                    <div class="skills id">60%</div>
                </div>
                <p>HTML</p>
                <div class="skills-container">
                    <div class="skills html">60%</div>
                </div>
                <p>CSS</p>
                <div class="skills-container">
                    <div class="skills css">50%</div>
                </div>
        </section> -->

            

        <!-- KONTAKTFORMULAR -->
        <section class="contact-form">
                
            <form>
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
    <?php include('partials/footer.php') ?>
    
</body>
</html>