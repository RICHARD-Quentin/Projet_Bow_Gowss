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
<?php if(isset($_SESSION['id_session'],$_SESSION['nickname'])) {


    ?>
<main>
    <!-- Formulaire d'inscription de recette -->
    <form action= "traitment/traitementRecipe.php" enctype="multipart/form-data" method="post" class="flex w-full">
        <div class="mx-auto border-gray-500 w-11/12 lg:w-2/3 flex-col shadow-lg my-6 rounded">
            <div class="w-full inline-block mx-auto">
                <div class="mb-2">
                    <label class="inline-block text-center w-1/3 ">Titre</label>
                    <input type="text" required name="title" class="w-1/2 border rounded border-gray-500">
                </div>
                <div class="mb-2">
                    <label class="inline-block text-center w-1/3 ">Image</label>
                    <input type="file" required name="myImage" class="w-1/2 border rounded border-gray-500">
                </div>
                <div  class="mb-2">
                    <label class="inline-block text-center w-1/3 ">Durée de preparation ( en minutes )</label>
                    <input type="number" required min="0" name="duree" class="w-1/2 border rounded border-gray-500">
                </div>
                <div  class="mb-2">
                    <label class="inline-block text-center w-1/3 ">Durée de cuisson ( en minutes )</label>
                    <input type="number" min="0" name="cuisson" class="w-1/2 border rounded border-gray-500">
                </div>
                <div  class="mb-2">
                    <label class="inline-block text-center w-1/3 ">Nombre de personnes</label>
                    <input type="number" required min="0" name="persons" class="w-1/2 border rounded border-gray-500 w-12 text-center">
                </div>
                <div  class=" mb-2">
                    <label class="inline-block text-center align-middle w-1/3">Description</label>
                    <textarea name="content" required class="w-1/2 border rounded border-gray-500"></textarea>
                </div>
            </div>
            <!--// Formulaire d'ajout d'ingredients-->
            <div id="ing" class="w-full inline-block text-center mb-5">
                <label>Ingredients</label><br>
                <ul id="ingredientList" class="mb-2">
                </ul>
                <span id="addIngredientButton" class="border border-gray-500 rounded bg-gray-300 mb-3 p-1">Ajouter un ingredient</span>

            </div>

            <!--Formulaire d'ajout d'etapes-->
            <div class="flex flex-col">
                <div id="stp" class="w-full inline-block text-center mb-5">
                    <label>Etapes</label><br>
                    <ul id="stepList" class="mb-2">
                    </ul>
                    <span id="addStepButton" class="border border-gray-500 rounded bg-gray-300 p-1">Ajouter une étape</span>

                </div>
                <input type="submit" name="submit" value="Envoyer" class="inline-block">
            </div>
        </div>
    </form>
</main>

<?php }
else{?>
<p>Vous n'êtes pas connecté, vous ne pouvez pas envoyer de recette</p>
<?php } ?>
<?php include("template/footer.php"); ?>
<?php include("js/buttonAddIngredientSteps.js") ?>
</body>

</html>
