<?php
require_once(COMPONENTS . "/header.php");
$validation_errors = $_SESSION['validation_errors'] ?? [];
?>
<main class="main py-3">
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="card mb-4">
                    <div class="card-header">
                        <h3 class="mb-0">Редактировать задачу</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="tasks/update?id=<?= h($task['id']) ?>"
                            enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="title">Название:</label>
                                <input type="text"
                                    class="form-control <?= isset($validation_errors['title']) ? 'is-invalid' : '' ?>"
                                    id="title" name="title" value="<?= h($task['title']) ?>" required>
                                <?php if (isset($validation_errors['title'])): ?>
                                    <div class="invalid-feedback d-block">
                                        <ul class="list-unstyled">
                                            <?php foreach ($validation_errors['title'] as $error): ?>
                                                <li><?= $error ?></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <label for="description">Описание:</label>
                                <textarea class="form-control" id="description"
                                    name="description"><?= h($task['description']) ?></textarea>
                            </div>
                            <div class="form-group">
                                <label>Приоритет:</label>
                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                    <label
                                        class="btn btn-outline-danger <?= $task['priority'] === 'high' ? 'active' : '' ?>">
                                        <input type="radio" name="priority" value="high" autocomplete="off"
                                            <?= $task['priority'] === 'high' ? 'checked' : '' ?>> Высокий
                                    </label>
                                    <label
                                        class="btn btn-outline-warning <?= $task['priority'] === 'medium' ? 'active' : '' ?>">
                                        <input type="radio" name="priority" value="medium" autocomplete="off"
                                            <?= $task['priority'] === 'medium' ? 'checked' : '' ?>> Средний
                                    </label>
                                    <label
                                        class="btn btn-outline-success <?= $task['priority'] === 'low' ? 'active' : '' ?>">
                                        <input type="radio" name="priority" value="low" autocomplete="off"
                                            <?= $task['priority'] === 'low' ? 'checked' : '' ?>> Низкий
                                    </label>
                                </div>
                                <?php if (isset($validation_errors['priority'])): ?>
                                    <div class="invalid-feedback d-block">
                                        <ul class="list-unstyled">
                                            <?php foreach ($validation_errors['priority'] as $error): ?>
                                                <li><?= $error ?></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                <?php endif; ?>
                                <span
                                    class="badge <?= $task['priority'] === 'high' ? 'badge-danger' : ($task['priority'] === 'medium' ? 'badge-warning' : 'badge-success') ?>">
                                    <?= h(ucfirst($task['priority'])) ?>
                                </span>
                                <?= isset($validationResult) ? $validationResult->listErrors("priority") : "" ?>
                            </div>
                            <div class="form-group">
                                <label for="due_date">Дата окончания:</label>
                                <input type="date" class="form-control" id="due_date" name="due_date"
                                    value="<?= h($task['due_date']) ?>">
                            </div>
                            <div class="form-group">
                                <label for="hashtags">Хэштеги:</label>
                                <input type="text" class="form-control" id="hashtags" name="hashtags"
                                    value="<?= h($hashtags_string) ?>"
                                    placeholder="Введите хэштеги через запятую (например: #важно, #срочно, #проект)">
                                <small class="form-text text-muted">Разделяйте хэштеги запятыми. Символ # добавлять не
                                    обязательно.</small>
                            </div>
                            <div class="form-group">
                                <label for="comment">Комментарий:</label>
                                <textarea class="form-control" id="comment"
                                    name="comment"><?= h($task['comment']) ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="file">Прикрепить файл:</label>
                                <input type="file" class="form-control-file" id="file_" name="file_">
                                <?php if (!empty($task['file_'])): ?>
                                    <small class="form-text text-muted">Текущий файл: <a href="<?= h($task['file_']) ?>"
                                            target="_blank">Скачать</a></small>
                                <?php endif; ?>
                            </div>
                            <button type="submit" class="btn btn-primary">Сохранить изменения</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php
// Очищаем данные сессии после отображения формы
unset($_SESSION['validation_errors']);
unset($_SESSION['old']);
?>
<?php require_once(COMPONENTS . "/footer.php"); ?>
<?php require_once(COMPONENTS . "/footer.php"); ?>