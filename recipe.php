<?php
include("setup.php");
?>

<!DOCTYPE html>

<html lang="fr">
<?php include("head.php"); ?>

<body>
<?php include("nav.php"); ?>
<?php include("hero.php"); ?>
<main>
    <div class="mx-auto block border-gray-500">
        <form action= "traitment/recipe.php" method="post">
            <div class="mb-2">
                <label>Titre</label>
                <input type="text" name="title" class="border rounded border-gray-500">
            </div>
            <div class="mb-2">
                <label>Image</label>
                <input type="file" name="image" class="border rounded border-gray-500">
            </div>
            <div  class="mb-2">
                <label>Durée</label>
                <input type="text" name="duree" class="border rounded border-gray-500">
            </div>
            <div  class="mb-2">
                <label>Vegan</label>
                <input type="checkbox" name="isVegan" class="border rounded border-gray-500 w-12">
            </div>
            <div  class="mb-2">
                <label>Nombre de personnes</label>
                <input type="number" name="persons" class="border rounded border-gray-500 w-12 text-center">
            </div>
            <div  class="mb-2">
                <label>Contenu</label>
                <textarea name="content" class="border rounded border-gray-500"></textarea>
            </div>
        <input type="submit" value="Envoyer">
        </form>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="js/script.js"></script>

<?php include("footer.php"); ?>

</body>
<?php include("js.php"); ?>

</html>
