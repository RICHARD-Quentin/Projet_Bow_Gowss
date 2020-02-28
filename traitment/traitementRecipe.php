<?php

include_once ('../class/recipes.php');
$classe = new recipes;

$title=$_POST['title'];
$duree=$_POST['duree'];
$image=1; /*$_POST['image'];*/

if (isset($_POST['isVegan'])){
    $isVegan=1;
}
else {
    $isVegan=0;
}

$path=__DIR__;
$recipeImage=$_FILES['image'];
$recipeImagePath= recipes::image($path,$recipeImage);

$persons=$_POST['persons'];
$content=$_POST['content'];
#$id=$_SESSION['id'];
$user_id=1;


$classe->register($title, $content, $duree , $recipeImagePath, $persons, $isVegan, $user_id);