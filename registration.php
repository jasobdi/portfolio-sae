<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio Janice Bader - Registration</title>
</head>
<body>

<h1>Portfolio Janice Bader</h1>

<form>
    <label for="username">Benutzername</label>
    <input type="text" id="username">
    <label for="email">E-Mail</label>
    <input type="email" id="email">
    <label for="password">Passwort</label>
    <input type="password" id="password">
    <legend>Nutzertyp</legend>
    <div>
        <input type="radio" id="administrator" name="usertype">
        <label for="administrator">Administrator</label>
    </div>
    <div>
        <input type="radio" id="user" name="usertype">
        <label for="administrator">Nutzer</label>
    </div>
   <label for="language">Bevorzugte Sprache</label>
   <select name="language" id="language">
    <option value="" selected hidden>Sprache auswählen</option>
    <option value="deutsch">Deutsch</option>
    <option value="english">English</option>
    <option value="francais">Francais</option>
    <option value="italiano">Italiano</option>
   </select>
   <legend>AGB's akzeptieren</legend>
   <div>
    <input type="checkbox" id="agb" name="agb">
    <label for="agb">Ich akzeptiere die AGB's</label>
   </div>
    
</form>

    
</body>
</html>