$(document).ready(function(){

// initialiser toutes les variables
    var email = $('#emailConnexion'),
        regexMail = /^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/ ;

    //appel de confcions
    email.keyup(verifEmailConnexion);

    function verifEmailConnexion(){

        if(regexMail.test(this.value)){
            $(this).removeClass("border-2 border-red-500 border-gray-200 border");
            $(this).addClass("border-2 border-green-500");
            $(this).next().addClass("hidden");
        }
        else{
            $(this).removeClass("border-2 border-green-500 border-gray-200 border");
            $(this).addClass("border-2 border-red-500");
            $(this).next().removeClass("hidden");
        }
    };
});






