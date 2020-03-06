<?php
$recipeId=$_GET['id'];

include_once ('../class/recipes.php');
recipes::deleteRecipe($recipeId);



header('Location: ../index.php');
