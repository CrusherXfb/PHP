<?php
// app/views/auth/register.php
require_once VIEWS . '/components/header.php';
?>

<main class="main py-3 d-flex justify-content-center align-items-center">
    <div class="registration-form" style="max-width: 400px; width: 100%;">
        <h2>Регистрация</h2>
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></div>
        <?php endif; ?>

        <form method="post" action="register">
            <div class="form-group">
                <label for="username">Имя пользователя:</label>
                <input type="text" class="form-control" id="username" name="username" value="<?= old(fieldname: 'username') ?>" required>
            </div>
            <div class="form-group">
                <label for="password">Пароль:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= old(fieldname: 'email') ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
        </form>
        <p>Уже есть аккаунт? <a href="login">Войдите</a></p>
    </div>
</main>

<?php require_once VIEWS . '/components/footer.php'; ?>
