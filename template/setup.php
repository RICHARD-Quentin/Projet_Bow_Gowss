<?php
session_start();
setcookie('accord', '');

//demande d'accord des cookies au démarage
//si la variable cookie est deja renseigné alors ne pas re-demander l'accord
if (!isset($_SESSION['nickname']) AND (!isset($_SESSION['id_session']))){
    if ($accord =!null){
        echo
        "<div id=\"divCookies\" class=\"z-20 bottom-0 fixed inset-x-0 bottom-0 w-full max-w-xs container mx-auto\">
            <form action=\"traitment/traitementFormCookies.php\" method=\"post\" class=\"flex focus:shadow-outline bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4\">
                COOKIES ?? <i class=\"fas fa-cookie-bite\"></i>
                <input class='hidden' type=\"radio\" id=\"cookiesNot\" name=\"cookies\">
                <label class=\"flex-auto m-2 bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline\" value='true' for=\"cookiesNot\">D'accord</label>
        
                <input class='hidden' type=\"radio\" id=\"cookiesYes\" name=\"cookies\">
                <label class=\"m-2 bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline\" value='false' for=\"cookiesYes\" >Pas d'accord</label>
                <input class='flex-auto hidden' type='submit' value='Envoyer'>
            </form>
        </div>";

    }
}

?>
