<h2>Registration</h2>
<?php
if (isset($_POST['regbtn'])) {
    $errors = registerUser(
        $_POST['login'],
        $_POST['email'],
        $_POST['password'],
        $_POST['password_confirm'],
    );
    if (!empty($errors)): ?>
        <ul style="color:red;">
            <?php foreach ($errors as $err): ?>
                <li><?= $err ?></li>
            <?php endforeach ?>
        </ul>
        <?php
    else:
        echo "<h4 style='color:green'>Пользователь успешно зарегистрирован!</h4>";
    endif;

}
require_once('pages/reg_form.php');
?>