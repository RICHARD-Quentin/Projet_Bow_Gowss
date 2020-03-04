<?php
include_once('class/recipes.php');
include_once('class/connexion.php');
$bdd = connexion::connexionBdd();

$id=intval($_GET['id']);

$content=$bdd->prepare("SELECT * FROM recipe WHERE id=:id");
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
<?php #if(isset($_SESSION['id_session'],$_SESSION['nickname'])) {


?>
<main>
    <!-- Formulaire d'inscription de recette -->
    <form action= "traitment/traitementUpdateRecipe.php" enctype="multipart/form-data" method="post" class="flex w-full">
        <div class="mx-auto border-gray-500 w-2/3 flex-col shadow-lg my-6 rounded">
            <input type="hidden" value="<?php echo $id;?>" name=id>
            <div class="w-full inline-block mx-auto">
                <div class="mb-2">
                    <label class="inline-block text-center w-1/3 ">Titre</label>
                    <input type="text" name="title" class="w-1/2 border rounded border-gray-500" value="<?php echo $cont['title']; ?>">
                </div>
                <div class="mb-2">
                    <label class="inline-block text-center w-1/3 ">Image</label>
                    <input type="file" name="myImage" class="w-1/2 border rounded border-gray-500" value="<?php echo $cont['image']; ?>">
                </div>
                <div  class="mb-2">
                    <label class="inline-block text-center w-1/3 ">Durée de preparation</label>
                    <input type="number" min="0" name="duree" class="w-1/2 border rounded border-gray-500" value=<?php echo ($cont['duree']); ?>>
                </div>
                <div  class="mb-2">
                    <label class="inline-block text-center w-1/3 ">Durée de cuisson</label>
                    <input type="number" min="0" name="cuisson" class="w-1/2 border rounded border-gray-500" value=<?php echo ($cont['cuisson']); ?>>
                </div>
                <div  class="mb-2">
                    <label class="inline-block text-center w-1/3 ">Vegan</label>
                    <input type="checkbox" name="isVegan" class="w-1/2 border rounded border-gray-500 w-12">
                </div>
                <div  class="mb-2">
                    <label class="inline-block text-center w-1/3 ">Nombre de personnes</label>
                    <input type="number" min="0" name="persons" class="w-1/2 border rounded border-gray-500 w-12 text-center" value=<?php echo $cont['persons']; ?>>
                </div>
                <div  class="mb-2">
                    <label class="inline-block text-center w-1/3">Contenu</label>
                    <textarea name="content" class="w-1/2 border rounded border-gray-500" ><?php echo $cont['content']; ?></textarea>
                </div>
            </div>
            <!--// Formulaire d'ajout d'ingredients-->
            <div id="ing" class="w-full inline-block text-center mb-5">
                <label>Ingredients</label><br>
                <ul id="ingredientList" class="mb-2">
                    <?php foreach ($ingredients as $ingredient){ ?>
                    <div>
                        <input class="ingId" type="hidden" value="<?php echo $ingredient->id ?>" name="ingId[]">
                        <li class="ingredient relative list-none flex-row">
                            <div class="inline-block w-1/3">
                                <label>Ingredient :</label>
                                <input type="text" class="ing border border-gray-500" value='<?php echo $ingredient->ingredient ?>' name="ing[]">
                            </div>
                            <div class="inline-block w-1/3">
                                <label for="">Qté</label>
                                <input type="text" class="qte border border-gray-500" value="<?php if ((int)$ingredient->quantity!=0) echo (int)$ingredient->quantity ?>" name="qte[]">

                                <select class="unit border border-gray-500" name="unit[]" value="<?php echo $ingredient->unity ?>">
                                    <option value=" ">unité</option>
                                    <option value="g">g</option>
                                    <option value="cl">cl</option>
                                </select>
                            </div>
                            <span class="removeButton absolute top-0 right-10 bottom-0">
                                <svg  class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Supprimer</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
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
                            <li class="step relative list-none">
                                <div>
                                    <label class="inline my-auto">Etape <span class="i"><?php echo $i; $i++ ?></span> : </label><textarea type="text" class="step border border-gray-500" cols="100" name="step[]"><?php echo $stp->steps ?></textarea>
                                </div>
                                <span class="removeButton absolute top-0 right-0 bottom-0">
                                    <svg  class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Supprimer</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                                </span>
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
<?php #} ?>
<script>
    //Script qui ajoute un ingredient quand on clique sur le bouton
    $('#addIngredientButton').click(function(e){
        var $clone=`<li class="newIngredient relative list-none flex-row">
            <div class="inline-block w-1/3">
                <label>Ingredient :</label>
                <input type="text" class="newIng border border-gray-500" value=' ' name="newIng[]">
            </div>
            <div class="inline-block w-1/3">
                <label for="">Qté</label>
                <input type="text" value=' ' class="newQte border border-gray-500" name="newQte[]">

                <select class="unit border border-gray-500" name="newUnit[]">
                <option value=" ">unité</option>
                <option value="g">g</option>
                <option value="cl">cl</option>
                </select>
            </div>


                <span class="removeButton absolute top-0 right-0 bottom-0">
                    <svg  class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Supprimer</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                </span>
</li>`;
        $('#ingredientList').append($clone)
    });
    //Script qui ajoute une etape quand on clique sur le bouton

    $('#addStepButton').click(function(){
        var $clone=
            `<li class="newStep relative list-none">
            <div>
            <label class="inline my-auto">Etape <span class="i"></span> : </label><textarea type="text" class="border border-gray-500" cols="100" name="newStep[]"></textarea>
            </div>
            <span class="removeButton absolute top-0 right-0 bottom-0">
            <svg  class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Supprimer</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
            </span>

            </li>`;

        $('#stepList').append($clone);
        $('.i').each(function(index){
            $index=index+1;
            $(this).html($index);
        });

    });
    //Script qui supprime une etape ou un ingredient quand on clique sur le bouton

    $(document).on('click','.removeButton',function(){
        if($(this).parent().hasClass('ingredient')){
            $(this).parent().addClass('hidden');
            $(this).parent().siblings('.ingId').attr({name:'delIngId[]'});
            $(this).siblings('div').children('.ing').attr({name:'delIng[]'});
            $(this).siblings('div').children('.qte').attr({name:'delQte[]'});
            $(this).siblings('div').children('.unit').attr({name:'delUnit[]'});
        }
        else if($(this).parent().hasClass('step')){
            $(this).parent().addClass('hidden');
            $(this).parent().siblings('.stepId').attr({name:'delStepId[]'});
            $(this).siblings('div').children('.step').attr({name:'delStep[]'});
            $(this).siblings('div').children('label').children('.i').removeClass('i');
        }
        else{
            $(this).parent().remove();
        }
        $('.i').each(function(index){
            $index=index+1;
            $(this).html($index);
        });
    });
</script>