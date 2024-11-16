<?php 

// Konfiguration - Session
define('SESSIONCOOKIE_NAME', md5('guetzli')); // eigener Name für Sessioncookie
define('SESSION_LIFETIME', 15); // login zeit wenn inaktiv in Minuten -> 15 Minuten


// Konfiguration - Datenbank

define('DBSERVER', 'localhost');
define('DBNAME', 'portfolio_jb');
define('DBUSER', 'root');
define('DBPASSWORD', 'root');


?>