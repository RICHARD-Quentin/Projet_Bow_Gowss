<?php
session_start();
// Suppression des variables de session et de la session
$_SESSION = array();
session_unset();
session_destroy();

echo "session destroy";

header('Location: ../index.php');

?>