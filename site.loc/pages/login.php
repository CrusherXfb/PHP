<h2>Login</h2>
<?php
if (isset($_POST['logbtn'])) {
    $result = loginUser(
        $_POST['login'],
        $_POST['password'],
    );
    if (!$result): ?>
        <ul style="color:red;">
            <?php
            echo "Неверный логин или пароль";
            ?>
        </ul>
        <?php
    else:
        echo "<h4 style='color:green'>Добро пожаловать, " . htmlentities($_POST['login']) . "!</h4>";
    endif;

}
require_once('pages/login_form.php');
?>