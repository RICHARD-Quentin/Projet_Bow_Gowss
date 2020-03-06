<script>
$(document).ready(function(){
    $(document).on('click','#fav',function(){
        if($(this).hasClass("false")){
            $(this).removeClass("false text-gray-400 hover:text-red-600").addClass("true text-red-600 hover:text-gray-400")
            var user=$(this).children('input.user').val();
            var recipe=$(this).children('input.recipe').val();
            console.log(user,recipe);

            $.ajax({
                url:'traitment/traitementInsertFavorite.php',
                method:'POST',
                data:{
                    user:user,
                    recipe:recipe
                }
            })

        }
        else if($(this).hasClass("true")){
            $(this).removeClass("true text-red-600 hover:text-gray-400").addClass("false text-gray-400 hover:text-red-600")
            var user=$(this).children('input.user').val();
            var recipe=$(this).children('input.recipe').val();
            console.log(user,recipe);
            $.ajax({
                url:'traitment/traitementDeleteFavorite.php',
                method:'POST',
                data:{
                    user:user,
                    recipe:recipe
                }
            })
        }
    })
})
</script>