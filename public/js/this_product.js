$(document).ready(function(){
    // var increase_quantity = $('#increase_quantity');
    // var decrease_quantity = $('#decrease_quantity');
    // var quantity = $('#quantity');
    // var qty = $("#qty");


    // qty.val(quantity.text());

    // increase_quantity.click(function(){
    //     new_q = parseInt(quantity.text()) + 1;
    //     quantity.text(new_q);
    //     qty.val(quantity.text());
    // });

    // decrease_quantity.click(function(){
    //     q = quantity.text();
    //     if(q == 1){
    //         $.notify('The least product you can order is 1', 'info');
    //     }else{
    //         new_q = quantity.text() - 1;
    //         quantity.text(new_q);
    //         qty.val(quantity.text());
    //     }
    // });

    $(".oto_option").click(function(e) {
        var option = $(this).attr('oto_option_val');
        var main = $(this).attr("main_option");
        var input_selected = $(`#${main}_selected`);
        input_selected.val(`${main}:${option}`);
        $(`.${main}`).css({background: 'grey'});
        $(this).css({background: 'red'});
    });
});