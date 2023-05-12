<?php
session_start();
session_destroy();

// Rediriger vers la page d'accueil ou une autre page
header("Location: index.php");
exit();
?>