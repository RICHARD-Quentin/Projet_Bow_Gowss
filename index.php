<?php
include("template/setup.php");
include_once ('class/connexion.php');
include_once ('class/recipes.php');

$bdd = connexion::connexionBdd();
?>

<!DOCTYPE html>

<html lang="fr">
<?php include("template/head.php"); ?>

<body  class="min-h-screen">
<?php include("template/nav.php"); ?>
<?php include("template/hero.php"); ?>

<?php include("template/mentionsLegales.php"); ?>

<?php include("formConnexion.php"); ?>
<?php include("formInscription.php"); ?>
<main>
<div class="flex flex-row flex-wrap w-11/12 mx-auto my-4">

<?php include("src/formSendMail.php"); ?>

<?php
$stmt=$bdd->query("SELECT recipe.id, title, content, image, duree, cuisson, persons, isVegan, user_id, nickname, isAdmin FROM recipe INNER JOIN user ON recipe.user_id=user.id");
$list=$stmt->fetchAll(PDO::FETCH_CLASS);

    foreach ($list as $lst)
    {
?>
            <div class="mx-4 inline-block w-1/3 max-w-sm rounded overflow-hidden shadow-lg hover:shadow-2xl ">
                <a href="recipeTemplate.php?id=<?php echo $lst->id ?>">
                    <img class="w-full h-64" src="<?php echo $lst->image ?>" alt="Sunset in the mountains">
                    <div class="px-6 py-4">
                        <div class="font-bold text-xl mb-2"><?php echo $lst->title ?></div>
                        <p>Par <?php echo $lst->nickname ?></p>
                        <p class="text-gray-700 text-base">
                            <?php echo $lst->content;?>
                        </p>
                    </div>
                    <div class="px-6 py-4">
                        <span class="my-1 mx-auto inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2">Nombre de  <?php if($lst->persons==1) echo 'personne : '. $lst->persons; else echo 'personnes : '. $lst->persons ?></span>
                        <span class="my-1 inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2">Preparation : <?php echo recipes::timeConvert($lst->duree);?></span>
                        <span class="my-1 inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2">Cuisson : <?php echo recipes::timeConvert($lst->cuisson);?></span>
                    </div>
                </a>
            </div>
<?php } ?>
</div>
</main>
<?php include("template/footer.php"); ?>

</body>


</html>
