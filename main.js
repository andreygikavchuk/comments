$(document).ready(function () {


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
            },
            success: function (data) {
                $('#comment_success').modal('show');
            },
            error: function (data) {
                $('#comment_error').modal('show');
            }
        })
    });


    $('#author_name').bind('keyup blur',function(){
        var node = $(this);
        node.val(node.val().replace(/[^A-Za-z_\s]/,'') ); }
    );


});