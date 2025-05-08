<?php require_once COMPONENTS . "/header.php"; ?>

<main class="main py-3">
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h2 class="mb-0">Настройки профиля</h2>
                    </div>
                    <div class="card-body">
                        <div class="mb-4">
                            <a href="profile" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left"></i> Вернуться к профилю
                            </a>
                        </div>
                        
                        <h4 class="border-bottom pb-2">Изменение пароля</h4>
                        
                        <form method="post" action="profile/settings" class="mt-4">
                            <div class="mb-3">
                                <label for="current_password" class="form-label">Текущий пароль</label>
                                <input type="password" class="form-control <?= isset($validation_errors['current_password']) ? 'is-invalid' : '' ?>" 
                                       id="current_password" name="current_password" required>
                                <?php if (isset($validation_errors['current_password'])): ?>
                                    <?php foreach ($validation_errors['current_password'] as $error): ?>
                                        <div class="invalid-feedback d-block"><?= $error ?></div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                            
                            <div class="mb-3">
                                <label for="new_password" class="form-label">Новый пароль</label>
                                <input type="password" class="form-control <?= isset($validation_errors['new_password']) ? 'is-invalid' : '' ?>" 
                                       id="new_password" name="new_password" required>
                                <?php if (isset($validation_errors['new_password'])): ?>
                                    <?php foreach ($validation_errors['new_password'] as $error): ?>
                                        <div class="invalid-feedback d-block"><?= $error ?></div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                                <div class="form-text">Пароль должен содержать минимум 6 символов</div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="confirm_password" class="form-label">Подтверждение пароля</label>
                                <input type="password" class="form-control <?= isset($validation_errors['confirm_password']) ? 'is-invalid' : '' ?>" 
                                       id="confirm_password" name="confirm_password" required>
                                <?php if (isset($validation_errors['confirm_password'])): ?>
                                    <?php foreach ($validation_errors['confirm_password'] as $error): ?>
                                        <div class="invalid-feedback d-block"><?= $error ?></div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                            
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-lg"></i> Сохранить изменения
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php require_once COMPONENTS . "/footer.php"; ?>