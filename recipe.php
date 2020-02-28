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
    <form action= "traitment/traitementRecipe.php" method="post">
        <div class="mx-auto border-gray-500 flex-row flex-wrap mx-auto">

            <div class="w-1/3 inline-block">
                <div>
                    <label class="w-1/3">Titre</label>
                    <input type="text" name="title" class="w-1/2 border rounded border-gray-500">
                </div>
                <div class="mb-2">
                    <label class="w-1/3">Image</label>
                    <input type="file" name="image" class="w-1/2 border rounded border-gray-500">
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
            <div class="w-1/3 inline-block text-center">
                <label>Ingredients</label>
                <?php
                $type = $bdd ->query("SELECT * FROM typeingredient");
                $typ=$type->fetchAll(PDO::FETCH_CLASS);

                $stmt = $bdd -> prepare("SELECT * FROM ingredient WHERE typeId=:typ");

                foreach ($typ as $tp){
                    $typeIngredient=$tp->type;
                    $idIngredient=$tp->id;
                    echo '<h2>' .  $typeIngredient . '</h2>';

                    $stmt->execute(array("typ"=>$idIngredient));
                    $nom=$stmt->fetchAll(PDO::FETCH_CLASS);

                    foreach ($nom as $name){

                        echo '<div class="checkbox"><input type="checkbox" v-model="checked" value="' . $name->name . '"><label>' . $name->name . '</label>
                                    <div v-show="checked"><label>Quantité en g</label><input type="text" class="border border-gray-500"></div></div>';
                    }
                }
                ?>
            </div>
        </div>
        <input type="submit" value="Envoyer" class="inline-block mx-auto">

    </form>

</main>

<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="js/script.js"></script>

<?php include("template/footer.php"); ?>

</body>
<?php include("template/js.php"); ?>

</html>
