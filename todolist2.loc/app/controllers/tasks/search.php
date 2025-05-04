<?php
global $db;

// Проверка на авторизацию
if (!isset($_SESSION['user_id'])) {
    redirect('login');
}

$title = "Поиск задач";
$query = trim($_GET['query'] ?? '');
$tasks = [];

if (!empty($query)) {
    $userId = $_SESSION['user_id'];
    $searchParam = "%{$query}%";
    
    // Поиск по всем полям задачи и по тегам
    $sql = "SELECT DISTINCT t.* FROM tasks t
            LEFT JOIN task_hashtags th ON t.id = th.task_id
            LEFT JOIN hashtags h ON th.hashtag_id = h.id
            WHERE t.user_id = :user_id 
            AND (
                t.title LIKE :query 
                OR t.description LIKE :query 
                OR t.comment LIKE :query
                OR h.name LIKE :query
            )";
    
    $result = $db->query($sql, [
        'user_id' => $userId,
        'query' => $searchParam
    ]);
    
    if ($result) {
        $tasks = $result->findAll();
    }
}

require_once VIEWS . "/tasks/search.tmpl.php";