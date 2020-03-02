<?php
?>

<div id="divFormConnexion" class="hidden fixed inset-0 w-full max-w-xs container mx-auto">
    <form action="traitment/traitementConnexion.php" method="post"
          class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <h3 class="block text-gray-700 text-sm font-bold mb-2">Connexion</h3>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="idConnexion">
Email de connexion
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                   name="emailConnexion" id="emailConnexion" type="text" placeholder="Email">
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="passConnexion">
Password
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                   name="passConnexion" id="passConnexion" type="password" placeholder="******************">
            <p class="text-red-500 text-xs italic">Please choose a password.</p>
        </div>
        <div class="flex items-center justify-between">
            <button id="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                    type="submit">
                        Sign In
</button>

        </div>
    </form>

</div>

<script type="text/javascript" src="js/formConnexion.js"></script>