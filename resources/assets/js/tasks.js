$(document).ready(function() {
    var csrfToken = $('meta[name="csrf-token"]').attr('content');

    $('.content').keydown(function(e) {
        if (e.keyCode === 13) {
            newTask();
            return false;
        }
    });

    $('.new-task-category-title').keydown(function(e) {
        if (e.keyCode === 13) {
            $('.new-task-category').click();
            return false;
        }
    });

    $('.tasks').on('click', '.complete-task', function() {
        var id = $(this).siblings('span').html();
        var task = $(this).parent();
        task.addClass('ghost');
        task.children('.complete-task').children('i').html('check_box');

        var ajaxOptions = {
            url: 'tasks/' + id,
            method: 'POST',
            data: {
                'content': $(this).siblings('div').html(),
                'is_completed': 1
            },
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            dataType: 'json'
        };

        $.ajax(ajaxOptions).done(function(response) {
            task.remove();
        });
    });

    $('.tasks').on('keypress', 'div', function() {
        $(this).siblings('.save-task').show();
    });

    $('.new-task-category').click(function() {
        var categoryTitle = $('.new-task-category-title').html();

        var ajaxOptions = {
            method: 'POST',
            url: 'tasks/categories',
            data: {
                'title': categoryTitle
            },
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        };

        $.ajax(ajaxOptions).done(function(taskCategory) {
            $('.task-categories').append('<li><div class="task-category" data-task-category="' + taskCategory.id + '"><i class="material-icons">view_list</i> <span>' + taskCategory.title + '</span></li>');
            $('.new-task-category-title').html('');
        });
    });

    $('.task-categories').on('click', '.task-category', function() {
        var taskCategory = $(this);
        $('.task-category').removeClass('active');
        taskCategory.addClass('active');
        var taskCategoryTitle = taskCategory.children('span').text();
        $('.current-task-category').html(taskCategoryTitle);
        $('.task').remove();

        categoryId = taskCategory.attr('data-task-category');

        var ajaxOptions = {
            url: 'tasks/bycategory/' + categoryId,
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            dataType: 'json'
        }

        $.ajax(ajaxOptions).done(function(response) {
            for (var i = 0, len = response.length; i < len; i++) {
                $('.tasks').append('<div class="task ' + response[i].id + '"><button class="save-task btn btn-primary"><i class="material-icons">save</i> Save</button> <a class="complete-task"><i class="material-icons">check_box_outline_blank</i></a><div contenteditable>' + response[i].content + '</div> <span>' + response[i].id + '</span>')
            }
        });

        $('.content').focus();

    });

    $('.tasks').on('click', '.save-task', function() {
        var id = $(this).siblings('span').html();
        var saveButton = $(this);
        saveButton.attr('disabled', 'disabled');
        saveButton.addClass('disabled');

        var ajaxOptions = {
            url: 'tasks/' + id,
            method: 'POST',
            data: {
                'content': $(this).siblings('div').html(),
                'is_completed': 0
            },
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            dataType: 'json'
        }

        $.ajax(ajaxOptions).done(function(response) {
            saveButton.hide();
        });
    });

    function newTask() {
        var taskCategory = $('.active');
        var taskCategoryId = taskCategory.attr('data-task-category');
        var taskContent = $('.content').html();
        $('.content').html('');

        var ajaxOptions = {
            method: "POST",
            url: "tasks",
            data: {
                content: taskContent,
                task_category_id: taskCategoryId,
                is_completed: 0
            },
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        };

        $.ajax(ajaxOptions).done(function(task) {
            $.ajax({
                url: 'tasks/' + task.id,
                method: "GET",
                headers: {
                    'Accept': 'text/html',
                    'X-CSRF-TOKEN': csrfToken
                }
            }).done(function(taskHtml){
                $('.tasks').append(taskHtml);
            });
        });
    }

    $('.content').focus();
});
