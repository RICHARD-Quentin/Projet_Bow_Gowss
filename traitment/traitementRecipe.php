<?php

include_once ('../class/recipes.php');
include_once ('../class/connexion.php');

$classe = new recipes;

$title=$_POST['title'];
$duree=$_POST['duree'];

$ingredient=implode('_',$_POST['ing']);
$quantity=implode('_',$_POST['qte']);

if (isset($_POST['isVegan'])){
    $isVegan=1;
}
else {
    $isVegan=0;
}
$path="..\\";
$recipeImage=$_FILES['myImage'];
$recipeImagePath= recipes::image($path,$recipeImage);

$persons=$_POST['persons'];
$content=$_POST['content'];
#$id=$_SESSION['id'];
$user_id=1;

recipes::register($title, $content, $duree , $recipeImagePath, $persons, $isVegan, $user_id, $ingredient, $quantity);

