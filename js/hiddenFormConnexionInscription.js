$(document).ready(function(){
    var btnInscription = $('#btnInscription'),
        btnConnexion = $('#btnConnexion'),
        formInscription = $('#divFormInscription'),
        formConnexion = $('#divFormConnexion');

        btnInscription.click(showInscription),
        btnConnexion.click(showConnexion);
        // formInscription.click(hideInscription);

    function showInscription(event) {
        formInscription.removeClass("hidden");
        event.stopPropagation();
    }

    function showConnexion() {
        formConnexion.removeClass("hidden");
        event.stopPropagation();
    }

    $(document).click(function(event) {
        if(!$(event.target).closest('#divFormConnexion').length){
            // le clic est en dehors de #element
            $('#divFormConnexion').addClass("hidden");
        }
    });

    $(document).click(function(event) {
        if(!$(event.target).closest('#divFormInscription').length){
            // le clic est en dehors de #element
            $('#divFormInscription').addClass("hidden");
        }
    });

});