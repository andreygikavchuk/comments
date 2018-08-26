<?php
require_once("header.php");
require_once("dbconnect.php");


?>

    <div class="container" id="content">
        <div id="comment_form" class="comment_form">
            <h2>Залиште свій коментар </h2>
            <form method="post" action="create_comment.php" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="author_name">Ім'я</label>
                    <input minlength="3" id="author_name" name="name" type="text" required>
                </div>
                <div class="form-group">
                    <label for="author_email">E-mail</label>
                    <input id="author_email" type="email" name="email">
                </div>
                <div class="form-group">
                    <label for="author_email">Фото</label>
                    <input id="author_photo" type="file" name="uploadfile" accept="image/x-png,image/jpg">
                </div>
                <div class="form-group">
                    <label for="comment_text">Коментар</label>
                    <textarea minlength="5" name="comment_text" id="comment_text" cols="30" rows="10"
                              required></textarea>
                </div>
                <input id="action" type="hidden" name="action" value="Новый комент">
                <button class="submit_btn btn btn-primary" type="submit">Відправити</button>
            </form>
        </div>

    </div>
<?php
require_once("footer.php");




