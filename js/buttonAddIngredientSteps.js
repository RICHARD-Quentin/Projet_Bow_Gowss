<script>
//Script qui ajoute un ingredient quand on clique sur le bouton
$('#addIngredientButton').click(function(e){
    var $clone=`

                        <li class="newIngredient inline-block relative list-none flex flex-col border-b border-gray-400 md:flex-row w-2/3 mx-auto">
                            <div class="inline-block md:w-1/3 flex flex-col mx-1">
                                <label>Ingredient :</label>
                                <input type="text" required class="ing border border-gray-500" value='' name="newIng[]">
                            </div>
                            <div class="inline-block md:w-1/3 flex flex-col mx-1">
                                <label for="">Qté</label>
                                <input type="text" class="qte border border-gray-500" value="" name="newQte[]">
                            </div>
                            <div class="inline-block flex flex-col md:w-1/6 mx-1">
                                <label>Unité :</label>
                                <select class="unit inline-block border border-gray-500 align-bottom mb-1" name="newUnit[]" value="">
                                    <option value=" ">unité</option>
                                    <option value="g">g</option>
                                    <option value="cl">cl</option>
                                </select>
                            </div>
                                <span class="removeButton absolute right-0 md:bottom-0 top-0">
                                    <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Supprimer</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                                </span>
                        </li>

`;
    $('#ingredientList').append($clone)
});
//Script qui ajoute une etape quand on clique sur le bouton

$('#addStepButton').click(function(){
    var $clone=
        `               
                            <li class="newStep list-none flex flex-row md:w-2/3 inline-block mx-auto relative">
                                <div class="h-auto my-2">
                                    <label class="inline-block m-auto align-middle">Etape <span class="i"></span> : </label><textarea type="text" required class="newStep border border-gray-500 align-middle w-5/6" cols="100" name="newStep[]"></textarea>
                                </div>
                                <span class="removeButton absolute right-0">
                                    <svg  class="align-bottom m-auto fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Supprimer</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                                </span>
                            </li>
                        `;

    $('#stepList').append($clone);
    $('.i').each(function(index){
        $index=index+1;
        $(this).html($index);
    });

});
//Script qui supprime une etape ou un ingredient quand on clique sur le bouton

$(document).on('click','.removeButton',function(){
    if($(this).parent().hasClass('ingredient')){
        $(this).parent().addClass('hidden');
        $(this).parent().siblings('.ingId').attr({name:'delIngId[]'});
        $(this).siblings().children('.ing').attr({name:'delIng[]'});
        $(this).siblings().children('.qte').attr({name:'delQte[]'});
        $(this).siblings().children('.unit').attr({name:'delUnit[]'});
    }
    else if($(this).parent().hasClass('step')){
        $(this).parent('li').addClass('hidden');
        $(this).parent('li').siblings('.stepId').attr({name:'delStepId[]'});
        $(this).siblings('div').children('.step').attr({name:'delStep[]'});
        $(this).siblings('div').children('label').children('.i').removeClass('i');
    }
    else{
        $(this).parent().remove();
    }
    $('.i').each(function(index){
        $index=index+1;
        $(this).html($index);
    });
});
</script>