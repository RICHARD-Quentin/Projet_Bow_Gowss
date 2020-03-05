<?php
if (isset($_SESSION['nickname']) AND (isset($_SESSION['id_session']))){
}
?>


<nav class="flex items-center justify-between flex-wrap bg-green-400 p-6">
    <a href="index.php">
        <div href="index.php" class="flex items-center flex-shrink-0 text-white mr-6">
        <i class="fas fa-carrot fa-fw mr-1"></i>
        <span  class="font-semibold text-xl tracking-tight">Les recettes du developpeur</span>
        </div>
    </a>
    <div class="block lg:hidden">
        <button class="flex items-center  rounded text-teal-200 border-teal-400 hover:text-white hover:border-white">
            <i id="btnHamburger" class="m-1 fas fa-hamburger"></i>
        </button>
    </div>

    <div id="navElements" class="w-full block flex-grow hidden sm:hidden lg:flex lg:items-center lg:w-auto">
        <div class="text-sm lg:flex-grow">
<?php
    if (isset($_SESSION['nickname'])){
        echo "<p class=\"float-right\">Bonjour " . $_SESSION['nickname'] . "<i class=\"fas fa-user fa-fw mr-1\"></i></p>";

        if (isset($_SESSION['is_admin']) AND ($_SESSION['is_admin'] == 1)){
            echo "</i> Vous étes sur une session administrateur</p>";
        }
        ?>
        <a href="traitment/traitementDeconnexion.php" class="float-right block mt-4 lg:inline-block lg:mt-0 text-teal-200 hover:text-white mr-4">
            <i class="fas fa-power-off fa-fw mr-1"></i>Déconnexion
        </a>
        <a href="recipe.php" class="block mt-4 lg:inline-block lg:mt-0 text-teal-200 hover:text-white mr-4">
            <i class="fas fa-blender fa-fw mr-1"></i>Envoyer une recette
        </a>
        <a href="recipesDisplay.php" class="block mt-4 lg:inline-block lg:mt-0 text-teal-200 hover:text-white mr-4">
            <i class="fas fa-book fa-fw mr-1"></i>Recettes
        </a>
        <a href="favoris.php" class="block mt-4 lg:inline-block lg:mt-0 text-teal-200 hover:text-white mr-4">
            <i class="fas fa-heart fa-fw mr-1"></i>Favoris
        </a>
        <?php

        if (isset($_SESSION['is_admin']) AND ($_SESSION['is_admin'] == 1)) {
            ?>
            <a href="dashboardAdmin.php" class="block mt-4 lg:inline-block lg:mt-0 text-teal-200 hover:text-white mr-4">
                <i class="fas fa-tachometer-alt fa-fw mr-1"></i>Dashboard
            </a>
            <?php

        }

    }else{
        ?>
        <a id="btnConnexion" class="cursor-pointer block mt-4 lg:inline-block lg:mt-0 text-teal-200 hover:text-white mr-4">
            Connexion
        </a>
        <a id="btnInscription" class="cursor-pointer block mt-4 lg:inline-block lg:mt-0 text-teal-200 hover:text-white mr-4">
            Inscription
        </a>
        <a href="recipesDisplay.php" class="block mt-4 lg:inline-block lg:mt-0 text-teal-200 hover:text-white mr-4">
            <i class="fas fa-book fa-fw mr-1"></i>Recettes
        </a>
        <?php
    }?>
        </div>
    </div>
</nav>
<?php include("formConnexion.php"); ?>
<?php include("formInscription.php"); ?>
<script type="text/javascript" src="js/hiddenFormConnexionInscription.js"></script>
<script type="text/javascript" src="js/hamburger.js"></script>
