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

$stmt=$bdd->query("SELECT recipe.id, title, content, image, duree, cuisson, persons, isVegan, user_id, nickname, isAdmin FROM recipe INNER JOIN user ON recipe.user_id=user.id");
$list=$stmt->fetchAll(PDO::FETCH_CLASS);
;?>
<div class="flex my-2">
<input type="text" id="search" class="border border-gray-500 w-1/3 inline-block mx-auto" placeholder="Rechercher une recette">
    <ul>
        <li id="resultResearch">

        </li>
    </ul>
</div>
    <?php include("template/recipeTemp.php") ?>


<?php include("template/footer.php"); ?>
<?php include("template/js.php"); ?>
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
<?php  ?>
<script>
/*    $('#search').keyup(function(){
        var name=$('#search').val();
        console.log(name)
      $.ajax({
            url:'searchList.php',
            method:'POST',
            data:{
                name:name,
            },
            success: $('#resultResearch').append(name)
        })
    })*/
</script>
<script src="https://code.jquery.com/jquery-3.4.1.js"></script>

</body>


</html>
