<?php
require_once("header.php");

if(!isset($_SESSION["email"]) && !isset($_SESSION["password"])){
    ?>
    <div class="container" id="content">
        <div id="form_auth">
            <h2>Форма авторизації</h2>
            <form action="auth.php" method="post" name="form_auth" >

                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input id="email" type="email" name="email" required>
                </div>


                <div class="form-group">
                    <label for="password">Пароль</label>
                    <input id="password" type="password" name="password" required>
                </div>

                <input class="submit_btn btn btn-primary" type="submit" name="btn_submit_auth" value="Вхід" />

            </form>
        </div>
    </div>

    <?php
}else{
    ?>
    <div id="authorized">
        <h2>Ви вже авторизовані!</h2>
    </div>

    <?php
}
?>

<?php

require_once("footer.php");
?>