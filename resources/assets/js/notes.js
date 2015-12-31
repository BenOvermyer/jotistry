$(document).ready(function () {
    $('div[contenteditable]').keydown(function(e) {
        if (e.keyCode === 13) {
            document.execCommand('insertHTML', false, '<br>');
            return false;
        }
    });

    $('.new-note').click(function () {
        $('.title').html('');
        $('.body').html('');
        $('.update-note').hide();
        $('.save-note').show();
        $('.active').removeClass('active');
        $('.title').focus();
    });

    $('.delete-note').click(function () {
        var noteId = $('.id').val();

        $.ajax({
            url: '/notes/' + noteId,
            method: 'DELETE'
        }).done(function(response) {
            $('.' + noteId).remove();
            $('.title').html('');
            $('.body').html('');
            $('.update-note').hide();
            $('.save-note').show();
            $('.active').removeClass('active');
            $('.title').focus();
        });
    });

    $('.cards').delegate('.card', 'click', function(){
        $('.active').removeClass('active');
        $(this).addClass('active');
        $('.save-note').hide();
        $('.update-note').show();
        $('.delete-note').show();
        $('.title').html($(this).children('h3').html());
        $('.body').html($(this).children('div').html());
        $('.id').val($(this).children('span').html());
    });

    $('.save-note').click(function() {
        var data = {
            'title': $('.title').html(),
            'body': $('.body').html()
        };

        $.post('/notes', data, function(response) {
            var noteDate = new Date(response.updated_at);
            noteDate = $.format.date(noteDate, 'MMM D, yyyy h:mm p');
            $('.cards').prepend('<div class="card ' + response.id + ' active"><h3>' + response.title + '</h3><h4>Last Updated: ' + noteDate + '</h4><div>' + response.body + '</div><span>' + response.id + '</span>');
            $('.save-note').hide();
            $('.update-note').show();
            $('.id').val(response.id);
        });
    });

    $('.update-note').click(function() {
        var data = {
            'title': $('.title').html(),
            'body': $('.body').html()
        };

        $.post('/notes/' + $('.id').val(), data, function(response) {
            $('.cards > .' + response.id).html('<h3>' + response.title + '</h3><div>' + response.body + '</div><span>' + response.id + '</span>');
        });
    });

});
