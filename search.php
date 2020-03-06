<?php

include_once('../class/recipes.php');
include_once('../src/valid_data.php');

$term=valid_data($_POST['search']);

    $bdd = connexion::connexionBdd();

    $req=$bdd->prepare("SELECT recipe.id, title, content, image, duree, cuisson, persons, user_id, nickname, isAdmin FROM recipe INNER JOIN user ON recipe.user_id=user.id WHERE title LIKE :term");
    $req->execute(array(
        'term'=>'%'.$term.'%'
    ));

    $list=$req->fetchAll(PDO::FETCH_CLASS);


include("template/setup.php");
include_once ('class/connexion.php');
include_once('class/recipes.php');

?>

<!DOCTYPE html>

<html lang="fr">
<?php include("template/head.php"); ?>

<body>
<?php include("template/nav.php"); ?>
<?php include("template/hero.php"); ?>

<?php
?>

<ul id="result-search">

</ul>
    <?php include("template/recipeTemp.php") ?>


<?php include("template/footer.php"); ?>
<?php  ?>
<script>
$(document).ready(function(){
    $('#search').keyup(function(){
        var search=$('#search').val();
        console.log(search);
        $.ajax({
            url:'traitment/search.php',
            type:'POST',
            data:{
                search:search,
            },
            success: function(data) {
                console.log(data);
                if (data != "") {
                    $('#result-search').append("<?php include("template/recipeTemp.php") ?>");
                } else {
                    $('#result-search').html("<div style='font-size: 20px; text-align: center; margin-top: 10px'>Aucun utilisateur</div>")
                }
            }
        })
    })
})
</script>
<script src="https://code.jquery.com/jquery-3.4.1.js"></script>

</body>


</html>