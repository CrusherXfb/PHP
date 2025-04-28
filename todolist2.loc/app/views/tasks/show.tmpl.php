<?php require_once(COMPONENTS . "/header.php");
$title = h($task['title']);
$description = h($task['description']);
$priority = h($task['priority']);
$due_date = h($task['due_date']);
$hashtag = h($task['hashtag']);
$comment = h($task['comment']);
?>

<main class="main py-3">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <h3 class="mb-0"><?= $title ?></h3>
                    </div>
                    <div class="card-body">
                        <p class="card-text"><?= $description ?? 'Нет описания' ?></p>

                        <div class="mb-4">
                            <strong>Приоритет:</strong> <?= $priority ?>
                        </div>

                        <div class="mb-3">
                            <strong>Дата окончания:</strong> <?= $due_date ?? 'Дата не установлена' ?>
                        </div>

                        <div class="mb-3">
                            <strong>Хэштег:</strong> <?= $hashtag ?? 'Нет хэштега' ?>
                        </div>

                        <div class="mb-3">
                            <strong>Комментарий:</strong> <?= $comment ?? 'Без комментариев' ?>
                        </div>

                        <div class="mb-3">
                            <strong>Прикрепленный файл:</strong>
                            <?php if (!empty($task['file_'])): ?>
                                <a href="<?= h($task['file_']) ?>" target="_blank" class="btn btn-link">Скачать файл</a>
                            <?php else: ?>
                                Нет прикрепленного файла
                            <?php endif; ?>
                        </div>

                        <div class="button-group">
                            <form action="tasks" method="POST" style="display:inline;">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="id" value="<?= h($task['id']) ?>">
                                <button type="submit" class="btn btn-outline-danger">Удалить задачу</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php require_once(COMPONENTS . "/footer.php"); ?>