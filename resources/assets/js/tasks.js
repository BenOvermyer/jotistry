$(document).ready(function() {
    $('.tasks').delegate( '.complete-task', 'click', function() {
        var id = $(this).siblings('span').html();

        var data = {
            'content': $(this).siblings('div').html(),
            'is_completed': 1
        };

        $.post( 'tasks/' + id, data, function( response ) {
            $('.' + id).remove();
        });
    });

    $('.new-task').click(function() {
        var data = {
            'content': $('.content').html(),
            'is_completed': 0
        };

        $.post( 'tasks', data, function( response ) {
            $('.tasks').append( '<div class="task ' + response.id + '"><div contenteditable>' + response.content + '</div><button class="save-task button"><i class="fa fa-save"> Save</i></button> <button class="complete-task button"><i class="fa fa-check"></i> Complete</button> <span>' + response.id + '</span>')
            $('.content').html('');
        });
    });

    $('.tasks').delegate( '.save-task', 'click', function() {
        var id = $(this).siblings('span').html();

        var data = {
            'content': $(this).siblings('div').html(),
            'is_completed': 0
        };

        $.post( 'tasks/' + id, data, function( response ) {
            $(this).hide();
        });
    });
});