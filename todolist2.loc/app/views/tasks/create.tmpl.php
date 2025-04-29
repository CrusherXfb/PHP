<?php require_once(COMPONENTS . "/header.php"); ?>
<main class="main py-3">
    <div class="container" style="max-width: 600px;">
        <h1>Создать задачу</h1>
        <form method="POST" action="tasks/create" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">Название:</label>
                <input type="text" class="form-control" id="title" name="title" value="<?= old('title') ?>" required>
                <?= isset($validationResult) ? $validationResult->listErrors("title") : "" ?>
            </div>
            <div class="form-group">
                <label for="description">Описание:</label>
                <textarea class="form-control" id="description" name="description"><?= old('description') ?></textarea>
            </div>
            <div class="form-group">
                <label>Приоритет:</label>
                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                    <label class="btn btn-outline-danger <?= old('priority') === 'high' ? 'active' : '' ?>">
                        <input type="radio" name="priority" value="high" autocomplete="off" <?= old('priority') === 'high' ? 'checked' : 'checked' ?>> Высокий
                    </label>
                    <label class="btn btn-outline-warning <?= old('priority') === 'medium' ? 'active' : '' ?>">
                        <input type="radio" name="priority" value="medium" autocomplete="off" <?= old('priority') === 'medium' ? 'checked' : '' ?>> Средний
                    </label>
                    <label class="btn btn-outline-success <?= old('priority') === 'low' ? 'active' : '' ?>">
                        <input type="radio" name="priority" value="low" autocomplete="off" <?= old('priority') === 'low' ? 'checked' : '' ?>> Низкий
                    </label>
                </div>
                <?= isset($validationResult) ? $validationResult->listErrors("priority") : "" ?>
            </div>
            <div class="form-group">
                <label for="due_date">Дата окончания:</label>
                <input type="date" class="form-control" id="due_date" name="due_date" value="<?= old('due_date') ?>">
            </div>
            <div class="form-group">
                <label for="hashtag">Хэштег:</label>
                <input type="text" class="form-control" id="hashtag" name="hashtag" value="<?= old('hashtag') ?>">
            </div>
            <div class="form-group">
                <label for="comment">Комментарий:</label>
                <textarea class="form-control" id="comment" name="comment"><?= old('comment') ?></textarea>
            </div>
            <div class="form-group">
                <label for="file">Прикрепить файл:</label>
                <input type="file" class="form-control-file" id="file_" name="file_">
            </div>
            <button type="submit" class="btn btn-primary">Создать</button>
        </form>
    </div>
</main>
<?php require_once(COMPONENTS . "/footer.php"); ?>
