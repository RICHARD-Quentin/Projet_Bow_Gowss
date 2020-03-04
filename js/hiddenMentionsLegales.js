$(document).ready(function(){
    var btnMentions = $('#btnMentions'),
        mentionsLegales = $('#divMentionsLegales');


    btnMentions.click(showMentions);


    function showMentions(event) {
        mentionsLegales.removeClass("hidden");
        event.stopPropagation();
    }

    $(document).click(function(event) {
        if(!$(event.target).closest('#divMentionsLegales').length){
            // le clic est en dehors de #element
            $('#divMentionsLegales').addClass("hidden");
        }
    });

});