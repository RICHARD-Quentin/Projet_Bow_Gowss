<?php
session_start();

include_once ('../class/recipes.php');
include_once ('../class/connexion.php');

$classe = new recipes;


// Recuperation des valeurs du formulaire
$title=$_POST['title'];
$duree=$_POST['duree'];
$cuisson=$_POST['cuisson'];

$ingredient=$_POST['ing'];
$quantity=$_POST['qte'];
$unit=$_POST['unit'];

$ingredients=array_combine($ingredient,$quantity+$unit);

$step=$_POST['step'];

if (isset($_POST['isVegan'])){
    $isVegan=1;
}
else {
    $isVegan=0;
}
// Gestion du chemin de l'image

$path="..\\";
$recipeImage=$_FILES['myImage'];
$recipeImagePath= recipes::image($path,$recipeImage);

$persons=$_POST['persons'];
$content=$_POST['content'];
$user_id=1;
/*$_SESSION['id_session'];*/


if(isset($title, $content, $duree, $cuisson, $recipeImagePath, $persons, $isVegan, $user_id, $ingredients, $step)) {
recipes::register($title, $content, $duree, $cuisson, $recipeImagePath, $persons, $isVegan, $user_id, $ingredients, $step);
}
else{

}
