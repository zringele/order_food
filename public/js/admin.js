$(document).ready(function(){
    var search = function () {
        $('.js-list').load('/users/' + $('#js-search-users').val());
    };
    search();
    $('#js-search-users').on('keyup', search);
    $('.fa-ban').on('click', function(){
        if (confirm("Užsakytas patiekalas bus atšauktas. Klientui išsiųsime el. laišką apie atšaukimą, ar tikrai norite tęsti?")) {
            $.ajax({
                url: "/ordered_dish/"+$(this).data('ordered_dish_id'),
                type: 'DELETE',
                success: function (result) {
                    alert(result);
                    location.reload();
                }
            });
        }
    });
});