<?php
require_once(COMPONENTS . "/header.php");
require_once APP . '/helpers/hashtag_helpers.php';
$title = h($task['title']);
$description = h($task['description']);
$priority = h($task['priority']);
$due_date = h($task['due_date']);
$comment = h($task['comment']);
$hashtags = getTaskHashtags($db, $task['id']);

// Преобразование значений приоритета в читаемые строки
switch ($priority) {
    case 'high':
        $priorityText = '<span style="color: red;">Высокий</span>';
        break;
    case 'medium':
        $priorityText = '<span style="color: orange;">Средний</span>';
        break;
    case 'low':
        $priorityText = '<span style="color: green;">Низкий</span>';
        break;
    default:
        $priorityText = 'Неизвестный приоритет';
}
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
                        <div class="task-details">
                        <?php if (!empty($task['comment'])): ?>
                                <p><strong>Комментарий:</strong> <?= h($task['comment']) ?></p>
                            <?php endif; ?>
                            <p class="description"><?= h($task['description']) ?></p>
                            <p><strong>Приоритет:</strong> <?= $priorityText ?></p>
                            
                            <?php if (!empty($hashtags)):?>
                                <div class="hashtags mb-3">
                                    <strong>Хэштеги:</strong>
                                    <?php foreach ($hashtags as $hashtag): ?>
                                        <span class="badge bg-info text-dark me-1">#<?= h($hashtag['name']) ?></span>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>

                            <?php if (!empty($task['comment'])): ?>
                                <p><strong>Комментарий:</strong> <?= h($task['comment']) ?></p>
                            <?php endif; ?>

                            <?php if (!empty($task['due_date'])): ?>
                                <p><strong>Срок выполнения:</strong> <?= date('d.m.Y', strtotime($task['due_date'])) ?></p>
                            <?php endif; ?>

                            <?php if (!empty($task['created_at'])): ?>
                                <p><strong>Создано:</strong> <?= date('d.m.Y H:i', strtotime($task['created_at'])) ?></p>
                            <?php endif; ?>

                            <?php if (!empty($task['updated_at']) && $task['updated_at'] != $task['created_at']): ?>
                                <p><strong>Последнее обновление:</strong>
                                    <?= date('d.m.Y H:i', strtotime($task['updated_at'])) ?></p>
                            <?php endif; ?>

                            <?php if (!empty($task['file_'])): ?>
                                <a href="<?= h($task['file_']) ?>" target="_blank" class="btn btn-link">Скачать файл</a>
                            <?php else: ?>
                                Нет прикрепленного файла
                            <?php endif; ?>
                        </div>

                        <div class="button-group">
                            <a href="tasks/update?id=<?= h($task['id']) ?>"
                                class="btn btn-outline-primary">Редактировать задачу</a>

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