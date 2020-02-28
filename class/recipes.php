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

    public function register($title, $content, $duree, $image, $persons, $isVegan, $user_id)
    {
        $bdd = connexion::connexionBdd();
        $reg = $bdd->prepare('INSERT INTO recipe (title, content, image, duree, persons, isVegan, user_id) VALUES (:title, :content, :image, :duree, :persons, :isVegan, :user_id)');
        $reg->execute(array(
            'title'=>$title,
            'content'=>$content,
            'image'=>$image,
            'duree'=>$duree,
            'persons'=>$persons,
            'isVegan'=>$isVegan,
            'user_id'=>$user_id
        ));
        $reg->debugDumpParams();
        #header('index.php');
    }

    public function update($id, $title, $content, $duree, $image)
    {
        $bdd = connexion::connexionBdd();
        $updt = $bdd->prepare('UPDATE recipe 
                        SET title= :title,
                        content= :content,
                        image= :image, 
                        duree= :duree  
                        WHERE id=:id');

        $updt->execute(array($title,$content,$image,$duree,$id));
    }
    public function delete($id){
        $bdd = connexion::connexionBdd();
        $del = $bdd->prepare('DELETE FROM recipe WHERE id=:id');
        $del-> execute(array($id));
    }
}
