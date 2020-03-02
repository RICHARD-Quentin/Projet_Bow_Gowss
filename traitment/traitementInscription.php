<?php
try {
        $bdd = new PDO('mysql:host=localhost;dbname=recipedb;charset=utf8', 'root', '',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }catch(Exception $e){
        die('Erreur : ' .$e->getMessage());
    }

$id_inscription = ($_POST['idInscription']);
$email_inscription = $_POST['emailInscription'];

//hachage du MDP
$pass_hash = password_hash($_POST['passInscription'], PASSWORD_DEFAULT);

//insertion
$req = $bdd->prepare('INSERT INTO user(nickname, password, email) VALUES(:id_inscription, :pass_inscription, :email_inscription)');

$req->execute([
    'id_inscription' => $id_inscription,
    'pass_inscription' => $pass_hash,
    'email_inscription' => $email_inscription
]);
$req->debugDumpParams();

header('location: ../index.php');
