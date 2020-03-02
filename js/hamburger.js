$(document).ready(function(){

    var btnHamburger = $('#btnHamburger'),
        navElements = $("#navElements");

    btnHamburger.click(showNav);


    function showNav() {
        navElements.removeClass("hidden sm:hidden");
        event.stopPropagation();
    }

    $(document).click(function(event) {
        if(!$(event.target).closest('#navElements').length){
            // le clic est en dehors de #element
            $('#navElements').addClass("hidden");
        }
    });

});