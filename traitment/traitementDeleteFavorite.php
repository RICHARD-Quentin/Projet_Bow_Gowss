<?php
include_once('../class/connexion.php');

$bdd = connexion::connexionBdd();

$user=$_POST['user'];
$recipe=$_POST['recipe'];

$deleteFavorite=$bdd->prepare("DELETE FROM favorite WHERE user=:user && recipe=:recipe");
$deleteFavorite->execute(array(
    "user"=>$user,
    "recipe"=>$recipe
));
