$(document).ready(function () {
    $('div[contenteditable]').keydown(function(e) {
        if (e.keyCode === 13) {
            document.execCommand('insertHTML', false, '<br>');
            return false;
        }
    });

    $('.new').click(function () {
        $('.title').html('');
        $('.body').html('');
        $('.update').hide();
        $('.save').show();
        $('.active').removeClass('active');
        $('.title').focus();
    });

    $('.cards').delegate('.card', 'click', function(){
        $('.active').removeClass('active');
        $(this).addClass('active');
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
            var noteDate = new Date(response.updated_at);
            noteDate = $.format.date(noteDate, 'MMM D, yyyy h:mm p');
            $('.cards').prepend('<div class="card ' + response.id + ' active"><h3>' + response.title + '</h3><h4>Last Updated: ' + noteDate + '</h4><div>' + response.body + '</div><span>' + response.id + '</span>');
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
