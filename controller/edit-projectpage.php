<?php 

require_once('config.php');
require_once ('class/Auth.class.php');

// Prüfen ob User eingeloggt ist anhand von CheckLogIn-Methode von Auth.class.php
Auth::checkLogIn(); 

?>