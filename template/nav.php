<?php
if (isset($_SESSION['nickname']) AND (isset($_SESSION['id_session']))){
}
?>


<nav class="flex items-center justify-between flex-wrap bg-green-400 p-6">
    <div class="flex items-center flex-shrink-0 text-white mr-6">
        <i class="fas fa-carrot fa-fw mr-1"></i>
        <span class="font-semibold text-xl tracking-tight">Les recettes du developpeur</span>
    </div>
    <div class="block lg:hidden">
        <button class="flex items-center  border rounded text-teal-200 border-teal-400 hover:text-white hover:border-white">
            <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Menu</title><i class="fas fa-hamburger"></i></svg>
        </button>
    </div>

    <div class="w-full block flex-grow lg:flex lg:items-center lg:w-auto">
        <div class="text-sm lg:flex-grow">
<?php
    if (isset($_SESSION['nickname'])){
        echo "<p>Bonjour " . $_SESSION['nickname'] . "<i class=\"fas fa-user fa-fw mr-1\"></i></p>" ?>
        <a href="traitment/traitementDeconnexion.php" class="block mt-4 lg:inline-block lg:mt-0 text-teal-200 hover:text-white mr-4">
            <i class="fas fa-power-off fa-fw mr-1"></i>Déconnexion
        </a>
        <a href="recipe.php" class="block mt-4 lg:inline-block lg:mt-0 text-teal-200 hover:text-white mr-4">
            <i class="fas fa-blender fa-fw mr-1"></i>Envoyer une recette
        </a>
        <?php
    }else{
        ?>
        <a href="#" class="block mt-4 lg:inline-block lg:mt-0 text-teal-200 hover:text-white mr-4">
            Connexion
        </a>
        <a href="#" class="block mt-4 lg:inline-block lg:mt-0 text-teal-200 hover:text-white mr-4">
            Inscription
        </a>
        <?php
    }?>
        </div>
    </div>
</nav>
