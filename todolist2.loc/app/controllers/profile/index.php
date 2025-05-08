<?php
global $db;

if (!isset($_SESSION['user_id'])) {
    redirect('/login');
}

$userId = $_SESSION['user_id'];

if (!$db) {
    $_SESSION['error'] = 'Ошибка подключения к базе данных';
    redirect('');
}

$query = $db->query("SELECT id, username, created_at FROM users WHERE id = :id", ['id' => $userId]);
if ($query === false) {
    $_SESSION['error'] = 'Ошибка при выполнении запроса к базе данных';
    redirect('');
}

$user = $query->find();
if (!$user) {
    $_SESSION['error'] = 'Пользователь не найден';
    redirect('');
}

//Запрос для получения статистики задач пользователя
$taskStatsQuery = $db->query("
    SELECT 
        COUNT(*) as total_tasks,
        SUM(CASE WHEN completed = 1 THEN 1 ELSE 0 END) as completed_tasks
    FROM tasks 
    WHERE user_id = :user_id
", ['user_id' => $userId]);

//Если неудачно
if ($taskStatsQuery === false) {
    $taskStats = [
        'total_tasks' => 0,
        'completed_tasks' => 0
    ];
} else {
    $taskStats = $taskStatsQuery->find() ?: [
        'total_tasks' => 0,
        'completed_tasks' => 0
    ];
}

//Запрос для получения статистики подзадач пользователя
$subtaskStatsQuery = $db->query("
    SELECT 
        COUNT(*) as total_subtasks,
        SUM(CASE WHEN s.completed = 1 THEN 1 ELSE 0 END) as completed_subtasks
    FROM subtasks s
    JOIN tasks t ON s.task_id = t.id
    WHERE t.user_id = :user_id
", ['user_id' => $userId]);

//Если неудачно
if ($subtaskStatsQuery === false) {
    $subtaskStats = [
        'total_subtasks' => 0,
        'completed_subtasks' => 0
    ];
} else {
    $subtaskStats = $subtaskStatsQuery->find() ?: [
        'total_subtasks' => 0,
        'completed_subtasks' => 0
    ];
}

$registrationDate = new DateTime($user['created_at']);
$formattedDate = $registrationDate->format('d.m.Y');

$completionRate = 0;
if ($taskStats['total_tasks'] > 0) {
    $completionRate = round(($taskStats['completed_tasks'] / $taskStats['total_tasks']) * 100);
}

$title = 'Мой профиль';

require_once VIEWS . '/profile/index.tmpl.php';