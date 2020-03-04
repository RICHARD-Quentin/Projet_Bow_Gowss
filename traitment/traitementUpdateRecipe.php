<?php

include_once ('../class/recipes.php');
//Infos recette
if(isset($_POST['title'],$_POST['duree'],$_POST['cuisson'],$_POST['persons'],$_POST['content'])
    && !empty($_POST['title']) && !empty($_POST['duree']) && !empty($_POST['persons']) && !empty($_POST['content'])) {

    $recipeId=$_POST['id'];
    $title = $_POST['title'];
    $duree = $_POST['duree'];
    $cuisson = $_POST['cuisson'];
    $persons = $_POST['persons'];
    $content = $_POST['content'];
}
// Ingredient modifié
if(isset($_POST['ingId'],$_POST['ing']) && !empty($_POST['ing'])) {

    $updateIngId = $_POST['ingId'];
    $updateIng = $_POST['ing'];
    $updateQte = $_POST['qte'];
    $updateUnit = $_POST['unit'];

    $i = 0;
    foreach ($updateIngId as $id) {
        $updateIngredientTable[$i] = [

            'id' => $id,
            'name' => $updateIng[$i],
            'quantity' => $updateQte[$i],
            'unity' => $updateUnit[$i]
        ];
        $i++;
    }
}else{
    $updateIngredientTable=null;
}

// Nouvel ingredient
if(isset($_POST['newIng'],$_POST['newQte'],$_POST['newUnit']) && !empty($_POST['newIng'])){
    $newIng=$_POST['newIng'];
    $newQte=$_POST['newQte'];
    $newUnit=$_POST['newUnit'];

    $i=0;
    foreach ($newIng as $newIngredient){
        $newIngredientTable[$i]=[

            'name'=>$newIngredient,
            'quantity'=>$newQte[$i],
            'unity'=>$newUnit[$i]
        ];
        $i++;
    }
}
else{
    $newIngredientTable=null;
}
//Ingredient supprimé
if(isset($_POST['delIngId'],$_POST['delIng'],$_POST['delQte'],$_POST['delUnit'])) {

    $delIngId = $_POST['delIngId'];
    $delIng = $_POST['delIng'];
    $delQte = $_POST['delQte'];
    $delUnit = $_POST['delUnit'];

    $i = 0;
    foreach ($delIngId as $id) {
        $delIngredientTable[$i] = [

            'id' => $id,
            'name' => $delIng[$i],
            'quantity' => $delQte[$i],
            'unity' => $delUnit[$i]
        ];
        $i++;
    }
}
else{
    $delIngredientTable=null;
}

//ETAPES

//Etapes modifiée
if(isset($_POST['stepId'],$_POST['step']) && !empty($_POST['step'])){
    $updateStepId=$_POST['stepId'];
    $updateStep=$_POST['step'];
    $i=0;
    foreach ($updateStepId as $id){
        $updateStepTable[$i]=[
            'id'=>$id,
            'name'=>$updateStep[$i],
        ];
        $i++;
    }
}else{
    $updateStepTable=null;
}

// Nouvelle etape
if(isset($_POST['newStep'])) {

    $newSteps = $_POST['newStep'];

    $i = 0;
    foreach ($newSteps as $newStep) {
        $newStepTable[$i] = [
            'name' => $newStep,
        ];
        $i++;
    }
}
else{
    $newStepTable=null;
}

if(isset($_POST['delStepId'],$_POST['delStep'])) {

//Step supprimé
    $delStepId = $_POST['delStepId'];
    $delStep = $_POST['delStep'];
    $i = 0;

    foreach ($delStepId as $id) {
        $delStepTable[$i] = [
            'id' => $id,
            'name' => $delStep[$i]
        ];
        $i++;
    }
}
else{
    $delStepTable=null;
}
recipes::update($recipeId, $title, $content, $duree, $cuisson, $persons, $updateIngredientTable, $newIngredientTable, $delIngredientTable,$updateStepTable, $newStepTable, $delStepTable);
header('Location: ../index.php');
