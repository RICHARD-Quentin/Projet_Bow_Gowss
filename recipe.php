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
<main>
    <form action= "traitment/traitementRecipe.php" enctype="multipart/form-data" method="post">
        <div class="mx-auto border-gray-500 flex-row flex-wrap mx-auto">

            <div class="w-full max-w-lg inline-block mx-auto">
                <div>
                    <label class="w-1/3">Titre</label>
                    <input type="text" name="title" class="w-1/2 border rounded border-gray-500">
                </div>
                <div class="mb-2">
                    <label class="w-1/3">Image</label>
                    <input type="file" name="myImage" class="w-1/2 border rounded border-gray-500">
                </div>
                <div  class="mb-2">
                    <label class="w-1/3">Durée</label>
                    <input type="text" name="duree" class="w-1/2 border rounded border-gray-500">
                </div>
                <div  class="mb-2">
                    <label class="w-1/3">Vegan</label>
                    <input type="checkbox" name="isVegan" class="w-1/2 border rounded border-gray-500 w-12">
                </div>
                <div  class="mb-2">
                    <label class="w-1/3">Nombre de personnes</label>
                    <input type="number" name="persons" class="w-1/2 border rounded border-gray-500 w-12 text-center">
                </div>
                <div  class="mb-2">
                    <label class="w-1/3">Contenu</label>
                    <textarea name="content" class="w-1/2 border rounded border-gray-500"></textarea>
                </div>
            </div>
            <div id="ing" class="w-2/5 inline-block text-center">
                <label>Ingredients</label><br>
                <span id="addIngredientButton" class="border border-gray-500 rounded bg-gray-300">Ajouter un ingredient</span>
                <ul id="ingredientList">

                </ul>
            </div>

            <div id="stp" class="w-2/5 inline-block text-center">
                <label>Etape</label><br>
                <span id="addStepButton" class="border border-gray-500 rounded bg-gray-300">Ajouter une étape</span>
                <ul id="stepList">

                </ul>
            </div>
        </div>
        <input type="submit" name="submit" value="Envoyer" class="inline-block">

    </form>
</main>
<script>
    let i=0;
    //Script qui ajoute un ingredient quand on clique sur le bouton
    $('#addIngredientButton').click(function(e){
        var $clone=`<li id="newIngredient" class="relative list-none">
            <div>
                <label>Ingredient :</label><input type="text" class="border border-gray-500" name="ing[]">
                <label for="">Qté</label><input type="text" class="border border-gray-500" name="qte[]">
                <span class="removeButton absolute top-0 right-10 bottom-0">
                                    <svg  class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Supprimer</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                                </span>
            </div>
</li>`;
        $('#ingredientList').append($clone)
    });
    //Script qui ajoute une etape quand on clique sur le bouton

    $('#addStepButton').click(function(){
        var $clone=
    `<li id="newStep" class="relative list-none">
            <div>
            <label>Etape <span class="i"></span> : </label><textarea type="text" class="border border-gray-500" name="step[]"></textarea>
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
</script>
<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
<script src="js/script.js"></script>

<?php include("template/footer.php"); ?>

</body>
<?php include("template/js.php"); ?>

</html>
