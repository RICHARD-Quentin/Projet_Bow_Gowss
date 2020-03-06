<?php

try {
    $bdd = new PDO('mysql:host=localhost;dbname=recipedb;charset=utf8', 'root', '',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}catch(Exception $e){
    die('Erreur : ' .$e->getMessage());
}

//fonction pour sécuriser les données utilisateurs coté serveur
function valid_donnees($donnees){
    $donnees = trim($donnees);
    $donnees = stripslashes($donnees);
    $donnees = htmlspecialchars($donnees);
    return $donnees;
}

$emailConnexionPost = valid_donnees($_POST['emailConnexion']);
$passConnexionPost= valid_donnees($_POST['passConnexion']);

//  Récupération de l'utilisateur et de son pass hashé
$req = $bdd->prepare('SELECT * FROM user WHERE email = :email');


$req->execute(array(
    'email' => $emailConnexionPost));

$resultat = $req->fetch();
$nickname = $resultat['nickname'];

// Comparaison du pass envoyé via le formulaire avec la base
$isPasswordCorrect = password_verify($passConnexionPost, $resultat['password']);


//  Récupération ID admin ou non de l'utilisateur

$isAdmin = $resultat['isAdmin'];




if (!$resultat)
{
    echo 'Mauvais identifiant ou mot de passe !';

}
else
{
    if ($isPasswordCorrect) {
        session_start();
        $_SESSION['nickname'] = $nickname;
        $_SESSION['id_session'] = $resultat['id'];
        $_SESSION['is_admin'] = $isAdmin;
        header('Location: ../index.php');
    }
    else {
        echo '<p>Mauvais identifiant ou mot de passe !</p>
        <a href="../index.php" class="block mt-4 lg:inline-block lg:mt-0 text-teal-200 hover:text-white mr-4">OK</a>';
    }
}


$req->closeCursor();
?>