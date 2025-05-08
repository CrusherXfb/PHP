<?php
// app/views/auth/register.php
require_once VIEWS . '/components/header.php';
?>

<main class="main py-3 d-flex justify-content-center align-items-center">
    <div class="registration-form" style="max-width: 400px; width: 100%;">
        <h2>Регистрация</h2>

        <form method="post" action="register">
            <div class="form-group mb-3">
                <label for="username">Имя пользователя:</label>
                <input type="text" class="form-control <?= isset($validation_errors['username']) ? 'is-invalid' : '' ?>" 
                       id="username" name="username" value="<?= old(fieldname: 'username') ?>" required>
                <?php if (isset($validation_errors['username'])): ?>
                    <div class="invalid-feedback">
                        <?php foreach ($validation_errors['username'] as $error): ?>
                            <div><?= $error ?></div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
            
            <div class="form-group mb-3">
                <label for="email">Email:</label>
                <input type="email" class="form-control <?= isset($validation_errors['email']) ? 'is-invalid' : '' ?>" 
                       id="email" name="email" value="<?= old(fieldname: 'email') ?>" required>
                <?php if (isset($validation_errors['email'])): ?>
                    <div class="invalid-feedback">
                        <?php foreach ($validation_errors['email'] as $error): ?>
                            <div><?= $error ?></div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
            
            <div class="form-group mb-3">
                <label for="password">Пароль:</label>
                <input type="password" class="form-control <?= isset($validation_errors['password']) ? 'is-invalid' : '' ?>" 
                       id="password" name="password" required>
                <?php if (isset($validation_errors['password'])): ?>
                    <div class="invalid-feedback">
                        <?php foreach ($validation_errors['password'] as $error): ?>
                            <div><?= $error ?></div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
            
            <div class="form-group mb-3">
                <label for="confirm_password">Подтверждение пароля:</label>
                <input type="password" class="form-control <?= isset($validation_errors['confirm_password']) ? 'is-invalid' : '' ?>" 
                       id="confirm_password" name="confirm_password" required>
                <?php if (isset($validation_errors['confirm_password'])): ?>
                    <div class="invalid-feedback">
                        <?php foreach ($validation_errors['confirm_password'] as $error): ?>
                            <div><?= $error ?></div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
            
            <button type="submit" class="btn btn-primary w-100 mb-3">Зарегистрироваться</button>
        </form>
        <p class="text-center">Уже есть аккаунт? <a href="login">Войдите</a></p>
    </div>
</main>

<?php 
// Очищаем данные сессии после отображения формы
unset($_SESSION['old']);
require_once VIEWS . '/components/footer.php'; 
?>
