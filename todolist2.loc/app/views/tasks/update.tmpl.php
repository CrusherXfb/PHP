<?php require_once(COMPONENTS . "/header.php"); ?>
<main class="main py-3">
    <div class="container" style="max-width: 600px;">
        <h1>Редактировать задачу</h1>
        <form method="POST" action="tasks/update?id=<?= h($task['id']) ?>" enctype="multipart/form-data">
            <input type="hidden" name="_method" value="PUT">
            <div class="form-group">
                <label for="title">Название:</label>
                <input type="text" class="form-control" id="title" name="title" value="<?= h($task['title']) ?>" required>
                <?= isset($validationResult) ? $validationResult->listErrors("title") : "" ?>
            </div>
            <div class="form-group">
                <label for="description">Описание:</label>
                <textarea class="form-control" id="description" name="description"><?= h($task['description']) ?></textarea>
            </div>
            <div class="form-group">
                <label>Приоритет:</label>
                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                    <label class="btn btn-outline-danger <?= $task['priority'] === 'high' ? 'active' : '' ?>">
                        <input type="radio" name="priority" value="high" autocomplete="off" <?= $task['priority'] === 'high' ? 'checked' : '' ?>> Высокий
                    </label>
                    <label class="btn btn-outline-warning <?= $task['priority'] === 'medium' ? 'active' : '' ?>">
                        <input type="radio" name="priority" value="medium" autocomplete="off" <?= $task['priority'] === 'medium' ? 'checked' : '' ?>> Средний
                    </label>
                    <label class="btn btn-outline-success <?= $task['priority'] === 'low' ? 'active' : '' ?>">
                        <input type="radio" name="priority" value="low" autocomplete="off" <?= $task['priority'] === 'low' ? 'checked' : '' ?>> Низкий
                    </label>
                </div>
                <?= isset($validationResult) ? $validationResult->listErrors("priority") : "" ?>
            </div>
            <div class="form-group">
                <label for="due_date">Дата окончания:</label>
                <input type="date" class="form-control" id="due_date" name="due_date" value="<?= h($task['due_date']) ?>">
            </div>
            <div class="form-group">
                <label for="hashtag">Хэштег:</label>
                <input type="text" class="form-control" id="hashtag" name="hashtag" value="<?= h($task['hashtag']) ?>">
            </div>
            <div class="form-group">
                <label for="comment">Комментарий:</label>
                <textarea class="form-control" id="comment" name="comment"><?= h($task['comment']) ?></textarea>
            </div>
            <div class="form-group">
                <label for="file">Прикрепить файл:</label>
                <input type="file" class="form-control-file" id="file_" name="file_">
                <?php if (!empty($task['file_'])): ?>
                    <small class="form-text text-muted">Текущий файл: <a href="<?= h($task['file_']) ?>" target="_blank">Скачать</a></small>
                <?php endif; ?>
            </div>
            <button type="submit" class="btn btn-primary">Сохранить изменения</button>
        </form>
    </div>
</main>
<?php require_once(COMPONENTS . "/footer.php"); ?>
