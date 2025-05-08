<?php
require_once(COMPONENTS . "/header.php");
require_once CORE . '/hashtag_helpers.php';
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
                        <div class="d-flex align-items-center">
                            <input type="checkbox" class="task-checkbox me-2" 
                                   data-id="<?= $task['id'] ?>" 
                                   <?= isset($task['completed']) && $task['completed'] ? 'checked' : '' ?>>
                            <h3 class="mb-0 <?= isset($task['completed']) && $task['completed'] ? 'text-decoration-line-through' : '' ?>">
                                <?= $title ?>
                            </h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Прогресс-бар выполнения задачи -->
                        <?php 
                        $subtaskCount = getSubtaskCount($db, $task['id']);
                        $completedSubtaskCount = getCompletedSubtaskCount($db, $task['id']);
                        $progressPercentage = $subtaskCount > 0 ? round(($completedSubtaskCount / $subtaskCount) * 100) : 0;
                        ?>
                        
                        <?php if ($subtaskCount > 0): ?>
                        <div class="progress mb-3" style="height: 15px;">
                            <div class="progress-bar" role="progressbar" 
                                 style="width: <?= $progressPercentage ?>%;" 
                                 aria-valuenow="<?= $progressPercentage ?>" 
                                 aria-valuemin="0" 
                                 aria-valuemax="100">
                                <?= $progressPercentage ?>%
                            </div>
                        </div>
                        <p class="text-muted mb-3">
                            Выполнено: <?= $completedSubtaskCount ?>/<?= $subtaskCount ?> подзадач
                        </p>
                        <?php endif; ?>
                        
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
                                <p><strong>Прикрепленный файл:</strong> 
                                    <a href="tasks/download?id=<?= h($task['id']) ?>" class="btn btn-sm btn-primary">
                                        <i class="fas fa-download"></i> Скачать файл
                                    </a>
                                </p>
                            <?php else: ?>
                                <p class="text-muted">Нет прикрепленного файла</p>
                            <?php endif; ?>
                        </div>

                        <!-- Подзадачи -->
                        <div class="subtasks-container mt-4">
                            <h4>Подзадачи</h4>
                            
                            <!-- Список существующих подзадач -->
                            <ul class="list-group mb-3">
                                <?php if (!empty($subtasks)): ?>
                                    <?php foreach ($subtasks as $subtask): ?>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <div class="form-check">
                                                <input class="form-check-input subtask-checkbox" type="checkbox" 
                                                       data-id="<?= $subtask['id'] ?>" 
                                                       <?= isset($subtask['completed']) && $subtask['completed'] ? 'checked' : '' ?>>
                                                <span class="<?= isset($subtask['completed']) && $subtask['completed'] ? 'text-decoration-line-through' : '' ?>">
                                                    <?= h($subtask['title']) ?>
                                                </span>
                                            </div>
                                            <button class="btn btn-sm btn-danger delete-subtask" data-id="<?= $subtask['id'] ?>">
                                                Удалить
                                            </button>
                                        </li>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <li class="list-group-item text-muted">Нет подзадач</li>
                                <?php endif; ?>
                            </ul>
                            
                            <!-- Форма для добавления новой подзадачи -->
                            <form action="tasks/add-subtask" method="POST" class="d-flex">
                                <input type="hidden" name="task_id" value="<?= h($task['id']) ?>">
                                <input type="text" name="subtask_title" class="form-control me-2" placeholder="Новая подзадача" required>
                                <button type="submit" class="btn btn-primary">Добавить</button>
                            </form>
                        </div>

                        <div class="button-group mt-4">
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

<style>
.subtasks-container {
    border-top: 1px solid #dee2e6;
    padding-top: 15px;
}

.subtask-checkbox:checked + span {
    text-decoration: line-through;
    color: #6c757d;
}
</style>

<!-- скрипт подключается здесь, были попытки подключить его в footer, но в этом случае он работал некорректно -->
<script src="/js/task-details.js"></script>

<?php require_once(COMPONENTS . "/footer.php"); ?>