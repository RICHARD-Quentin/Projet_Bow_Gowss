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
        <div class="mx-auto border-gray-500 w-2/3 flex-col shadow-lg my-6 rounded">
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
<script>
    $(document).ready(function(){
        //Script qui ajoute un ingredient quand on clique sur le bouton
        $('#addIngredientButton').click(function(e){
            var $clone=`<li id="newIngredient" class="relative list-none flex-row">
                <div class="inline-block w-1/3">
                    <label>Ingredient :</label>
                    <input type="text" class="border border-gray-500" value='' name="ing[]">
                </div>
                <div class="inline-block w-1/3">
                    <label for="">Qté</label>
                    <input type="text" value='' class="border border-gray-500" name="qte[]">

                    <select class="border border-gray-500" name="unit[]">
                    <option value=" ">unité</option>
                    <option value="g">g</option>
                    <option value="cl">cl</option>
                    </select>
                </div>


                    <span class="removeButton absolute top-0 right-10 bottom-0">
                        <svg  class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Supprimer</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                    </span>
    </li>`;
            $('#ingredientList').append($clone)
        });
        //Script qui ajoute une etape quand on clique sur le bouton

        $('#addStepButton').click(function(){
            var $clone=
                `<li id="newStep" class="relative list-none">
                <div>
                <label class="inline my-auto">Etape <span class="i"></span> : </label><textarea type="text" required class="border border-gray-500" cols="100" name="step[]"></textarea>
            <span class="removeButton absolute top-0 right-10 bottom-0">
                <svg  class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Supprimer</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                </span>
                </div>
                </li>`;
            $('#stepList').append($clone);
            $('.i').each(function(index){
                $index=index+1;
                $(this).html($index);
            });
        });
        //Script qui supprime une etape ou un ingredient quand on clique sur le bouton

        $(document).on('click','.removeButton',function(){
            $(this).parent().remove();
            $('.i').each(function(index){
                $index=index+1;
                $(this).html($index);
            });
        });
    });
</script>
<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
<script src="js/script.js"></script>
</body>

</html>
