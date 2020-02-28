<?php
include_once ('../class/connexion.php');
$bdd = connexion::connexionBdd();

$id_connexion = ($_POST['idConnexion']);
$email_connexion = $_POST['emailConnexion'];

//hachage du MDP
$pass_hash = password_hash($_POST['passConnexion'], PASSWORD_DEFAULT);

//insertion
$req = $bdd->prepare('INSERT INTO user(nickname, password, email) VALUES(:id_connexion, :pass_connexion, :email_connexion)');

$req->execute([
    'id_connexion' => $id_connexion,
    'pass_connexion' => $pass_hash,
    'email_connexion' => $email_connexion
]);
$req->debugDumpParams();

header('location: ../index.php');
