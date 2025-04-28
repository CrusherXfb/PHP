<?php
$high_pririty_tasks = $db->query("SELECT * FROM tasks WHERE user_id = {$_SESSION['user_id']} ORDER BY priority ASC LIMIT 10;")->findAll();
$today = new DateTime();
$two_days_later = $today->modify('+2 days')->format('Y-m-d');
?>

<div class="col-3"> 
    <h3>Высокий приоритет</h3>
    <ul class="list-group">
        <?php foreach ($high_pririty_tasks as $task): ?>
            <?php
            $due_date = $task['due_date'];
            if ($due_date != null) {
                $is_near_deadline = $due_date <= $two_days_later;
            }
            ?>
            <li class="list-group-item <?= $is_near_deadline ? 'near-deadline' : '' ?>"
                style="display: flex; justify-content: space-between; align-items: center; cursor: pointer;"
                onclick="window.location.href='tasks?id=<?= $task['id'] ?>'">
                <span><?= $task['title'] ?></span>
                <span><?= $task['due_date'] ?></span>
            </li>
        <?php endforeach ?>
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