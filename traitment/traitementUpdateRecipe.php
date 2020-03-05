<?php
include_once ('src/valid_data.php');
include_once ('../class/recipes.php');
//Infos recette
if(isset($_POST['title'],$_POST['duree'],$_POST['cuisson'],$_POST['persons'],$_POST['content'])){ //Test de l'existence des champs
    if(!empty($_POST['title']) && !empty($_POST['duree']) && !empty($_POST['persons']) && !empty($_POST['content'])) { // Test de la cohérence des valeurs

        // Attribution des valeurs aux variables
        $recipeId= valid_donnees($_POST['id']);
        $title = valid_donnees($_POST['title']);
        $duree = valid_donnees($_POST['duree']);
        $cuisson = valid_donnees($_POST['cuisson']);
        $persons = valid_donnees($_POST['persons']);
        $content = valid_donnees($_POST['content']);
    }
    else{
        echo "Erreur dans un des champs de la description de la recette" ;
    }
}else{
    echo "Erreur un des champs de la description de la recette n'existe pas" ;
}
// Ingredient modifié
if(isset($_POST['ingId'],$_POST['ing'],$_POST['qte'],$_POST['init'])) {//Test de l'existence des champs

    if((!empty($_POST['ingId']) && !empty($_POST['ing'])) // Test de la cohérence des valeurs
        && (is_int($_POST['qte']) || empty($_POST['qte']))) {

        // Attribution des valeurs aux variables
        $updateIngId = valid_donnees($_POST['ingId']);
        $updateIng = valid_donnees($_POST['ing']);
        $updateQte = valid_donnees($_POST['qte']);
        $updateUnit = valid_donnees($_POST['unit']);

        // On boucle pour intégrer les valeurs dans un tableau associatif

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
    }
}else{
    $updateIngredientTable=null; // Si les valeurs n'existes pas, on retourne un tableau vide
}

// Nouvel ingredient
if(isset($_POST['newIng'],$_POST['newQte'],$_POST['newUnit']) && !empty($_POST['newIng'])){ //Test de l'existence des champs

    if((!empty($_POST['newIng']) && !empty($_POST['newUnit']) // Test de la cohérence des valeurs
        && (is_int($_POST['newQte']) || empty($_POST['newQte'])))) {

        // Attribution des valeurs aux variables

        $newIng = valid_donnees($_POST['newIng']);
        $newQte = valid_donnees($_POST['newQte']);
        $newUnit = valid_donnees($_POST['newUnit']);

        // On boucle pour intégrer les valeurs dans un tableau associatif
        $i = 0;
        foreach ($newIng as $newIngredient) {
            $newIngredientTable[$i] = [

                'name' => $newIngredient,
                'quantity' => $newQte[$i],
                'unity' => $newUnit[$i]
            ];
            $i++;
        }
    }else{
        echo "Erreur dans un des nouveaux ingrédients";
    }
}
else{
    $newIngredientTable=null; // Si les valeurs n'existes pas, on retourne un tableau vide
}
//Ingredient supprimé
if(isset($_POST['delIngId'],$_POST['delIng'],$_POST['delQte'],$_POST['delUnit'])) { //Test de l'existence des champs

    if((!empty($_POST['delIngId']) && !empty($_POST['delIng'])) // Test de la cohérence des valeurs
        && (is_int($_POST['delQte']) || empty($_POST['delQte']))){

        // Attribution des valeurs aux variables

        $delIngId = valid_donnees($_POST['delIngId']);
        $delIng = valid_donnees($_POST['delIng']);
        $delQte = valid_donnees($_POST['delQte']);
        $delUnit = valid_donnees($_POST['delUnit']);

        // On boucle pour intégrer les valeurs dans un tableau associatif

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
    }else{
        echo "Erreur dans un ingredient supprimé";
    }
}
else{
    $delIngredientTable=null; // Si les valeurs n'existes pas, on retourne un tableau vide
}

//ETAPES

//Etapes modifiée

if(isset($_POST['stepId'],$_POST['step'])){ //Test de l'existence des champs

    if(!empty($_POST['step'])){ // Test de la cohérence des valeurs

        // Attribution des valeurs aux variables

        $updateStepId=valid_donnees($_POST['stepId']);
        $updateStep=valid_donnees($_POST['step']);
        // On boucle pour intégrer les valeurs dans un tableau associatif

        $i=0;
        foreach ($updateStepId as $id){
            $updateStepTable[$i]=[
                'id'=>$id,
                'name'=>$updateStep[$i],
            ];
            $i++;
        }
    }
        else{
            echo "Erreur, une étape modifée est vide";
        }
}else{
    $updateStepTable=null; // Si les valeurs n'existes pas, on retourne un tableau vide
}

// Nouvelle etape
if(isset($_POST['newStep'])) { //Test de l'existence des champs
    if (!empty($_POST['newStep'])) { // Test de la cohérence des valeurs

        // Attribution des valeurs aux variables

        $newSteps = valid_donnees($_POST['newStep']);

        // On boucle pour intégrer les valeurs dans un tableau associatif

        $i = 0;
        foreach ($newSteps as $newStep) {
            $newStepTable[$i] = [
                'name' => $newStep,
            ];
            $i++;
        }
    }
}
else{
    $newStepTable=null; // Si les valeurs n'existes pas, on retourne un tableau vide
}

//Etape supprimée

if(isset($_POST['delStepId'],$_POST['delStep'])) { //Test de l'existence des champs

        if(!empty($_POST['delStepId']) && !empty($_POST['stepId'])){ // Test de la cohérence des valeurs

        // Attribution des valeurs aux variables

        $delStepId = valid_donnees($_POST['delStepId']);
        $delStep = valid_donnees($_POST['delStep']);
        // On boucle pour intégrer les valeurs dans un tableau associatif

        $i = 0;
        foreach ($delStepId as $id) {
            $delStepTable[$i] = [
                'id' => $id,
                'name' => $delStep[$i]
            ];
            $i++;
        }
    }
}
else{
    $delStepTable=null; // Si les valeurs n'existes pas, on retourne un tableau vide
}
// Test si toute les valeurs ont été attribuées
if(isset($recipeId, $title, $content, $duree, $cuisson, $persons, $updateIngredientTable, $newIngredientTable, $delIngredientTable,$updateStepTable, $newStepTable, $delStepTable)){
    recipes::update($recipeId, $title, $content, $duree, $cuisson, $persons, $updateIngredientTable, $newIngredientTable, $delIngredientTable,$updateStepTable, $newStepTable, $delStepTable);
    header('Location: ../index.php');
}
