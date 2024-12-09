<!DOCTYPE html>
<html lang="en">
<!--  HEAD  -->
<?php include('../partials/head-cms.php') ?>
<body>
    <!-- NAVIGATION -->
    <?php include('../partials/nav-cms.php') ?>

    <main class="main-edit-about-cms">
        <h1>About bearbeiten</h1>
        <form class="edit-about" action="" novalidate>
                <label for="pagetitle">Seitentitel*</label>
                <input type="text" name="pagetitle" id="pagetitle" required>

                <label for="desc-top">Beschreibung 1</label>
                <textarea name="desc-top" id="desc-top"></textarea>
                <label for="img-top">Bild 1</label>
                <div class="img-top" ></div>
                <!-- <img src="" alt=""> -->

                <label for="desc-top">Beschreibung 2</label>
                <textarea name="desc-bottom" id="desc-bottom"></textarea>
                <label for="img-bottom">Bild 2</label>
                <div class="img-bottom"></div>
                <!-- <img src="" alt=""> -->
        
            <button type="submit" name="safe">Speichern</button> 
        </form>
    </main>
</body>
</html>