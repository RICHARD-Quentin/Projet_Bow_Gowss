$(document).ready(function(){
        var btnSendMail = $('#btnSendMail');
        var formSendMail = $('#formSendMail');
        var btnClose = $('#closeBtn');

        btnSendMail.click(popSendMail);
        btnClose.click(unPopSendMail);

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