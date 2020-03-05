<form method="post" id="formSendMail" action="src/sendMail.php" class="z-10 hidden" >
    <div class="max-w-sm rounded overflow-hidden shadow-lg bg-gray-200">
        <button class="btn btn-blue float-right">
            <i class="fas fa-times text-red-500 mx-2"></i>
        </button>
        Email : <input class="rounded w-64 my-1 ml-8" name="mailTo" type="text" /><br />
        Subject : <input class="rounded w-64 my-1 ml-5"id="mailSubject" name="subject" type="text" /><br/>
        Message:</br>
        <textarea class="rounded" name="contentInMail" rows="15" cols="40"></textarea><br/>
        <input class="ml-5 bg-blue-100 hover:bg-blue-300 rounded-sm my-2 px-2 shadow" type="reset" value="Reset">
        <input class="rounded-sm inset-y-0 bg-blue-100 hover:bg-blue-300 float-right mr-5 my-2 px-2 shadow" id="formSendMail" type="submit" value="Send" />
    </div>
</form>
<script type="text/javascript" src="js/sendMailPopUp.js"></script>