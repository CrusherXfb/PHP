<?php
//10 задач, у которых высокий приоритет и которые не выполнены
$user_id = $_SESSION['user_id'];
$high_priority_tasks = $db->query("SELECT * FROM tasks WHERE user_id = ? AND priority = 'high' AND (completed = 0 OR completed IS NULL) ORDER BY due_date ASC LIMIT 10;", [$user_id])->findAll();
$today = new DateTime();
$two_days_later = $today->modify('+2 days')->format('Y-m-d');
?>

<div class="col-3">
    <h3>Высокий приоритет</h3>
    <ul class="list-group">
        <?php foreach ($high_priority_tasks as $task): ?>
            <?php
            $due_date = $task['due_date'];
            $is_near_deadline = $due_date != null && $due_date <= $two_days_later;
            ?>
            <!-- Если срок выполнения в ближайшие два дня или просрочен -->
            <li class="list-group-item <?= $is_near_deadline ? 'near-deadline' : '' ?>"
                style="display: flex; justify-content: space-between; align-items: center; cursor: pointer;"
                onclick="window.location.href='tasks?id=<?= $task['id'] ?>'">
                <span><?= $task['title'] ?></span>
                <span><?= $due_date ? $due_date : 'Нет даты' ?></span>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

<style>
    .list-group-item:hover {
        background-color: #f0f0f0;
    }

    .near-deadline {
        color: red;
    }
</style>
