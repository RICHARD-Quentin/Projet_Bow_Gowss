<?php
session_start();
include_once ('../src/valid_data.php');

include_once ('../class/recipes.php');
include_once ('../class/connexion.php');

$classe = new recipes;


// Recuperation des valeurs du formulaire
if(isset($_POST['title'],$_POST['duree'],$_POST['cuisson'],$_POST['persons'],$_POST['content'])){ //Test de l'existence des champs
    if(!empty($_POST['title']) && !empty($_POST['duree']) &&!empty($_POST['cuisson']) && !empty($_POST['persons']) && !empty($_POST['content']) &&
    is_int((intval($_POST['duree']))) && is_int((intval($_POST['cuisson']))) && is_int(intval($_POST['persons']))){ // Test de la cohérence des valeurs

        // Attribution des valeurs aux variables

        $title=valid_donnees($_POST['title']);
        $duree=valid_donnees($_POST['duree']);
        $cuisson=valid_donnees($_POST['cuisson']);
        $persons=valid_donnees($_POST['persons']);
        $content=valid_donnees($_POST['content']);
    }
}

//Gestion des ingrédients
if((isset($_POST['ing']) && !empty($_POST['ing']))){ //Test de l'existence des champs
    if(is_int(intval($_POST['qte'])) || empty($_POST['qte']))  { // Test de la cohérence des valeurs
        // Attribution des valeurs aux variables

        $ing = $_POST['ing'];
        $qte = $_POST['qte'];
        $unit = $_POST['unit'];
        // On boucle pour intégrer les valeurs dans un tableau associatif

        $i = 0;
        foreach ($ing as $ingredient) {
            $ingredientTable[$i] = [

                'name' => valid_donnees($ingredient),
                'quantity' => valid_donnees($qte[$i]),
                'unity' => valid_donnees($unit[$i])
            ];
            $i++;
        }
    }
}

if(isset($_POST['step'])){ //Test de l'existence des champs
    if(!empty($_POST['step'])){ // Test de la cohérence des valeurs
        $steps=$_POST['step'];

        $i=0;
        foreach($steps as $step){
            $stepsTable[$i] = [

                'step'=>valid_donnees($step)

            ];
            $i++;
        }

    }
}
// Gestion du chemin de l'image
if(isset($_FILES['myImage'])){ //Test de l'existence des champs
    $path="..\\";
    $recipeImage=$_FILES['myImage'];
    $recipeImagePath= recipes::image($path,$recipeImage);
}

if(isset($_SESSION['id_session'])){ //Test de l'existence des champs
    $user_id=($_SESSION['id_session']);
}

if(isset($title, $content, $duree, $cuisson, $recipeImagePath, $persons, $user_id, $ingredientTable, $stepsTable)){ // Test de l'existence des variables
recipes::register($title, $content, $duree, $cuisson, $recipeImagePath, $persons, $user_id, $ingredientTable, $stepsTable); // Appel de la fonction d'insertion
    header('Location: ../index.php'); // redirection vers l'index(
}
else{
    echo 'Erreur dans votre formulaire ! Valeur manquante';
}
