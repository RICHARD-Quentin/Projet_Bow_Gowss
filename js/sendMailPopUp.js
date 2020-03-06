$(document).ready(function(){
        var btnSendMail = $('#btnSendMail');
        var formSendMail = $('#formSendMail');


        btnSendMail.click(popSendMail);

        function popSendMail(event) {
            formSendMail.removeClass("hidden");
            event.stopPropagation();
        }

        $(document).click(function(event) {
            if(!$(event.target).closest('#formSendMail').length){
                // le clic est en dehors de #element
                $('#formSendMail').addClass("hidden");
            }
        });
    });