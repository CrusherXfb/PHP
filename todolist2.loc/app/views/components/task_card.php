<div class="col-md-6 col-lg-4 mb-3">
    <div class="card h-100 shadow-sm">
        <!-- Индикатор приоритета в виде цветной полосы сверху карточки -->
        <div class="card-priority-indicator" style="height: 5px; background-color: 
            <?= $task['priority'] === 'high' ? '#dc3545' : ($task['priority'] === 'medium' ? '#ffc107' : '#28a745') ?>;">
        </div>

        <!-- заголовок -->
        <div class="card-header d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <?php if (isset($showCheckbox) && $showCheckbox): ?>
                <input type="checkbox" class="task-checkbox me-2" 
                       data-id="<?= $task['id'] ?>" 
                       <?= isset($task['completed']) && $task['completed'] ? 'checked' : '' ?>>
                <?php endif; ?>
                <h5 class="card-title mb-0 <?= isset($task['completed']) && $task['completed'] ? 'text-decoration-line-through' : '' ?>" 
                    title="<?= h($task['title']) ?>">
                    <?= h($task['title']) ?>
                </h5>
            </div>
            
            <!-- приоритет -->
            <div class="priority-badge px-2 py-1 rounded" style="background-color: 
                <?= $task['priority'] === 'high' ? '#ffebee' : ($task['priority'] === 'medium' ? '#fff8e1' : '#e8f5e9') ?>; 
                color: <?= $task['priority'] === 'high' ? '#c62828' : ($task['priority'] === 'medium' ? '#ff8f00' : '#2e7d32') ?>; 
                border: 1px solid <?= $task['priority'] === 'high' ? '#ffcdd2' : ($task['priority'] === 'medium' ? '#ffe0b2' : '#c8e6c9') ?>; 
                font-weight: bold; font-size: 0.8rem;">
                <?= $task['priority'] === 'high' ? 'Высокий' : ($task['priority'] === 'medium' ? 'Средний' : 'Низкий') ?>
            </div>
        </div>

        <!-- тело карточки -->
        <div class="card-body py-2">
            <?php if (isset($task['due_date']) && !empty($task['due_date'])): ?>
                <p class="card-text mb-1 small">
                    <i class="fas fa-calendar-alt"></i>
                    <?= date('d.m.Y', strtotime($task['due_date'])) ?>
                </p>
            <?php endif; ?>

            <!-- прогресс-бар -->
            <?php if (isset($showProgress) && $showProgress): ?>
                <?php 
                $subtaskCount = getSubtaskCount($db, $task['id']);
                $completedSubtaskCount = getCompletedSubtaskCount($db, $task['id']);
                $progressPercentage = $subtaskCount > 0 ? round(($completedSubtaskCount / $subtaskCount) * 100) : 0;
                ?>
                <?php if ($subtaskCount > 0): ?>
                <div class="progress mt-2" style="height: 10px;">
                    <div class="progress-bar" role="progressbar" 
                         style="width: <?= $progressPercentage ?>%;" 
                         aria-valuenow="<?= $progressPercentage ?>" 
                         aria-valuemin="0" 
                         aria-valuemax="100">
                    </div>
                </div>
                <div class="small text-muted mt-1">
                    Выполнено: <?= $completedSubtaskCount ?>/<?= $subtaskCount ?> (<?= $progressPercentage ?>%)
                </div>
                <?php endif; ?>
            <?php endif; ?>

            <!-- хэштеги -->
            <?php $hashtags = getTaskHashtags($db, $task['id']); ?>
            <?php if (!empty($hashtags)): ?>
                <div class="hashtags mt-2">
                    <div class="hashtags mb-3">
                        <strong>Хэштеги:</strong>
                        <?php foreach ($hashtags as $hashtag): ?>
                            <span class="badge bg-info text-dark me-1">#<?= h($hashtag["name"]) ?></span>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- управление задачами -->
        <div class="card-footer bg-white border-top-0 pt-0">
            <div class="btn-group btn-group-sm w-100">
                <a href="tasks?id=<?= $task['id'] ?>" class="btn btn-outline-primary">Подробнее</a>
                <a href="tasks/update?id=<?= $task['id'] ?>" class="btn btn-outline-secondary">Изменить</a>
                <!-- изначально кнопка была в форме, но ради сохранения внешнего вида кнопок пришлось вынести её за пределы формы -->
                <a href="#" onclick="event.preventDefault(); document.getElementById('delete-form-<?= $task['id'] ?>').submit();" class="btn btn-outline-danger">Удалить</a>
            </div>
            <form id="delete-form-<?= $task['id'] ?>" action="tasks" method="POST" style="display: none;">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="id" value="<?= $task['id'] ?>">
            </form>
        </div>
    </div>
</div>