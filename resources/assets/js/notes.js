$(document).ready(function() {
    var csrfToken = $('meta[name="csrf-token"]').attr('content');

    $('.new-note').click(function() {
        $('.title').html('');
        $('.body').html('');
        $('.update-note').hide();
        $('.delete-note').hide();
        $('.save-note').show();
        $('.active').removeClass('active');
        $('.title').focus();
    });

    $('.delete-note').click(function() {
        var noteId = $('.id').val();

        $.ajax({
            url: '/notes/' + noteId,
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
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

    $('.cards').on('click', '.card', function() {
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
        $.ajax({
            url: 'notes',
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            data: {
                'title': $('.title').html(),
                'body': $('.body').html()
            }
        }).done(function(note) {
            var noteDate = new Date(note.updated_at);
            noteDate = $.format.date(noteDate, 'MMM D, yyyy h:mm p');
            $('.cards').prepend('<div class="card ' + note.id + ' active"><h3>' + note.title + '</h3><h4>Last Updated: ' + noteDate + '</h4><div>' + note.body + '</div><span>' + note.id + '</span>');
            $('.save-note').hide();
            $('.update-note').show();
            $('.id').val(note.id);
        });
    });

    $('.update-note').click(function() {
        $.ajax({
            url: 'notes/' + $('.id').val(),
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            data: {
                'title': $('.title').html(),
                'body': $('.body').html()
            }
        }).done(function(note) {
            $('.cards > .' + note.id).html('<h3>' + note.title + '</h3><div>' + note.body + '</div><span>' + note.id + '</span>');
        });
    });

});
