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

        $stmt=$bdd->prepare("SELECT title, content, image, duree, cuisson, persons, isVegan, user_id, nickname, isAdmin FROM recipe INNER JOIN user ON recipe.user_id=user.id WHERE recipe.id=:id");
        $stmt->execute(array("id"=>$id));
        $list=$stmt->fetchAll(PDO::FETCH_CLASS);
        foreach ($list as $lst) {
            // Recup des ingredients de la recette
            $stmt = $bdd->prepare("SELECT * FROM recipeingredient WHERE recipe=:id");
            $stmt->execute(array('id' => $id));
            $ing = $stmt->fetchAll(PDO::FETCH_CLASS);

            // Recup des etapes de la recette
            $stmt = $bdd->prepare("SELECT * FROM recipesteps WHERE recipe=:id");
            $stmt->execute(array('id' => $id));
            $step = $stmt->fetchAll(PDO::FETCH_CLASS);
            ?>
            <!--Header recette-->
            <div class="max-w-3xl w-5/6 rounded overflow-hidden shadow-lg mx-auto my-6">
                <img class="w-full h-64" src="<?php echo $lst->image ?>">
                <div class="px-6 py-4">
                    <div class="mx-auto flex flex-col">
                        <div class="font-bold text-xl mb-2 mx-auto inline-block"><?php echo $lst->title ?></div>
                        <div class="px-6 py-4 mx-auto inline-block">
                            <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2">Nombre de  <?php if ($lst->persons == 1) echo 'personne : ' . $lst->persons; else echo 'personnes : ' . $lst->persons ?></span>
                            <span class="my-1 inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2">Preparation : <?php recipes::timeConvert($lst->duree) ?></span>
                            <span class="my-1 inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2">Cuisson : <?php recipes::timeConvert($lst->cuisson) ?></span>
                        </div>
                    </div>
                    <!--Main de la recette-->
                    <div class="flex">
                        <ul class="text-gray-700 text-base w-1/5">

                            <?php

                            foreach ($ing as $ingr) {
                                echo '<li>' . $ingr->ingredient . ' : ' . $ingr->quantity . '<br>';

                            } ?>
                        </ul>
                        <ul class="w-4/5">
                            <?php
                            $i = 1;
                            foreach ($step as $stp) {
                                echo '<li class="mb-2">Etape ' . $i . ' : ' . $stp->steps . '</li>';
                                $i++;
                            }
                            ?>
                        </ul>
                    </div>
                    <!--Footer de recette-->
                    <div class="w-full relative mt-10">
                        <div class="absolute left-0 bottom-0">
                            <?php if((isset($_SESSION['id_session'], $_SESSION['nickname']) && ($_SESSION['nickname'] === $lst->nickname && $_SESSION['id_session'] === $lst->user_id)) || (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] === 1)) { ?>
                                <a href="updateRecipe.php?id=<?php echo $id ?>">
                                    <button
                                        class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-1 px-2 border border-blue-500 hover:border-transparent rounded">
                                        Modifier
                                    </button>
                                </a>
                            <?php } ?>

                            <?php if(isset($_SESSION['is_admin']) && $_SESSION['is_admin'] === 1) { ?>
                                <a href="traitment/suprRecipe.php?id=<?php echo $id ?>">
                                    <button
                                        class="bg-transparent hover:bg-red-500 text-red-700 font-semibold hover:text-white py-1 px-2 border border-red-500 hover:border-transparent rounded">
                                        Supprimer
                                    </button>
                                </a>
                            <?php } ?>

                        </div>
                        <div class="absolute right-0 bottom-0">
                            <span class="text-gray-600"> Par <?php echo $lst->nickname ?></span>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
        <?php include("template/footer.php"); ?>
        <?php include("template/js.php"); ?>
    </body>
</html>