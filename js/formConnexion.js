$(document).ready(function(){

// initialiser toutes les variables
    var email = $('#emailConnexion'),
        regexMail = /^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/ ,
        mdp = $('#passConnexion'),
        envoyer = $('#submit');

    //appel de fonction
    email.keyup(verifEmailConnexion);
    mdp.keyup(verifMdp);

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

    function verifMdp(){

        if($(this).val().length > 5){
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

    // envoyer.click(function (e) {
    //     // e.preventDefault();
    //     verifForm(email);
    //     verifForm(mdp);
    // });

    function verifForm(){
        if($(this.value) == ""){
            console.log("ERROR: le champ "+ ($(this)) + " est vide");
            $(this).addClass("border-2 border-red-500");
        } else {
            console.log(($(this)) + "complet");
        };
    };

});






