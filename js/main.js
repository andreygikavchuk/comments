$(document).ready(function () {

        $(document).on('click', '.comment_action_form button', function (e) {
        event.preventDefault();
        var form = $(this).parents('.comment_action_form'),
            action = $(this).data('action'),
            status = $(this).data('status');
        form.find('.status').val(status);
        form.find('.action').val(action);
        form.trigger('submit');
    });


    $(document).on('submit', '.comment_action_form', function (e) {
        e.preventDefault();
        var value = $(this).serializeArray(),
            item = $(this).parents('.comment_item'),
            action = $(this).find('.action').val();
        console.log(action);
        $.ajax({
            url: 'ajax.php',
            method: 'POST',
            data: value,
            success: function (data) {
                $('#success_action').modal('show');
            },
            complete: function (data) {
                reload_comments_list();
            },
            error: function (data) {
                $('#comment_error').modal('show');
            }
        })
    });


    var files;
    jQuery('#author_photo').on('change', function () {
        files = this.files;

    });


    $(document).on('submit', '#comment_form', function (e) {
        e.preventDefault();
        var file_data = $('#author_photo').prop('files')[0];
        var form_data = new FormData(),
            name = $('#author_name').val(),
            email = $('#author_email').val(),
            comment_text = $('#comment_text').val(),
            action = $('#action').val();


        $(files).each(function (key, value) {
            form_data.append(key, value);
        });



        form_data.append("action", action);
        form_data.append("name", name);
        form_data.append("email", email);
        form_data.append("comment_text", comment_text);

        $.ajax({
            url: 'create_comment.php',
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            complete: function (data) {
                $("form").trigger('reset');
                console.log(data);

            },
            success: function (data) {
                $('#comment_success').modal('show');
            },
            error: function (data) {
                $('#comment_error').modal('show');
            }
        })
    });


    function reload_comments_list() {
        var data = {
            'action': 'select'
        };

        $.ajax({
            url: 'ajax.php',
            method: 'POST',
            data: data,
            success: function (data) {
                $('#comments_list *').remove();
                $('#comments_list').append(data);
            },
            error: function (data) {
                console.log(data);
            }
        })
    }


    $('#author_name').bind('keyup blur',function(){
        var node = $(this);
        node.val(node.val().replace(/[^A-Za-z_\s]/,'') ); }
    );




    var exampleData = {
        'Опубліковані': $('#approved_num').text(),
        'В черзі': $('#draft_num').text(),
        'Відхилено': $('#spam_num').text(),
    };

    var exampleOptions = {
        'height': 400,
        'title': 'Діаграма кількості відгуків',
        'width': 1000,
        'fixPadding': 18,
        'barFont': [0, 12, "bold"],
        'labelFont': [0, 13, 0]
    };

    var example = $('#comments_chart');

    graphite(exampleData, exampleOptions, example);



});





