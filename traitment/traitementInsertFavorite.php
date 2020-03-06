<?php
include_once('../class/connexion.php');

$bdd = connexion::connexionBdd();

// Recuperation des valeurs
$user=$_POST['user'];
$recipe=$_POST['recipe'];

// Requete d'inscrption dans la base
$insertFavorite=$bdd->prepare("INSERT INTO favorite (recipe,user) VALUES (:recipe, :user)");
$insertFavorite->execute(array(
    "user"=>$user,
    "recipe"=>$recipe
));
