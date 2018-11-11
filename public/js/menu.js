$(document).ready(function(){

    function getOrder() {
        var selectedDishes = [];
        $('.js-dish').each(function () {
            var sides = [];
            var dish;
            if ($(this).hasClass('bg-success')) {
                dish = $(this).data('id');
                $(this).find('.selected-side').each(function(){
                    if ($(this).val() !== 'default') {
                        sides.push($(this).val());
                    }
                });
                selectedDishes.push({
                    'dish': dish,
                    'sides': sides
                });
            }
        });
        return selectedDishes;
    }

    $('.js-dish').on('click', function(e){
        if (e.target.localName !== 'td') return;
        $(this).toggleClass('bg-success');
    });

    $('.js-order').on('click', function(){
        var order = getOrder();
        $.post('/user/order', { 'order': JSON.stringify(order), 'email': $(this).data('email'), 'feed': $(this).data('feed') }, function(data){
           alert("Užsakymas priimtas");
           window.location = '/';
        });
    });
});