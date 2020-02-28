<?php
try {
    $bdd = new PDO('mysql:host=localhost;dbname=recipedb;charset=utf8', 'root', '',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}catch(Exception $e){
    die('Erreur : ' .$e->getMessage());
}

//  Récupération de l'utilisateur et de son pass hashé
$req = $bdd->prepare('SELECT email, password, nickname, id FROM user WHERE email = :email');

$req->execute(array(
    'email' => $_POST['emailConnexion']));

$resultat = $req->fetch();
$nickname = $resultat['nickname'];

// Comparaison du pass envoyé via le formulaire avec la base
$isPasswordCorrect = password_verify($_POST['passConnexion'], $resultat['password']);

if (!$resultat)
{
    echo 'Mauvais identifiant ou mot de passe !';
}
else
{
    if ($isPasswordCorrect) {
        session_start();
        $_SESSION['nickname'] = $nickname ;
        $_SESSION['id_session'] = $resultat['id'];
        header('Location: ../index.php');
    }
    else {
        echo 'Mauvais identifiant ou mot de passe !';
    }
}

$req->closeCursor();
?>