<?php


class connexion
{

    public static function connexionBdd(){
        try
        {
            $bdd = new PDO('mysql:host=localhost;dbname=recipedb;port=3306;charset=utf8', 'root', '');
            return $bdd;
        }
        catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }
    }

}
