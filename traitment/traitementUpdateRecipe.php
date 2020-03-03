<?php

include_once ('class/recipes.php');

var_dump($_POST['ing'],$_POST['qte'],$_POST['unit'],$_POST['newIng'],$_POST['newQte'],$_POST['newUnit'],$_POST['delIng'],$_POST['delQte'],$_POST['delUnit']);

$updtIng=$_POST['ing'];
$updtQte=$_POST['qte'];
$updtUnit=$_POST['unit'];



recipes::update($id, $title, $content, $duree, $cuisson, $image, $persons, $isVegan, $user_id, $ingredient, $step);