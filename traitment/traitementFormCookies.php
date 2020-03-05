<?php

if (isset($_POST['cookies'])) {
    $temps = 365*24*3600;
    setcookie ("accord", $_POST['cookies'], time() + $temps);
}

header('Location: ../index.php');

?>