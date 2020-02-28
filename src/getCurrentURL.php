<?php
require "../template/setup.php";


function getCurrentURL()
{
    $protocol = strpos(strtolower($_SERVER['SERVER_PROTOCOL']),'https') === FALSE ? 'http' : 'https';

    $host = $_SERVER['HTTP_HOST'];

    $script = $_SERVER['SCRIPT_NAME'];

    $params = $_SERVER['QUERY_STRING'];


    $lien = $protocol . '://' . $host . $script . '?' . $params;
    return $lien;
}

getCurrentURL();

?>