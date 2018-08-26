<?php
require_once("header.php");

if(!isset($_SESSION["email"]) && !isset($_SESSION["password"])){
    ?>

    <div class="container" id="content">
        <div id="form_register">
            <h2>Форма реєстрації </h2>

            <form action="register.php" method="post" name="form_register" >


                <div class="form-group">
                    <label for="name">Ім'я</label>
                    <input id="name" type="text" name="name" required>
                </div>

                <div class="form-group">
                    <label for="last_name">Прізвище</label>
                    <input id="last_name" type="text" name="last_name" required>
                </div>


                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input id="email" type="email" name="email" required>
                </div>


                <div class="form-group">
                    <label for="password">Пароль</label>
                    <input id="password" type="password" name="password" required>
                </div>

                <input id="action" type="hidden" name="action" value="Новый комент">
                <input class="submit_btn btn btn-primary" type="submit" name="btn_submit_register" value="Зареєструватись!" />


            </form>
        </div>
    </div>

    <?php
}else{
    ?>
    <div id="authorized">
        <h2>Ви вже зареєстровані</h2>
    </div>

    <?php
}

require_once("footer.php");
?>