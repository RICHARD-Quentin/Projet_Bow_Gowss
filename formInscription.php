<?php
?>

<div class="w-full max-w-xs">
    <form action="traitment/traitementInscription.php" method="post"
          class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="idInscription">
                Username
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                   name="idInscription" id="idInscription" type="text" placeholder="Username">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="emailInscription">
                email
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                   name="emailInscription" id="emailInscription" type="text" placeholder="email">
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="passInscription">
                Password
            </label>
            <input class="shadow appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                   name="passInscription" id="passInscription" type="password" placeholder="******************">
            <p class="text-red-500 text-xs italic">Please choose a password.</p>
        </div>
        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="passInscriptionConfirm">
                Password confirm
            </label>
            <input class="shadow appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                   name="passInscriptionConfirm" id="passInscriptionConfirm" type="password" placeholder="******************">
            <p class="text-red-500 text-xs italic">Please confirm your password.</p>
        </div>
        <div class="flex items-center justify-between">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                    id="envoyerInscription" type="submit">
                Sign In
            </button>

        </div>
    </form>

</div>

<script type="text/javascript" src="js/formInscription.js"></script>