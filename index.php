<?php
require_once("header.php");
require_once("dbconnect.php");


?>

    <div class="container" id="content">


        <?php

        $result = $db->Select("SELECT * FROM comments WHERE comment_status = 'approved'");
        if (count($result) > 0) { ?>
            <div id="comments_list" class="comments_list">
                <h1>Список коментарів </h1>
                <table class="table comment">
                    <thead>
                    <tr>
                        <th>Інформація про автора</th>
                        <th>Текст</th>
                        <th>Дата</th>
                    </tr>
                    </thead>
                    <?php

                    foreach ($result as $item) {
                        $status = $item['comment_status']; ?>


                        <tbody>
                        <tr>
                            <td>
                                <?php
                                if ($item['author_photo']) { ?>
                                    <div class="comment_img">
                                        <img src="<?= $item['author_photo'] ?>" alt="<?= $item['author_name'] ?>"
                                             title="<?= $item['author_name'] ?>">
                                    </div>

                                <?php }
                                ?>

                                <h3 class="comment_name">  <?= $item['author_name'] ?></h3>
                                <a class="comment_email"
                                   href="mailto:<?= $item['author_email'] ?>">  <?= $item['author_email'] ?></a>
                            </td>
                            <td>
                                <div class="comment_text"><?= $item['comment_text'] ?></div>
                            </td>

                            <td>
                         <span class="comment_date">
                             <?= $date_start = date('d.m.Y', strtotime($item['comment_date'])); ?>
                         </span>
                            </td>
                        </tr>

                        </tbody>


                    <?php }

                    $db->Close();

                    if ($result) { ?>
                </table>
                <?php
                }
                ?>
            </div>
        <?php } else { ?>
            <h1>Коментарів поки що немає </h1>
        <?php }


        ?>


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




