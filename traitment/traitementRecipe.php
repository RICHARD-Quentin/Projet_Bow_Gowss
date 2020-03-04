<?php
session_start();

include_once ('../class/recipes.php');
include_once ('../class/connexion.php');

$classe = new recipes;


// Recuperation des valeurs du formulaire
$title=$_POST['title'];
$duree=$_POST['duree'];
$cuisson=$_POST['cuisson'];

if(isset($_POST['ing']) && !empty($_POST['ing'])) {


    $ing = $_POST['ing'];
    $qte = $_POST['qte'];
    $unit = $_POST['unit'];

    $i = 0;
    foreach ($ing as $ingredient) {
        $ingredientTable[$i] = [

            'name' => $ingredient,
            'quantity' => $qte[$i],
            'unity' => $unit[$i]
        ];
        $i++;
    }
}else{
    $ingredientTable=null;
}

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
$user_id=$_SESSION['id_session'];


if(isset($title, $content, $duree, $cuisson, $recipeImagePath, $persons, $isVegan, $user_id, $ingredientTable, $step)) {
recipes::register($title, $content, $duree, $cuisson, $recipeImagePath, $persons, $isVegan, $user_id, $ingredientTable, $step);
    header('Location: ../index.php');
}
else{
    echo 'Erreur';
}
