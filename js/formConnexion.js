$(document).ready(function(){

// initialiser toutes les variables
    var $emailConnexion = $('#emailConnexion'),
        $mdpConnexion = $('#passConnexion '),
        $envoiConnexion = $('#submit');

    $emailConnexion.keyup(function () {
        if($(this).val().length < 5){
            $(this).removeClass("border-2 border-green-500 border-gray-200 border");
            $(this).addClass("border-2 border-red-500");
        }else {
            $(this).removeClass("border-2 border-red-500 border-gray-200 border");
            $(this).addClass("border-2 border-green-500");
        }
    });

    $mdpConnexion.keyup(function(){
        if (regexMdp.test(this.value))
        {
            console.log("MDP fort");
            $(this).removeClass("border-red-500 border-gray-200");
            $(this).addClass("border-2 border-green-500");
        }
        else {
            console.log("MDP faible");
            $(this).removeClass("border-green-500 border-gray-200");
            $(this).addClass("border-2 border-red-500");
        }
    });

});






