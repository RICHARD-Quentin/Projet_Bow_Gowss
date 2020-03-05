<?php
include("template/setup.php");
include_once('class/connexion.php');
include_once('class/recipes.php');

$bdd = connexion::connexionBdd();
?>

<!DOCTYPE html>

<html lang="fr">
<?php include("template/head.php"); ?>

<body>
<?php include("template/nav.php"); ?>
<?php include("template/hero.php"); ?>

<?php
$id=intval($_GET['id']);

$stmt=$bdd->prepare("SELECT recipe.id, title, content, image, duree, cuisson, persons, isVegan, user_id, nickname, isAdmin FROM recipe INNER JOIN user ON recipe.user_id=user.id WHERE recipe.id=:id");
$stmt->execute(array("id"=>$id));
$list=$stmt->fetchAll(PDO::FETCH_CLASS); ?>


<?php include("template/recipeTemp.php") ?>

<?php include("template/footer.php"); ?>
</body>

</html>