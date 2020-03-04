<?php

include_once ('connexion.php');
class recipes
{
    public static function image($path,$file){
        $i=1;
        $imgDirectory='img';
        $ext=pathinfo($file['name'],PATHINFO_EXTENSION);
        while(file_exists("$path\\$imgDirectory\\image($i).$ext"))
        {
            $i++;
        }
        move_uploaded_file($file['tmp_name'],"$path\\$imgDirectory\\image($i).$ext");
        $recipeImagePath="$imgDirectory/image($i).$ext";
        return $recipeImagePath;
    }

    public static function register($title, $content, $duree, $cuisson, $image, $persons, $isVegan, $user_id, $ingredients, $step)
    {

        $bdd = connexion::connexionBdd();

        $reg = $bdd->prepare('INSERT INTO recipe (title, content, image, duree, cuisson, persons, isVegan, user_id) VALUES (:title, :content, :image, :duree, :cuisson, :persons, :isVegan, :user_id)');
        $reg->execute(array(
            'title'=>$title,
            'content'=>$content,
            'image'=>$image,
            'duree'=>$duree,
            'cuisson'=>$cuisson,
            'persons'=>$persons,
            'isVegan'=>$isVegan,
            'user_id'=>$user_id
        ));
        $id = $bdd->lastInsertId();

        if ($ingredients!=null){
            foreach($ingredients as $ingredient){
                $ing = $bdd->prepare('INSERT INTO recipeingredient (recipe, ingredient, quantity, unity) VALUES (:recipe, :ingredient, :quantity, :unity)');
                $ing->execute(array(
                    'recipe'=>$id,
                    'ingredient'=>$ingredient['name'],
                    'quantity'=>$ingredient['quantity'],
                    'unity'=>$ingredient['unity']
                ));
            }
        }
        foreach($step as $steps){
        $stp = $bdd->prepare('INSERT INTO recipesteps(recipe, steps) VALUES (:recipe, :steps)');
        $stp->execute(array(
            'recipe'=>$id,
            'steps'=>$steps
        ));
        }
        #header('index.php');
    }

    public static function update($recipeId, $title, $content, $duree, $cuisson, $persons, $updateIngredientTable, $newIngredientTable, $delIngredientTable,$updateStepTable, $newStepTable, $delStepTable)
    {
        $bdd = connexion::connexionBdd();

        $reg = $bdd->prepare('UPDATE recipe SET title=:title, content=:content, duree=:duree, cuisson=:cuisson, persons=:persons WHERE id=:id');
        $reg->execute(array(
            'title'=>$title,
            'content'=>$content,
            'duree'=>$duree,
            'cuisson'=>$cuisson,
            'persons'=>$persons,
            'id'=>$recipeId
        ));
        foreach($updateIngredientTable as $Ingredient){
            $ing = $bdd->prepare('UPDATE recipeingredient SET ingredient=:ingredient, quantity=:quantity, unity=:unity WHERE id=:ing_id');
            $ing->execute(array(
                'ing_id'=>$Ingredient['id'],
                'ingredient'=>$Ingredient['name'],
                'quantity'=>$Ingredient['quantity'],
                'unity'=>$Ingredient['unity']
            ));
        }
        foreach($updateStepTable as $step){
            $stp = $bdd->prepare('UPDATE recipesteps SET recipe=:recipe, steps=:steps WHERE id=:stepId ');
            $stp->execute(array(
                'recipe'=>$recipeId,
                'steps'=>$step['name'],
                'stepId'=>$step['id']
            ));
        }
        if ($newIngredientTable!=null){
            foreach($newIngredientTable as $newIngredient){
                $ing = $bdd->prepare('INSERT INTO recipeingredient (recipe, ingredient, quantity, unity) VALUES (:recipe, :ingredient, :quantity, :unity)');
                $ing->execute(array(
                    'recipe'=>$recipeId,
                    'ingredient'=>$newIngredient['name'],
                    'quantity'=>$newIngredient['quantity'],
                    'unity'=>$newIngredient['unity']
                ));
            }
        }
        if ($newStepTable!=null) {
            foreach ($newStepTable as $step) {
                $stp = $bdd->prepare('INSERT INTO recipesteps(recipe, steps) VALUES (:recipe, :steps)');
                $stp->execute(array(
                    'recipe' => $recipeId,
                    'steps' => $step['name'],
                ));
            }
        }
        if ($delIngredientTable!=null) {
            foreach ($delIngredientTable as $delIngredient) {
                $del = $bdd->prepare('DELETE FROM recipeingredient WHERE id=:id');
                $del->execute(array("id" => $delIngredient['id']));
            }
        }

        if ($delStepTable!=null) {
            foreach ($delStepTable as $delStep) {
                $del = $bdd->prepare('DELETE FROM recipesteps WHERE id=:id');
                $del->execute(array("id" => $delStep['id']));
            }
        }
    }
    public static function deleteRecipe($id){
        $bdd = connexion::connexionBdd();
        $del = $bdd->prepare('DELETE FROM recipe WHERE id=:id');
        $del-> execute(array("id"=>$id));
    }
    public static function timeConvert($time){
        $hPrep=intdiv($time,60);
        $minPrep=$time%60;
        if($hPrep!=0) {
            echo $hPrep.'h'.$minPrep.'min';
        } else {
            echo $minPrep . 'min';
        }
    }
}
