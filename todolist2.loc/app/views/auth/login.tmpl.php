<?php require_once VIEWS . '/components/header.php'; ?>

<main class="main d-flex justify-content-center align-items-center"  >
    <div class="login-form" style="max-width: 400px; width: 100%;">
        <h2>Вход</h2>
        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger"><?php echo $_SESSION['error'];
            unset($_SESSION['error']); ?></div>
        <?php endif; ?>

        <form method="post" action="login">
            <div class="form-group">
                <label for="username">Имя пользователя:</label>
                <input type="text" class="form-control" id="username" name="username" 
                       value="<?= old('username') ?>" required>
            </div>
            <div class="form-group">
                <label for="password">Пароль:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Войти</button>
        </form>
        <p>Нет аккаунта? <a href="register">Зарегистрируйтесь</a></p>
    </div>
</main>

<?php 
// Очищаем данные сессии после отображения формы
unset($_SESSION['old']);
require_once VIEWS . '/components/footer.php'; 
?>
