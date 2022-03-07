$(document).ready(function() {
    // $.get($('#box-gold').data('url'), function (data) {
    //     $('#box-gold').html(data);
    // }, 'html');

    // $.get($('#box-coin').data('url'), function (data) {
    //     $('#box-coin').html(data);
    // }, 'html');



    btnSearch = $('ul.tabs'); 
    btnSearch.click(function() {
        val = $('li.current')[0].innerHTML.toLowerCase();
        $('input.purpose').val(val);

    });

   

});