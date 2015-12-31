$(document).ready(function() {
    $('.content').keydown(function(e) {
        if (e.keyCode === 13) {
            $('.new-task').click();
            return false;
        }
    });

    $('.tasks').delegate( '.complete-task', 'click', function() {
        var id = $(this).siblings('span').html();
        var task = $(this).parent();
        task.addClass('ghost');
        task.children('.complete-task').children('i').removeClass('fa-square-o').addClass('fa-check-square-o');

        var data = {
            'content': $(this).siblings('div').html(),
            'is_completed': 1
        };

        $.post( 'tasks/' + id, data, function( response ) {
            task.remove();
        });
    });

    $('.tasks').delegate( 'div', 'keypress', function() {
        $(this).siblings('.save-task').show();
    });

    $('.new-task').click(function() {
        var taskCategory = $('.active');
        var data = {
            'content': $('.content').html(),
            'task_category_id': taskCategory.attr('data-task-category'),
            'is_completed': 0
        };

        $.post( 'tasks', data, function( response ) {
            $('.tasks').append( '<div class="task ' + response.id + '"><button class="save-task button"><i class="fa fa-save"> Save</i></button> <button class="complete-task"><i class="fa fa-square-o"></i></button><div contenteditable>' + response.content + '</div> <span>' + response.id + '</span>')
            $('.content').html('');
        });
    });

    $('.new-task-category').click(function() {
        var data = {
            'title': $('.new-task-category-title').html()
        };

        $.post( 'tasks/categories', data, function( response ) {
            $('.task-categories').append( '<li><div class="task-category" data-task-category="' + response.id + '"><i class="fa fa-list"></i> ' + response.title + '</li>');
            $('.new-task-category-title').html('');
        });
    });

    $('.task-categories').delegate( '.task-category', 'click', function() {
        var taskCategory = $(this);
        $('.task-category').removeClass('active');
        taskCategory.addClass('active');
        $('.current-task-category').html(taskCategory.text());
        $('.task').remove();

        categoryId = taskCategory.attr('data-task-category');

        $.get( 'tasks/bycategory/' + categoryId, function( response ) {
            for (var i=0, len = response.length; i < len; i++) {
                $('.tasks').append( '<div class="task ' + response[i].id + '"><button class="save-task button"><i class="fa fa-save"> Save</i></button> <button class="complete-task"><i class="fa fa-square-o"></i></button><div contenteditable>' + response[i].content + '</div> <span>' + response[i].id + '</span>')
            }
        } );

    });

    $('.tasks').delegate( '.save-task', 'click', function() {
        var id = $(this).siblings('span').html();
        var saveButton = $(this);
        saveButton.attr('disabled', 'disabled');
        saveButton.addClass('disabled');

        var data = {
            'content': $(this).siblings('div').html(),
            'is_completed': 0
        };

        $.post( 'tasks/' + id, data, function( response ) {
            saveButton.hide();
        });
    });
});
