$(document).ready(function(){
    // initialiser toutes les variables
    var username = $('#idInscription'),
        email = $('#emailInscription'),
        password = $('#passInscription'),
        passwordConfirm = $('#passInscriptionConfirm'),
        regexPseudo = /^([a-zA-Z ]+)$/ ,
        regexMail = /^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/;
        // envoyer = $('#envoyerConnexion');

    //appel de confcions

    username.on('keyup change focus',verifUsername);
    email.on('keyup change focus',verifEmail);
    password.on('keyup change focus', verifPassword);
    passwordConfirm.on('keyup change focus', verifPasswordIsEgal);

    function verifUsername(){

        if(regexPseudo.test(this.value)&&($(this).val().length >= 5)){
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

    function verifEmail(){

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

    function verifPassword(){

        if($(this).val().length <= 5){
            $(this).removeClass("border-2 border-green-500 border-gray-200 border");
            $(this).addClass("border-2 border-red-500");
            $(this).next().removeClass("hidden");

        }
        else{
            $(this).removeClass("border-2 border-red-500 border-gray-200 border");
            $(this).addClass("border-2 border-green-500");
            $(this).next().addClass("hidden");
        }
    };

    function verifPasswordIsEgal(){

        if(password.val() == passwordConfirm.val()){
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