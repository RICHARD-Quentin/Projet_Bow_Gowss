<?php
include("template/setup.php");
include_once ('class/connexion.php');
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

$stmt=$bdd->query("SELECT recipe.id, title, content, image, duree, cuisson, persons, user_id, nickname, isAdmin FROM recipe INNER JOIN user ON recipe.user_id=user.id");
$list=$stmt->fetchAll(PDO::FETCH_CLASS);
?>
<form action="search.php" method="post" class="flex">
    <div class="inline-block w-1/2 mx-auto my-2 relative">
        <input name="search" type="text" id="search" class="p-1 border border-gray-500 relative w-full" placeholder="Rechercher une recette">
        <button class="absolute right-0 top-0 bottom-0"><i class="fas fa-search hover:text-green-500 p-1"></i></button>
    </div>
</form>

    <?php include("template/recipeTemp.php") ?>


<?php include("template/footer.php"); ?>


<script src="https://code.jquery.com/jquery-3.4.1.js"></script>

</body>


</html>
