<?php
//cette page permet à l'utilisateur de se déconnecter mais il ne la visualisera pas 
session_start();
$_SESSION = array();
session_destroy();
header("Location: index.php");
?>
