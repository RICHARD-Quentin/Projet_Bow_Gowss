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

<?php include("template/mentionsLegales.php"); ?>

<?php include("formConnexion.php"); ?>
<?php include("formInscription.php"); ?>

<main>
<div class="flex flex-row flex-wrap w-11/12 mx-auto my-4 min-h-screen">

<?php include("src/formSendMail.php"); ?>

<?php
$stmt=$bdd->prepare("SELECT recipe.id, title, content, image, duree, cuisson, persons, isVegan, user_id, nickname FROM recipe INNER JOIN favorite ON recipe.id = favorite.recipe INNER JOIN user ON recipe.user_id = user.id WHERE favorite.user = :user_id");
$stmt->execute(array('user_id'=>$_SESSION['id_session']));
$list=$stmt->fetchAll(PDO::FETCH_CLASS);




    foreach ($list as $lst)
    {
        $id=$lst->id;
        //Test favorite
        $fav= $bdd->prepare("SELECT * FROM favorite WHERE user=:user && recipe=:recipe");
        $fav->execute(array("recipe"=>$id,
            "user"=>$_SESSION['id_session']
        ));
        $isFavorite=$fav->fetch(PDO::FETCH_BOUND);
        if($isFavorite){
            $isFavoriteClass="true text-red-600 hover:text-gray-400";
        }
        else{
            $isFavoriteClass="false text-gray-400 hover:text-red-600";
        }
?>
        <div class="mx-4 inline-block mb-2 md:w-1/2 lg:w-1/3 max-w-sm rounded overflow-hidden shadow-lg hover:shadow-2xl">
            <a href="recipeTemplate.php?id=<?php echo $lst->id ?>">
                <img class="w-full h-64" src="<?php echo $lst->image ?>" alt="Sunset in the mountains">
                <div class="px-6 py-4 relative">
                    <i id="fav" class="<?php echo $isFavoriteClass ?> fa-lg fas fa-heart absolute right-0 m-1"><input class="recipe" type="hidden" value="<?php echo $id ?>"><input class="user" type="hidden" value="<?php echo $_SESSION['id_session'] ?>"></i>
                    <div class="font-bold text-xl mb-2"><?php echo $lst->title ?></div>
                    <p>Par <?php echo $lst->nickname ?></p>
                    <p class="text-gray-700 text-base">
                        <?php echo $lst->content;?>
                    </p>
                </div>
                <div class="px-6 py-4">
                    <span class="my-1 mx-auto    inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2">Nombre de  <?php if($lst->persons==1) echo 'personne : '. $lst->persons; else echo 'personnes : '. $lst->persons ?></span>
                    <span class="my-1 inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2">Preparation : <?php $timePrep=$lst->duree; $hPrep=intdiv($timePrep,60); $minPrep=$timePrep%60; if($hPrep!=0) echo $hPrep.'h'.$minPrep.'min'; else echo $minPrep . 'min'?></span>
                    <span class="my-1 inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2">Cuisson : <?php $timeCui=$lst->cuisson; $hCui=intdiv($timeCui,60); $minCui=$timeCui%60;  if($hCui!=0) echo $hCui.'h'.$minCui.'min'; else echo $minCui . 'min' ?></span>
                </div>
            </a>
        </div>

<?php } ?>
</div>
</main>
<?php include("template/footer.php"); ?>
<?php include("template/js.php"); ?>

</body>


</html>
