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

            <div class="label-container">
                <label for="img-top">Bild 1</label>
                <i class="fa-solid fa-trash"></i>
            </div>
                <div class="img-top" ></div>
                <!-- <img src="" alt=""> -->

                <label for="desc-bottom">Beschreibung 2</label>
                <textarea name="desc-bottom" id="desc-bottom"></textarea>

            <div class="label-container">
                <label for="img-bottom">Bild 2</label>
                <i class="fa-solid fa-trash"></i>
            </div>
                <div class="img-bottom"></div>
                <!-- <img src="" alt=""> -->
        
            <button type="submit" name="safe">Speichern</button> 
        </form>
    </main>
    <!-- FOOTER -->
    <?php include('../partials/footer-cms.php') ?>
</body>
</html>