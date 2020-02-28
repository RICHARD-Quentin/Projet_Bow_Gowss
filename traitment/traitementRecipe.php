<?php

include_once ('../class/recipes.php');
$classe = new recipes;

$title=$_POST['title'];
$duree=$_POST['duree'];
$image=1; /*$_POST['image'];*/
$isVegan=$_POST['isVegan'];
$persons=$_POST['persons'];
$content=$_POST['content'];
#$id=$_SESSION['id'];
$user_id=1;

$classe->register($title, $content, $duree , $image, $persons, $isVegan, $user_id);