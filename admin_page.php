<?php
require_once("header.php");
require_once("dbconnect.php");


$status_arr['approved'] = 'опубліковано';
$status_arr['draft'] = 'в черзі';
$status_arr['spam'] = 'відхилено';
$result = $db->Select("SELECT * FROM comments");

$approved_arr = 0;
$draft_arr = 0;
$spam_arr = 0;
foreach ($result as $item) {
    if ($item['comment_status'] == 'approved') {
        $approved_arr += 1;
    } elseif ($item['comment_status'] == 'draft') {
        $draft_arr += 1;
    } else  {
        $spam_arr += 1;
    }
}


?>
    <div class="container" id="content">
        <div  class="graph" id="comments_chart">
        <span class="sr-only" id="approved_num"><?= $approved_arr ?></span>
        <span class="sr-only" id="draft_num"><?= $draft_arr ?></span>
        <span class="sr-only" id="spam_num"><?= $spam_arr ?></span>

        </div>

        <div id="comments_list" class="comments_list">
            <?php



            if ($result) { ?>

            <h1>Список коментарів </h1>
            <table class="table comment">
                <thead>
                <tr>
                    <th>Інформація про автора</th>
                    <th>Текст</th>
                    <th>Статус</th>
                    <th>Управління</th>
                </tr>
                </thead>
                <?php } else { ?>
                    <h1>Коментарів поки що немає  </h1>
               <?php }


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
                            <div class="comment_status">
                                <?= $status_arr[$status] ?>
                            </div>
                        </td>
                        <td>
                            <form class="comment_action_form" action="#">

                                <input type="hidden" name="comment_id" value="<?= $item['id'] ?>">
                                <input class="action" type="hidden" name="action">
                                <input class="status" type="hidden" name="status">
                                <?php
                                switch ($status) {
                                    case "approved";
                                        echo "<button class='btn btn-danger' data-status='' data-action='delete'>Видалити</button>
                                             <button class='btn btn-warning' data-status='spam' data-action='change'>Відхилити</button>";
                                        break;
                                    case "draft";
                                        echo "<button class='btn btn-success' data-status='approved' data-action='change'>Одобрити</button>
                                            <button class='btn btn-danger' data-status='' data-action='delete'>Видалити</button>
                                             <button class='btn btn-warning' data-status='spam' data-action='change'>Відхилити</button>";
                                        break;
                                    case "spam";
                                        echo "<button class='btn btn-success' data-status='approved' data-action='change'>Одобрити</button>
                                            <button class='btn btn-danger' data-status='' data-action='delete'>Видалити</button>";
                                        break;
                                }
                                ?>

                            </form>
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


    </div>
<?php
require_once("footer.php");
?>