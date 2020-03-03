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

    public static function update($id, $title, $content, $duree, $cuisson, $image, $persons, $isVegan, $user_id, $ingredient, $step)
    {
        $bdd = connexion::connexionBdd();
        $reg = $bdd->prepare('UPDATE recipe SET title=:title, content=:content, image=:image, duree=:duree, cuisson=:cuisson, persons=:persons, isVegan=:isVegan, user_id=:user_id) WHERE id=:id');
        $reg->execute(array(
            'title'=>$title,
            'content'=>$content,
            'image'=>$image,
            'duree'=>$duree,
            'cuisson'=>$cuisson,
            'persons'=>$persons,
            'isVegan'=>$isVegan,
            'user_id'=>$user_id,
            'id'=>$id
        ));
        foreach($ingredient as $ingr=>$qte){
            $ing = $bdd->prepare('UPDATE recipeingredient SET (ingredient=:ingredient, quantity=:quantity) WHERE id=:ing_id');
            $ing->execute(array(
                'ing_id'=>$ing_id,
                'ingredient'=>$ingr,
                'quantity'=>$qte
            ));
        }
        foreach($step as $steps){
            $stp = $bdd->prepare('UPDATE recipesteps SET (recipe=:recipe, steps=:steps) ');
            $stp->execute(array(
                'recipe'=>$id,
                'steps'=>$steps
            ));
        }
    }
    public static function deleteRecipe($id){
        $bdd = connexion::connexionBdd();
        $del = $bdd->prepare('DELETE FROM recipe WHERE id=:id');
        $del-> execute(array("id"=>$id));
    }
}
