<?php
session_start();
$accord = true;
setcookie('accord',$accord);

if (!isset($_SESSION['nickname']) AND (!isset($_SESSION['id_session']))){
    if ($accord = true){
        include("formCookies.php");
    }
}





?>
