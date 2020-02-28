<?php

try {
        $bdd = new PDO('mysql:host=localhost;dbname=recipedb;charset=utf8', 'root', '',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }catch(Exception $e){
        die('Erreur : ' .$e->getMessage());
    }

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
