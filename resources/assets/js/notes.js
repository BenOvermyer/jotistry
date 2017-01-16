$(document).ready(function() {
    var csrfToken = $('meta[name="csrf-token"]').attr('content');

    $('.new-note').click(function() {
        var currentCard = null;
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

        var cardId = $(this).children('span').html();

        loadNote(cardId);
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
            $.ajax({
                url: 'notes/' + note.id,
                method: "GET",
                headers: {
                    'Accept': 'text/html',
                    'X_CSRF-TOKEN': csrfToken
                }
            }).done(function(noteHtml) {
                $('.cards').prepend(noteHtml);
            });
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
            $.ajax({
                url: 'notes/' + note.id,
                method: "GET",
                headers: {
                    'Accept': 'text/html',
                    'X_CSRF-TOKEN': csrfToken
                }
            }).done(function(noteHtml) {
                $('.cards > .' + note.id ).replaceWith(noteHtml);
            });
        });
    });

    function loadNote(id) {
        $.ajax({
            url: 'notes/' + id,
            method: "GET",
            headers: {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            }
        }).done(function(note) {
            $('.title').html(note.title);
            $('.body').html(note.body);
            $('.id').val(note.id);
        })
    }

});
