<?php
include_once('class/recipes.php');
include_once('class/connexion.php');
$bdd = connexion::connexionBdd();

$id=intval($_GET['id']);

$content=$bdd->prepare("SELECT recipe.id, title, content, image, duree, cuisson, persons, user_id, nickname, isAdmin FROM recipe INNER JOIN user ON recipe.user_id=user.id WHERE recipe.id=:id");
$content->execute(array("id"=>$id));

$ing=$bdd->prepare("SELECT * FROM recipeingredient WHERE recipe=:id");
$ing->execute(array("id"=>$id));

$step=$bdd->prepare("SELECT * FROM recipesteps WHERE recipe=:id");
$step->execute(array("id"=>$id));

$cont=$content->fetch(PDO::FETCH_ASSOC);
$ingredients=$ing->fetchAll(PDO::FETCH_CLASS);
$stps=$step->fetchAll(PDO::FETCH_CLASS);

include("template/setup.php");
include_once('class/connexion.php');
$bdd = connexion::connexionBdd();
?>

<!DOCTYPE html>

<html lang="fr">
<?php include("template/head.php"); ?>

<body>
<?php include("template/nav.php"); ?>
<?php include("template/hero.php"); ?>
<?php if(isset($_SESSION['id_session'],$_SESSION['nickname'])) {
    if($_SESSION['id_session']==$cont['user_id'] || $_SESSION['is_admin']==1) {

?>
<main>
    <!-- Formulaire d'inscription de recette -->
    <form action= "traitment/traitementUpdateRecipe.php" enctype="multipart/form-data" method="post" class="flex w-full">
        <div class="mx-auto border-gray-500 px-1 w-11/12 lg:w-2/3 flex-col shadow-lg my-6 rounded">
            <input type="hidden" value="<?php echo $id;?>" name=id>
            <div class="w-full inline-block mx-auto">
                <div class="mb-2">
                    <label class="inline-block w-1/3 ">Titre</label>
                    <input type="text" name="title" class="w-1/2 border rounded border-gray-500" value="<?php echo $cont['title']; ?>">
                </div>
                <div  class="mb-2">
                    <label class="inline-block w-1/3 ">Durée de preparation</label>
                    <input type="number" min="0" name="duree" class="w-1/2 border rounded border-gray-500" value=<?php echo ($cont['duree']); ?>>
                </div>
                <div  class="mb-2">
                    <label class="inline-block w-1/3 ">Durée de cuisson</label>
                    <input type="number" min="0" name="cuisson" class="w-1/2 border rounded border-gray-500" value=<?php echo ($cont['cuisson']); ?>>
                </div>
                <div  class="mb-2">
                    <label class="inline-block w-1/3 ">Nombre de personnes</label>
                    <input type="number" min="0" name="persons" class="w-1/2 border rounded border-gray-500 w-12 text-center" value=<?php echo $cont['persons']; ?>>
                </div>
                <div  class="mb-2">
                    <label class="inline-block w-1/3">Contenu</label>
                    <textarea name="content" class="w-1/2 border rounded border-gray-500" ><?php echo $cont['content']; ?></textarea>
                </div>
            </div>
            <!--// Formulaire d'ajout d'ingredients-->
            <div id="ing" class="w-full inline-block text-center mb-5">
                <label>Ingredients</label><br>
                <ul id="ingredientList" class="mb-2">
                    <?php foreach ($ingredients as $ingredient){ ?>
                    <div class="">
                        <input class="ingId" type="hidden" value="<?php echo $ingredient->id ?>" name="ingId[]">
                        <li class="ingredient inline-block relative list-none flex flex-col border-b border-gray-400 md:flex-row w-2/3 mx-auto">
                            <div class="inline-block md:w-1/3 flex flex-col mx-1">
                                <label>Ingredient :</label>
                                <input type="text" class="ing border border-gray-500" value='<?php echo $ingredient->ingredient ?>' name="ing[]">
                            </div>
                            <div class="inline-block md:w-1/3 flex flex-col mx-1">
                                <label for="">Qté</label>
                                <input type="text" class="qte border border-gray-500" value="<?php if ((int)$ingredient->quantity!=0) echo (int)$ingredient->quantity ?>" name="qte[]">
                            </div>
                            <div class="inline-block flex flex-col md:w-1/6 mx-1">
                                <label>Unité :</label>
                                <select class="unit inline-block border border-gray-500 align-bottom mb-1" name="unit[]" value="<?php echo $ingredient->unity ?>">
                                    <option value=" ">unité</option>
                                    <option value="g">g</option>
                                    <option value="cl">cl</option>
                                </select>
                            </div>
                                <span class="removeButton absolute right-0 top-0 md:inset-y-auto">
                                    <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Supprimer</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                                </span>
                        </li>
                    </div>
                    <?php } ?>
                </ul>
                <span id="addIngredientButton" class="border border-gray-500 rounded bg-gray-300 mb-3 p-1">Ajouter un ingredient</span>
            </div>

            <!--Formulaire d'ajout d'etapes-->
            <div class="flex flex-col">
                <div id="stp" class="w-full inline-block text-center mb-5">
                    <label>Etapes</label><br>
                    <ul id="stepList" class="mb-2">
                        <?php $i=1;
                        foreach ($stps as $stp){ ?>
                        <div>
                            <input class="stepId" type="hidden" value="<?php echo $stp->id ?>" name="stepId[]">
                            <li class="step list-none flex flex-row md:w-2/3 inline-block mx-auto relative">
                                <div class="h-auto my-2">
                                    <label class="inline-block m-auto align-middle">Etape <span class="i"><?php echo $i; $i++ ?></span> : </label><textarea type="text" required class="step border border-gray-500 align-middle w-5/6" cols="100" name="step[]"><?php echo $stp->steps ?></textarea>
                                </div>
                                <div class="removeButton absolute right-0">
                                    <svg  class="align-bottom m-auto fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Supprimer</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                                </div>
                            </li>
                        </div>
                        <?php } ?>

                    </ul>
                    <span id="addStepButton" class="border border-gray-500 rounded bg-gray-300 p-1">Ajouter une étape</span>

                </div>
                <input type="submit" name="submit" value="Envoyer" class="inline-block">
            </div>
        </div>
    </form>
</main>
<?php     }else{
        echo "Vous n'êtes pas l'auteur de cette recette !";
    }
}else{
    echo "Vous n'êtes pas connecté";
} ?>
<?php include("js/buttonAddIngredientSteps.js") ?>