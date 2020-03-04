<?php
include_once('../class/connexion.php');

$bdd = connexion::connexionBdd();

$user=$_POST['user'];
$recipe=$_POST['recipe'];

$insertFavorite=$bdd->prepare("INSERT INTO favorite (recipe,user) VALUES (:recipe, :user)");
$insertFavorite->execute(array(
    "user"=>$user,
    "recipe"=>$recipe
));