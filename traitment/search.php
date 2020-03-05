<?php

include_once('../class/connexion.php');
include_once('../class/recipes.php');

$bdd = connexion::connexionBdd();

$term=$_POST['search'];

$req=$bdd->prepare("SELECT * FROM recipe WHERE title LIKE :term");
$req->execute(array(
   'term'=>'%'.$term.'%'
));
$req->fetchAll();
