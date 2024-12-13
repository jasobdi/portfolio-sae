<?php
// Logout Script

// Start der Session, falls noch nicht geschehen
session_start();

// Alle Session-Daten löschen
session_unset();

// Session vollständig zerstören
session_destroy();

// Umleiten zum Login
header("Location: ../view/login.php");
exit(); // Script abbrechen
?>
