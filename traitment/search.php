<?php

include_once('../class/connexion.php');
include_once('../class/recipes.php');

$bdd = connexion::connexionBdd();

$term=$_POST['name'];

$req=$bdd->prepare("SELECT * FROM recipeingredient WHERE ingredient LIKE :term");
$req->execute(array(
   'term'=>'%'.$term.'%'
));
return $req->fetchAll();
