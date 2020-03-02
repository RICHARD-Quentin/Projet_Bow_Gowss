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

$stmt=$bdd->query("SELECT * FROM recipe");
$list=$stmt->fetchAll(PDO::FETCH_CLASS);

foreach ($list as $lst) {
    // Recup des ingredients de la recette
    $stmt=$bdd->prepare("SELECT * FROM recipeingredient WHERE recipe=:id");
    $stmt->execute(array('id'=>$lst->id));
    $ing=$stmt->fetchAll(PDO::FETCH_CLASS);

    // Recup des etapes de la recette
    $stmt=$bdd->prepare("SELECT * FROM recipesteps WHERE recipe=:id");
    $stmt->execute(array('id'=>$lst->id));
    $step=$stmt->fetchAll(PDO::FETCH_CLASS);
    ?>
    <div class="max-w-sm rounded overflow-hidden shadow-lg">
        <img class="w-full" src="<?php echo $lst->image ?>" alt="Sunset in the mountains">
        <div class="px-6 py-4">
            <div class="font-bold text-xl mb-2"><?php echo $lst->title ?></div>
            <div>
            <p class="text-gray-700 text-base w-2/5">

            <?php

                foreach ($ing as $ingr){
                    echo $ingr->ingredient . ' : ' . $ingr->quantity . '<br>';

                } ?>
            </p>
                <ul class="w-2/5">
                    <?php
                    $i=1;
                    foreach ($step as $stp) {
                        echo '<li>Etape ' . $i . ' : ' . $stp->steps . '</li>';
                        $i++;
                    }
                    ?>
                </ul>
            </div>
        </div>
        <div class="px-6 py-4">
            <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2">Durée :<?php echo $lst->duree ?>h</span>
            <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2">Nombre de personnes :<?php echo $lst->cuisson ?>h</span>
            <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2">Nombre de personnes :<?php echo $lst->persons ?></span>

        </div>
    </div>
<?php } ?>
<?php include("template/footer.php"); ?>
<?php include("template/js.php"); ?>

</body>


</html>
