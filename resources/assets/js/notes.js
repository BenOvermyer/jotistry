$(document).ready(function () {
    $('.new').click(function () {
        $('.title').html('');
        $('.body').html('');
        $('.update').hide();
        $('.save').show();
        $('.title').focus();
    });

    $('.card').click(function(){
        $('.save').hide();
        $('.update').show();
        $('.title').html($(this).children('h3').html());
        $('.body').html($(this).children('div').html());
        $('.id').val($(this).children('span').html());
    });

    $('.save').click(function() {
        var data = {
            'title': $('.title').html(),
            'body': $('.body').html()
        };

        $.post('/notes', data, function(response) {
            $('.cards').prepend('<div class="card"><h3>' + response.title + '</h3><div>' + response.body + '</div><span>' + response.id + '</span>');
            $('.save').hide();
            $('.update').show();
            $('.id').val(response.id);
        });
    });

    $('.update').click(function() {
        var data = {
            'title': $('.title').html(),
            'body': $('.body').html()
        };

        $.post('/notes/' + $('.id').val(), data, function(response) {
            $('.cards > .' + response.id).html('<h3>' + response.title + '</h3><div>' + response.body + '</div><span>' + response.id + '</span>');
        });
    });

});
