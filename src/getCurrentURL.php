<?php



function getCurrentURL()
{
    $protocol = strpos(strtolower($_SERVER['SERVER_PROTOCOL']),'https') === FALSE ? 'http' : 'https';   //strpos: cherche 1ere occurence d'une chaine. strtolower: transforme chaine en minuscule.

    $host = $_SERVER['HTTP_HOST'];

    $script = $_SERVER['SCRIPT_NAME'];

    $params = $_SERVER['QUERY_STRING'];


    $lien = $protocol . '://' . $host . $script . '?' . $params;
    return $lien;
}

getCurrentURL();
?>