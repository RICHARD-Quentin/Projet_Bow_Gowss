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
<div class="min-h-screen w-full flex">
    <div class="flex flex-row flex-wrap w-11/12 mx-auto my-4">

    <?php include("src/formSendMail.php"); ?>

    <?php
    $stmt=$bdd->prepare("SELECT recipe.id, title, content, image, duree, cuisson, persons, user_id, nickname FROM recipe INNER JOIN favorite ON recipe.id = favorite.recipe INNER JOIN user ON recipe.user_id = user.id WHERE favorite.user = :user_id");
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
            <div class="mx-4 inline-block mb-2 md:w-1/2 lg:w-1/3 max-w-sm rounded relative overflow-hidden shadow-lg hover:shadow-2xl">
                <i id="fav" class="<?php echo $isFavoriteClass ?> fa-lg fas fa-heart absolute right-0 m-4"><input class="recipe" type="hidden" value="<?php echo $id ?>"><input class="user" type="hidden" value="<?php echo $_SESSION['id_session'] ?>"></i>
                <a href="recipeTemplate.php?id=<?php echo $lst->id ?>">
                    <img class="w-full h-64" src="<?php echo $lst->image ?>" alt="Sunset in the mountains">
                    <div class="px-6 py-4 relative">
                        <div class="font-bold text-xl mb-2"><?php echo $lst->title ?></div>
                        <p>Par <?php echo $lst->nickname ?></p>
                        <p class="text-gray-700 text-base">
                            <?php echo $lst->content;?>
                        </p>
                    </div>
                    <div class="px-1 py-4 flex flex-col mx-auto">
                        <span class="my-1 w-3/4 mx-auto text-center inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700">Nombre de  <?php if($lst->persons==1) echo 'personne : '. $lst->persons; else echo 'personnes : '. $lst->persons ?></span>
                        <span class="my-1 w-3/4 mx-auto text-center inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700">Preparation : <?php echo recipes::timeConvert($lst->duree);?></span>
                        <span class="my-1 w-3/4 mx-auto text-center inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700">Cuisson : <?php echo recipes::timeConvert($lst->cuisson);?></span>
                    </div>
                </a>
            </div>

    <?php } ?>
    </div>
</div>
</main>
<?php include("template/footer.php"); ?>

<script>
    $(document).on('click','#fav',function(){
        if($(this).hasClass("false")){
            $(this).removeClass("false text-gray-400 hover:text-red-600").addClass("true text-red-600 hover:text-gray-400")
            var user=$(this).children('input.user').val();
            var recipe=$(this).children('input.recipe').val();
            console.log(user,recipe);

            $.ajax({
                url:'traitment/traitementInsertFavorite.php',
                method:'POST',
                data:{
                    user:user,
                    recipe:recipe
                }
            })

        }
        else if($(this).hasClass("true")){
            $(this).removeClass("true text-red-600 hover:text-gray-400").addClass("false text-gray-400 hover:text-red-600")
            var user=$(this).children('input.user').val();
            var recipe=$(this).children('input.recipe').val();
            console.log(user,recipe);
            $.ajax({
                url:'traitment/traitementDeleteFavorite.php',
                method:'POST',
                data:{
                    user:user,
                    recipe:recipe
                }
            })
        }
    })
</script>

</body>


</html>
