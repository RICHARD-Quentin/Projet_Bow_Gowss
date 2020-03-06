<?php
require('src/getCurrentURL.php');
$monLien = getCurrentURL();
?>
<form method="post" id="formSendMail" action="src/sendMail.php?link=<?php echo $monLien ?>" class="z-20 hidden fixed inset-0 w-full max-w-xs container mx-auto">
    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <!--<button class="btn btn-blue float-right" >
            <i class="fas fa-times text-red-500 mx-2" id="closeBtn"></i>
        </button>-->
        <label class="block text-gray-700 text-sm font-bold mb-2">
            Email : <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="mailTo" type="text" required/><br />
        </label>
        <label class="block text-gray-700 text-sm font-bold mb-2">
            Subject : <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="mailSubject" name="subject" type="text" required/><br/>
        </label>
        <label class="block text-gray-700 text-sm font-bold mb-2">
            Message:</br>
        </label>
        <textarea class="mb-6" name="contentInMail" rows="10"></textarea><br/>
        <input class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="reset" value="Reset" required>
        <input class="float-right bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" id="formSendMail" type="submit" value="Send"/>
    </div>
</form>
<script type="text/javascript" src="js/sendMailPopUp.js"></script>
