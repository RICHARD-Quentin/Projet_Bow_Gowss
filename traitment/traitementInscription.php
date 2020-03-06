<?php
//fonction pour sécuriser les données utilisateurs coté serveur
function valid_donnees($donnees){
    $donnees = trim($donnees);
    $donnees = stripslashes($donnees);
    $donnees = htmlspecialchars($donnees);
    return $donnees;
}
$id_inscription = valid_donnees($_POST['idInscription']);
$email_inscription = valid_donnees($_POST['emailInscription']);
$pass_inscription = valid_donnees($_POST['passInscription']);

//hachage du MDP
$pass_hash = password_hash($pass_inscription, PASSWORD_DEFAULT);

/*Si les champs prenom et mail ne sont pas vides et si les donnees ont
 *bien la forme attendue...*/
if (!empty($id_inscription)
    && strlen($pass_inscription) >= 5
    && strlen($id_inscription) <= 20
    && strlen($pass_inscription) >= 5
    && preg_match("/^([a-zA-Z ]+)$/",$id_inscription)
    && !empty($email_inscription)
    && filter_var($email_inscription, FILTER_VALIDATE_EMAIL)){

    try {
        $bdd = new PDO('mysql:host=localhost;dbname=recipedb;charset=utf8', 'root', '',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

        //On insère les données reçues
        $req = $bdd->prepare('INSERT INTO user(nickname, password, email) VALUES(:id_inscription, :pass_inscription, :email_inscription)');

        $req->execute([
            'id_inscription' => $id_inscription,
            'pass_inscription' => $pass_hash,
            'email_inscription' => $email_inscription
        ]);

        header('location: ../index.php');

    }catch(Exception $e){
        die('Erreur : ' .$e->getMessage());
    }
}else{
    header("Location:../index.php");
}
