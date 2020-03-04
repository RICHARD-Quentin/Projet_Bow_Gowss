<?php
include("template/setup.php");
include_once ('class/connexion.php');
$bdd = connexion::connexionBdd();
?>

<!DOCTYPE html>

<html lang="fr">
<?php include("template/head.php"); ?>

<body>
<?php include("template/nav.php"); ?>
<?php include("template/hero.php"); ?>

<?php

if (isset($_SESSION['is_admin']) AND ($_SESSION['is_admin'] == 1)){

    $reponse= $bdd->query('SELECT COUNT(*) AS nbr_inscrit FROM user');
    $nbr_inscrit = $reponse->fetchColumn();

    $reponse= $bdd->query('SELECT COUNT(*) AS nbr_admin FROM user WHERE isAdmin = 1');
    $nbr_admin = $reponse->fetchColumn();

    $reponse= $bdd->query('SELECT COUNT(*) AS nbr_inscrit FROM recipe');
    $nbr_recette = $reponse->fetchColumn();

    echo "<div class= \"items-center justify-between bg-green-400 p-6 \">
<p><i class=\"fas fa-users fa-fw mr-1\"></i>Nbr d'utilisateurs inscrits " . $nbr_inscrit. "</p>
<p><i class=\"fas fa-user-tie fa-fw mr-1\"></i>Nbr d'administrateurs " . $nbr_admin. "</p>
<p><i class=\"fas fa-user-check fa-fw mr-1\"></i>Nbr d'utilisateurs connecté</p>
<p><i class=\"fas fa-book fa-fw mr-1\"></i>Nbr total de recettes postés " . $nbr_recette. "</p>
<p><i class=\"fas fa-book-medical fa-fw mr-1\"></i>Nbr total de recettes à approuver</p>
</div>";
}
?>

<?php include("template/mentionsLegales.php"); ?>

<?php include("formConnexion.php"); ?>
<?php include("formInscription.php"); ?>
<?php include("src/formSendMail.php"); ?>


<?php include("template/footer.php"); ?>
<?php include("template/js.php"); ?>

</body>


</html>


