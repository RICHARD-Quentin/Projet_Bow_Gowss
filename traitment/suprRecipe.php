<?php
$recipeId=$_GET['id'];
var_dump($recipeId);

include_once ('../class/recipes.php');
recipes::deleteRecipe($recipeId);
header('Location: ../index.php');
